<?php namespace App\Http\Controllers\Cms\Pages;

use App\Datatables\Cms\Pages\PagesDatatable;
use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Cms\Pages\Pages;
use App\Models\Cms\Pages\PagesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid as UUID;

/***
 * Class PagesController
 * @package App\Http\Controllers
 */
class PagesController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        $data = [
            'breadcrumbs' => [
                'pages' => 'Sayfalar',
            ]
        ];
        return view('cms.pages.index',$data);
    }

    /***
     * @param pagesDatatable $pagesDatatable
     * @return mixed
     * @throws \Exception
     */
    public function pagesDatatable(PagesDatatable $pagesDatatable){
        return $pagesDatatable->index();
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function add(Request $request){

        // Eger formdan gelen bir POST islemi var ise bu blok calisir eger yok ise
        // else kismi calisir.
        if($request->isMethod('post')){

            // Validations Kontrolu
            $fields = [
                'title' => 'Başlık',
            ];

            $this->validate(request(),[
                'title' => 'required'
            ],[],$fields);

            // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
            // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
            // Burada formdan gelen degerleri cekiyoruz

            $insert = [
                'title'       => $request->post('title'),
                'categoryid'  => $request->post('category'),
                'slug'        => Str::slug($request->post('title')),
                'description' => $request->post('description'),
                'detail'      => $request->post('detail'),
                'uuid'        => UUID::generate()->string,
                'status'      => $request->post('status'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            // Burada veritabanina kayit islemi yapilmistir.
            $result = Pages::create($insert);

            if($result){

                // System Log Kaydi
                $logMessage = $insert['title'].' isimli sayfa sisteme eklendi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_INFORMATION);

                // Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
                return redirect('tavsiocms/pages')
                    ->with('status','success')
                    ->with('responseTitle','Sistem Kayıt İşlemi Başarılı')
                    ->with('responseMessage',$logMessage);
            }else{

                // System Log Kaydi
                $logMessage = $insert['title'].' isimli sayfa sisteme eklenirken sorun oluştu.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_ERROR);

                // Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
                return redirect()->back()
                    ->with('status','error')
                    ->with('responseTitle','Sistem Kayıt İşlemi Başarısız')
                    ->with('responseMessage',$logMessage);
            }

        }else{

            $categories = PagesCategory::select(['id','title'])->where('status',1)->get();

            // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
            $data = [
                'title'      => 'Yeni Sayfa Ekle',
                'categories' => $categories,
                'breadcrumbs' => [
                    'pages' => 'Sayfalar'
                ]
            ];

            return view('cms.pages.add',$data);
        }

    }

    /***
     * @param Request $request
     * @param $uuid
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request,$uuid){

        // Eger formdan gelen bir POST islemi var ise bu blok calisir eger yok ise
        // else kismi calisir.
        if($request->isMethod('post')){

            // Validations Kontrolu
            $fields = [
                'title' => 'Başlık'
            ];

            $this->validate(request(),[
                'title' => 'required'
            ],[],$fields);

            // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
            // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
            // Burada formdan gelen degerleri cekiyoruz

            $update = [
                'title'       => $request->post('title'),
                'categoryid'  => $request->post('category'),
                'slug'        => Str::slug($request->post('title')),
                'description' => $request->post('description'),
                'detail'      => $request->post('detail'),
                'status'      => $request->post('status'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            // Burada veritabaninda duzenleme islemi yapilmistir.
            $result = Pages::where('uuid',$uuid)->update($update);

            if($result){

                // System Log Kaydi
                $logMessage = $update['title'].' isimli sayfa düzenlendi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_INFORMATION);

                // Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
                return redirect('tavsiocms/pages')
                    ->with('status','success')
                    ->with('responseTitle','Sistem Düzenleme İşlemi Başarılı')
                    ->with('responseMessage',$logMessage);
            }else{

                // System Log Kaydi
                $logMessage = $update['title'].' isimli sayfa düzenlenirken sorun oluştu.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_ERROR);

                // Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
                return redirect()->back()
                    ->with('status','error')
                    ->with('responseTitle','Sistem Düzenleme İşlemi Başarısız')
                    ->with('responseMessage',$logMessage);
            }

        }else{

            // Pages kategorisinin kontrolunu sagliyoruz yok ise listeleme ekranina donus yapiyoruz...
            $pages = Pages::where('uuid',$uuid)->first();
            if(!$pages){
                return redirect(url('tavsiocms/pages'));
            }

            $categories = PagesCategory::select(['id','title'])->where('status',1)->get();

            // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
            $data = [
                'title'      => 'Sayfa Düzenle',
                'pages'      => $pages,
                'categories' => $categories,
                'breadcrumbs'  => [
                    'pages' => 'Sayfalar'
                ]
            ];

            return view('cms.pages.edit',$data);
        }

    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove(Request $request){

        // Eger formdan gelen bir AJAX islemi var ise bu blok calisir eger yok ise metodu calistiramaz
        if($request->ajax()){

            $uuid = $request->post('uuid');

            // Silinmek istenilen pages var mi onun kontrolu yapiliyor...
            $pages = Pages::select('title')->where('uuid',$uuid)->first();
            if(!$pages){
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Silmeye çalıştığınız içerik bulunamadı!'
                ]);
            }

            $result = Pages::where('uuid',$uuid)->delete();

            if ($result) {

                // System Log Kaydi
                $logMessage = $pages->title.' isimli sayfa silinmiştir.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_INFORMATION);

                return response()->json([
                    'status'  => 'success',
                    'message' => $logMessage
                ]);

            }else{

                // System Log Kaydi
                $logMessage = $pages->title.' isimli sayfa silinirken sorun meydana geldi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_ERROR);

                return response()->json([
                    'status'  => 'success',
                    'message' => $logMessage
                ]);
            }
        }else{
            return response()->json([
                'status'  => 'success',
                'message' => 'Böyle bir istek bulunamadı!'
            ]);
        }
    }
}
