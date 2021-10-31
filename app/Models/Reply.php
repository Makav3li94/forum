<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function isFavorited(){
        return $this->favorites()->where('user_id',auth()->user()->id)->exists();
    }
}
