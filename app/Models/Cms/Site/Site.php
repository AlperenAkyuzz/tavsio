<?php namespace App\Models\Cms\Site;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Site
 * @package App\Models\Cms\Site
 *
 */
class Site extends Model
{
    /***
     * @var string
     */
    protected $table = 'site_settings';

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
        'updated_at' => 'datetime',
    ];

    public static function getDatatable(){
        return Site::select()->first();
    }
}
