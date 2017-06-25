<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Cookie;

class LoginController extends Controller
{
	public function index()
	{
		return view('Auth/login');
	}

	public function login(LoginRequest $request)
	{
		//$data = $request->all();
		$flag = Auth::attempt(['userId' => $request->username, 
			'password' => $request->pwd]);
		if($flag)
		{
			$loginTime = Auth::user()->user_logintime;
			//将登录时间存入session
			session(['Time' => $loginTime]);
			//将登录时间存入cookie
			//Cookie::queue('loginTime', $loginTime,);
			return redirect(action('Home\IndexController@index'));
		}
		else
		{
			return redirect()->back()->withErrors('用户名和密码不匹配');
		}
	}

	public function getLogout()
    {
        Auth::logout();

        return redirect(action('Home\IndexController@index'));
    }
}