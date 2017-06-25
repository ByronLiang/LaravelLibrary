<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Models\UserFileModel;

//中间件，若成功登录，则利用用户id去获取当前用户个人资料表的名字与id
//查询返回是一个UserFile模型对象，里面有username，与id成员；
//此对象到Auth::user()->user变量里，

class AuthInfo
{
	public function handle($request, \Closure $next)
	{
		if (Auth::user()) {
			Auth::user()->user = (new UserFileModel)
				->keyValues(['userid' => Auth::user()->id], 
					['id', 'username']);
		}
		return $next($request);
	}
}