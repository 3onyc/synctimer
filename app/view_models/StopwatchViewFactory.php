<?php
class StopwatchViewFactory
{
    /**
     * @var Stopwatch
     */
    protected $stopwatch;

    public function __construct(Stopwatch $stopwatch)
    {
        $this->stopwatch = $stopwatch;
    }

    public function forForm()
    {
        return StopwatchView::forForm($this->stopwatch);
    }
    public function fill(array $input)
    {
        return StopwatchView::fill($this->stopwatch, $input);
    }
    public function fromForm(array $input, $offset = 0)
    {
        return StopwatchView::fromForm($input, $offset);
    }
    public function fromModel()
    {
        return StopwatchView::fromModel($this->stopwatch);
    }
}
