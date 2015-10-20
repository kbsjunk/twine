<?php

namespace Twine\FileFormats;

class Chrome extends AbstractJson implements FileFormatInterface
{
	protected $format = 'chrome';

	public function read($path) {

		parent::read($path);
		
		$this->makeSource();
		
		$strings = $this->parsed;
		
		foreach ($strings as $key => $string)
		{
			if (is_array($string['message']))
			{
				foreach ($string['message'] as $i => $value) {
					$this->makeString([$key, $i], $key, $value);
				}
			}
			else
			{
				$this->makeString($key, $key, $string['message'], null, @$string['description'], @$string['placeholders']);
			}
		}
		
		dd($this);
		

		
	}
	
	// public function write($file, $data) {

	// }
	
}