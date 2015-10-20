<?php

namespace Twine\FileFormats;

use Geekwright\Po\PoFile;
use Geekwright\Po\PoTokens;
use Geekwright\Po\Exceptions\UnrecognizedInputException;
use Geekwright\Po\Exceptions\FileNotReadableException;

class Gettext extends AbstractFileFormat
{
	protected $format = 'gettext';
	
	public function read($path)
	{

		$this->setPath($path);

		try {
			$poFile = new PoFile();
			$poFile->readPoFile($this->getPath());

			$pluralRule = $poFile->getHeaderEntry()->getHeader('plural-forms');

			dd($pluralRule);

			$entries = $poFile->getEntries();
			foreach($entries as $entry) {
				$key = $entry->getAsString(PoTokens::MESSAGE);
				
				$msgid_plural = $entry->get(PoTokens::PLURAL);

				if (empty($msgid_plural)) {
					$value = $entry->getAsString(PoTokens::TRANSLATED);
				} else {
					$value = $entry->getAsStringArray(PoTokens::TRANSLATED);
				}

				var_dump($key, $value);

			}
		} catch (UnrecognizedInputException $e) {
        // we had unrecognized lines in the file, decide what to do
		} catch (FileNotReadableException $e) {
        // the file couldn't be read, nothing happened
		}

		// $this->makeSource();
		// 
		// $strings = $this->parsed;
		
		// foreach ($strings as $key => $string)
		// {
		// 	if (is_array($string['message']))
		// 	{
		// 		foreach ($string['message'] as $i => $value) {
		// 			$this->makeString([$key, $i], $key, $value);
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$this->makeString($key, $key, $string['message'], null, @$string['description'], @$string['placeholders']);
		// 	}
		// }
		
		dd($this);
		
		return $this;
	}
	
	public function write($path)
	{
		// $this->contents;
	}
	
}