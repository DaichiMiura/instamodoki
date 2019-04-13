<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(int $user_id)
    {
        $user = User::find($user_id);

        if (is_null($user)) {
            return redirect()->route('home');
        }

        return view('home.profile', [
            'user' => $user,
        ]);
    }
}
