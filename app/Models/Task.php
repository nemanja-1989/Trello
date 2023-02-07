<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'title',
        'description'
    ];

    public function boards() {
        return $this->belongsToMany(Board::class, 'board_tasks', 'task_id', 'board_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
