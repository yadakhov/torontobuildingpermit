<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function front()
    {
        $data = [];

        return view('page.front', $data);
    }

    /**
     * GET /about
     */
    public function about()
    {
        $data = [];

        return view('page.about', $data);
    }
}
