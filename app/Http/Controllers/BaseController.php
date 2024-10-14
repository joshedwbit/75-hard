<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

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

    /**
     * Sanitize input strings
     *
     * @param string $string
     * @return string
     */
    public function stripTags(string $string): string
    {
        return strip_tags($string);
    }
}
