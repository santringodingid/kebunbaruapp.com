<?php

namespace App\Models\PaymentManagement;

use App\Models\SettingManagement\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccountDisbursement extends Model
{
    protected $table = 'account_disbursements';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = ['account_id', 'institution_id', 'gender'];

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'id', 'account_id');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }
}
