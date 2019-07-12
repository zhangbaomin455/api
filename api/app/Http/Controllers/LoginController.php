<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $name=$request->name ?? "";
        $pwd=$request->pwd ?? "";
        $email=$request->email ?? "";
        if($name=='' || $pwd=="" ||$email){
            $this->error(4001,'参数缺失');
        }
        $pwd=encrypt($pwd);

    }


}
