<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Crypt;

use App\Http\Model\User;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login(){
    	// echo 222222;
    	
    	if($input = Input::all()){
    		// dd($input);
    		
    		$code = new \Code;
    		$_code = $code -> get();
    		if(strtoupper($input['code']) != $_code){
    			return back() -> with('msg','验证码错误');
    		}

    		$user = User::first();
    		if($user -> user_name != $input['user_name'] || Crypt::decrypt($user -> user_pass) != $input['user_pass']){
    			return back() -> with('msg','用户名或者密码错误');
    		}

    		session(['user'=>$user]);
    		// dd(session('user'));
    		// echo "ok";
                
                  return redirect('admin/index');   

    	}else{
    		// $user = User::first();
    		// $user = User::all();
    		// dd($user);
            
                //清session  
                  // session(['user'=>null]);
                  
	    	// 分配模板
	    	return view('admin.login');    		
    	}

    }

    public function code(){
    	// echo 222222;
    	
    	$code = new \Code();
    	$code -> make();
    	
    }

    //获得验证码
    public function getcode(){

    	$code = new \Code();
    	echo $code -> get();
    	
    }    

    //密码加密
    public function crypt(){
    	$str = 'admin123456';
    	// $str_p = "eyJpdiI6InQzMkFOUmFGS2VDZVpKQ2p4TGJCZlE9PSIsInZhbHVlIjoiRXBTeXgxS3RqTHRcL2tvUUpRQ1g1ZXc9PSIsIm1hYyI6IjQ0MzUzODI2NmE0NmZmN2ViZWEzYzg5MzU2YmQ1YmRhNzBjMzA2ZjQzYmFhNzA1MGI5MzA3NmRhNjg4Yzk4ODAifQ==";

    	echo Crypt::encrypt($str);
    	// echo "<br>";
    	// echo Crypt::decrypt($str_p);
    }
    
    //退出
    public function quit(){

        session(['user'=>null]);
        return redirect('admin/login');
        
    }        

}
