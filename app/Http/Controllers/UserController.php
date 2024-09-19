<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{
    /**
     * Direct to login view
     *
     * @return void
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Direct to register view
     *
     * @return void
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Log user out
     *
     * @return void
     */
    public function logout()
    {
        auth('web')->logout();
        return redirect('/login');
    }

    /**
     * Validate a login request
     *
     * @param Request $request
     * @return void
     */
    public function userLogin(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $formFields['email'],
            'password' => $formFields['password'],
        ];

        if (auth('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/login');
        } else {
            return back()->withErrors([
                'password' => 'These credentials do not match our records.',
            ]);
        }
    }

    /**
     * Validate registering a new user
     *
     * @param Request $request
     * @return void
     */
    public function registerNewUser(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3|max:10',
            'email' => 'required|email|' . Rule::unique('users','email'),
            'password' => 'required|min:6|max:15',
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        auth('web')->login($user);
        $request->session()->regenerate();

        return redirect('/login');
    }
}
