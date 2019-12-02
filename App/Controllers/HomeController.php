<?php namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    use \App\Traits\TPublics;

    public function index()
    {
        $user=self::AuthLogin();

        //check image exist
        $image=env('ROOT_ADDRESS').'/uploads/' . $user->image;
        if (!@getimagesize($image)) $image='';

        $logout=env('ROOT_ADDRESS').'/logout';
        $data=[
            'user'=>$user,
            'image'=>$image,
            'logout'=>$logout
        ];
        return View::renderTemplate("index",$data);

    }
}