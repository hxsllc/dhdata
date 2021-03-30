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

    protected $table = "00SLUCatalog";

    protected $versionClass = Version::class;

    protected $guarded = [
        'id',
    ];

    public function getRollAttribute()
    {
        if(! array_key_exists('rServiceCopyNumber', $this->attributes)){
            return '';
        }
        return Str::of($this->attributes['rServiceCopyNumber'])
                    ->padLeft(5, '0');
    }

    public function getOldCodexAttribute()
    {
        if(! array_key_exists('mCodexNumberOld', $this->attributes)){
            return '';
        }
        return Str::of($this->attributes['mCodexNumberOld'])
                    ->replaceMatches('/\([0-9]++\)/', '')
                    ->padLeft(5, '0');
    }

    public function getPartAttribute()
    {
        if(! array_key_exists('qualifier_is_edited', $this->attributes)){
            return '';
        }
        $this->attributes['qualifier_is_edited'] = false;
        $qualifier = Str::of($this->attributes['mQualifier'])->trim();
        if($qualifier->isNotEmpty()){
            if($qualifier->match('/[1-9]/')){
                $this->attributes['qualifier_is_edited'] = true;
                return $qualifier->padLeft(2, '0');
            }else{
                return $this->attributes['mQualifier'];
            }
        }

        $part = Str::of($this->attributes['mCodexNumberOld'])->match('/\([0-9]++\)/');
        if($part->trim()->isNotEmpty()){
            $this->attributes['qualifier_is_edited'] = true;
            return $part->trim('()')->padLeft(2, '0');
        }else{
            return '';
        }
    }

    public function getCalulatedIdentifierAttribute()
    {
        return $this->mapCollection() . '_' . $this->old_codex . '_01';
    }

    private function mapCollection()
    {
        switch(trim($this->mCollection)){
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
        }
    }

}
