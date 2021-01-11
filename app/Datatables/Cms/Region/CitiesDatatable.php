<?php namespace App\Datatables\Cms\Region;

use App\Http\Controllers\Controller;
use App\Models\Cms\Region\Cities;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class CitiesDatatable
 */
class CitiesDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Cities::getDatatable())
            ->editColumn('created_at', function (Cities $cities) {
                return date('d-m-Y H:i', strtotime($cities->created_at));
            })
            ->editColumn('status',function (Cities $cities){
                $class = $cities->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $cities->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->addColumn('actions',function (Cities $cities) {
                $uuid      = $cities->uuid;
                $editUrl   = url('tavsiocms/region/cities/edit/'.$uuid);
                $removeUrl = url('tavsiocms/region/cities/remove');

                return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
            })
            ->rawColumns(['actions','status'])
            ->make(true);

        return $data;
    }
}
