<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserQuest extends Model
{
    use HasFactory, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'user_id',
        'quest_id',
        'progress',
        'status',namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quest extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['id', 'title', 'description', 'target_value', 'type'];

    public function userQuests()
    {
        return $this->hasMany(UserQuest::class);
    }
}

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quest()
    {
        return $this->belongsTo(Quest::class);
    }
}
