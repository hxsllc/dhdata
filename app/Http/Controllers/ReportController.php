<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function quality()
    {
        $records = collect([]);
        $collections = Collection::where('auto_calculate', 1)->pluck('acronym', 'name')->all();

        Record::cataloged()->chunk(50, function($items) use (&$records, $collections){
            foreach($items as $item){
                if(in_array($item->mCollection, array_keys($collections))){
                    if(! Str::of($item->mFolderNumber)->trim()->startsWith($collections[$item->mCollection])){
                        $records->push($item);
                    }
                }
            }
        });

        return view('reports.index', [
            'records' => $records,
        ]);
    }
}
