<?php namespace App\Http\Controllers\Cms\Categories;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Webpatser\Uuid\Uuid as UUID;
use Image;

/***
 * Class CategoriesController
 * @package App\Http\Controllers
 */
class CategoriesController extends Controller
{
    // | CATEGORIES METODS

    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function categories(){
        $categories    = Category::getTopCategories();
        $allCategories = Category::getAllCategories();

        $data = [
            'title'         => 'Kategoriler',
            'categories'    => $categories,
            'allCategories' => $allCategories,
            'breadcrumbs' => [
                'categories' => 'Kategoriler',
            ]
        ];

        return view('cms.categories.index',$data);
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryAdd(Request $request){

        // Request Type Ajax Check
        if($request->ajax()){
            $title       = $request->post('title');
            $parent_id   = $request->post('categories');
            $status      = $request->post('status');
            $description = $request->post('description');
            $icon        = $request->post('icon');

            $categoryOrder = 1;
            $category      = Category::select(['order_number'])->where('parent_id',$parent_id)->orderBy('order_number','DESC')->first();

            if($category){
                $categoryOrder = $category->order_number + 1;
            }

            $photo = null;
            if($request->hasFile('photo')){
                $file = Str::slug($title) . time() . '.jpg';
                Image::make($request->file('photo'))->save(public_path('images/categories/'.$file),100);
                $photo = $file;
            }

            $insert = [
                'title'        => $title,
                'uuid'         => UUID::generate()->string,
                'parent_id'    => $parent_id,
                'order_number' => $categoryOrder,
                'description'  => $description,
                'status'       => $status,
                'icon'         => $icon,
                'photo'        => $photo,
                'slug'         => Str::slug($title),
                'created_at'   => date('Y-m-d H:i:s')
            ];

            $result = Category::create($insert);
            $cat    = Category::select('*')->where('id',$parent_id)->first();

            if($result){

                // System Log Kaydi
                $logMessage = $title.' isimli ders kategorisi eklenmiştir.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_INFORMATION);

                return response()->json([
                    'status'   => 'success',
                    'id'       => $parent_id,
                    'category' => $cat
                ]);
            }else{

                // System Log Kaydi
                $logMessage = $title.' isimli ders kategorisi eklenirken sorun meydana geldi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_ERROR);

                return response()->json([
                    'status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'status'  => 'error',
                'message' => 'Böyle bir istek bulunamadı!'
            ]);
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryEdit(Request $request){

        // Request Type Ajax Check
        if($request->ajax()){
            $title       = $request->post('title');
            $parent_id   = $request->post('categories');
            $status      = $request->post('status');
            $seo_title   = $request->post('seo_title');
            $description = $request->post('description');
            $icon        = $request->post('icon');
            $id          = $request->post('id');

            $update = [
                'title'        => $title,
                'parent_id'    => $parent_id,
                'description'  => $description,
                'seo_title'    => $seo_title,
                'status'       => $status,
                'icon'         => $icon,
                'slug'         => Str::slug($title),
                'updated_at'   => date('Y-m-d H:i:s')
            ];

            if($request->hasFile('photo')){
                $file = Str::slug($title) . time() . '.jpg';
                Image::make($request->file('photo'))->save(public_path('images/categories/'.$file),100);
                $update['photo'] = $file;
            }

            $result = Category::where('id',$id)->update($update);
            $cat    = Category::select('*')->where('id',$parent_id)->first();

            if($result){

                // System Log Kaydi
                $logMessage = $title.' isimli ders kategorisi düzenlenmiştir.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_INFORMATION);

                return response()->json([
                    'status'   => 'success',
                    'id'       => $parent_id,
                    'category' => $cat
                ]);
            }else{

                // System Log Kaydi
                $logMessage = $title.' isimli ders kategorisi düzenlenirken sorun meydana geldi.';
                Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_ERROR);

                return response()->json([
                    'status' => 'error'
                ]);
            }
        }else{
            return response()->json([
                'status'  => 'error',
                'message' => 'Böyle bir istek bulunamadı!'
            ]);
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function childsCategory(Request $request){
        try{
            $parentId   = $request->input('parent_id');
            $categories = Category::select(['id','title'])
                ->where('parent_id',$parentId)
                ->orderBy('order_number')
                ->get();

            $categories->map(function ($item,$key){
                $check = Category::select(['id','title'])->where('parent_id',$item->id)->exists();
                if($check){
                    $item->count = 1;
                }else{
                    $item->count = 0;
                }

                return $item;
            });

            return response($categories);
        }catch (\Exception $e){
            return response(['error' => $e->getMessage()]);
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function orderingCategory(Request $request){
        try{
            $arrays = $this->parseJsonArray($request->input('listData'));

            foreach($arrays as $key => $row){
                Category::where('id',$row['id'])
                    ->update([
                        'parent_id'    => $row['parent_id'],
                        'order_number' => $key+1
                    ]);
            }

            return response(['succes']);

        }catch (\Exception $e){
            return response(['error' => $e->getMessage()]);
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCategory(Request $request){
        // Request Type Ajax Check
        if($request->ajax()){
            $id = $request->post('id');

            $category = Category::where('id',$id)->first();
            if(!$category){
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Bu kategoriye ait ilan ve alt kategori mevcuttur!Lütfen ilk önce bu kategoriye ait olan ilan ve alt kategorileri siliniz.'
                ]);
            }else{
                $categoriesDelete = Category::destroy($id);
                if($categoriesDelete){

                    // System Log Kaydi
                    $logMessage = $category->title.' isimli ders kategorisi silinmiştir.';
                    Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_INFORMATION);

                    return response()->json(['status' => 'success']);
                }else{

                    // System Log Kaydi
                    $logMessage = $category->title.' isimli ders kategorisi silinirken sorun meydana geldi.';
                    Logger::logMessage(Logger::CLIENT_MODEL,$logMessage,Auth::id(),Logger::LOG_LEVEL_ERROR);

                    return response()->json([
                        'status' => 'error',
                        'message' => 'İşlem Başarısız'
                    ]);
                }
            }
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function getCategory(Request $request)
    {
        try{
            $category       = Category::find($request->input('id'));
            $categoryParent = Category::select(['title'])->where('id',$category->parent_id)->first();

            return response([
                'category' => $category,
                'title'    => $categoryParent ? $categoryParent->title : 'Ana Kategori Olarak Ekle'
            ]);

        }catch (\Exception $e){
            return response(['error' => $e->getMessage()]);
        }
    }

    // | ---------------- HELPERS FUNCTIONS -------------------------------

    /***
     * @param $jsonArray
     * @param int $parentID
     * @return array
     */
    private function parseJsonArray($jsonArray, $parentID = 0) {
        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray['children'])) {
                $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
            }

            $return[] = array('id' => $subArray['id'], 'parent_id' => $parentID);
            $return   = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

}
