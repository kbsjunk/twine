<?php

namespace Twine\FileFormats;

use Twine\Source;
use Twine\String;

abstract class AbstractFileFormat
{
	protected $path;
	protected $locale;
	protected $format;
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

	public function getPath()
	{
		return $this->path;
	}
	
	public function getSource()
	{
		return $this->source;
	}
	
	public function setSource(Source $source)
	{
		$this->source = $source;
		
		return $this;
	}
	
	protected function read($path)
	{
		$this->setPath($path);
		$this->contents = file_get_contents($this->path);

		return $this;
	}
	
	// protected function write($path, $contents)
	// {
	// 	$this->setPath($path);
	// 	$this->contents = $contents;
		
	// 	file_put_contents($this->path, $contents);
		
	// 	return $this;
	// }
	
	protected function makeSource()
	{
		if (empty($this->source)) {
			
			$locale = $this->locale;
			$format = $this->format;
			$path = $this->path;

			$this->source = Source::create(compact('locale', 'format', 'path'));
		}
		
		return $this;
	}
	
	protected function makeString($uri, $key, $value, $plural = null, $comment = null, $placeholders = null)
	{
		$source_id = $this->source->id;
		$locale = $this->locale;
		$uri = String::makeUri($uri);

		$string = String::firstOrNew(compact('locale', 'uri', 'source_id'));
		$string->fill(compact('key', 'value', 'plural', 'comment', 'placeholders'))->save();
		
		$this->strings[] = $string;
		
		return $this;
	}
	
}