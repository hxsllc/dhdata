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

    protected $table = "SLU_SQL";

    protected $fillable = [
        'mCity',
        'mRepository',
        'rServiceCopyNumber',
        'mCollection',
        'mCodexNumberOld',
        'rMasterNegNumber',
        'mCodexNumberNew',
        'mQualifier',
        'mCountry',
        'mLanguage',
        'mTextReference',
        'mDateDigitized',
        'mFolderNumber',
    ];

    public function getRollAttribute()
    {
        return Str::of($this->attributes['rServiceCopyNumber'])
                    ->padLeft(5, '0');
    }

    public function getOldCodexAttribute()
    {
        return Str::of($this->attributes['mCodexNumberOld'])
                    ->replaceMatches('/\([0-9]++\)/', '')
                    ->padLeft(5, '0');
    }

    public function getPartAttribute()
    {
        $part = Str::of($this->attributes['mCodexNumberOld'])->match('/\([0-9]++\)/');
        if($part->trim()->isNotEmpty()){
            return $part->trim('()')->padLeft(2, '0');
        }else{
            return '01';
        }
    }

}
