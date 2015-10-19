<?php

use Illuminate\Database\Seeder;

use Twine\String;

class StringSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		DB::table('strings')->delete();

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
				'value'      => $value,
				'locale'     => 'en',
				'created_by' => 1,
			];
			
			$string = String::create($string);
		}
	}
}
