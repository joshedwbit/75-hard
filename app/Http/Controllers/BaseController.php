<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * Check if user is logged in
     *
     * @return boolean
     */
    public static function isLoggedIn()
    {
        return auth('web')->check();
    }
}
