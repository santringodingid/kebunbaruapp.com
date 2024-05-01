<?php

namespace App\Models\RegisterManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Domicile extends Model
{
    protected $table = 'domicile_registrations';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'period_id', 'student_id', 'domicile_status', 'domicile', 'domicile_number',
        'is_new', 'note', 'created_at_hijri', 'created_at'
    ];

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
}
