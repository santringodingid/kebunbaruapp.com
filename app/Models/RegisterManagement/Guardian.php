<?php

namespace App\Models\RegisterManagement;

use App\Models\Region;
use App\Models\Scopes\GenderScope;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Guardian extends Model
{
    protected $table = 'guardians';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nik',
        'name',
        'gender',
        'phone',
        'wa_number',
        'address',
        'region_id',
        'last_education',
        'employment',
        'created_at_hijri'
    ];

    public function region(): HasOne
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'guardian_id', 'id');
    }

    public function allStudent(): HasMany
    {
        return $this->hasMany(Student::class, 'guardian_id', 'id')->withoutGlobalScope(GenderScope::class);
    }

    protected function gender(): Attribute
    {
        $statuses = ['Perempuan', 'Laki-laki'];
        return Attribute::make(
            get: fn ($value) => $statuses[$value],
        );
    }
}
