<?php namespace App\Datatables\Cms\Pages;

use App\Http\Controllers\Controller;
use App\Models\Cms\Pages\Pages;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class PagesDatatable
 */
class PagesDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Pages::getDatatable())
            ->editColumn('created_at', function (Pages $pages) {
                return date('d-m-Y H:i', strtotime($pages->created_at));
            })
            ->editColumn('status',function (Pages $pages) {
                $class = $pages->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $pages->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->addColumn('actions',function (Pages $pages) {
                $uuid      = $pages->uuid;
                $editUrl   = url('tavsiocms/pages/edit/'.$uuid);
                $removeUrl = url('tavsiocms/pages/remove');

                return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
            })
            ->rawColumns(['actions','status'])
            ->make(true);

        return $data;
    }
}
