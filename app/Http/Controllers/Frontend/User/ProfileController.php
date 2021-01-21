<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Tavsio\Tavsio;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    public function index() {
        return view('frontend.user.profile');
    }

    public function show($user) {
        $user->rank = Tavsio::getRank($user->points);
        if(Auth::check()) {
            $user->isFriend = Auth::user()->friends()->exists();
        }
        $data = [
            'user' => $user
        ];
        return view('frontend.user.profile', $data);
    }

    public function addFriend($username)
    {

        //dd(Auth::user()->friends());
        $user = User::where('username', $username)->first();
        Auth::user()->friends()->attach($user->id);
        return Redirect::back();
    }

    public function removeFriend($username)
    {
        $user = User::where('username', $username)->first();
        Auth::user()->friends()->detach($user);
        return Redirect::back();
    }

    public function showFriends() {
        Auth::user()->friends();
    }
}
