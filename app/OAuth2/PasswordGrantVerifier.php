<?php
/**
 * Created by PhpStorm.
 * User: Danilo
 * Date: 20/02/16
 * Time: 22:04
 */

namespace CodeDelivery\OAuth2;


use Illuminate\Support\Facades\Auth;

class PasswordGrantVerifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}