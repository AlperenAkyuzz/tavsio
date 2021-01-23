<?php namespace App\Models\Cms\User;

use Illuminate\Database\Eloquent\Model;

/***
 * Class UserRank
 * @package App\Models\Cms
 *
 * @property id
 * @property user_id
 * @property level
 * @property content
 * @property created_at
 */
class USerRank extends Model
{

    /***
     * @var string
     */
    protected $table = 'ranks';

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

}
