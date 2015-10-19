<?php

namespace Twine\FileFormats;

abstract class AbstractJson extends AbstractFileFormat
{
	protected $format = 'abstractJson';
	
	public function read($path)
	{
		$this->read($path);
		
		$this->parsed = json_decode($this->contents, true);
		
		return $this;
	}
	
	public function write($path, $contents)
	{
		// $this->contents;
	}
	
}