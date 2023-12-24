<?php

namespace App\Http\Controllers;

use App\Helper\CustomController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pageLogin()
    {
        return view('auth.login');
    }

    public function login()
    {
        $status = 'Password mismatch.';
        $akun = request('username');
        $credentials = request()->validate(
            [
                'password' => 'required',
            ]
        );

        if (strpos(request('username'), '@') == false) {
            $user = User::where('username', '=', request('username'))->first();
            if ( ! $user) {
                $akun = '';
                $status = 'Username not found.';
                return Redirect::back()->withErrors(['status' => $status]);
            }
            Arr::set($credentials, 'username', request('username'));
        } else {
            $user = User::where('email', '=', request('username'))->first();
            if ( ! $user) {
                $akun = '';
                $status = 'Email not found.';

                return Redirect::back()->withErrors(['status' => $status]);

            }
            Arr::set($credentials, 'email', request('username'));
        }

        if ($this->isAuth($credentials)) {
            $redirect = '/';

//            return response()->json();

            return redirect($redirect);
        }

//        return response()->json('gagal', 501);

        return Redirect::back()->withErrors(['pasword' => 'Password mismach.'])->with(['username' => request('username')]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

}
