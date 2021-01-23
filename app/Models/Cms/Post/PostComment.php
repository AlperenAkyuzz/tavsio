<?php namespace App\Models\Cms\Post;

use App\User;
use Illuminate\Database\Eloquent\Model;

/***
 * Class PostComment
 * @package App\Models\Cms\Post
 */
class PostComment extends Model
{
    const POST_TYPE_ALBUM = 1;
    const POST_TYPE_EXTERNAL = 2;
    const POST_TYPE_MAP = 3;
    const POST_TYPE_SPONSOR = 4;
    const POST_TYPE_VIDEO = 5;

    /***
     * @var string
     */
    protected $table = 'post_comments';



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
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /***
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function likes()
    {
        //return $this->hasMany(PostLike::class);
    }

}
