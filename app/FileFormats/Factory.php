<?php

namespace Twine\FileFormats;

class Factory
{
	public static function make($format, $locale = null)
	{
		$format = 'Twine\\FileFormats\\'.ucfirst($format);
		
		return new $format($locale);
	}
}