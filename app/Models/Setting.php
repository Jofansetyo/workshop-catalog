<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public static function map(): array
    {
        return static::pluck('value', 'key')->all();
    }
}
