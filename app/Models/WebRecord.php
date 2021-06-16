<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WebRecord extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = "mysql";

    protected $table = "metadata_web";

    protected $primaryKey = 'uid';

    protected $guarded = [
        'uid',
    ];

}
