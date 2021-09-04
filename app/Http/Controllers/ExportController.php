<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\ValidationErrors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('export.index', [
            'count' => Record::has('images')->count(),
            'errors' => ValidationErrors::paginate(25),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        DB::table('validation_errors')->truncate();

        Artisan::call('manifests:export', [
            'validate' => true,
            'period' => $request->period,
        ]);

        return redirect()->back();
    }
}
