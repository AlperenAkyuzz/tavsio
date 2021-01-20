<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\User;

/***
 * Class RedirectController
 * @package App\Http\Controllers\Frontend
 */
class RedirectController extends Controller
{
    /***
     * @param string $slug
     * @param false $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View|string
     */
    public function index(string $slug, $id = false){
        $checkProfile = User::where('username',$slug)->where('status',1)->first();
        if($checkProfile){
            $controller = new ProfileController();
            return $controller->show($checkProfile);
        }

        return '404';
    }
}
