<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id',
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function isCompleted() {
        return $this->completed_at !== null;
    }
}
