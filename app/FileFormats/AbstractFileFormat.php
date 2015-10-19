<?php

namespace Twine\FileFormats;

use Twine\Source;
use Twine\String;

abstract class AbstractFileFormat
{
	protected $path;
	protected $contents;
	protected $parsed;
	protected $source;
	protected $strings = [];
	
	public function __construct($locale = null)
	{
		$this->setLocale($locale);
	}
	
	public function setLocale($locale = null)
	{
		$this->locale = $locale ?: config('app.locale');
	}
	
	public function getLocale()
	{
		return $this->locale;
	}
	
	public function setPath($path)
	{
		$this->path = base_path($path);
		
		return $this;
	}
	
	protected function loadPath($path)
	{
		$this->setPath($path);
		$this->contents = file_get_contents($this->path);
		
		return $this;
	}
	
	protected function savePath($path, $contents)
	{
		$this->setPath($path);
		$this->contents = $contents;
		
		file_put_contents($this->path, $contents);
		
		return $this;
	}
	
	protected function makeSource($locale, $format, $path)
	{
		$this->source = Source::create(compact('locale', 'format', 'path'));
		
		return $this;
	}
	
	protected function makeString($locale, $resource, $key, $value, $type = 'string')
	{
		$source_id = $this->source->id;
		
		$this->strings[] = String::create(compact('locale', 'resource', 'key', 'value', 'type', 'source_id'));
		
		return $this;
	}
	
}