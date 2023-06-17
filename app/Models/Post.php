<?php

namespace App\Models;

use App\Models\User;
use App\Models\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'news_content',
        'author',
    ];



    public function author()
    {
        return $this->hasMany(User::class, 'id', 'author');
    }

    /**
     * Get all of the comments for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function komen(): HasMany
    {
        return $this->hasMany(comment::class, 'post_id', 'id');
    }



}