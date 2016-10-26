<?php

namespace App\Http\Controllers;

use App\Models\Geocode;
use App\Models\Permit;

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
    public function permit($permitId, $slug = '')
    {
        /** @var Permit $permit */
        $permit = Permit::find($permitId);

        if ($slug != $permit->slug) {
            return redirect()->route('permit', ['permitId' => $permit->id, 'slug' => $permit->slug]);
        }

        $geocode = Geocode::find($permitId);

        $data = [
            'title' => 'Work Permit for ' . $permit->getFullAddress(),
            'permit' => $permit,
            'geocode' => $geocode,
        ];

        return view('page.permit', $data);
    }
}
