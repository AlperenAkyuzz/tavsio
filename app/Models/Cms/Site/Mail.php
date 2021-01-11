<?php namespace App\Models\Cms\Site;

use Illuminate\Database\Eloquent\Model;

/***
 * Class Mail
 * @package App\Models\Cms\Site
 *
 */
class Mail extends Model
{
    /***
     * @var string
     */
    protected $table = 'site_mails';

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
   /**
	* @var mixed
	*/
   private $uuid;
   
   public static function getDatatable(){
        return Mail::join('users_types','users_types.id','=','site_mails.usertype')
	  				->select('site_mails.id','site_mails.uuid','site_mails.title','site_mails.message',
					   'site_mails.usertype','users_types.name as user','site_mails.notification',
					   'site_mails.email','site_mails.created_at','site_mails.updated_at')->get();
    }
}
