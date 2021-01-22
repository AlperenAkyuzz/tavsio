<?php namespace App\Models\Cms\Post;

use Illuminate\Database\Eloquent\Model;
use Zoha\Metable;

/***
 * Class Post
 * @package App\Models\Cms\Post
 */
class Post extends Model
{
    use Metable;
    const POST_TYPE = [
        1 => 'album',
        2 => 'single',
        3 => 'external',
        4 => 'map',
        5 => 'sponsor',
        6 => 'video'
    ];

    const POST_TYPE_ALBUM = 1;
    const POST_TYPE_EXTERNAL = 2;
    const POST_TYPE_MAP = 3;
    const POST_TYPE_SPONSOR = 4;
    const POST_TYPE_VIDEO = 5;

    /***
     * @var string
     */
    protected $table = 'user_posts';



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
    /**
     * @var int|\Zoha\Meta\Helpers\MetaCollection
     */

    /***
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
