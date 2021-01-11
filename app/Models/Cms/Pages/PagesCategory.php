<?php namespace App\Models\Cms\Pages;

use Illuminate\Database\Eloquent\Model;

/***
 * Class PagesCategory
 * @package App\Models\Cms\Pages
 *
 */
class PagesCategory extends Model
{
    /***
     * @var string
     */
    protected $table = 'pages_categories';

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
        return PagesCategory::select(['uuid','id','title','status', 'created_at']);
    }
}
