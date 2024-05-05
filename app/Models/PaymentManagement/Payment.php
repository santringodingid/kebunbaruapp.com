<?php

namespace App\Models\PaymentManagement;

use App\Models\RegisterManagement\Registration;
use App\Models\RegisterManagement\Student;
use App\Models\SettingManagement\Institution;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Number;

class Payment extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = ['id', 'registration_id', 'institution_id', 'fare', 'registration', 'amount', 'is_paid', 'created_at_hijri', 'notes', 'user_id'];

    protected function fare(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    protected function amount(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    protected function registration(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Number::format($value, 0, 0, 'id'),
        );
    }

    public function registrationHasOne(): HasOne
    {
        return $this->hasOne(Registration::class, 'id', 'registration_id');
    }

    public function student(): HasOneThrough
    {
        return $this->hasOneThrough(
            Student::class,
            Registration::class,
            'id',
            'id',
            'registration_id'
        );
    }

    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id', 'id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function institution(): HasOne
    {
        return $this->hasOne(Institution::class, 'id', 'institution_id');
    }
}
