<?php

namespace App\Http\Controllers;

use App\Models\OmekaErrors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class OmekaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('omeka.index', [
            'errors' => OmekaErrors::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        DB::table('omeka_errors')->truncate();

        Artisan::call('omeka:export', [

        ]);

        return redirect()->back();
    }
}
