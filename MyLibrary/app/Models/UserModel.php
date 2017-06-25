<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class UserModel extends BaseModel implements AuthenticatableContract
{
	use Authenticatable;
	
	protected $table = 'user';
	public $timestamps = false;
	
	public function signup($data)
	{
		return $this->create(
			[
			'userId' => $data->username,
			'password' => password_hash($data->pwd, PASSWORD_BCRYPT, ['cost' => 10]),
			'user_logintime' => date('Y-m-d H:i:s')	
			]
		);
	}
}
