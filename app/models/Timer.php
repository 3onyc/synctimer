<?php
class Timer extends Eloquent
{
    const COUNTDOWN = 'countdown';
    const STOPWATCH = 'stopwatch';

    protected $fillable = ['name', 'type', 'target'];

	/**
	 * @var string
	 */
	protected $table = 'timers';
}
