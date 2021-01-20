<?php


namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\Cms\User\UserLogs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view('frontend.user.login');
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login_process(Request $request){

        // Request Type Ajax Check
        if($request->ajax()){

            // Request Get Data
            $email    = $request->input('email');
            $password = $request->input('password');
            $remember = $request->input('remember') ?? false;

            // Validate Login Form
            $validation_rules = [
                'email'    => 'required|string|email',
                'password' => 'required|string'
            ];

            $fields = [
                'email'    => 'E-posta',
                'password' => 'Şifre'
            ];

            $validator = validator(\request()->input(), $validation_rules,[],$fields);
            // if there was validation error
            if ($validator->fails()) {
                $content = '';
                foreach ($validator->getMessageBag()->toArray() as $validate){
                    $content .= $validate[0];
                }

                UserLogs::userAddLog(0,$content);
                return $this->render('invalidArg',$validator->getMessageBag()->toArray(),422);
            }

            // Get User email field
            $user = User::select(['email','id'])->where('email',$email)->first();

            // User Not Found Return Message
            if(is_null($user)){
                $content = 'Lütfen e-posta adresinizi kontrol edip tekrar deneyin';

                UserLogs::userAddLog(0,$content);
                return $this->render('userNotFound',$content,409);
            }

            // User Login Proccess
            if(!auth()->attempt(['email' => $email, 'password' => $password],$remember)) {
                $content = 'Lütfen e-posta adresinizi veya şifrenizi kontrol edin.';

                UserLogs::userAddLog($user->id,$content);
                return $this->render('userLoginError',$content,403);
            }else{
                $content = 'Hoşgeldiniz '.$user->firstname;

                //User::userUpdate($user->id,['last_login' => date('Y-m-d H:i:s')]);
                User::where('id', $user->id)
                    ->update(['last_login' => date('Y-m-d H:i:s')]);

                UserLogs::userAddLog($user->id,$content,UserLogs::LOG_LEVEL_INFORMATION);
                return $this->render('userLoginSuccess',$content,200);
            }

        }else{
            $content = 'Lütfen e-posta adresinizi kontrol edin ve hesabınızı onaylayın';
            UserLogs::userAddLog(0,$content);

            return $this->render('userLoginError',$content,403);
        }
    }

    /***
     * @return mixed
     */
    public function logout() {
        $content = 'Kullanıcı Sistemden Çıkış Yaptı';
        UserLogs::userAddLog(Auth::id(),$content,UserLogs::LOG_LEVEL_INFORMATION);

        Session::flush();
        Auth::logout();

        return redirect(url('/'));
    }
}
