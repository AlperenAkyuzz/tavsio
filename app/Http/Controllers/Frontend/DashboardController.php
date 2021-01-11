<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

/***
 * Class DashboardController
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        return view('frontend.home');
    }

}
