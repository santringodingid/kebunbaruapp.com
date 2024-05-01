<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    protected $table = 'payment_accounts';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['name'];

    public function disbursement(): BelongsTo
    {
        return $this->belongsTo(AccountDisbursement::class, 'id', 'account_id');
    }
}
