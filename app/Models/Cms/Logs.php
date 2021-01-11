<?php namespace App\Models\Cms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/***
 * Class Logs
 * @package App\Models\Cms
 *
 * @property id
 * @property log_type_id
 * @property user_id
 * @property level
 * @property content
 * @property created_at
 */
class Logs extends Model
{
    /***
     * @var string
     */
    protected $table = 'sys_logs';

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
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getDatatable(){
        return Logs::select(['sys_logs.id','sys_admins.username','sys_log_types.display','sys_logs.level','sys_logs.content', 'sys_logs.created_at'])
            ->join("sys_log_types","sys_logs.log_type_id","=","sys_log_types.id")
            ->join("sys_admins","sys_logs.user_id","=","sys_admins.id");
    }
}
