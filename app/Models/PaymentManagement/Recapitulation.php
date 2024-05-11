<?php

namespace App\Models\PaymentManagement;

use App\Models\SettingManagement\Institution;
use App\Models\SettingManagement\Period;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recapitulation extends Model
{
    protected $table = 'recapitulations';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'period_id', 'institution_id', 'period', 'gender', 'amount'
    ];

    public function details(): HasMany
    {
        return $this->hasMany(RecapitulationDetail::class, 'recapitulation_id', 'id');
    }

    public function period(): HasOne
    {
        return $this->hasOne(Period::class, 'id', 'period_id');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }
}
