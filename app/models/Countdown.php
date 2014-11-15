<?php
class Countdown extends Timer
{
    public function getFormData()
    {
        list($target_date, $target_time) = explode(" ", $this->target);

        return [
            'name' => $this->name,
            'type' => $this->type,
            'target_date' => $target_date,
            'target_time' => $target_time
        ];
    }

    public function fillFromInput(array $input)
    {
        $input['target'] = DateTime::createFromFormat(
            "Y-m-d H:i:s",
            $input['target_date'] . ' ' . $input['target_time']
        );

        $this->fill($input);
    }
}
