<?php

namespace Twine\Jobs;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Carbon\Carbon;
use Twine\Repository;
use Twine\Project;
use Twine\Source;
use Twine\String;

class ApacheCrawlerJob extends AbstractCrawlerJob
{
    use DispatchesJobs;

    /**
     * Process the job.
     *
     * @return void
     */
    public function process()
    {
        $class = basename(str_replace('\\','/',get_class($this->model)));
        $function = 'process'.$class;

        if ($function == 'processSource') {
            $this->processSource();
        }
        else {

            $jobs = 0;

            $this->output->writeln('<info>Processing:</info> '.$class);
            $this->output->writeln('<info>Crawling:</info> '.$this->model->url);

            $rows = $this->crawler->filter('body > table')->first()->filter('tr:nth-child(n+4):not(:last-child)');

            $bar = $this->output->createProgressBar(count($rows));

            $rows->each(function ($node) use ($function, $bar, &$jobs) {

                $tds = $node->filter('td');

                $name = trim(implode($tds->eq(1)->extract('_text')), '/');
                $url = $tds->eq(1)->filter('a')->link()->getUri();
                $date = new Carbon(implode($tds->eq(2)->extract('_text')));

                $nextModel = $this->$function($name, $url, $date);

                if ($nextModel) {
                    if (empty($nextModel->crawled_at) || $date->gt($nextModel->crawled_at)) {
                        $this->dispatch(new ApacheCrawlerJob($nextModel));
                        $jobs++;
                    }
                }

                $bar->advance();

            });

            $bar->finish();

            $this->output->writeln('');

            $this->output->writeln('<info>Found:</info> ' . count($rows) . ' URLs');
            $this->output->writeln('<info>Queued:</info> ' . $jobs . ' new jobs');

            $this->output->writeln("Done");
        }
    }

    private function processRepository($name, $url)
    {
        @list($name, $branch) = explode('.', $name, 2);

        $repository_id = $this->model->id;

        $project = Project::firstOrCreate(compact('name', 'branch', 'url', 'repository_id'));

        return $project;
    }

    private function processProject($name, $url)
    {
        $project_id = $this->model->id;

        $path = explode('.',str_replace($this->model->name_branch.'.', '', $name));

        $path = array_filter($path, function($val) {
            return !in_array($val, [$this->model->name, $this->model->name.'-properties', $this->model->branch, 'master', 'properties']);
        });

        $path = implode('.', $path);
        
        $format = pathinfo($path, PATHINFO_EXTENSION);
        $locale = pathinfo($path, PATHINFO_FILENAME);

        if ($locale && $format) {
            $source = Source::firstOrCreate(compact('name', 'locale', 'format', 'url', 'project_id'));
        }
        else {
            $source = false;
        }

        return $source;
    }

    private function processSource()
    {

    }

}
