<?php namespace App\Datatables\Cms\Site\MailTemplate;

use App\Http\Controllers\Controller;
use App\Models\Cms\Site\MailTemplate;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class MailTemplateDatatable
 */
class MailTemplateDatatable extends Controller
{

   /***
	* @param $request
	* @return mixed
	* @throws \Exception
	*/
   public function index()
   {
	  $data = DataTables::of(MailTemplate::getDatatable())
          ->editColumn('created_at', function (MailTemplate $mailTemplate) {
              return date('d.m.Y H:i', strtotime($mailTemplate->created_at));
          })
		 ->addColumn('actions',function (MailTemplate $mailTemplate) {
			$uuid      = $mailTemplate->uuid;
			$editUrl   = url('tavsiocms/site/mail-template/edit/'.$uuid);
			$removeUrl = url('tavsiocms/site/mail-template/remove');

			return Ozelders::datatableActionButtons(['url' => $editUrl], ['uuid' => $uuid, 'url' => $removeUrl]);
		 })
		 ->rawColumns([ 'actions' ])
		 ->make(true);

	  return $data;
   }
}
