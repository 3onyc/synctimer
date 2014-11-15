<?php

class TimerController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('auth', array('except' => 'show'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('timer.index', [
            'timers' => Timer::all()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($errors = null)
    {
        $view = [];
        if ($errors) {
            $view['errors'] = $errors;
        }

        return View::make('timer.create', $view);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::only(['name', 'type', 'target-date', 'target-time']);
        $validator = TimerFormValidator::make($input);

        if ($validator->fails()) {
            Session::flashInput($input);
            return $this->create($validator->messages());
        }

        if ($input['type'] === Timer::STOPWATCH) {
            $target = new DateTime;
        } elseif ($input['type'] === Timer::COUNTDOWN) {
            $dateTimeString = $input['target-date'] . ' ' . $input['target-time'];
            $target = DateTime::createFromFormat("Y-m-d H:i:s", $dateTimeString);
        }

        $timer = Timer::create([
            'name' => $input['name'],
            'type' => $input['type'],
            'target' => $target
        ]);

        return Redirect::to(action('TimerController@show', $timer->id));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $timer = Timer::find($id);
        if (!$timer) {
            App::abort(404);
        }

        return View::make('timer.show', [
            'timer' => $timer,
            'diff' => $this->getDiff($timer)->format('%H:%I:%S.000')
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $timer = Timer::findOrFail($id);
        $timer->delete();

        return Redirect::to(action('TimerController@index'));
    }


    /**
     * Reset the specified stopwatch
     *
     * @param  int  $id
     * @return Response
     */
    public function resetStopwatch($id)
    {
        $timer = Timer::findOrFail($id);
        if ($timer->type !== Timer::STOPWATCH) {
            App::abort(400);
        }

        $timer->target = new DateTime;
        $timer->save();

        return Redirect::to(action('TimerController@show', $timer->id));
    }

    /**
     * Get a DateInterval with the difference between now and Timer::target
     *
     * @param Timer $timer
     *
     * @return DateInterval
     */
    protected function getDiff(Timer $timer)
    {
        $now = new DateTimeImmutable;
        $target = new DateTimeImmutable($timer->target);

        return $target->diff($now, true);
    }
}
