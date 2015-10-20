<?php

namespace Twine\Jobs;

class ApacheCrawlerJob extends AbstractCrawlerJob
{

    /**
     * Process the job.
     *
     * @return void
     */
    public function process()
    {

		$this->crawler->filter('body > table:first-child > tr')->each(function ($node) {
			$link = $node->filter('td:nth-child(2) a')->getLink();
			
		});
		
    }
}
