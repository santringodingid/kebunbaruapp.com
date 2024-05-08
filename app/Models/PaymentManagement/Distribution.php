<?php

namespace App\Models\PaymentManagement;

use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Student;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Number;

class Distribution extends Model
{
    protected $table = 'distributions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'reduction_id', 'registration_id', 'notes'
    ];

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    public function reduction(): HasOne
    {
        return $this->hasOne(Reduction::class, 'id', 'reduction_id');
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'id', 'registration_id');
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(
            Student::class,
            Registration::class,
            'id',
            'id',
            'registration_id'
        );
    }

    public function details(): HasMany
    {
        return $this->hasMany(DistributionDetail::class, 'distribution_id', 'id');
    }
}
