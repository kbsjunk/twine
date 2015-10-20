<?php

namespace Twine\FileFormats;
use Sabre\Xml\Reader;
use Sabre\Xml\Writer;

abstract class AbstractXml extends AbstractFileFormat
{
	protected $format = 'abstractXml';
	
	public function read($path)
	{
		parent::read($path);
		
		$reader = new Reader;
		
		$reader->xml($this->contents);
		
		$this->parsed = $reader->parse();
		
		return $this;
	}
	
	public function write($path)
	{
		$writer = new Writer;
	}
	
}