<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Number;

class PaymentDetail extends Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['payment_id', 'account_id', 'nominal', 'is_divisible'];

    protected function nominal(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }
}
