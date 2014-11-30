<?php
use Carbon\Carbon;

abstract class TimerView
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $type;

    /**
     * @var Carbon
     */
    public $target;

    /**
     * @var bool
     */
    public $private;

    public function toForm()
    {
        list($targetDate, $targetTime) = explode(' ', $this->target->format('Y-m-d H:i:s'));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'target_date' => $targetDate,
            'target_time' => $targetTime
        ];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'target' => $this->target,
            'private' => $this->private
        ];
    }

    public static function forForm(Timer $timer)
    {
        return static::fromModel($timer)->toForm();
    }

    public static function fill(Timer $timer, array $input)
    {
        $timer->fill(static::fromForm($input)->toArray());
    }

    public static function fromForm(array $input)
    {
        $view = new static();
        $view->name = $input['name'];
        $view->type = $input['type'];
        $view->private = isset($input['private']);

        return $view;
    }

    public static function fromModel(Timer $timer)
    {
        $view = new static();
        $view->id = $timer->id;
        $view->name = $timer->name;
        $view->type = $timer->type;
        $view->target = $timer->target->copy();
        $view->private = $timer->private;

        return $view;
    }
}
