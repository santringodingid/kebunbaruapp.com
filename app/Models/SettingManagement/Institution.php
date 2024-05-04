<?php

namespace App\Models\SettingManagement;

use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Institution extends Model
{
    use HasFactory;
    protected $table = 'institutions';
    public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'commission', 'chief', 'secretary', 'treasurer', 'gender_access', 'status_access'
    ];
    protected function genderAccess(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if ($value == 0) {
                    return 'Putri';
                }

                if ($value == 1) {
                    return 'Putra';
                }

                if ($value == 2) {
                    return 'Umum';
                }

                return '';
            }
        );
    }

    protected function statusAccess(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if ($value == 0) {
                    return 'Umum';
                }

                if ($value == 1) {
                    return 'Diniyah';
                }

                if ($value == 2) {
                    return 'Ammiyah';
                }

                return '';
            }
        );
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'institution_id', 'id');
    }
}
