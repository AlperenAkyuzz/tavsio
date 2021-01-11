<?php namespace App\Http\Controllers\Cms\Pages;

use App\Datatables\Cms\Pages\PagesCategoryDatatable;
use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Cms\Pages\PagesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid as UUID;

/***
 * Class PagesCategoryController
 * @package App\Http\Controllers
 */
class PagesCategoryController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(){
        $data = [
            'breadcrumbs' => [
                'pages/categories' => 'Sayfa Kategorileri',
            ]
        ];
        return view('cms.pages.categories.index',$data);
    }

    /***
     * @param pagesCategoryDatatable $pagesCategoryDatatable
     * @return mixed
     * @throws \Exception
     */
    public function categoryDatatable(PagesCategoryDatatable $pagesCategoryDatatable){
        return $pagesCategoryDatatable->index();
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
                'title' => 'Kategori Başlık'
            ];

            $this->validate(request(),[
                'title' => 'required'
            ],[],$fields);

            // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
            // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
            // Burada formdan gelen degerleri cekiyoruz

            $insert = [
                'title'       => $request->post('title'),
                'uuid'        => UUID::generate()->string,
                'status'      => $request->post('status'),
                'created_at'  => date('Y-m-d H:i:s')
            ];

            // Burada veritabanina kayit islemi yapilmistir.
            $result = PagesCategory::create($insert);

            if($result){

                // System Log Kaydi
                $logMessage = $insert['title'].' isimli kategori sisteme eklendi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_INFORMATION);

                // Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
                return redirect('tavsiocms/pages/categories')
                    ->with('status','success')
                    ->with('responseTitle','Sistem Kayıt İşlemi Başarılı')
                    ->with('responseMessage',$logMessage);
            }else{

                // System Log Kaydi
                $logMessage = $insert['title'].' isimli kategori sisteme eklenirken sorun oluştu.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_ERROR);

                // Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
                return redirect()->back()
                    ->with('status','error')
                    ->with('responseTitle','Sistem Kayıt İşlemi Başarısız')
                    ->with('responseMessage',$logMessage);
            }

        }else{

            // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
            $data = [
                'title'       => 'Yeni Kategori Ekle',
                'breadcrumbs' => [
                    'pages/categories' => 'Sayfa Kategorileri'
                ]
            ];

            return view('cms.pages.categories.add',$data);
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
                'title' => 'Kategori Başlık'
            ];

            $this->validate(request(),[
                'title' => 'required'
            ],[],$fields);

            // Eger yukaridaki validations kontrolunden gecerse sistem eger gecmez ise
            // otomatik olarak forma hata mesaji gonderir formun icinde bulunan $error degiskeni...
            // Burada formdan gelen degerleri cekiyoruz

            $update = [
                'title'       => $request->post('title'),
                'status'      => $request->post('status'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            // Burada veritabaninda duzenleme islemi yapilmistir.
            $result = PagesCategory::where('uuid',$uuid)->update($update);

            if($result){

                // System Log Kaydi
                $logMessage = $update['title'].' isimli kategori sistemde düzenlendi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_INFORMATION);

                // Burada hersey basarili ise listeleme ekranina donus yapilir geriye 3 adet degisken ve mesajlari ile birlikte...
                return redirect('tavsiocms/pages/categories')
                    ->with('status','success')
                    ->with('responseTitle','Sistem Düzenleme İşlemi Başarılı')
                    ->with('responseMessage',$logMessage);
            }else{

                // System Log Kaydi
                $logMessage = $update['title'].' isimli kategori sisteme düzenlenirken sorun oluştu.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::guard('admin')->id(),Logger::LOG_LEVEL_ERROR);

                // Burada basarisiz mesaji degiskenler ile birlikte post isteginin geldigi sayfaya gonderir.
                return redirect()->back()
                    ->with('status','error')
                    ->with('responseTitle','Sistem Düzenleme İşlemi Başarısız')
                    ->with('responseMessage',$logMessage);
            }

        }else{

            // Pages kategorisinin kontrolunu sagliyoruz yok ise listeleme ekranina donus yapiyoruz...
            $pagesCategory = PagesCategory::where('uuid',$uuid)->first();
            if(!$pagesCategory){
                return redirect(url('tavsiocms/pages/categories'));
            }

            // Eger metoda gelen istek GET ile yapilmissa burasi calisir.
            $data = [
                'title'        => 'Kategori Düzenle',
                'pagesCategory' => $pagesCategory,
                'breadcrumbs'  => [
                    'pages/categories' => 'Sayfa Kategorileri'
                ]
            ];

            return view('cms.pages.categories.edit',$data);
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

            // Silinmek istenilen pages kategorisi var mi onun kontrolu yapiliyor...
            $pagesCategory = PagesCategory::select('title')->where('uuid',$uuid)->first();
            if(!$pagesCategory){
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Silmeye çalıştığınız içerik bulunamadı!'
                ]);
            }

            $result = PagesCategory::where('uuid',$uuid)->delete();

            if ($result) {

                // System Log Kaydi
                $logMessage = $pagesCategory->title.' isimli sayfa kategorisi silinmiştir.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_INFORMATION);

                return response()->json([
                    'status'  => 'success',
                    'message' => $logMessage
                ]);

            }else{

                // System Log Kaydi
                $logMessage = $pagesCategory->title.' isimli sayfa kategorisi silinirken sorun meydana geldi.';
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
