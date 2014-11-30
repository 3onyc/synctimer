<?php
use Carbon\Carbon;

class CountdownView extends TimerView
{
    public static function fromForm(array $input)
    {
        $view = parent::fromForm($input);
        $view->target = Carbon::parse($input['target_date'] . ' ' . $input['target_time']);

        return $view;
    }
}
