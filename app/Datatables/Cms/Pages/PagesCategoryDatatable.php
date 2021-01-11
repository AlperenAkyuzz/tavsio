<?php namespace App\Datatables\Cms\Pages;

use App\Http\Controllers\Controller;
use App\Models\Cms\Pages\PagesCategory;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class PagesCategoryDatatable
 */
class PagesCategoryDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(PagesCategory::getDatatable())
            ->editColumn('created_at', function (PagesCategory $pagesCategory) {
                return date('d-m-Y H:i', strtotime($pagesCategory->created_at));
            })
            ->editColumn('status',function (PagesCategory $pagesCategory) {
                $class = $pagesCategory->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $pagesCategory->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->addColumn('actions',function (PagesCategory $pagesCategory) {
                $uuid      = $pagesCategory->uuid;
                $editUrl   = url('tavsiocms/pages/category-edit/'.$uuid);
                $removeUrl = url('tavsiocms/pages/category-remove');

                return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
            })
            ->rawColumns(['actions','status'])
            ->make(true);

        return $data;
    }
}
