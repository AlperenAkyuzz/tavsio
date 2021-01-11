<?php namespace App\Datatables\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\Logs;
use Yajra\DataTables\DataTables;

/****
 * Class LogsDatatable
 */
class LogsDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Logs::getDatatable())
            ->editColumn('created_at',function (Logs $logs) {
                return date('d-m-Y', strtotime($logs->created_at));
            })
            ->rawColumns(['sys_admins.username','sys_log_types.display','sys_logs.level','sys_logs.content','sys_logs.created_at'])
            ->make(true);

        return $data;
    }
}
