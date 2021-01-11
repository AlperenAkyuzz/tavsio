<?php namespace App\Models\Cms\Site;

use Illuminate\Database\Eloquent\Model;

/***
 * Class MailTemplate
 * @package App\Models\Cms\Site
 *
 */
class MailTemplate extends Model
{
    /***
     * @var string
     */
    protected $table = 'site_mail_temp';

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
     * @return mixed
     */
   public static function getDatatable(){
        return MailTemplate::select(['created_at','uuid','id','title','description'])->get();
    }
}
