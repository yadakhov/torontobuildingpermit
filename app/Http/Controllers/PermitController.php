<?php

namespace App\Http\Controllers;

class PermitController extends Controller
{
    /**
     * GET /search
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        $data = [];

        return view('page.search', $data);
    }

    /**
     * /permit/{permitId}
     */
    public function permit()
    {
        $data = [];

        return view('page.permit', $data);
    }
}
