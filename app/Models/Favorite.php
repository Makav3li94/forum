<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use RecordActivity;

    protected $guarded = [];
    use HasFactory;

    public function favorited()
    {
        return $this->morphTo();
    }
}
