<?php namespace App\Datatables\Cms\Site\Mail;

use App\Http\Controllers\Controller;
use App\Models\Cms\Site\Mail;
use App\Ozelders\Ozelders;
use Yajra\DataTables\DataTables;

/****
 * Class MailDatatable
 */
class MailDatatable extends Controller
{

   /***
	* @param $request
	* @return mixed
	* @throws \Exception
	*/
   public function index()
   {
	  $data = DataTables::of(Mail::getDatatable())
		 ->addColumn('actions',
			function(Mail $mail) {
			   $uuid 	= $mail->uuid;
			   $editUrl = url('tavsiocms/site/mail/edit/'.$uuid);
			   $sendUrl = url('tavsiocms/site/mail/send/'.$uuid);
			   $removeUrl = url('tavsiocms/site/mail/remove');

			   return Ozelders::datatableActionButtons2([ 'url' => $editUrl ], [ 'url' => $sendUrl ], [ 'uuid' => $uuid, 'url' => $removeUrl ]);
			})
		 ->editColumn('message',function(Mail $mail){
		    return $mail->message;
		 })
		 ->rawColumns([ 'actions' ,'message' ])
		 ->make(true);

	  return $data;
   }
}
