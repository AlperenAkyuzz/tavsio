<?php namespace App\Models\Cms\Pages;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Pages
 * @package App\Models\Cms\Pages
 *
 */
class Pages extends Model
{
    /***
     * @var string
     */
    protected $table = 'pages_pages';

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

    //==================================================================================================================
    // Global METODS
    //==================================================================================================================

    /***
     * @return mixed
     */
    public static function getDatatable(){
        return Pages::select(['uuid','id','title','slug','description','detail','status','created_at']);
    }

    public static function getPageBySlug($slug) {
        return Pages::select(['title','description','detail'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->first();
    }
}
