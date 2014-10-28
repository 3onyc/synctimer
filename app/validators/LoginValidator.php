<?php
class LoginValidator
{
    public static function make($input)
    {
        return Validator::make(
            $input,
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

    }
}
