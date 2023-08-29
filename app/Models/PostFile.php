<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_file',
        'post_id'
    ];
    protected $timestamp = false;
    protected $table = 'post_files';
}
