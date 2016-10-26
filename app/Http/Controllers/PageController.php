<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function front()
    {
        dd('front');
    }

    /**
     * /permit/{permitId}
     */
    public function permit()
    {
        dd('permit');
    }
}
