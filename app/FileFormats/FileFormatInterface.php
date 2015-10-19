<?php

namespace Twine\FileFormats;

interface FileFormatInterface
{
	public function read($file);
	
	public function write($file, $data);
}