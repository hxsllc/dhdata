<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "metadata_images";

    public function getFrameAttribute()
    {
        return trim($this->attributes['frame']);
    }

    public function getFormatAttribute()
    {
        return trim($this->attributes['format']);
    }

    public function getWidthAttribute()
    {
        return trim($this->attributes['width']);
    }

    public function getHeightAttribute()
    {
        return trim($this->attributes['height']);
    }

    public function getMaxframeAttribute()
    {
        return trim($this->attributes['maxframe']);
    }
}
