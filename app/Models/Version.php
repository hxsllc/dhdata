<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mpociot\Versionable\Version as BaseVersion;

class Version extends BaseVersion
{
    protected $connection = 'mysql';

}
