<?php namespace App;

use App\Ozelders\Ozelders;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Cmgmyr\Messenger\Traits\Messagable;

/**
 * Class User
 * @package App
 * @property int id
 */
class User extends Authenticatable
{
   use Notifiable;
    use Messagable;

    // Page Limit
   const HOME_TEACHERS_LIMIT = 10;

   const USER_PARENTS = 1;
   const USER_TEACHER = 2;
   const USER_COMPANIES = 3;

   const USER_STATUS_ACTIVE = 1;
   const USER_STATUS_WAITING = 2;
   const USER_STATUS_DELETE = 3;
   const USER_STATUS_NOT_APPROVED = 4;
   const USER_STATUS_FROZEN = 5;

   const GENDER_REVERSE = [
       1 => 'Bayan',
       2 => 'Erkek'
   ];

   const STATUS_TABLE_DESC = [
       1 => 'Aktif',
       2 => 'Onay Bekliyor',
       3 => 'Silinmiş',
       4 => 'Red edildi',
       5 => 'Dondurulmuş'
   ];

   protected $table = 'users_users';

   /**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
   protected $fillable = [
	  'name', 'email', 'password',
   ];

   /**
	* The attributes that should be hidden for arrays.
	*
	* @var array
	*/
   protected $hidden = [
	  'password', 'remember_token',
   ];

   /**
	* The attributes that should be cast to native types.
	*
	* @var array
	*/
   protected $casts = [
	  'email_verified_at' => 'datetime',
   ];

   //==================================================================================================================
   // Global METODS
   //==================================================================================================================

   /***
	* @param $request
	* @param int $type
	* @return mixed
	*/
   public static function getDatatable($request, $type = User::USER_PARENTS)
   {
	  $user = User::select([ 'id', 'uuid', 'created_at', 'photo', 'firstname', 'lastname', 'email', 'mobile', 'email_valid', 'mobile_valid', 'statusid', 'last_login', 'point', 'change_city' ])
		 ->where('typeid', $type);

	  $removeUserGet = true;
	  if(isset($request[ 'status' ])) {
		 $user = $user->where('statusid', $request[ 'status' ]);
		 if($request[ 'status' ] == User::USER_STATUS_DELETE) {
			$removeUserGet = false;
		 }
	  }

	  if($removeUserGet) {
		 $user = $user->where('statusid', '!=', User::USER_STATUS_DELETE);
	  }

	  if(isset($request[ 'date' ])) {
		 $date = explode('|', $request[ 'date' ]);

		 $startDate = date('Y-m-d 00:00:00', strtotime($date[ 0 ]));
		 $startEnd = date('Y-m-d H:i:s', strtotime($date[ 1 ]));

		 $user = $user->where('created_at', '>=', $startDate)
			->where('created_at', '<=', $startEnd);
	  }

	  return $user;
   }

