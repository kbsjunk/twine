<?php

use Illuminate\Database\Seeder;

use Twine\User;

class UserSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		DB::table('users')->delete();

		$users = [
			'system@twine' => 'Twine',
			'admin@twine'  => 'Administrator',
			'user@twine'   => 'User',
		];

		foreach ($users as $email => $name) {
			$user = [
				'email'    => $email,
				'name'     => $name,
				'password' => bcrypt('password'),
			];
			
			$user = User::create($user);
		}
	}
}
