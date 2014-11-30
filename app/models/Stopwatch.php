<?php
class Stopwatch extends Timer
{
    public function __construct($values = [])
    {
        parent::__construct($values);

        // Default to NOW
        if ($this->target === null) {
            $this->target = new DateTime;
        }
    }

    public function reset()
    {
        $this->target = new DateTime;
        $this->save();
    }

    public function getViewFactory()
    {
        return new StopwatchViewFactory($this);
    }
}