   /***
	* @param int $userid
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getUniFacultiyDeparments(int $userid)
   {
	  return DB::table('users_education as ue')
		 ->select([ 'uf.name as faculty', 'uu.name as university', 'uud.name as departments' ])
		 ->where('ue.userid', $userid)
		 ->leftJoin('util_university as uu', 'ue.universityid', '=', 'uu.id')
		 ->leftJoin('util_faculty as uf', 'ue.facultyid', '=', 'uf.id')
		 ->leftJoin('util_university_departments as uud', 'ue.university_branchid', '=', 'uud.id')
		 ->first();
   }

    /***
     * @param int $userid
     * @param array $fields
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
   public static function getUserInformation(int $userid,array $fields = ['gender']){
	  return DB::table('users_information')->select($fields)->where('user_id', $userid)->first();
   }

    /***
     * @return \Illuminate\Support\Collection
     */
   public static function getAllTeacherIds(){
       return DB::table('users_users as uu')
           ->join('users_lesson_locations as ull','ull.userid','=','uu.id')
           ->where(['statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER])
           ->pluck('uu.id');
   }

    /***
     * @param $getChilds
     * @param int $itemId
     * @param string $type
     * @return \Illuminate\Support\Collection
     */
   public static function getCityDistrictPlaceLessonTeacherIds($getChilds,int $itemId,string $type = 'city'){
       $getCity = DB::table('users_users as uu')
           ->join('users_lesson_locations as ull','ull.userid','=','uu.id')
           ->join('lessons_users as lu','lu.userid','=','uu.id')
           ->where(['statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER]);

       if($type == 'city'){
           $getCity->where('ull.cityid',$itemId);
       }else{
           $getCity->where(function ($q) use($itemId,$type){
               $q->whereRaw('json_contains(ull.'.$type.', \'[' . $itemId . ']\')')
                   ->orWhereRaw('json_contains(ull.'.$type.', \'["' . $itemId . '"]\')');
           });
       }

       if(is_array($getChilds)){
           $getCity->whereIn('lu.categoryid',$getChilds);
       }else{
           $getCity->where('lu.categoryid',$getChilds);
       }

       $getCity = $getCity->pluck('uu.id');

       return $getCity;
   }

   /***
	* @param int $userid
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getCityDistrictPlace(int $userid)
   {
	  return DB::table('users_address as ua')
		 ->select([ 'ucity.city', 'uc.name', 'ud.district', 'up.place' ])
		 ->where('ua.userid', $userid)
		 ->leftJoin('util_country as uc', 'ua.countryid', '=', 'uc.numcode')
		 ->leftJoin('util_city as ucity', 'ua.cityid', '=', 'ucity.id')
		 ->leftJoin('util_district as ud', 'ua.districtid', '=', 'ud.id')
		 ->leftJoin('util_place as up', 'ua.placeid', '=', 'up.id')
		 ->first();
   }

   /***
	* @param int $userId
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getShowParentTeachers(int $userId)
   {
	  return DB::table('users_views_teacher as uvt')
		 ->select([ 't.firstname', 't.lastname', 'uvt.ip_address', 'uvt.created_at' ])
		 ->join('users_users as t', 't.id', '=', 'uvt.teacherid')
		 ->where([ 'uvt.userid' => $userId ])
		 ->get();
   }

   /***
	* @param int $userId
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getShowingParents(int $userId)
   {
	  return DB::table('users_views_teacher as uvt')
		 ->select([ 't.firstname', 't.lastname', 't.email', 'uvt.ip_address', 'uvt.created_at' ])
		 ->join('users_users as t', 't.id', '=', 'uvt.userid')
		 ->where([ 'uvt.teacherid' => $userId ])
		 ->get();

   }

   // ===============================================================================================
   // | FRONTEND METODS
   // ===============================================================================================

    /***
     * @param int $teacherId
     * @param array|string[] $fields
     * @return mixed
     */
    public static function getTeacher(int $teacherId,array $fields = ['firstname','lastname','photo']){
        return User::select($fields)
            ->where(['id' => $teacherId,'statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER])
            ->first();
    }

    /***
     * @param string $username
     * @param array|string[] $fields
     * @return mixed
     */
    public static function getTeacherByUsername(string $username,array $fields = ['firstname','lastname','photo']){
        return User::select($fields)
            ->where(['username' => $username,'statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER])
            ->first();
    }

    /***
     * @param string $teacherUuid
     * @param array|string[] $fields
     * @return mixed
     */
    public static function getTeacherByUuid(string $teacherUuid,array $fields = ['id']){
        return User::select($fields)
            ->where(['uuid' => $teacherUuid,'statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER])
            ->first();
    }

    /***
     * @return mixed
     */
   public static function getHomeTeacherCount(){
	  return User::where([ 'statusid' => User::USER_STATUS_ACTIVE, 'typeid' => User::USER_TEACHER])->count();
   }

   public static function getHomeTeacherCountByCategory(){
       $raw = '';
       return User::select($raw)
           ->where([ 'statusid' => User::USER_STATUS_ACTIVE, 'typeid' => User::USER_TEACHER])
           ->get();
   }

   /***
	* @param int $userId
	* @param $data
	* @return mixed
	*/
   public static function userUpdate(int $userId, array $data)
   {
	  return User::where('id', $userId)->update($data);
   }

   /***
	* @param int $lessoinId
	* @return array|false
	*/
   public static function getHomeTeachers($lessoinId)
   {
	  $teachers = DB::select('call sp_teachers_order(?,?,?,?)', [
		 User::USER_STATUS_ACTIVE, User::USER_TEACHER, $lessoinId, User::HOME_TEACHERS_LIMIT
	  ]);

	  $outs = [];

	  if($teachers) {
		 foreach($teachers as $teacher) {
			$outs[ $teacher->categoryid ][] = $teacher;
		 }
	  }

	  return $outs;
   }

    /***
     * @param int $userid
     * @return \Illuminate\Support\Collection
     */
    public static function getTeacherAvailableTimes(int $userid){
        return DB::table('users_available_times')
            ->select('days')
            ->where('userid', $userid)
            ->get();
    }

   /***
	* @param int $userId
	* @param int $lessonId
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getLessonMinPrices(int $userId, int $lessonId)
   {
	  return DB::table('lessons_users as lu')
		 ->select([ DB::raw('MIN(price) as minPrice'), DB::raw('MIN(online_price) as minOnlinePrice') ])
		 ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
		 ->where('lu.userid', $userId)
		 ->where('lu.categoryid', $lessonId)
		 ->where('lp.countryid', 215) // Ulkeler eklenince burasi degisecek dinamik olacak
		 ->first();
   }

    /***
     * @param array $lessonIds
     * @return \Illuminate\Support\Collection
     */
    public static function getLessonSumPrices(array $lessonIds,array $getUserIds)
    {
        return DB::table('lessons_users as lu')
            ->select([ DB::raw('SUM(price) as totalPrice'),DB::raw('COUNT(price) as totalRows')])
            ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
            ->whereIn('lu.categoryid', $lessonIds)
            ->whereIn('lu.userid', $getUserIds) // Ulkeler eklenince burasi degisecek dinamik olacak
            ->where('lp.countryid', 215) // Ulkeler eklenince burasi degisecek dinamik olacak
            ->first();
    }

    /***
	* @param int $userId
	* @param int $lessonId
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getLessonsMinPrices(int $userId, int $state = 215)
   {
	  return DB::table('lessons_users as lu')
		 ->select([ DB::raw('MIN(price) as minPrice'), DB::raw('MIN(online_price) as minOnlinePrice') ])
		 ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
		 ->where('lu.userid', $userId)
		 ->where('lp.countryid', $state) // Ulkeler eklenince burasi degisecek dinamik olacak
		 ->first();
   }

   /**
	* @param string $username
	* @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
	*/
   public static function getTeacherInformations(string $username)
   {
	  return DB::table('users_users as uu')
		 ->select([ 'uu.id', 'uu.firstname', 'uu.username', 'uu.lastname', 'uu.email_approved', 'uu.photo', 'uu.last_login', 'uu.premium_end', 'uu.point', 'uu.mobile',
			'ui.gender', 'ui.about', 'ui.why', 'ui.experiences', 'ui.acquisitions', //ui.online
			'ui.about_me', 'ui.experience_year',
			'ui.technique', 'ui.advices', 'ui.opportunities', 'ui.main_branch', 'ui.title', 'ui.experience_year', 'ui.keywords',
			'util_u.name as university_name', 'util_f.name as faculty_name', 'util_d.name as branch',
			'util_c.city as user_city', 'util_di.district as user_district', 'util_pl.place as user_place'
		 ])
		 ->join('users_information as ui', 'ui.user_id', '=', 'uu.id')
		 ->leftJoin('users_education as ue', 'ue.userid', '=', 'uu.id')
		 ->leftJoin('util_university as util_u', 'util_u.id', '=', 'ue.universityid')
		 ->leftJoin('util_faculty as util_f', 'util_f.id', '=', 'ue.facultyid')
		 ->leftJoin('util_university_departments as util_d', 'util_d.id', '=', 'ue.university_branchid')
		 ->leftJoin('users_address as ua', 'ua.userid', '=', 'uu.id')
		 ->leftJoin('util_city as util_c', 'util_c.id', '=', 'ua.cityid')
		 ->leftJoin('util_district as util_di', 'util_di.id', '=', 'ua.districtid')
		 ->leftJoin('util_place as util_pl', 'util_pl.id', '=', 'ua.placeid')
		 ->where('uu.username', $username)
		 ->first();
   }

   /**
	* @param int $userId
	* @return \Illuminate\Support\Collection
	*/
   public static function getTeacherQuestions(int $userId)
   {
	  return DB::table('users_questions as uq')
		 ->select([ 'uq.questions as questions', 'uq.reply', 'uu.firstname' ])
		 ->leftJoin('users_users as uu', 'uu.id', '=', 'uq.author')
		 ->where('uq.userid', $userId)
		 ->get();
   }

   /**
	* @param int $userId
	* @return \Illuminate\Support\Collection
	*/
   public static function getTeacherLessons(int $userId, int $state = 215)
   {
	  return DB::table('lessons_users as lu')
		 ->select([ 'lc.id as child_id', 'lp.price', 'lp.online_price', 'lu.time' ])
		 ->join('lessons_categories as lc', 'lc.id', '=', 'lu.categoryid')
		 ->join('lessons_prices as lp', 'lp.lessonid', '=', 'lu.id')
		 ->where('lu.userid', $userId)
		 ->where('lp.countryid', $state)
		 ->get();
   }

    /***
     * @param int $userid
     * @return \Illuminate\Support\Collection
     */
   public static function getUserViewTeachers(int $userid){
	  return DB::table('users_views_teacher as uvt')
		  ->select(['uu.firstname','uu.lastname','uu.photo'])
          ->join('users_users as uu', 'uu.id', '=', 'uvt.teacherid')
		  ->where('uvt.userid', $userid)
		  ->get();
   }

   /***
	* @param int $userId
	* @param array $data
	* @return mixed
	*/
   public static function teacherUpdate(int $userId, array $data)
   {
	  return DB::table('users_information')->where('user_id', $userId)->update($data);
   }

    /***
     * @param array $data
     * @return bool
     */
   public static function teacherInfInsert(array $data){
	  return DB::table('users_information')->insert($data);
   }

    /***
     * @param int $userId
     * @return bool
     */
   public static function teacherInfCheck(int $userId){
	  return DB::table('users_information')->where('user_id', $userId)->exists();
   }

    /***
     * @param int $userId
     * @param array $data
     * @return mixed
     */
   public static function updateUser(int $userId, array $data){
	  return User::where('id', $userId)->update($data);
   }

   /***
     * @param string $username
     * @return mixed
     */
   public static function checkTeacher(string $username){
	  return User::where(['statusid' => User::USER_STATUS_ACTIVE,'typeid' => User::USER_TEACHER,'username' => $username])->exists();
   }

   /***
	* @param int $userId
	* @param array $data
	* @return mixed
	*/
   public static function teacherAddressUpdate(int $userId, array $data){
	  return DB::table('users_address')->where('userid', $userId)->update($data);
   }

    /***
     * @param array $data
     * @return bool
     */
   public static function teacherAddressInsert(array $data){
	  return DB::table('users_address')->insert($data);
   }

    /***
     * @param int $userId
     * @return bool
     */
    public static function teacherAddressCheck(int $userId){
        return DB::table('users_address')->where('userid', $userId)->exists();
    }

    /***
     * @param int $userId
     * @param array $fields
     * @return bool
     */
    public static function getUserAddress(int $userId,array $fields = ['cityid']){
        return DB::table('users_address')->select($fields)->where('userid', $userId)->first();
    }

   /***
	* @param int $userId
	* @param array $data
	* @return mixed
	*/
   public static function teacherEducationUpdate(int $userId, array $data){
	  return DB::table('users_education')->where('userid', $userId)->update($data);
   }

    /***
     * @param int $userId
     * @return bool
     */
   public static function teacherEducationCheck(int $userId){
	  return DB::table('users_education')->where('userid', $userId)->exists();
   }

    /***
     * @param array $data
     * @return bool
     */
   public static function viewInsertCheck(array $data){
       $checkUserView = DB::table('users_views_teacher')
           ->where('userid',$data['userid'])
           ->where('teacherid',$data['teacherid'])
           ->where('ip_address',$data['ip_address'])
           ->where('created_at','>=',date('Y-m-d 00:00:00'))
           ->where('created_at','<=',date('Y-m-d 23:59:59'))
           ->exists();

       if(!$checkUserView){
           return DB::table('users_views_teacher')->insert($data);
       }
   }

   /**
     * @param array $data
     * @return bool
     */
   public static function teacherEducationSave(array $data){
	  return DB::table('users_education')->insert($data);
   }

    /***
     * @param int $type
     * @return int
     */
    public static function teacherStudentLastYearCreatedAccountCount($type = User::USER_TEACHER){
        return DB::table('users_users')
            ->where('created_at','>=',date('Y-m-d H:i:s',strtotime('-1 years')))
            ->where('typeid',$type)
            ->count();
    }

    /***
     * @param int $aId
     * @param int $aType
     * @param int $paginate
     * @param int $type
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getCityUsers(int $aId, int $aType = 1, $type = User::USER_TEACHER) {
        return DB::table('users_users as uu')
            ->select([ 'uu.id', 'uu.firstname', 'uu.username', 'uu.lastname', 'uu.email_approved', 'uu.photo', 'uu.last_login', 'uu.premium_end', 'uu.point', 'uu.mobile',
                'ui.gender', 'ui.about', 'ui.why', 'ui.experiences', 'ui.acquisitions', //ui.online
                'ui.about_me', 'ui.experience_year',
                'ui.technique', 'ui.advices', 'ui.opportunities', 'ui.main_branch', 'ui.title', 'ui.experience_year', 'ui.keywords',
                'util_u.name as university', 'util_f.name as faculty_name', 'util_d.name as branch',
                'util_c.city as city', 'util_di.district as district', 'util_pl.place as place'])
            ->join('users_address as ua', 'ua.userid', '=', 'uu.id')
            ->join('users_information as ui', 'ui.user_id', '=', 'uu.id')
            ->leftJoin('users_education as ue', 'ue.userid', '=', 'uu.id')
            ->leftJoin('util_university as util_u', 'util_u.id', '=', 'ue.universityid')
            ->leftJoin('util_faculty as util_f', 'util_f.id', '=', 'ue.facultyid')
            ->leftJoin('util_university_departments as util_d', 'util_d.id', '=', 'ue.university_branchid')
            ->leftJoin('util_city as util_c', 'util_c.id', '=', 'ua.cityid')
            ->leftJoin('util_district as util_di', 'util_di.id', '=', 'ua.districtid')
            ->leftJoin('util_place as util_pl', 'util_pl.id', '=', 'ua.placeid')
            ->where(Ozelders::UTIL_TYPES_ID[$aType], $aId)
            ->where('uu.typeid', $type);
    }

    /***
     * @param int $cityId
     * @return int
     */
    public static function getCityUserCount(int $cityId) {
        return DB::table('users_users as uu')
            ->join('users_lesson_locations as ull', 'ull.userid', '=', 'uu.id')
            ->where('uu.statusid',User::USER_STATUS_ACTIVE)
            ->where('uu.typeid',User::USER_TEACHER)
            ->where('ull.cityid',$cityId)
            ->count();
    }

    public static function getCityUsersCount(int $aId, int $aType = 1, $type = User::USER_TEACHER) {
        return DB::table('users_users as uu')
            ->join('users_address as ua', 'ua.userid', '=', 'uu.id')
            ->where(Ozelders::UTIL_TYPES_ID[$aType], $aId)
            ->count();

    }

    /***
     * @param int $userId
     * @return \Illuminate\Database\Query\Builder
     */
    public static function getLessonBranch(int $userId) {
        return DB::table('users_lesson_branch_city')->select(['city','branch','change'])->where('userid', $userId)->first();
    }

    /***
     * @param array $insert
     * @return bool
     */
    public static function addLessonBranch(array $insert) {
        return DB::table('users_lesson_branch_city')->insert($insert);
    }

    /***
     * @param int $userId
     * @param array $update
     * @return int
     */
    public static function updateLessonBranch(int $userId, array $update) {
        return DB::table('users_lesson_branch_city')->where('userid', $userId)->update($update);
    }

    /***
     * @param int $userId
     * @return arra
     */
    public static function getUserTeach(int $userId) {
        return DB::table('users_teach as ut')
            ->join('users_teach_types as utt','ut.categoryid','=','utt.id')
            ->where('ut.userid',$userId)
            ->groupBy('ut.userid','utt.title')
            ->pluck('utt.title')
            ->toArray();
    }
}
