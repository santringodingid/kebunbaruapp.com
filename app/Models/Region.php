<?php

namespace App\Models;

use App\Models\RegisterManagement\Guardian;
use App\Models\RegisterManagement\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Region extends Model
{
    protected $table = 'regions';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'id', 'village', 'district', 'city', 'province', 'portal_code'
    ];

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class, 'id', 'region_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'id', 'region_id');
    }
}
