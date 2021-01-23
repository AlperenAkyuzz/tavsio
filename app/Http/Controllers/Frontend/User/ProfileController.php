<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Cms\Post\Post;
use App\Tavsio\Tavsio;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/***
 * Class ProfileController
 * @package App\Http\Controllers\Frontend\User
 */
class ProfileController extends Controller
{
    public function index() {
        return view('frontend.user.profile');
    }

    public function show($user) {
        $user->rank = Tavsio::getRank($user->points);
        $user->isFollowing = false;
        if(Auth::check()) {
            //$user->isFriend = Auth::user()->friends()->exists();
            $user->isFollowing = Auth::user()->isFollowing($user);
        }

        $posts = Post::where('status', 1)
            ->orderBy('id', 'DESC')
            ->where('user_id', $user->id)
            ->get();

        $data = [
            'user' => $user,
            'posts' => $posts
        ];
        return view('frontend.user.profile', $data);
    }

    public function addFollow($username)
    {

        //dd(Auth::user()->friends());
        $user = User::where('username', $username)->first();
        /*Auth::user()->friends()->attach($user->id);*/
        Auth::user()->follow($user);
        return Redirect::back();
    }

    public function unFollow($username)
    {
        $user = User::where('username', $username)->first();
        Auth::user()->unfollow($user);
        return Redirect::back();
    }

    public function showFriends() {
        Auth::user()->friends();
    }

}
