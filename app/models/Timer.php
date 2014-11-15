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

    /*
     * Single-table inheritance handling
     */
    public function newFromBuilder($attributes = [])
    {
        $attributes = (array)$attributes;

        $timer = self::factory($attributes['type']);
        $timer->exists = true;
        $timer->setRawAttributes($attributes, true);

        return $timer;
    }

    public static function factory($type, $values = [])
    {
        switch($type) {
            case self::COUNTDOWN: return new Countdown($values);
            case self::STOPWATCH: return new Stopwatch($values);
        }

        throw new RuntimeException(sprintf("Unknown timer type '%s'", $type));
    }

    public static function fromInput(array $input)
    {
        $timer = self::factory($input['type']);
        $timer->fillFromInput($input);

        return $timer;
    }
}
