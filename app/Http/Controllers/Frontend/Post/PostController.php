<?php namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Models\Cms\Post\Post;
use App\Tavsio\Tavsio;
use App\User;
use Illuminate\Support\Facades\Auth;

/***
 * Class PostController
 * @package App\Http\Controllers\Frontend\Post
 */
class PostController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        // If User Auth Get Following Users Posts except own posts
        if(Auth::check()) {
            $followings = Auth::user()->followings->pluck('id');
            $userPosts = Post::where('status', 1)
                ->orderBy('id', 'DESC')
                ->whereIn('user_id', $followings)
                ->get();

            $otherPosts = Post::where('status', 1)
                ->where('user_id', '<>', Auth::id())
                ->orderBy('id', 'DESC')
                ->take(Tavsio::HOME_POSTS_TAKE)
                ->get();
            $posts = $userPosts->merge($otherPosts);

        } else { // if not auth
            // Get Latest Posts
            $posts = Post::where('status', 1)
                ->orderBy('id', 'DESC')
                ->take(Tavsio::HOME_POSTS_TAKE)
                ->get();
        }
        //dd($posts);
        $data = [
            'posts' => $posts
        ];
        return view('frontend.home', $data);
    }

    public function test() {
        $user = Auth::user();
        dd(User::unfolloweds($user, 20));
    }

}
