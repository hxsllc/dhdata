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

        $manifest = [];
        $manifest["@context"] = "http://iiif.io/api/presentation/2/context.json";
        $manifest["@id"] = "https://metascripta.org/iiif/" . $record->mFolderNumber . ".json";
        $manifest["@type"] = "sc:Manifest";
        $manifest["label"] = "Saint Louis University, " . $record->mCollection . " " . $record->mCodexNumberNew;
        $manifest["license"] = "https://creativecommons.org/publicdomain/zero/1.0/";
        $manifest["description"] = "Vatican Film Library Manuscript on Microfilm";
        $manifest["attribution"] = "Saint Louis University Libraries";
        $manifest["logo"] = "https://metascripta.org/iiif/metascripta-logo.png";
        $manifest["structures"] = [];
        $manifest["seeAlso"] = [
            "@id" => "https://metascripta.org/document/" . $record->mFolderNumber,
            "format" => "text/html",
        ];
        $manifest["rendering"] = [
            "@id" => "https://metascripta-01.s3.amazonaws.com/" . $record->mFolderNumber . ".pdf",
            "label" => "Download as PDF",
            "format" => "application/pdf",
        ];
        $manifest["thumbnail"] = [
            "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $record->mFolderNumber . "/" . $record->mFolderNumber . "_0002.jp2/full/120,/0/default.jpg",
            "service" => [
                "@context" => "http://iiif.io/api/image/2/context.json",
                "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $record->mFolderNumber . "/" . $record->mFolderNumber . "_0002.jp2/",
                "profile" => "http://iiif.io/api/image/2/level1.json",
            ],
        ];
        $manifest["metadata"] = [
            [
                "label" => "Shelfmark",
                "value" => $record->mCollection . " " . $record->mCodexNumberNew,
            ],
            [
                "label" => "VFL Part",
                "value" => $record->mQualifier,
            ],
            [
                "label" => "Century",
                "value" => $record->mCentury,
            ],
            [
                "label" => "Country",
                "value" => $record->mCountry,
            ],
            [
                "label" => "Language",
                "value" => $record->mLanguage,
            ],
            [
                "label" => "Reference",
                "value" => $record->mTextReference,
            ],
            [
                "label" => "METAscripta ID",
                "value" => $record->mFolderNumber,
            ],
            [
                "label" => "VFL Roll",
                "value" => $record->rServiceCopyNumber,
            ],
            [
                "label" => "Date Digitized",
                "value" => $record->mDateDigitized,
            ],
        ];

        $manifest["sequences"] = [
            [
                "@id" => "https://SEQUENCE_ID_1",
                "@type" => "sc:Sequence",
                "label" => "Normal Sequence",
                "canvases" => $record->images->map(function($image, $key){
                    return [
                        "@id" => "https://metascripta.org/iiif/". $image->metascripta_id . "/" . ($key + 1),
                        "@type" => "sc:Canvas",
                        "label" => $image->metascripta_id . "_" .  $image->frame,
                        "width" => $image->width,
                        "height" => $image->height,
                        "images" => [
                            [
                                "@id" => "https://IMAGE_ID_" . ($key + 1),
                                "@type" => "oa:Annotation",
                                "motivation" => "sc:painting",
                                "resource" => [
                                    "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $image->metascripta_id  . "_" . $image->frame . "." . $image->format,
                                    "@type" => "dctypes:Image",
                                    "format" => "image/jpeg",
                                    "width" => $image->width,
                                    "height" => $image->height,
                                    "service" => [
                                        "@context" => "http://iiif.io/api/image/2/context.json",
                                        "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $image->metascripta_id  . "/" . $image->frame . "." . $image->format,
                                        "profile" => "http://iiif.io/api/image/2/level1.json",
                                    ],
                                ],
                                "on" => "https://metascripta.org/iiif/" . $image->metascripta_id . "/" . ($key + 1),
                            ],
                        ],
                    ];
                })->all(),
            ]
        ];

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
