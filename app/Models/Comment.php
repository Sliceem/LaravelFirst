<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
      'text',
      'user_id',
      'post_id'
    ];

    public function post() {
        $this->hasMany(Post::class);
    }

    public function user() {
        $this->hasMany(User::class);
    }
}
