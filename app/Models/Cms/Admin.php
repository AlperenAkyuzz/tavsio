<?php namespace App\Models\Cms;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/***
 * Class Admin
 * @package App\Models\Cms
 *
 * @property id
 * @property email
 * @property name
 * @property username
 * @property status
 */
class Admin extends Authenticatable
{
    use Notifiable;

    //==================================================================================================================
    // enums
    //==================================================================================================================

    const USER_SYSTEM   = 1; // Id of system user
    const USER_LOG_TYPE = 1; // Id of system user

    //==================================================================================================================
    // enums
    //==================================================================================================================

    const USER_CLIENT_USER   = 4; // Id of system user
    const USER_GENDER_MALE   = 1;
    const USER_GENDER_FEMALE = 2;

    /***
     * @var string
     */
    protected $table = 'sys_admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //==================================================================================================================
    // Global METODS
    //==================================================================================================================

    /***
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getDatatable(){
        return Admin::select(['id','email','name','username','status']);
    }
}
