<?php

namespace App\Models\LicensingManagement;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Recapitulation extends Model
{
    protected $table = 'petition_recapitulations';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id', 'gender', 'period', 'status'
    ];

    protected function status(): Attribute
    {
        $statuses = ['Pending', 'Ongoing', 'Selesai'];
        return Attribute::make(
            get: fn ($value) => $statuses[$value],
        );
    }

    public function petition(): HasOne
    {
        return $this->hasOne(Petition::class, 'id', 'id');
    }
}
