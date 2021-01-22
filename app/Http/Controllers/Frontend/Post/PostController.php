<?php namespace App\Http\Controllers\Frontend\Post;

use App\Http\Controllers\Controller;
use App\Models\Cms\Post\Post;
use App\Tavsio\Tavsio;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid as UUID;

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

    public function store(Request $request) {
        if($request->post()){
            $title    = $request->input('title');
            $category = $request->input('category');
            $content  = $request->input('content');
            $meta     = $request->input('meta');


            $post = new Post;
            $post->type = 0;
            $post->user_id = Auth::id();
            $post->title = 'Test';
            // Save post for retrieve meta owner id
            $post->save();
            $content = 'asdasdas';
            $post->createMeta('content',$content);

            if ($request->hasFile('photos')) {
                $photos = $this->uploadPhotos($request);
                //var_dump($photos);
                $post->setMeta('images' , json_decode($photos) , 'json');
                if(count($photos) > 1) $post->type = 1;
                else $post->type = 2;
            }
            // Save post after set meta keys
            $post->save();

        }
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
    }

    public function test() {
       /* $post = Post::find(1);
        $post->title = 'Test';
        $post->createMeta('image' , 'image1.jpg');
        //$post->setMeta('key' , 'value'); // create meta
        $post->save();
        dd($post);*/
        return view('frontend.test');
    }

    /***
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Support\Collection
     */
    private function uploadPhotos(Request $request) {
        $photos = collect();
        //$allowedfileExtension = ['pdf','jpg','png','docx'];
        $files = $request->file('photos');
        foreach($files as $file) {
            $rules = array('file' => 'required|mimes:png,gif,jpeg');

            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){
                $destinationPath = 'uploads';
                $filename = UUID::generate()->string.$file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                if($upload_success) {
                    $photos->push($filename);
                }
            }
        }
        return $photos;
    }


}
