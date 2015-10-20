<?php

namespace Twine\Console\Commands;

use Illuminate\Console\Command;
use Twine\FileFormats\Factory;


class LoadFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twine:load
							{format : The file format.}
							{locale : The file locale.}
							{path : The path to the file to load (relative to base_path()).}
							';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load a language file into Twine.';

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
        $format = $this->argument('format');
        $path = $this->argument('path');
        $locale = $this->argument('locale');
		
		$loader = Factory::make($format, $locale);
		
        $output = $loader->read($path);
		
		dd($output);
		
    }
}
