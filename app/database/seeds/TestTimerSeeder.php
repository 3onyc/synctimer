<?php

class TestTimerSeeder extends Seeder
{
	public function run()
	{
		Eloquent::unguard();

        Timer::create([
            'name' => 'foobar',
            'type' => Timer::STOPWATCH,
            'target' => new DateTime(),
            'user_id' => 1
        ]);
	}
}

