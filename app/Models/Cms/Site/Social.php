<?php namespace App\Models\Cms\Site;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Social
 * @package App\Models\Cms\Site
 *
 */
class Social extends Model
{
    /***
     * @var string
     */
    protected $table = 'site_social';

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
        return Social::select()->first();
    }
}
