<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class CommonController extends Controller
{

    //图片上传
    public function upload(){
        $file = Input::file('Filedata');//file() 方法获取上传文件的信息
        if($file -> isValid()){//检验一下上传的文件是否有效.
            $entension = $file -> getClientOriginalExtension(); //获取上传文件的后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file -> move(base_path().'/uploads',$newName);//laravel的base_path() 根目录
            $filepath = 'uploads/'.$newName;
            return $filepath;
        }
    }
}
