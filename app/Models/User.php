<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'status_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    // Relationships
    public function info() {
        return $this->hasOne(UserInfo::class);
    }
    public function wallet() {
        return $this->hasOne(Wallet::class);
    }
    public function status() {
        return $this->belongsTo(Status::class);
    }
    public function idVerification() {
        return $this->hasOne(IdVerification::class);
    }

    // Mutators
    public function getEmailVerifiedAttribute() {
        return $this->email_verified_at ? true : false;
    }
    public function getPhoneVerifiedAttribute() {
        return $this->phone_verified_at ? true : false;
    }
}
