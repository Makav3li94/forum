<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show($name)
    {
        $profileUser = User::where('name', $name)->first();
        $activities = Activity::feed($profileUser);
        return view('profiles.show', compact('profileUser', 'activities'));
    }


}
