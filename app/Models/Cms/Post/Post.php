<?php namespace App\Models\Cms\Post;

use Illuminate\Database\Eloquent\Model;


/***
 * Class Post
 * @package App\Models\Cms\Post
 */
class Post extends Model
{

    /***
     * @var string
     */
    protected $table = 'posts';

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
