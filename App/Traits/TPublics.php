<?php namespace App\Traits;
session_start();

use App\Models\User;

trait TPublics
{

    public function isPost() {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }

    public function redirect($location) {
        header("Location: {$location}");
        die;
    }

    public function validation_required($items) {
        $counter_error = 0;
        foreach ( $items as $item) {
            if( empty($item) )
                $counter_error++;
        }
        return $counter_error == 0;
    }

    public function validation_email($email) {
        return filter_var($email , FILTER_VALIDATE_EMAIL);
    }

    public function AuthLogin($location = "login.php") {
        if(isset($_SESSION['username']) ) {
            if($user=User::whereEmail($_SESSION['username'])->first()){
                return $user;
            }
        }
        $url=env('ROOT_ADDRESS').'/login';
        self::redirect($url);
    }

    public function AuthLogout($location = '/') {
        if( isset($_SESSION['username']) )
            self::redirect($location);
    }

/*    public function old($key) {
        if( ! empty($_REQUEST[$key]) )
            return htmlspecialchars($_REQUEST[$key]);
        return '';
    }*/
}

