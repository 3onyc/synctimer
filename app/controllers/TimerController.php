<?php

use Illuminate\Support\MessageBag;

class TimerController extends \BaseController
{
    private static $fields = [ 'name', 'type', 'target_date', 'target_time' ];

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
            'timers' => Auth::user()->timers
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($errors = null)
    {
        return View::make('timer.create', [
            'errors' => $errors ?: new MessageBag
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::only(self::$fields);
        $validator = TimerFormValidator::make($input);

        if ($validator->fails()) {
            Session::flashInput($input);
            return $this->create($validator->messages());
        }

        $timer = Timer::fromInput($input);
        Auth::user()->timers()->save($timer);

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
        return View::make('timer.show', [
            'timer' => Timer::findOrFail($id)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, $errors = null)
    {
        $timer = Auth::user()->timers()->where('id', '=', $id)->firstOrFail();

        Session::flashInput($timer->getFormData());
        return View::make('timer.edit', [
            'errors' => $errors ?: new MessageBag,
            'id' => $timer->id
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $timer = Auth::user()->timers()->where('id', '=', $id)->firstOrFail();
        $input = Input::only(self::$fields);

        $validator = TimerFormValidator::make($input);
        if ($validator->fails()) {
            Session::flashInput($timer->getFormData());
            return $this->edit($id, $validator->messages());
        }

        $timer->fillFromInput($input);
        $timer->save();

        return Redirect::to(action('TimerController@show', $timer->id));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $timer = Auth::user()->timers()->where('id', '=', $id)->firstOrFail();
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
        $timer = Auth::user()->timers()->where('id', '=', $id)->firstOrFail();
        if (! $timer instanceof Stopwatch) {
            App::abort(400);
        }

        $timer->reset();

        return Redirect::to(action('TimerController@show', $timer->id));
    }
}
