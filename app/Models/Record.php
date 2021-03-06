<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Record extends Model
{
    use HasFactory;

    const CREATED_AT = "lastUpdatedOn";

    const UPDATED_AT = "lastUpdatedOn";

    protected $connection = "slu";

    protected $table = "00SLUCatalog";

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

}
