<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('dashboard', [
            'record_count' => Record::count(),
            'cataloged' => Record::cataloged()
                                    ->count(),
            'digitized' => Record::digitized()
                                    ->count(),
        ]);
    }
}
