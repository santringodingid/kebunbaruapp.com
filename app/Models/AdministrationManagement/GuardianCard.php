<?php

namespace App\Models\AdministrationManagement;

use App\Models\RegisterManagement\Guardian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class GuardianCard extends Model
{
    use softDeletes;

    protected $table = 'guardian_cards';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id', 'guardian_id', 'created_at', 'created_by', 'deleted_by'
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function guardian(): HasOne
    {
        return $this->hasOne(Guardian::class, 'id', 'guardian_id');
    }
}
