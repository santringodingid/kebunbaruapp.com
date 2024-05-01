<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReductionDetail extends Model
{
    protected $table = 'reduction_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = false;
    protected $fillable = ['reduction_id', 'account_id', 'nominal'];
}
