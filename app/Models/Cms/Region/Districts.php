<?php namespace App\Models\Cms\Region;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/***
 * Class Districts
 * @package App\Models\Cms\Region
 *
 */
class Districts extends Model
{
    /***
     * @var string
     */
    protected $table = 'util_district';

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
        return Districts::join("util_city","util_district.city_id","=","util_city.id")
            ->join("util_country","util_city.country_id","=","util_country.id")
            ->get(['util_district.id','util_district.uuid','util_district.district','util_district.slug','util_district.city_id','util_city.city','util_country.printable_name','util_district.status', 'util_district.created_at']);
    }

    /***
     * @param string $slug
     * @return mixed
     */
    public static function checkDistrict(string $slug){
        return Districts::where(['slug' => $slug])->exists();
    }

    /***
     * @param int $districId
     * @param int $state
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getDistrictLessonsPrices(int $districId, int $state = 215)
    {
        return DB::table('lessons_users as lu')
            ->select(DB::raw('MAX(price) as max'),DB::raw('MIN(price) as min'), DB::raw('AVG(price) as avg'))
            ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
            ->join('users_users as uu', 'uu.id', 'lu.userid')
            ->join('users_address as ua', 'ua.userid', '=', 'uu.id')
            ->where('ua.districtid', $districId)
            ->where('lp.countryid', $state) // Ulkeler eklenince burasi degisecek dinamik olacak
            ->first();
    }

    /***
     * @param $districtId
     * @return Model|\Illuminate\Database\Query\Builder|object|null
     */
    public static function getCity($districtId) {
        return DB::table('util_city as uc')
            ->select(['uc.city', 'uc.slug'])
            ->join('util_district as ud', 'ud.city_id', '=', 'uc.id')
            ->where('ud.id', $districtId)
            ->first();
    }
}
