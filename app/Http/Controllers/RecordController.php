<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\WebRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = new Record;

        if($collection = request('shelfmark')){
            $records = $records->where('mCollection', 'LIKE', '%'.$collection.'%');
        }
        if($codex = request('codex')){
            $records = $records->where('mCodexNumberOld', 'LIKE', '%'.$codex.'%');
        }
        if($roll = request('roll')){
            $records = $records->where('rServiceCopyNumber', 'LIKE', '%'.$roll.'%');
        }
        if($updated = request('updated')){
            $records = $records->where('lastUpdatedBy', 'LIKE', '%'.$updated.'%');
        }

        return view('records.index', [
            'records' => $records->orderBy('lastUpdatedOn', 'DESC')->paginate(25),
            'collections' => DB::connection('slu')
                                    ->table('SLU_SQL')
                                    ->select(DB::raw('DISTINCT mCollection'))
                                    ->orderBy('mCollection')
                                    ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create', [
            'record' => new Record(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $record = new Record;
        $record->fill($request->only([
            'mCollection',
            'mSubCollection01',
            'mSubCollection02',
            'mSubCollection03',
            'rNotes',
            'rServiceCopyNumber',
            'rMasterNegNumber',
            'mCodexNumberOld',
            'mCodexNumberNew',
            'mQualifier',
            'mCountry',
            'mLanguage',
            'mCentury',
            'mTextReference',
        ]));
        $record->lastUpdatedBy = auth()->user()->email;

        $record->save();

        return redirect()->route('records.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        return view('records.edit', [
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
    public function update(Request $request, Record $record)
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

        return redirect()->route('records.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }

    /**
     * Push Item Record to Web Queue.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function pushToQueue(REquest $request, Record $record)
    {
        $request->validate([
            'vfl_roll' => 'required|max:10',
            'codex' => 'required|max:10',
            'vfl_part' => 'required|max:10',
        ], $record->toArray());

        $webRecord = new WebRecord;
        $webRecord->vfl_roll = $record->rMasterNegNumber;
        $webRecord->shelfmark = $record->mCollection;
        $webRecord->codex = $record->mCodexNumberNew;
        $webRecord->vfl_part = $record->mQualifier;
        $webRecord->century = $record->mCentury;
        $webRecord->country = $record->mCountry;
        $webRecord->language = $record->mLanguage;
        $webRecord->reference = $record->mTextReference;
        $webRecord->metascripta_id = $record->mFolderNumber;
        $webRecord->date_digitized = $record->mDateDigitized;
        $webRecord->int_roll = intval($record->vfl_roll);
        $webRecord->int_manu = intval($record->codex);
        $webRecord->int_part = intval($record->vfl_part);
        //$webRecord->century_named = $record->;
        $webRecord->save();
    }
}
