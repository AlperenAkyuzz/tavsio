<?php namespace App\Models\Cms\Region;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/***
 * Class Cities
 * @package App\Models\Cms\Region
 *
 */
class Cities extends Model
{

    /***
     * @var string
     */
    protected $table = 'util_city';

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
        return Cities::join("util_country","util_city.country_id","=","util_country.id")
            ->get(['util_city.id','util_city.uuid','util_city.city','util_city.slug','util_city.country_id','util_country.printable_name','util_city.status', 'util_city.created_at']);
    }

    /***
     * @param string $slug
     * @return mixed
     */
    public static function checkCity(string $slug){
        return Cities::where(['slug' => $slug])->first();
    }

    /***
     * @param string $uuid
     * @return int
     */
    public static function cityUuidById(string $uuid){
        $city = Cities::where('uuid',$uuid)->select('id')->first();
        return $city->id ?? 0;
    }

    /***
     * @param array $cityIds
     * @return array
     */
    public static function getCities(array $cityIds){
        $cities = Cities::whereIn('id',$cityIds)->select('city')->pluck('city');
        return $cities ? $cities->toArray() : [];
    }

    /***
     * @param int $cityId
     * @param int $state
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getCityLessonsPrices(int $cityId, int $state = 215){
        return DB::table('lessons_users as lu')
            ->select(DB::raw('MAX(price) as max'),DB::raw('MIN(price) as min'), DB::raw('AVG(price) as avg'))
            ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
            ->join('users_users as uu', 'uu.id', 'lu.userid')
            ->join('users_address as ua', 'ua.userid', '=', 'uu.id')
            ->where('ua.cityid', $cityId)
            ->where('lp.countryid', $state) // Ulkeler eklenince burasi degisecek dinamik olacak
            ->first();
    }
}
