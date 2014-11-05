<?php
class Timer extends Eloquent
{
    const COUNTDOWN = 'countdown';
    const STOPWATCH = 'stopwatch';

	/**
	 * @var string
	 */
	protected $table = 'timers';
}
