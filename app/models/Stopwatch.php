<?php
class Stopwatch extends Timer
{
    public function getFormData()
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'target_date' => null,
            'target_time' => null
        ];
    }

    public function fillFromInput(array $values)
    {
        $this->fill($values);
    }

    public function reset()
    {
        $this->target = new DateTime;
        $this->save();
    }
}
