<?php
use Carbon\Carbon;

class CountdownView extends TimerView
{
    public static function fromForm(array $input, $offset = 0)
    {
        $view = parent::fromForm($input, $offset);
        $view->target = Carbon::parse($input['target_date'] . ' ' . $input['target_time']);

        return $view;
    }
}
