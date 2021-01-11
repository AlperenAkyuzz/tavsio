<?php namespace App\Http\Controllers\Cms;

use App\Helpers\Logger;
use App\Http\Controllers\Controller;
use App\Models\Cms\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/***
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /***
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function login(){
        if (Auth::guard('admin')->check()) {
            return redirect('tavsiocms');
        }

        return view('cms.login');
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

            $validator = validator( \request()->input(), $validation_rules,[],$fields);
            // if there was validation error
            if ($validator->fails()) {
                $content = '';
                foreach ($validator->getMessageBag()->toArray() as $validate){
                    $content .= $validate[0];
                }

                Logger::logError(Admin::USER_LOG_TYPE,$content);
                return $this->render('invalidArg',$validator->getMessageBag()->toArray(),422);
            }

            $captcha = $request->input('g-recaptcha-response');
            if(!$captcha){
                Logger::logCritical(Admin::USER_LOG_TYPE,'Güvenlik Doğrulama Hatası!');
                return $this->render('userNotFound','Güvenlik Doğrulama Hatası!',409);
            }

            $secretKey = "6LdufSgaAAAAAGNafxyNU8GcqPI5cPonf2bj9-ut";
            $url       = 'https://www.google.com/recaptcha/api/siteverify';
            $data      = array('secret' => $secretKey, 'response' => $captcha);

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );

            $context      = stream_context_create($options);
            $response     = file_get_contents($url, false, $context);
            $responseKeys = json_decode($response);

            if ($responseKeys->success == false) {
                Logger::logCritical(Admin::USER_LOG_TYPE,'Güvenlik Doğrulama Hatası!');
                return $this->render('userNotFound','Güvenlik Doğrulama Hatası!',409);
            }

            // Get User email field
            $user = Admin::where('email',$email)->first();

            // User Not Found Retrun Message
            if(is_null($user)){
                Logger::logError(Admin::USER_LOG_TYPE,'Lütfen e-posta adresinizi kontrol edip tekrar deneyin');
                return $this->render('userNotFound','Lütfen e-posta adresinizi kontrol edip tekrar deneyin',409);
            }

            // User Login Proccess
            if(!auth()->guard('admin')->attempt(['email' => $email, 'password' => $password],$remember)) {
                Logger::logError(Admin::USER_LOG_TYPE,'Lütfen e-posta adresinizi kontrol edin ve hesabınızı onaylayın',$user->id);
                return $this->render('userLoginError','Lütfen e-posta adresinizi kontrol edin ve hesabınızı onaylayın',403);
            }else{
                setcookie('adminCooki',true, time() + (86400 * 30), "/");
                Logger::logInfo(Admin::USER_LOG_TYPE, 'Hoşgeldiniz '.$user->name,$user->id);
                return $this->render('userLoginSuccess','Hoşgeldiniz '.$user->name,200);
            }

        }else{
            Logger::logCritical(Admin::USER_LOG_TYPE,'Lütfen e-posta adresinizi kontrol edin ve hesabınızı onaylayın');
            return $this->render('userLoginError','Lütfen e-posta adresinizi kontrol edin ve hesabınızı onaylayın',403);
        }
    }

    /***
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request){

        Logger::logInfo(Admin::USER_LOG_TYPE, trans('logout_var',['username' => Auth::guard('admin')->user()->name]),Auth::guard('admin')->user()->id);
        Auth::guard('admin')->logout();
        setcookie('adminCooki', NULL, 0, "/");

        return redirect('tavsiocms/login');
    }

}
