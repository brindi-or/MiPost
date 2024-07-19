<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['content','title','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        //un post peut aoir un ou plusieurs comment
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Likes::class);
    }
}
