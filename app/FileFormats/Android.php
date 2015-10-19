<?php

namespace Twine\FileFormats;

class Android extends AbstractXML implements FileFormatInterface
{
	public function read($file) {
		
		$this->readXml($file);
		$this->makeSource($this->locale, 'android', $file);
		
		$resources = $this->parsed['value'];
		
		foreach ($resources as $resource)
		{
			if ($resource['name'] == '{}string')
			{
				$this->makeString($this->locale, $resource['attributes']['name'], $resource['attributes']['name'], $resource['value'], 'string');
			}
			elseif ($resource['name'] == '{}string-array')
			{
				$i = 0;
				foreach ($resource['value'] as $value) {
					$this->makeString($this->locale, $resource['attributes']['name'].'.'.$i, $resource['attributes']['name'], $value['value'], 'array');
					$i++;
				}
			}
			elseif ($resource['name'] == '{}plurals')
			{
				foreach ($resource['value'] as $value) {
					$this->makeString($this->locale, $resource['attributes']['name'].'.'.$value['attributes']['quantity'], $resource['attributes']['name'], $value['value'], 'plural');
				}
			}
		}
		
		dd($this);
		

		
	}
	
	public function write($file, $data) {
		
	}
	
}