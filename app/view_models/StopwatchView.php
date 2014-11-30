<?php
class StopwatchView extends TimerView
{
    public function fill(Timer $timer, array $input)
    {
        $timer->fill(array_except($this->toArray(), ['target']));
    }
}
