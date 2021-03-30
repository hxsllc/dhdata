<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\WebRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = new WebRecord();

        if($collection = request('shelfmark')){
            $records = $records->where('shelfmark', 'LIKE', '%'.$collection.'%');
        }
        if($codex = request('codex')){
            $records = $records->where('mCodexNumberOld', 'LIKE', '%'.$codex.'%');
        }
        if($roll = request('roll')){
            $records = $records->where('int_roll', 'LIKE', '%'.$roll.'%');
        }
        if($part = request('part')){
            $records = $records->where('int_part', 'LIKE', '%'.$part.'%');
        }

        return view('webimport.index', [
            'records' => $records->where('published', 0)->paginate(25),
            'collections' => DB::connection('mysql')
                                    ->table('metadata_web')
                                    ->select(DB::raw('DISTINCT shelfmark'))
                                    ->orderBy('shelfmark')
                                    ->get(),
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function edit(WebRecord $record)
    {
        return view('webimport.edit', [
            'record' => $record
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebRecord $record)
    {
        $record->fill($request->only([
            'mSubCollection01',
            'mSubCollection02',
            'mSubCollection03',
            'rNotes',
            'rMasterNegNumber',
            'mCodexNumberNew',
            'mQualifier',
            'mCountry',
            'mLanguage',
            'mCentury',
            'mTextReference',
            'mFolderNumber',
            'mDateDigitized',
        ]));
        $record->lastUpdatedBy = auth()->user()->email;

        $record->save();

        return redirect()->route('queue.index');
    }

}
