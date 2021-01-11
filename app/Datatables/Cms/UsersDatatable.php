<?php namespace App\Datatables\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\Admin;
use Yajra\DataTables\DataTables;

/****
 * Class UsersDatatable
 */
class UsersDatatable extends Controller {

    /***
     * @param $request
     * @return mixed
     * @throws \Exception
     */
    public function index()
    {
        $data = DataTables::of(Admin::getDatatable())
            ->editColumn('name',function (Admin $admin) {
                $states = [ 'success', 'light', 'danger', 'success', 'warning', 'dark', 'primary', 'info' ];

                return '<div class="d-flex align-items-center">
                            <div class="symbol symbol-50 symbol-light-'. $states[array_rand($states,1)] .' flex-shrink-0">
                                <div class="symbol-label font-size-h5"> '. substr($admin->name,0,1) .' </div>
                            </div>
                            <div class="ml-3">
                                <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">'.$admin->name.'</span>
                                <a href="#" class="text-muted text-hover-primary"> Özelders Alanı Yönetici Hesabı </a>
                            </div>
                        </div>';
            })
            ->editColumn('email',function (Admin $admin) {
                return '<a class="text-dark-50 text-hover-primary" href="mailto:' . $admin->email . '">' . $admin->email . '</a>';
            })
            ->editColumn('status',function (Admin $admin) {
                $class = $admin->status == 1 ? 'label-light-success' : 'label-light-danger';
                $name  = $admin->status == 1 ? 'Aktif' : 'Pasif';

                return '<span class="label label-lg font-weight-bold ' . $class . ' label-inline">' . $name . '</span>';
            })
            ->editColumn('actions',function (Admin $admin) {
                return '<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Yetkiler">
                            <i class="flaticon-security"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">
                            <i class="la la-edit"></i>
                        </a>
                        <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">
                            <i class="la la-trash"></i>
                        </a>';
            })
            ->rawColumns(['actions','name','email','status'])
            ->make(true);

        return $data;
    }
}
