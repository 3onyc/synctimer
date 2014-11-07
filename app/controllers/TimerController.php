<?php

class TimerController extends \BaseController {

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
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
			'diff' => $this->getDiff($timer)->format('%H:%I:%S')
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
		//
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
