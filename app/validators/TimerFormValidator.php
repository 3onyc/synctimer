<?php
class TimerFormValidator
{
    public static function make(array $input)
    {
        return Validator::make(
            $input,
            [
                'name' => ['required', 'min:4'],
                'type' => ['required', 'in:countdown,stopwatch'],
                'target-date' => ['date_format:Y-m-d', 'required_if:type,countdown'],
                'target-time' => ['date_format:H:i:s', 'required_if:type,countdown']
            ]
        );

    }
}

