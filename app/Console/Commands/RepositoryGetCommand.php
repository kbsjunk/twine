<?php

namespace Twine\Console\Commands;

use Illuminate\Console\Command;
use Twine\FileFormats\Factory;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Twine\Jobs\ApacheCrawlerJob;

use Twine\Repository;

class RepositoryGetCommand extends Command
{
    use DispatchesJobs;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twine:repository:get
    {name : The repository name.}
    {format : The page format.}
    {url : The URL to the repository to load.}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load a language repository URL into Twine.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $format = $this->argument('format');
        $url = $this->argument('url');

        $repository = Repository::firstOrCreate([
            'name'   => $name,
            'format' => $format,
            'url'    => $url,
            ]);

        $this->dispatch(new ApacheCrawlerJob($repository));

        // $job = new ApacheCrawlerJob($repository);

        // $job->handle(new \Goutte\Client);

        // dd($job);

		// $loader = Factory::make($format, $locale);

        // $output = $loader->read($path);

		// dd($output);

    }
}
