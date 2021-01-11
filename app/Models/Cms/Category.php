<?php namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Category
 * @package App\Models\Cms
 *
 */
class Category extends Model
{
    /***
     * @var string
     */
    protected $table = 'categories';

    /***
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /***
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childs() {
        return $this->hasMany('App\Models\Cms\Category','parent_id','id')->orderBy('order_number');
    }

    /***
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo('App\Models\Cms\Category', 'parent_id')->orderBy('order_number');
    }

    //==================================================================================================================
    // Global METODS
    //==================================================================================================================

    /***
     * @return mixed
     */
    public static function getTopCategories(){
        return Category::select(['uuid','id','title', 'slug'])->where('id', '!=', 0)->where('parent_id', '=', 0)->orderBy('order_number')->get();
    }

    /***
     * @param int $parentId
     * @return mixed
     */
    public static function getTopCategory(int $parentId){
        $category = Category::select(['id','title','parent_id'])->where('id', '=', $parentId)->first();
        if($category->parent_id != 0){
           return self::getTopCategory((int)$category->parent_id);
        }

        return $category;
    }

    /***
     * @param string $uuid
     * @return int
     */
    public static function getCategoryUuidById(string $uuid){
        $category = Category::select('id')
            ->where('uuid', '=', $uuid)
            ->first();

        return $category->id ?? 0;
    }

    /***
     * @param string $slug
     * @return mixed
     */
    public static function getCategorySlug(string $slug){
        return Category::select(['uuid','bg','slug','id','parent_id','title'])
            ->where('slug', '=', $slug)
            ->first();
    }

    /***
     * @param $uuid
     * @return mixed
     */
    public static function getLessonID($uuid) {
        $Categories = Category::where('uuid', $uuid)->first();
        return $Categories->id ?? 0;
    }

    /***
     * @param int $categoryId
     * @param array $fields
     *
     * @return mixed
     */
    public static function getChildsCategories(int $categoryId, array $fields = ['uuid','id','title']){
        return Category::select($fields)
            ->where('parent_id', '=', $categoryId)
            ->orderBy('order_number')
            ->get();
    }

    /***
     * @param int $categoryId
     * @param array $teacherIds
     * @param array|string[] $fields
     * @return mixed
     */
    public static function getTeachersChildsCategories(int $categoryId,array $teacherIds, array $fields = ['lessons_categories.uuid','lessons_categories.slug','lessons_categories.title']){
        return Category::select($fields)
            ->join('lessons_users as lu','lu.categoryid','=','lessons_categories.id')
            ->where('parent_id', '=', $categoryId)
            ->whereIn('lu.userid', $teacherIds)
            ->orderBy('order_number')
            ->groupBy(['lessons_categories.id','lessons_categories.uuid','lessons_categories.slug','lessons_categories.title'])
            ->get();
    }

    /***
     * @param int $parentId
     * @param array $fields
     *
     * @return mixed
     */
    public static function getParentSameCategories(int $parentId, array $fields = ['uuid','id','title']){
        return Category::select($fields)
            ->where('parent_id', '=', $parentId)
            ->orderBy('order_number')
            ->get();
    }

    /***
     * @param int $categoryId
     * @return array
     */
    public static function getChilds(int $categoryId){
        $childs = Category::where('parent_id',$categoryId)
            ->orderBy('order_number')
            ->pluck('id');

        return $childs->toArray() ?? [];
    }

    /***
     * @return mixed
     */
    public static function getAllCategories(){
        return Category::select(['uuid','id','title'])->orderBy('order_number')->get();
    }

    /***
     * @return mixed
     */
    public static function getLessonTeachers(){
        return Category::select(['uuid','id','title'])->orderBy('order_number')->get();
    }
}
