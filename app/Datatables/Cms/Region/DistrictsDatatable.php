<?php namespace App\Datatables\Cms\Region;

use App\Http\Controllers\Controller;
use App\Models\Cms\Region\Districts;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class DistrictsDatatable
 */
class DistrictsDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Districts::getDatatable())
            ->editColumn('created_at', function (Districts $districts) {
                return date('d-m-Y H:i', strtotime($districts->created_at));
            })
            ->editColumn('status',function (Districts $districts){
                $class = $districts->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $districts->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->addColumn('actions',function (Districts $districts) {
                $uuid      = $districts->uuid;
                $editUrl   = url('tavsiocms/region/districts/edit/'.$uuid);
                $removeUrl = url('tavsiocms/region/districts/remove');

                return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
            })
            ->rawColumns(['actions','status'])
            ->make(true);

        return $data;
    }
}
