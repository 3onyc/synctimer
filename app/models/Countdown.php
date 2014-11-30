<?php
use Carbon\Carbon;

class Countdown extends Timer
{
    public function __construct()
    {
        $this->target = Carbon::now();
    }

    public function getViewFactory()
    {
        return new CountdownViewFactory($this);
    }
}
