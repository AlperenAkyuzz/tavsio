<?php namespace App\Models\Cms\Region;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/***
 * Class Places
 * @package App\Models\Cms\Region
 *
 */
class Places extends Model
{
    /***
     * @var string
     */
    protected $table = 'util_place';

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

    public static function getDatatable(){
        return Places::join("util_district","util_place.district_id","=","util_district.id")
            ->join("util_city","util_district.city_id","=","util_city.id")
            ->get(['util_place.id','util_place.uuid','util_place.place','util_place.slug','util_place.district_id','util_district.district','util_district.city_id','util_city.city','util_place.status', 'util_place.created_at']);
    }

    /***
     * @param string $slug
     * @return mixed
     */
    public static function checkPlace(string $slug){
        return Places::where(['slug' => $slug])->exists();
    }

    /***
     * @param int $districId
     * @param int $state
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getPlaceLessonsPrices(int $placeid, int $state = 215)
    {
        return DB::table('lessons_users as lu')
            ->select(DB::raw('MAX(price) as max'),DB::raw('MIN(price) as min'), DB::raw('AVG(price) as avg'))
            ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
            ->join('users_users as uu', 'uu.id', 'lu.userid')
            ->join('users_address as ua', 'ua.userid', '=', 'uu.id')
            ->where('ua.placeid', $placeid)
            ->where('lp.countryid', $state) // Ulkeler eklenince burasi degisecek dinamik olacak
            ->first();
    }

    /***
     * @param $placeId
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getDistrict($placeId) {
        return DB::table('util_district as ud')
            ->select(['ud.id','ud.district', 'ud.slug'])
            ->join('util_place as up', 'up.district_id', '=', 'ud.id')
            ->where('up.id', $placeId)
            ->first();
    }
}
