<?php
class CountdownViewFactory
{
    public function forForm(Countdown $countdown)
    {
        return CountdownView::forForm($countdown);
    }
    public function fill(Countdown $countdown, array $input)
    {
        return CountdownView::fill($countdown, $input);
    }
    public function fromForm(array $input)
    {
        return CountdownView::fromForm($input);
    }
    public function fromModel(Countdown $countdown)
    {
        return CountdownView::fromModel($countdown);
    }
}
