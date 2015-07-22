<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		Eloquent::unguard();

        User::create([
            'username' => 'admin',
            'password' => Hash::make('toor'),
            'email' => 'admin@localhost'
        ]);
	}
}
