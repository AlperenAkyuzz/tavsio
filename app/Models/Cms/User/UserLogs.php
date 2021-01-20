<?php namespace App\Models\Cms\User;

use Illuminate\Database\Eloquent\Model;

/***
 * Class UserLogs
 * @package App\Models\Cms
 *
 * @property id
 * @property user_id
 * @property level
 * @property content
 * @property created_at
 */
class UserLogs extends Model
{
    // log levels
    const LOG_LEVEL_CRITICAL    = 0;
    const LOG_LEVEL_ERROR       = 1;
    const LOG_LEVEL_WARNING     = 2;
    const LOG_LEVEL_INFORMATION = 3;

    /***
     * @var string
     */
    protected $table = 'users_logs';

    /***
     * @var bool
     */
    public $timestamps = false;

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
     * @param $userId
     * @param string $content
     * @param int $level
     * @return mixed
     */
    public static function userAddLog(int $userId, string $content, int $level = UserLogs::LOG_LEVEL_ERROR){
        return UserLogs::create([
            'user_id'    => $userId,
            'level'      => $level,
            'content'    => $content,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
