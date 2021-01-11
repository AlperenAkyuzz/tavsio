<?php namespace App\Http\Controllers\Cms;

use App\Datatables\Cms\UsersDatatable;
use App\Http\Controllers\Controller;

/***
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        return view('cms.users.users');
    }

    /***
     * @param UsersDatatable $usersDatatable
     * @return mixed
     * @throws \Exception
     */
    public function usersDatatable(UsersDatatable $usersDatatable){
        return $usersDatatable->index();
    }

}
