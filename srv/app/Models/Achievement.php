<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'unlocked_at',
        'icon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
