<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReductionDetail extends Model
{
    protected $table = 'reduction_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['reduction_id', 'account_id', 'nominal'];

    public function reduction(): BelongsTo
    {
        return $this->belongsTo(Reduction::class, 'reduction_id', 'id');
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }
}
