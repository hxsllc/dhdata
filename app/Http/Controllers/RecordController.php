<?php

namespace App\Http\Controllers;

use App\Models\Record;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $record->fill($request->only());
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
     * Remove the specified resource from storage.
     *
     * @param  Record $record
     * @return \Illuminate\Http\Response
     */
    public function push(Record $record)
    {
        //
    }
}
