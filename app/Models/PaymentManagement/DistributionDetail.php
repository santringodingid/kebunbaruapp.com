<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

class DistributionDetail extends Model
{
    protected $table = 'distribution_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'distribution_id', 'account_id', 'nominal'
    ];

    protected function nominal(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }
}
