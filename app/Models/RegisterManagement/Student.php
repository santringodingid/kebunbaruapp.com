<?php

namespace App\Models\RegisterManagement;

use App\Models\Region;
use App\Models\Scopes\GenderScope;
use App\Models\SettingManagement\Institution;
use App\Models\SettingManagement\Period;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'id', 'registration_number', 'gender', 'kk', 'nik', 'period_id', 'name', 'place_of_birth', 'date_of_birth',
        'address', 'region_id', 'last_education', 'domicile_status', 'domicile', 'domicile_number', 'grade_of_diniyah',
        'institution_diniyah_id', 'grade_of_formal', 'institution_formal_id', 'father_nik', 'father', 'mother_nik',
        'mother', 'guardian_id', 'guardian_relationship', 'committee', 'image_of_profile', 'image_of_signature', 'status',
        'created_at_hijri'
    ];

    protected static function booted(): void
    {
        parent::booted();
        self::addGlobalScope(new GenderScope());
    }

    public function region(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function diniyah(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_diniyah_id');
    }

    public function formal(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_formal_id');
    }

    public function guardian(): BelongsTo
    {
        return $this->belongsTo(Guardian::class, 'guardian_id', 'id');
    }

    public function period(): HasOne
    {
        return $this->hasOne(Period::class, 'id', 'period_id');
    }

    protected function status(): Attribute
    {
        $statuses = ['Berhenti', 'Aktif', 'Tugas', 'Pengurus'];
        return Attribute::make(
            get: fn ($value) => $statuses[$value],
        );
    }

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'datetime'
        ];
    }
}
