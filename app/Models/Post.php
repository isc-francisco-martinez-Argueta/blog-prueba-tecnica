<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PharIo\Manifest\Author;

class Post extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'user_id', 'title', 'author','content'
    ];
}
