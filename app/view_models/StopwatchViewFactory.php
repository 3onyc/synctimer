<?php
class StopwatchViewFactory
{
    public function forForm(Stopwatch $stopwatch)
    {
        return StopwatchView::forForm($stopwatch);
    }
    public function fill(Stopwatch $stopwatch, array $input)
    {
        return StopwatchView::fill($stopwatch, $input);
    }
    public function fromForm(array $input)
    {
        return StopwatchView::fromForm($input);
    }
    public function fromModel(Stopwatch $stopwatch)
    {
        return StopwatchView::fromModel($stopwatch);
    }
}
