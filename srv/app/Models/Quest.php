<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quest extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'title',
        'description',
        'type',
        'target',
    ];

    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }
}
