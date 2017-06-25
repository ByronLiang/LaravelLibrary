<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{UserModel,UserFileModel};

class RegisterController extends Controller
{
	public function signup(Request $request)
	{
		if (! Captcha::check($request->captcha)) {
            return redirect()->back()->withErrors('验证码不正确');
        }
		$user = new UserModel();
		if ($user->isExist(['userId' => $request->username])) {
			return redirect()->back()
				->withInput()
				->withErrors('当前用户名已被注册');
		}
		$info = $user->signup($request);
		if ($info) {
			$flag = (new UserFileModel())->signup($info->id);
			if ($flag) {
				//注册后直接利用返回的序列id进行登录。
				//验证指定id序列的用户信息，并完成登录
				Auth::loginUsingId($info->id);
				//完成登录，进行跳转到信息填写页面
				return redirect()->action('User\IndexController@initprofile')
					->withErrors('注册成功!');
			}
		} else {
			return redirect()->back()->withErrors('未知名错误!');
		}
		// $userfile = new UserFileModel();
		// $userfile->signup();
	}
}