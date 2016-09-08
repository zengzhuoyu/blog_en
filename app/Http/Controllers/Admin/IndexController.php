<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

// use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;

use App\Http\Model\User;

use Illuminate\Support\Facades\Crypt;

class IndexController extends CommonController
{
    public function index(){
    	// echo 222;
    	// $pdo = DB::connection()->getPdo();
    	// dd($pdo);
    	

    	return view('admin.index');
    }

    public function info(){

    	return view('admin.info');
    }

    //更改超级管理员密码
    public function pass(){
        if($input = Input::all()){//Input:all() 接收POST的数据组 

            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];

            $message = [
                'password.required'=>'新密码不能为空！',
                'password.between'=>'新密码必须在6-20位之间！',
                'password.confirmed'=>'新密码和确认密码不一致！',
            ];

            $validator = Validator::make($input,$rules,$message);

            if($validator->passes()){
                $user = User::first();

                $_password = Crypt::decrypt($user->user_pass);//解密

                if($input['password_o']==$_password){

                    $user->user_pass = Crypt::encrypt($input['password']);//加密

                    $user->update();
                    // return redirect('admin/info');
                    return back()->with('errors','密码修改成功！');
                }else{
                    return back()->with('errors','原密码错误！');
                }
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }    
}
