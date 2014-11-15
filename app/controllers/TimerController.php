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
        $formView = TimerFormView::fromInput(Input::only(self::$fields));
        $validator = $formView->validator();

        if ($validator->fails()) {
            Session::flashInput($formView->getFormData());
            return $this->create($validator->messages());
        }

        $formView->getModel()->save();

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
            'timer' => $timer
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
        $timer = Timer::findOrFail($id);

        Session::flashInput(TimerFormView::formData($timer));
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
        $timer = Timer::findOrFail($id);
        $formView = TimerFormView::fromInput(Input::only(self::$fields), $timer);
        $validator = $formView->validator();

        if ($validator->fails()) {
            Session::flashInput($formView->getFormData());
            return $this->edit($id, $validator->messages());
        }

        $formView->getModel()->save();

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
}
