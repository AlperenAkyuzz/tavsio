<?php namespace App\Datatables\Cms\Region;

use App\Http\Controllers\Controller;
use App\Models\Cms\Region\Places;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class PlacesDatatable
 */
class PlacesDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Places::getDatatable())
            ->editColumn('created_at', function (Places $places) {
                return date('d-m-Y H:i', strtotime($places->created_at));
            })
            ->editColumn('status',function (Places $places){
                $class = $places->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $places->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->addColumn('actions',function (Places $places) {
                $uuid      = $places->uuid;
                $editUrl   = url('tavsiocms/region/places/edit/'.$uuid);
                $removeUrl = url('tavsiocms/region/places/remove');

                return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
            })
            ->rawColumns(['actions','status'])
            ->make(true);

        return $data;
    }
}
