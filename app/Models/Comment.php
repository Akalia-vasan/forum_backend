<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Comment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'content','author_id', 'post_id', 'parent_id'
    ];
    public function parent()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
