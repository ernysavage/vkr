<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = $model->id ?? Str::uuid();
        });
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

  public function achievements()
{
    return $this->belongsToMany(Achievement::class, 'user_achievements')
        ->withPivot('unlocked_at')
        ->withTimestamps();
}



    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }

    public function userLessons()
    {
        return $this->hasMany(UserLesson::class);
    }
}
