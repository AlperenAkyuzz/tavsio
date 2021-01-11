<?php namespace App\Models\Cms\Site;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Contact
 * @package App\Models\Cms\Site
 *
 */
class Contact extends Model
{
    /***
     * @var string
     */
    protected $table = 'site_contact';

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
        return Contact::select()->first();
    }
}
