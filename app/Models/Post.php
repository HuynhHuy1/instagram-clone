<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "content",
        "user_id",
        "privacy_mode"
    ];
    protected $table = "posts";

    public function user(){
        return $this->belongsTo('App\Models\User');  
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    // Quan hệ một-nhiều với bảng "post_comments"
    public function comments()
    {
        return $this->hasMany('App\Models\Comment','post_id','id');
    }

    // Quan hệ một-nhiều với bảng "post_files"
    public function files()
    {
        return $this->hasMany('App\Models\PostFile');
    }
}
