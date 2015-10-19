<?php

namespace Twine\FileFormats;

interface FileFormatInterface
{
	public function read($path);
	
	public function write($path);
}