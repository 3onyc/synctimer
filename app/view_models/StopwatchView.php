<?php
class StopwatchView extends TimerView
{
    public static function fill(Timer $timer, array $input)
    {
        $data = static::fromForm($input)->toArray();
        unset($data['target']);

        $timer->fill($data);
    }
}
