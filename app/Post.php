<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable  = ['title', 'description', 'content', 'published_at', 'image', 'category_id', 'user_id'];

    /*
    *delete image from storage
	*@return void
    */
    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    /*check if post has tags
    *
    *return bool
    */
    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }
    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query;
        }

        return $query->where('title', 'LIKE', "%{$search}%");
    }
}
