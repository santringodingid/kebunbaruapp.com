<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Number;

class FareOfRegistration extends Model
{
    protected $table = 'fare_of_registrations';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['account_id', 'domicile_status', 'nominal'];

    protected function nominal(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
