<?php

use Illuminate\Database\Seeder;

use Twine\Source;
use Twine\String;
use Twine\User;

class SourceStringSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		DB::table('sources')->delete();
		DB::table('strings')->delete();

		$source = [
			'locale'     => 'en',
			'format'     => 'twine',
			'path'       => null,
		];

		$source = Source::create($source);

		$strings = [
			'save'   => 'Save',
			'load'   => 'Load',
			'new'    => 'New',
			'open'   => 'Open',
			'close'  => 'Close',
			'ok'     => 'OK',
			'cancel' => 'Cancel',
			'delete' => 'Delete',
		];

		foreach ($strings as $key => $value) {
			$string = [
				'key'        => $key,
				'uri'        => 'basic.'.$key,
				'value'      => $value,
				'locale'     => 'en',
				'source_id'  => $source->id,
			];
			
			$string = String::create($string);
		}
		
	}
}
