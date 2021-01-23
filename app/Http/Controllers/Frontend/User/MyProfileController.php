<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Cms\Post\Post;
use App\Tavsio\Tavsio;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    public function index() {
        $user = Auth::user();
        $user->rank = Tavsio::getRank($user->points);

        // Get own posts
        if(Auth::check()) {
            //$followings = Auth::user()->followings->pluck('id');
            $posts = Post::where('status', 1)
                ->orderBy('id', 'DESC')
                ->where('user_id', $user->id)
                ->get();
        }
        $data = [
            'user' => $user,
            'posts' => $posts
        ];
        return view('frontend.user.my', $data);
    }

    public function edit() {

    }


}
