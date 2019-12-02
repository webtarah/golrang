<?php namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use Core\Controller;
use Core\View;

class AuthController extends Controller
{
    use \App\Traits\TPublics;

    public function login()
    {
        $action=env('ROOT_ADDRESS').'/auth';
        $register=env('ROOT_ADDRESS').'/register';
        $data=[
            'action'=>$action,
            'register'=>$register
        ];
        return View::renderTemplate("user/login",$data);
    }

    public function auth(){
        self::AuthLogout();

        $status = null;

        if( self::isPost() ) {
            extract($_POST);

            if( self::validation_required([$email , $pwd]) ) {
                $pwd = hash_hmac("sha256" , $pwd , "secret");

                if($user=User::where([['email',$email],['password',$pwd]])->first()){
                    if( isset($remember) ) {
                        setcookie("email" , $email , time() + 60 * 60 * 24 * 7);
                        setcookie("pwd" , $pwd , time() + 60 * 60 * 24 * 7);
                    }
                    $_SESSION['username'] = $user->email;
                    self::redirect(env('ROOT_ADDRESS'));
                }
            }
            $status = "this user not exists";

            $action=env('ROOT_ADDRESS').'/auth';
            $register=env('ROOT_ADDRESS').'/register';

            $data=[
                'action'=>$action,
                'status'=>$status,
                'register'=>$register,
            ];
            return View::renderTemplate('user/login',$data);
        }
    }

    public function logout(){
        session_destroy();
        self::redirect(env('ROOT_ADDRESS'));
    }
}