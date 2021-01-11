<?php namespace App\Models\Cms;

use \Illuminate\Database\Eloquent\Model;

/**
 * Class Log
 * @property int client_id
 * @property int log_type_id
 * @property string content
 * @property int user_id
 * @property int level
 * @property string created_at
 */
class LogMessage extends Model {

    //==================================================================================================================
    //  Protected members
    //==================================================================================================================

    // table name
    protected $table = 'sys_logs';

    // date format, must be in ISO 8601
    //protected $dateFormat = 'c';

    // default values
    protected $attributes = [];

    /***
     * @var array
     */
    protected $guarded = [];

    public  $timestamps = false;

}
