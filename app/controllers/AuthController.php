<?php

use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class AuthController extends \BaseController
{
    /**
     * @return Response
     */
    public function showLogin()
    {
        return View::make('auth.login');
    }

    /**
     * Handle user logging in
     *
     * @return Response
     */
    public function login()
    {
        $input = Input::only(['username', 'password']);
        $validator = LoginValidator::make($input);

        if ($validator->fails()) {
            return $this->loginError($validator);
        }

        if (!Auth::attempt($input)) {
            return $this->loginError([
                'username' => ['Invalid username and/or password']
            ]);
        }

        return Redirect::intended(route('home'));
    }

    /**
     * @param array|Validator $errors
     *
     * @return RedirectResponse
     */
    protected function loginError($errors)
    {
        return Redirect::to('login')
            ->with(Input::only(['username']))
            ->withErrors($errors);
    }

    /**
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return Redirect::to('login');
    }
}
