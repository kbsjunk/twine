<?php

namespace Twine\FileFormats;
use Sabre\Xml\Reader;
use Sabre\Xml\Writer;

abstract class AbstractXML extends AbstractFileFormat
{
	protected $parsed;
	
	public function readXml($path)
	{
		$this->loadPath($path);
		
		$reader = new Reader;
		
		$reader->xml($this->contents);
		
		$this->parsed = $reader->parse();
		
		return $this;
	}
	
	public function writeXml($path, $xml)
	{
		$writer = new Writer;
	}
	
}