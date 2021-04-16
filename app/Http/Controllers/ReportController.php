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
        $collections = Collection::all();

        Record::cataloged()->chunk(50, function($items) use (&$records, $collections){
            $autoCollections = $collections->where('auto_calculate', 1)->pluck('acronym', 'name')->all();
            $manualCollections = $collections->where('auto_calculate', 0)->pluck('acronym', 'name')->all();
            foreach($items as $item){
                if(in_array($item->mCollection, array_keys($autoCollections))){
                    if(! Str::of($item->mFolderNumber)->trim()->startsWith($autoCollections[$item->mCollection])){
                        $records->push($item);
                    }
                }else if(in_array($item->mCollection, array_keys($manualCollections))){
                    if(! Str::of($item->mFolderNumber)->trim()->startsWith(Str::of($manualCollections[$item->mCollection])->explode('[')->first())){
                        $records->push($item);
                    }
                    if(! Str::of($manualCollections[$item->mCollection])->matchAll('/[A-Z]{3}_/')->count() < 1){
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
