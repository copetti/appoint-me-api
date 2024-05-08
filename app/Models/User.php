<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guarded = [
        'id',
    ];

    protected $with = ['teams'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function resetPasswordTokens()
    {
        return $this->hasMany(PasswordResetToken::class);
    }

    public function teams()
    {
        return $this->belongsToMany(
            related: Team::class,
            table: 'model_has_roles',
            foreignPivotKey: 'model_id',
            relatedPivotKey: 'team_id',
        );
    }
}
