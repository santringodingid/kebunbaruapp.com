<?php

namespace App\Models\RegisterManagement;

use App\Models\SettingManagement\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id', 'domicile_status', 'domicile', 'domicile_number', 'is_new_domicile',
        'grade_of_diniyah', 'institution_diniyah_id', 'is_new_diniyah',
        'grade_of_formal', 'institution_formal_id', 'is_new_formal', 'created_at_hijri'
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'id');
    }

    public function diniyah(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_diniyah_id');
    }

    public function formal(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_formal_id');
    }
}
