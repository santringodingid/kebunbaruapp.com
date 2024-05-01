<?php

namespace App\Models\PaymentManagement;

use App\Models\SettingManagement\Institution;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Number;

class Fare extends Model
{
    protected $table = 'fares';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['grade', 'institution_id', 'domicile_status', 'amount'];

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(FareDetail::class, 'fare_id', 'id');
    }
}
