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

    /**
     * @var bool
     */
    private $local;

    /**
     * @var int
     */
    private $offset;

    public function __construct()
    {
        $this->local = false;
        $this->offset = 0;
    }

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

    public function getLocal($offset)
    {
        if ($this->local) {
            throw new RuntimeException("View already in Local timezone");
        }

        $view = clone $this;

        $view->target = $view->target->copy()->subMinutes($offset);
        $view->local = true;
        $view->offset = $offset;

        return $view;
    }

    public function getUTC()
    {
        if (!$this->local) {
            throw new RuntimeException("View already in UTC timezone");
        }

        $view = clone $this;

        $view->target = $view->target->copy()->addMinutes($this->offset);
        $view->local = false;
        $view->offset = 0;

        return $view;
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

    public function fill(Timer $timer)
    {
        $timer->fill($this->toArray());
    }

    public static function fromForm(array $input, $offset = 0)
    {
        $view = new static();
        $view->name = $input['name'];
        $view->type = $input['type'];
        $view->private = isset($input['private']);

        $view->local = $offset != 0;
        $view->offset = $offset;

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
