<?php


namespace App\Models;


trait Favoritable
{

    public function isFavorited()
    {
        return !!$this->favorites->where('user_id', auth()->user()->id)->count();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        $arr = ['user_id' => auth()->user()->id];
        if (!$this->favorites()->where($arr)->exists()) {
            $this->favorites()->create($arr);
        }
    }
}