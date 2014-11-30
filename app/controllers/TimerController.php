<?php

use Illuminate\Support\MessageBag;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class TimerController extends BaseController
{
    private static $fields = ['name', 'type', 'target_date', 'target_time', 'private'];

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
        $views = array_map(function (Timer $timer) {
            return $timer->view()->getLocal(Session::get('offset'));
        }, Auth::user()->timers->all());

        return View::make('timer.index', [
            'timers' => $views
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
        $input = $this->getInput();
        $validator = TimerFormValidator::make($input);

        if ($validator->fails()) {
            Session::flashInput($input);
            return $this->create($validator->messages());
        }

        $timer = Timer::factory($input['type']);
        $timer
            ->getViewFactory()
            ->fromForm($input, Session::get('offset'))
            ->getUTC()
            ->fill($timer);

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
        $timer = Timer::findOrFail($id);
        if ($timer->private && $timer->user != Auth::user()) {
            throw new AccessDeniedHttpException;
        }

        return View::make('timer.show', [
            'timer' => $timer->view()->getLocal(Session::get('offset'))
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

        Session::flashInput($timer->view()->getLocal(Session::get('offset'))->toForm());
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

        $input = $this->getInput();

        $validator = TimerFormValidator::make($input);
        if ($validator->fails()) {
            Session::flashInput($input);
            return $this->edit($id, $validator->messages());
        }

        $timer
            ->getViewFactory()
            ->fromForm($input, Session::get('offset'))
            ->getUTC()
            ->fill($timer);

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
        $stopwatch = Auth::user()->timers()->where('id', '=', $id)->firstOrFail();
        if (! $stopwatch instanceof Stopwatch) {
            App::abort(400);
        }

        $stopwatch->reset();

        return Redirect::to(action('TimerController@show', $stopwatch->id));
    }

    protected function getInput()
    {
        return Input::only(static::$fields);
    }
}
