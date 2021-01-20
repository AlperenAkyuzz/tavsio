<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Tavsio\Tavsio;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        $user->rank = Tavsio::getRank($user->points);
        $data = [
            'user' => $user
        ];
        return view('frontend.user.my', $data);
    }

    public function edit() {

    }


}
