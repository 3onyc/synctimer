<?php
class Timer extends Eloquent
{
    const COUNTDOWN = 'countdown';
    const STOPWATCH = 'stopwatch';

    protected $fillable = ['name', 'type', 'target', 'private'];
    protected $hidden = ['user_id'];

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

    public function fillFromForm(array $input)
    {
        return $this->getViewFactory()->fill($this, $input);
    }

    public function toForm()
    {
        return $this->getViewFactory()->forForm($this);
    }

    public function view()
    {
        return $this->getViewFactory()->fromModel($this);
    }

    public function getViewFactory()
    {
        throw new RuntimeException("Not Implemented!");
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'target'];
    }
}
