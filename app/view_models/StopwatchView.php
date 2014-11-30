<?php
class StopwatchView extends TimerView
{
    public function fill(Timer $timer)
    {
        $timer->fill(array_except($this->toArray(), ['target']));
    }
}
