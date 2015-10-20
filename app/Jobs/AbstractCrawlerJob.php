<?php

namespace Twine\Jobs;

use Twine\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use Goutte\Client;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractCrawlerJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
	
	protected $client;
	protected $crawler;
	protected $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Client $client)
    {
        $this->client = $client;
		$this->model = $this->model->fresh();
		
		$this->crawler = $this->client->request('GET', $this->model->url);		
		$this->process();
    }
}
