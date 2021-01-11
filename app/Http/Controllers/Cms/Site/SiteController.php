<?php namespace App\Http\Controllers\Cms\Site;

use App\Datatables\Cms\Site\MailTemplate\MailTemplateDatatable;
use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Cms\Site\Site;
use App\Models\Cms\Site\Contact;
use App\Models\Cms\Site\Social;
use App\Models\Cms\Site\MailTemplate;
use App\Models\Cms\UserTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid as UUID;

/***
 * Class SiteController
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
   // SETTINGS

   /***
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	*/
   public function indexSettings()
   {
	  $site = DB::table('site_settings')->first();
	  $data = [
		 'site' => $site,
		 'breadcrumbs' => [
			'site/settings' => 'Genel Ayarlar',
		 ]
	  ];
	  return view('cms.site.settings', $data);
   }

   /***
	* @param Request $request
	* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	* @throws \Illuminate\Validation\ValidationException
	*/
   public function editSettings(Request $request)
   {

	  if($request->isMethod('post')) {

		 // Validations Kontrolu
		 $fields = [
			'name' => 'Site adı'
		 ];

		 $this->validate(request(), [
			'name' => 'required',
		 ], [], $fields);

		 // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
		 // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
		 // Burada formdan gelen degerleri cekiyoruz

		 $update = [
			'name' => $request->post('name'),
			'title' => $request->post('title'),
			'description' => $request->post('description'),
			'youtubecode' => $request->post('youtubecode'),
			'why' => $request->post('why'),
			'main' => $request->post('main'),
			'footer' => $request->post('footer'),
			'agreement' => $request->post('agreement'),
			'app_store' => $request->post('app_store'),
			'google_play' => $request->post('google_play'),
			'updated_at' => date('Y-m-d H:i:s')
		 ];

		 // Burada veritabaninda duzenleme islemi yapilmistir.
		 $result = Site::where('id', 1)->update($update);

		 if($result) {

			// System Log Kaydi
			$logMessage = 'Site ayarları düzenlendi.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_INFORMATION);

			// Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
			return redirect('tavsiocms/site/settings')
			   ->with('status', 'success')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarılı')
			   ->with('responseMessage', $logMessage);
		 } else {

			// System Log Kaydi
			$logMessage = 'Site ayarları düzenlenirken sorun oluştu.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_ERROR);

			// Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
			return redirect(url('tavsiocms/site/settings')) //->back()
			->with('status', 'error')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarısız')
			   ->with('responseMessage', $logMessage);
		 }

	  } else {
		 return redirect(url('tavsiocms/site/settings'));
	  }

   }

   //CONTACT

   /***
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	*/
   public function indexContact()
   {
	  $contact = DB::table('site_contact')->first();
	  $data = [
		 'contact' => $contact,
		 'breadcrumbs' => [
			'site/contact' => 'İletişim Bilgileri Ayarları',
		 ]
	  ];
	  return view('cms.site.contact', $data);
   }

   /***
	* @param Request $request
	* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	* @throws \Illuminate\Validation\ValidationException
	*/
   public function editContact(Request $request)
   {

	  if($request->isMethod('post')) {

		 $update = [
			'email' => $request->post('email'),
			'phone' => $request->post('phone'),
			'phone_other' => $request->post('phone_other'),
			'fax' => $request->post('fax'),
			'firm' => $request->post('firm'),
			'brand' => $request->post('brand'),
			'address' => $request->post('address'),
			'updated_at' => date('Y-m-d H:i:s')
		 ];

		 // Burada veritabaninda duzenleme islemi yapilmistir.
		 $result = Contact::where('id', 1)->update($update);

		 if($result) {

			// System Log Kaydi
			$logMessage = 'İletişim bilgileri düzenlendi.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_INFORMATION);

			// Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
			return redirect('tavsiocms/site/contact')
			   ->with('status', 'success')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarılı')
			   ->with('responseMessage', $logMessage);
		 } else {

			// System Log Kaydi
			$logMessage = 'İletişim bilgileri düzenlenirken sorun oluştu.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_ERROR);

			// Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
			return redirect(url('tavsiocms/site/contact')) //->back()
			->with('status', 'error')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarısız')
			   ->with('responseMessage', $logMessage);
		 }

	  } else {
		 return redirect(url('tavsiocms/site/contact'));
	  }
   }

   //SOCIAL

   /***
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	*/
   public function indexSocial()
   {
	  $social = DB::table('site_social')->first();
	  $data = [
		 'social' => $social,
		 'breadcrumbs' => [
			'site/social' => 'Sosyal Medya Ayarları',
		 ]
	  ];
	  return view('cms.site.social', $data);
   }

   /***
	* @param Request $request
	* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	* @throws \Illuminate\Validation\ValidationException
	*/
   public function editSocial(Request $request)
   {

	  if($request->isMethod('post')) {

		 $update = [
			'facebook' => $request->post('facebook'),
			'twitter' => $request->post('twitter'),
			'instagram' => $request->post('instagram'),
			'linkedin' => $request->post('linkedin'),
			'youtube' => $request->post('youtube'),
			'periscope' => $request->post('periscope'),
			'updated_at' => date('Y-m-d H:i:s')
		 ];

		 // Burada veritabaninda duzenleme islemi yapilmistir.
		 $result = Social::where('id', 1)->update($update);

		 if($result) {

			// System Log Kaydi
			$logMessage = 'Sosyal medya bilgileri düzenlendi.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_INFORMATION);

			// Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
			return redirect('tavsiocms/site/social')
			   ->with('status', 'success')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarılı')
			   ->with('responseMessage', $logMessage);
		 } else {

			// System Log Kaydi
			$logMessage = 'Sosyal medya bilgileri düzenlenirken sorun oluştu.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_ERROR);

			// Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
			return redirect(url('tavsiocms/site/socail')) //->back()
			->with('status', 'error')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarısız')
			   ->with('responseMessage', $logMessage);
		 }
	  } else {
		 return redirect(url('tavsiocms/site/social'));
	  }
   }

   //MAIL TEMPLATE

   /***
	* @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	*/
   public function indexMailTemplate()
   {
	  $data = [
		 'breadcrumbs' => [
			'site/mail-template' => 'Mail şablonları',
		 ]
	  ];
	  return view('cms.site.mailtemplate.index', $data);
   }

   /***
	* @param MailTemplateDatatable $mailTemplateDatatable
	* @return mixed
	* @throws \Exception
	*/
   public function mailTemplateDatatable(MailTemplateDatatable $mailTemplateDatatable)
   {
	  return $mailTemplateDatatable->index();
   }

   /***
	* @param Request $request
	* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	* @throws \Illuminate\Validation\ValidationException
	*/
   public function editMailTemplate(Request $request, $uuid)
   {

	  if($request->isMethod('post')) {

		 // Validations Kontrolu
		 $fields = [
			'title' => 'Mail şablon bağlığı'
		 ];

		 $this->validate(request(), [
			'title' => 'required',
		 ], [], $fields);

		 // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
		 // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
		 // Burada formdan gelen degerleri cekiyoruz

		 $update = [
			'title' 	  => $request->post('title'),
			'description' => $request->post('description'),
			'content' 	  => $request->post('content'),
			'updated_at'  => date('Y-m-d H:i:s')
		 ];

		 // Burada veritabaninda duzenleme islemi yapilmistir.
		 $result = MailTemplate::where('uuid', $uuid)->update($update);

		 if($result) {

			// System Log Kaydi
			$logMessage = 'Mail şablonu düzenlendi.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_INFORMATION);

			// Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
			return redirect('tavsiocms/site/mail-template')
			   ->with('status', 'success')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarılı')
			   ->with('responseMessage', $logMessage);
		 } else {

			// System Log Kaydi
			$logMessage = 'Mail şablonu düzenlenirken sorun oluştu.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_ERROR);

			// Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
			return redirect(url('tavsiocms/site/mail-template')) //->back()
			->with('status', 'error')
			   ->with('responseTitle', 'Düzenleme İşlemi Başarısız')
			   ->with('responseMessage', $logMessage);
		 }

	  } else {

		 $mailtemplate = MailTemplate::where('uuid', $uuid)->first();
		 if(!$mailtemplate) {
			return redirect(url('tavsiocms/site/mail-template'));
		 }

		 // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
		 $data = [
			'title' => 'Mail şablonu düzenle',
			'mailtemplate' => $mailtemplate,
			'breadcrumbs' => [
			   'site/mail-template' => 'Mail şablonları'
			]
		 ];

		 return view('cms.site.mailtemplate.edit', $data);
	  }

   }

   /***
	* @param Request $request
	* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
	* @throws \Illuminate\Validation\ValidationException
	*/
   public function addMailTemplate(Request $request)
   {

	  // Eger formdan gelen bir POST islemi var ise bu blok calisir eger yok ise
	  // else kismi calisir.
	  if($request->isMethod('post')) {

		 // Validations Kontrolu
		 $fields = [
			'title' => 'Şablon başlığı'
		 ];

		 $this->validate(request(), [
			'title' => 'required'
		 ], [], $fields);

		 // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
		 // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
		 // Burada formdan gelen degerleri cekiyoruz

		 $insert = [
			'uuid' 			=> UUID::generate()->string,
			'title' 		=> $request->post('title'),
			'description'   => $request->post('description'),
			'content' 		=> $request->post('content'),
			'created_at' 	=> date('Y-m-d H:i:s')
		 ];

		 // Burada veritabanina kayit islemi yapilmistir.
		 $result = MailTemplate::create($insert);

		 if($result) {

			// System Log Kaydi
			$logMessage = $insert[ 'title' ].' başlıklı şablon sisteme eklendi.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_INFORMATION);

			// Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
			return redirect('tavsiocms/site/mail-template')
			   ->with('status', 'success')
			   ->with('responseTitle', 'Sistem Kayıt İşlemi Başarılı')
			   ->with('responseMessage', $logMessage);
		 } else {

			// System Log Kaydi
			$logMessage = $insert[ 'title' ].' başlıklı şablon sisteme eklenirken sorun oluştu.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::guard('admin')->id(), Logger::LOG_LEVEL_ERROR);

			// Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
			return redirect()->back()
			   ->with('status', 'error')
			   ->with('responseTitle', 'Sistem Kayıt İşlemi Başarısız')
			   ->with('responseMessage', $logMessage);
		 }

	  } else {

		 // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
		 $data = [
			'title' => 'Yeni Mail Şablonu Ekle',
			'breadcrumbs' => [
			   'site/mail-template' => 'Mail şablonları'
			],
		 ];

		 return view('cms.site.mailtemplate.add', $data);
	  }

   }

   /***
	* @param Request $request
	* @return \Illuminate\Http\JsonResponse
	*/
   public function removeMailTemplate(Request $request)
   {

	  // Eger formdan gelen bir AJAX islemi var ise bu blok calisir eger yok ise metodu calistiramaz
	  if($request->ajax()) {

		 $uuid = $request->post('uuid');
		 // Silinmek istenilen şablon var mi onun kontrolu yapiliyor...
		 $mailtemplate = MailTemplate::where('uuid', $uuid)->first();
		 if(!$mailtemplate) {
			return response()->json([
			   'status' => 'error',
			   'message' => 'Silmeye çalıştığınız şablon bulunamadı!'
			]);
		 }

		 $result = MailTemplate::where('uuid', $uuid)->delete();

		 if($result) {

			// System Log Kaydi
			$logMessage = $mailtemplate->title.' başlıklı şablon silinmiştir.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::id(), Logger::LOG_LEVEL_INFORMATION);

			return response()->json([
			   'status' => 'success',
			   'message' => $logMessage
			]);

		 } else {

			// System Log Kaydi
			$logMessage = $mailtemplate->title.' başlıklı şablon silinmiştir.';
			Logger::logMessage(Logger::CLIENT_MODEL, $logMessage, Auth::id(), Logger::LOG_LEVEL_ERROR);

			return response()->json([
			   'status' => 'success',
			   'message' => $logMessage
			]);
		 }
	  } else {
		 return response()->json([
			'status' => 'success',
			'message' => 'Böyle bir istek bulunamadı!'
		 ]);
	  }
   }
}
