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
