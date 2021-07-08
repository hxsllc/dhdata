<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Record;
use Illuminate\Http\Request;

class ManifestGeneratorController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $identifier)
    {
        $record = Record::with('images')->firstWhere('mFolderNumber', $identifier);

        if(empty($record)){
            abort(404, "Invalid manuscript ID specified");
        }

        $manifest = Record::manifest($record);

        switch($request->get('format')){
            case 'html':
                return view('manifests.html', [
                    'manifest' => $manifest,
                ]);
            case 'text':
                return view('manifests.text', [
                    'manifest' => $manifest,
                ]);
            default:
                return response()->json($manifest, 200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_PRETTY_PRINT);
        }
    }
}
