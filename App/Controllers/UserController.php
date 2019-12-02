<?php namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use Core\Controller;
use Core\View;

class UserController extends Controller
{
    use \App\Traits\TPublics;

    public function register()
    {
        $action=env('ROOT_ADDRESS').'/registerStore';
        $login=env('ROOT_ADDRESS').'/login';

        $data=[
            'action'=>$action,
            'login'=>$login,
        ];
       return View::renderTemplate("user/register",$data);
    }

    public function store(){

        self::AuthLogout(env('ROOT_ADDRESS'));

        //is request post
        if( self::isPost() ) {
            extract($_POST);


           //validation
           $validation=self::validation($name,$email,$pwd,$pwdConfirm,$_FILES["image"]);
           if($validation == 'ok'){

               $data = [
                   "name" => $name ,
                   "email" => $email,
                   "password" =>  hash_hmac("sha256" , $pwd , "secret")
               ];

               //insert in data base
               if($userId=User::insertGetId ($data)){
                   //upload image
                   $image = $_FILES["image"]["name"];
                   if($image != ""){
                       $target_dir    = "uploads/";
                       $imageName=time(). basename( $_FILES["image"]["name"] );
                       $target_file   = $target_dir .$imageName;
                       $imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );
                       move_uploaded_file( $_FILES["image"]["tmp_name"], $target_file );
                       $user=User::find($userId);
                       $user->image=$imageName;
                       $user->save();
                   }

                   $root=env('ROOT_ADDRESS')."/login";
                   self::redirect($root);
               }else{
                   $status = "please try again" ;
               }

           }

           $action=env('ROOT_ADDRESS').'/registerStore';
            $login=env('ROOT_ADDRESS').'/login';
           $data=[
               'action'=>$action,
               'status'=>$validation,
               'login'=>$login,
           ];
           return View::renderTemplate('user/register',$data);

        }else{
            self::redirect(env('ROOT_ADDRESS'));
        }
    }

    protected  function validation($name , $email , $pwd,$pwdConfirm,$file){
        $status='';
        if( !self::validation_required([$name , $email , $pwd]) ) $status .= "name and email and password is required. <br>";
        if( !self::validation_email($email)) $status .= "Invalid email format. <br>";
        if($pwd != $pwdConfirm)  $status .= "Those passwords didn't match. <br>";
        if(User::whereEmail($email)->first()) $status .= "this email is exists.<br>";

        if($file['name'] != ''){
            // Check file size
            if ( $file["size"] > 500000 )   $status .= "Sorry, your file is too large. <br>";

            // Allow certain file formats
            $imageFileType = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );
            if ( $imageFileType != "jpg" && $imageFileType!= "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
                $status .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed. <br>";
        }

        if($status == '') $status = 'ok';


        return $status;
    }
}