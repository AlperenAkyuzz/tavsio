<?php namespace App\Http\Controllers\Cms;

use App\Datatables\Cms\LogsDatatable;
use App\Http\Controllers\Controller;

/***
 * Class LogsController
 * @package App\Http\Controllers
 */
class LogsController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        return view('cms.logs.logs');
    }

    /***
     * @param LogsDatatable $logsDatatable
     * @return mixed
     * @throws \Exception
     */
    public function logsDatatable(LogsDatatable $logsDatatable){
        return $logsDatatable->index();
    }

}
