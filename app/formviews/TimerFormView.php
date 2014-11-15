<?php

class TimerFormView
{
    /**
     * @var Timer
     */
    protected $model;

    public function __construct(Timer $model = null)
    {
        $this->model = $model ?: new Timer;
    }

    public static function fromInput(array $input, Timer $model = null)
    {
        if (!$model) {
            $model = new Model(['target' => new DateTime]);
        }

        $model->fill(self::normalizeInput($input));
        return new TimerFormView($model);
    }

    protected static function normalizeInput(array $input)
    {
        if ($input['type'] === Timer::COUNTDOWN) {
            $input['target'] = DateTime::createFromFormat(
                "Y-m-d H:i:s",
                $input['target_date'] . ' ' . $input['target_time']
            );
        }

        return $input;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function formData(Timer $model)
    {
        return (new TimerFormView($model))->getFormData();
    }

    public function getFormData()
    {
        if ($this->model->type === Timer::STOPWATCH) {
            list($target_date, $target_time) = [null, null];
        } else {
            list($target_date, $target_time) = explode(" ", $this->model->target);
        }

        return [
            'name' => $this->model->name,
            'type' => $this->model->type,
            'target_date' => $target_date,
            'target_time' => $target_time
        ];
    }

    public function validator()
    {
        return TimerFormValidator::make($this->getFormData());
    }

    protected function isNew()
    {
        return !$this->model->id;
    }

}
