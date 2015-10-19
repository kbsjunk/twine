<?php

namespace Twine\Console\Commands;

use Illuminate\Console\Command;
use Twine\FileFormats\Factory;

use Twine\Source;

class ReloadFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twine:reload
    {source : The database ID of the source to reload.}
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

        $source = Source::find($this->argument('source'));

        $path = $this->argument('path');
        $format = $source->format;
        $locale = $source->locale;
        
        $loader = Factory::make($format, $locale);
        
        $loader->setSource($source);
        $output = $loader->read($path);
        
        dd($output);
        
    }
}
