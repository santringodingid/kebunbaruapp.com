<?php

namespace App\Models\LicensingManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'licensing_configurations';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = [
        'gender', 'kamtib', 'health', 'guardian', 'kabid', 'chief'
    ];
}
