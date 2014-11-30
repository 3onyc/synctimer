<?php

class TimezoneController extends BaseController
{
    public function setTimezone()
    {
        if (!Input::has('offset')) {
            App::abort(400);
        }

        Session::set('offset', Input::get('offset'));
        return Response::json(true);
    }
}
