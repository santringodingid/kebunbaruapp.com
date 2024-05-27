<?php

namespace App\Models\LicensingManagement;

use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Petition extends Model
{
    protected $table = 'petitions';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = [
        'id', 'reg_number', 'registration_id', 'reason', 'note', 'is_health', 'status',
        'created_at_hijri', 'created_by', 'expired_at'
    ];

    protected function casts(): array
    {
        return [
            'expired_at' => 'datetime'
        ];
    }

    protected function status(): Attribute
    {
        $statuses = ['Kadaluarsa', 'Pending', 'Ongoing', 'Selesai'];
        return Attribute::make(
            get: fn ($value) => $statuses[$value],
        );
    }

    public function registration(): HasOne
    {
        return $this->hasOne(Registration::class, 'id', 'registration_id');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id', 'registration_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
