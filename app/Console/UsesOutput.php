<?php

namespace Twine\Console;

use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Console\OutputStyle;

trait UsesOutput
{

	/**
	* The output interface implementation.
	*
	* @var \Illuminate\Console\OutputStyle
	*/
	protected $output;

	public function useOutput()
	{
		$input = new ArgvInput;
		$output = new ConsoleOutput;
		$this->output = new OutputStyle($input, $output);
	}
}