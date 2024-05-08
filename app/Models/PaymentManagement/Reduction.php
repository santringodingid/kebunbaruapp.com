<?php

namespace App\Models\PaymentManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reduction extends Model
{
    protected $table = 'reductions';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['name', 'amount'];

    public function details(): HasMany
    {
        return $this->hasMany(ReductionDetail::class, 'reduction_id', 'id');
    }
}
