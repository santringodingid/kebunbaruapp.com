<?php

namespace App\Models\LicensingManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class License extends Model
{
    protected $table = 'petition_licenses';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id', 'start_at', 'end_at', 'finish_at', 'start_at_hijri', 'end_at_hijri', 'finish_at_hijri',
        'is_late', 'status', 'created_by', 'finished_by'
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'finish_at' => 'datetime',
        ];
    }

    protected function isLate(): Attribute
    {
        $statuses = ['Disiplin', 'Terlambat'];
        return Attribute::make(
            get: fn ($value) => $statuses[$value],
        );
    }

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

    public function createdBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function finishedBy(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'finished_by');
    }
}
