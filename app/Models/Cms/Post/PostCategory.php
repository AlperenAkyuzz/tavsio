<?php namespace App\Models\Cms\Pages;

use Illuminate\Database\Eloquent\Model;

/***
 * Class PagesCategory
 * @package App\Models\Cms\Pages
 *
 */
class PostCategory extends Model
{
    /***
     * @var string
     */
    protected $table = 'post_categories';

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

    public function parent()
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function children()
    {
        return $this->hasMany(PostCategory::class);
    }


    //==================================================================================================================
    // Global METODS
    //==================================================================================================================

    /***
     * @return mixed
     */
    public static function getDatatable(){
        return PagesCategory::select(['uuid','id','title','status', 'created_at']);
    }

}
