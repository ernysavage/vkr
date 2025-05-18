<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'title',
        'content',
    ];

    public function userLessons()
    {
        return $this->hasMany(UserLesson::class);
    }
}
