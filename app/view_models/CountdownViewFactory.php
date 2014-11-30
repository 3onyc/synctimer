<?php
class CountdownViewFactory
{
    /**
     * @var Countdown
     */
    protected $countdown;

    public function __construct(Countdown $countdown)
    {
        $this->countdown = $countdown;
    }

    public function forForm()
    {
        return CountdownView::forForm($this->countdown);
    }
    public function fill(array $input)
    {
        return CountdownView::fill($this->countdown, $input);
    }
    public function fromForm(array $input, $offset = 0)
    {
        return CountdownView::fromForm($input, $offset);
    }
    public function fromModel()
    {
        return CountdownView::fromModel($this->countdown);
    }
}
