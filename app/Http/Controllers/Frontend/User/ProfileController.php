<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Tavsio\Tavsio;

class ProfileController extends Controller
{
    public function index() {
        return view('frontend.user.profile');
    }

    public function show($user) {
        $user->rank = Tavsio::getRank($user->points);
        $data = [
            'user' => $user
        ];
        return view('frontend.user.profile', $data);
    }
}
