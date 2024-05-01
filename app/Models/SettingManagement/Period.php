<?php

namespace App\Models\SettingManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $table = 'periods';
    public $timestamps = false;

    protected $fillable = [
        'diniyah', 'ammiyah', 'created_at'
    ];
}
