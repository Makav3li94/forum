<?php

namespace App\Filters;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Http\Request;

class ThreadFilters extends Filters
{
    protected $filters = ['by'];

    /**
     * @filter Query By given username
     * @param $username
     * @return mixed
     */
    public function by($username)
    {
        $user = User::where('name', $username)->first();
        return $this->builder->where('user_id', $user->id);
    }
}
