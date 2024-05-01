<?php

namespace App\Models\SettingManagement;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Hijri extends Model
{
    protected $table = 'hijri';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'hijri', 'masehi'
    ];

}
