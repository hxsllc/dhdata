<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mpociot\Versionable\VersionableTrait;

class Record extends Model
{
    use HasFactory;
    use VersionableTrait;

    const CREATED_AT = "lastUpdatedOn";

    const UPDATED_AT = "lastUpdatedOn";

    protected $connection = "slu";

    protected $table = "metadata_source";

    protected $versionClass = Version::class;

    protected $guarded = [
        'id',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'metascripta_id', 'mFolderNumber')->orderBy('frame', 'ASC');
    }

    public function getRollAttribute()
    {
        if(! array_key_exists('rServiceCopyNumber', $this->attributes)){
            return '';
        }
        if(! empty($this->rMasterNegNumber)){
            return $this->rMasterNegNumber;
        }
        $this->attributes['roll_is_edited'] = true;
        return Str::of($this->attributes['rServiceCopyNumber'])
                    ->padLeft(5, '0');
    }

    public function getOldCodexAttribute()
    {
        if(! $this->should_auto_calculate || ! array_key_exists('mCodexNumberOld', $this->attributes)){
            return '';
        }else if(! empty($this->attributes['mCodexNumberNew'])){
            return $this->attributes['mCodexNumberNew'];
        }
        $this->attributes['new_codex_is_edited'] = true;
        return Str::of($this->attributes['mCodexNumberOld'])
                    ->replaceMatches('/\([0-9]++\)/', '')
                    ->padLeft(5, '0');
    }

    public function getPartAttribute()
    {
        if(! $this->should_auto_calculate){
            return '';
        }
        if(! array_key_exists('mQualifier', $this->attributes)){
            $this->attributes['qualifier_is_edited'] = true;
            $this->attributes['qualifier_is_default'] = true;
            return '01';
        }
        $qualifier = Str::of($this->attributes['mQualifier'])->trim();
        // Check it the mQualifier is empty. If so, set default to 01 and show warning
        if($qualifier->isEmpty()){
            $this->attributes['qualifier_is_edited'] = true;
            $this->attributes['qualifier_is_default'] = true;
            return '01';
        }
        $this->attributes['qualifier_is_edited'] = false;
        // If mQualifier i snot empty, check if it's a single digit and pad with 0's
        if($qualifier->isNotEmpty()){
            if($qualifier->length() < 2 && $qualifier->match('/[1-9]/')){
                $this->attributes['qualifier_is_edited'] = true;
                return $qualifier->padLeft(2, '0');
            }else{
                return $qualifier;
            }
        }
        // Currently this will never be reached but the idea was to extract the number part, pad it, and then return
        $part = Str::of($this->attributes['mCodexNumberOld'])->match('/\([0-9]++\)/');
        if($part->trim()->isNotEmpty()){
            $this->attributes['qualifier_is_edited'] = true;
            return $part->trim('()')->padLeft(2, '0');
        }else{
            return '';
        }
    }

    public function getShouldAutoCalculateAttribute()
    {
        return in_array($this->mCollection, Collection::where('auto_calculate', 1)->pluck('name')->all());
    }

    public function getCalulatedIdentifierAttribute()
    {
        return $this->mapCollection() . '_' . $this->old_codex . '_01';
    }

    public function isCataloged()
    {
        return ! empty($this->mCentury)
            && ! empty($this->mCountry)
            && ! empty($this->mLanguage)
            && ! empty($this->mTextReference);
    }

    public function isDigitized()
    {
        return $this->isCataloged()
            && ! empty($this->mDateDigitized)
            && $this->mDateDigitized != '0000-00-00'
            && ! empty($this->mFolderNumber);
    }

    public function scopeCataloged($query)
    {
        return $query->whereNotNull('mCentury')->where('mCentury', '<>', '')
                    ->whereNotNull('mCountry')->where('mCountry', '<>', '')
                    ->whereNotNull('mLanguage')->where('mLanguage', '<>', '')
                    ->whereNotNull('mTextReference')->where('mTextReference', '<>', '');
    }

    public function scopeDigitized($query)
    {
        return $query->cataloged()
                    ->whereNotNull('mDateDigitized')
                    ->where('mDateDigitized', '<>', 0)
                    ->whereNotNull('mFolderNumber')
                    ->where('mFolderNumber', '<>', '');
    }

    private function mapCollection()
    {
        return optional(Collection::whereName(trim($this->mCollection))->first())->acronym;
        /*switch(trim($this->mCollection)){
            case 'Arch. Cap. S. Pietro':
                return 'AP[+]';
            case 'Barb. gr.':
                return 'BAG';
            case 'Barb. lat.':
                return 'BAL';
            case 'Barb. or.':
                return 'BAO';
            case 'Borgh.':
                return 'BHS';
            case 'Borg. ar.':
                return 'BOA';
            case 'Borg. ebr.':
                return 'BOH';
            case 'Borg. et.':
                return 'BOE';
            case 'Borg. gr.':
                return 'BOG';
            case 'Borg. lat.':
                return 'BOL';
            case 'Borg. sir.':
                return 'BOS';
            case 'Capp. Giulia':
                return 'CPG';
            case 'Capp. Sist.':
                return 'CPS';
            case 'Cappon.':
                return 'CPP';
            case 'Cerulli et.':
                return 'CRE';
            case 'Chig.':
                return 'CH[+]';
            case 'Ferr.':
                return 'FRR';
            case 'Neofiti':
                return 'NEO';
            case 'Ott. gr.':
                return 'OTG';
            case 'Ott. lat.':
                return 'OTL';
            case 'Pal. gr.':
                return 'PLG';
            case 'Pal. lat.':
                return 'PLL';
            case 'Patetta':
                return 'PAT';
            case 'Reg. gr.':
                return 'RGG';
            case 'Reg. gr. Pio II':
                return 'RGP';
            case 'Reg. lat.':
                return 'RGL';
            case 'Ross.':
                return 'RSS';
            case 'Sala cons. mss.':
                return 'SCM';
            case 'Urb. ebr.':
                return 'UBH';
            case 'Urb. gr.':
                return 'UBG';
            case 'Urb. lat.':
                return 'UBL';
            case 'Vat. ar.':
                return 'VTA';
            case 'Vat. ebr.':
                return 'VTH';
            case 'Vat. et.':
                return 'VTE';
            case 'Vat. gr.':
                return 'VTG';
            case 'Vat. lat.':
                return 'VTL';
            case 'Vat. sir.':
                return 'VTS';
        }*/
    }

    static function manifest($record)
    {
        $manifest = [];
        $manifest["@context"] = "http://iiif.io/api/presentation/2/context.json";
        $manifest["@id"] = url('/manifest/') . "/" . $record->mFolderNumber . ".json";
        $manifest["@type"] = "sc:Manifest";
        $manifest["label"] = "Saint Louis University, " . $record->mCollection . " " . $record->mCodexNumberNew;
        $manifest["license"] = "https://creativecommons.org/publicdomain/zero/1.0/";
        $manifest["description"] = "Vatican Film Library Manuscript on Microfilm";
        $manifest["attribution"] = "Saint Louis University Libraries";
        $manifest["logo"] = "https://metascripta.org/iiif/metascripta-logo.png";
        // Removed but present in old generator: $manifest["structures"] = [];
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
            "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $record->mFolderNumber . "%2f" . $record->mFolderNumber . "_0002.jp2/full/120,/0/default.jpg",
            "service" => [
                "@context" => "http://iiif.io/api/image/2/context.json",
                "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $record->mFolderNumber . "%2f" . $record->mFolderNumber . "_0002.jp2/",
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
                "value" => $record->roll,
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
                "canvases" => $record->images->sortBy('frame')->map(function($image, $key){
                    return [
                        "@id" => "https://metascripta.org/iiif/". $image->metascripta_id . "/" . ($key + 1),
                        "@type" => "sc:Canvas",
                        "label" => $image->metascripta_id . "_" .  $image->frame,
                        "width" => intval($image->width),
                        "height" => intval($image->height),
                        "images" => [
                            [
                                "@id" => "https://IMAGE_ID_" . ($key + 1),
                                "@type" => "oa:Annotation",
                                "motivation" => "sc:painting",
                                "resource" => [
                                    "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $image->metascripta_id  . "%2f" . $image->metascripta_id . "_" . $image->frame . "." . $image->format . "/full/full/0/default.jpg",
                                    "@type" => "dctypes:Image",
                                    "format" => "image/jpeg",
                                    "width" => intval($image->width),
                                    "height" => intval($image->height),
                                    "service" => [
                                        "@context" => "http://iiif.io/api/image/2/context.json",
                                        "@id" => "https://cantaloupe.metascripta.org/iiif/2/". $image->metascripta_id  . "%2f" . $image->metascripta_id . "_" . $image->frame . "." . $image->format,
                                        "profile" => "http://iiif.io/api/image/2/level1.json",
                                    ],
                                ],
                                "on" => "https://metascripta.org/iiif/" . $image->metascripta_id . "/" . ($key + 1),
                            ],
                        ],
                    ];
                })->values(),
            ]
        ];

        return $manifest;
    }

}
