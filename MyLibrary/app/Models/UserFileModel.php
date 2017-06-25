<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;

class UserFileModel extends BaseModel
{
	protected $table = 'user_file';
	public $timestamps = false;

	public function signup($userid)
	{
		return $this->create([
			'userid' => $userid
		]);
	}

	public function createProfile($data)
	{
		return $this->updateValue("userid", Auth::user()->id, [
			'username' => $data->nickname,
			'gender' => $data->gender,
			'birth' => $data->birth,
			'description' => $data->desc,
			'contact' => $data->contact
		]);
	}

	public function uploadImg($request, $name)
	{
		$file = $request->file($name);
		$filter = array("image/jpeg", "image/png");
        $type = $file->getMimeType();
        if (in_array($type, $filter)) {
            //在应用的public文件夹里建立publicImage文件夹
            $destPath = public_path('UserImages');
            //dd($destPath);
            //验证是否存在这个文件夹，若不存在，则返回false
            if (!realpath($destPath)) {
                //新建一个文件夹
                mkdir($destPath,0755,true);
            }
            //获得上传文件的原文件名
            $filename = $file->getClientOriginalName();
            //进行文件名替换
            $filename = explode(".", $filename);
            $filename[0] = time().rand(0,100);
            $filename = implode(".", $filename);
            
            if (! $file->move($destPath,$filename)) {
            	//头像更新失败！
                return 3;
            }
            $this->updateValue("userid", Auth::user()->id, ['image' => $filename]);
            //头像更新成功
            return 1;
        } else {
        	//图片类型不符合
            return 2;
        }
	}

    public function getGender()
    {
        $gender = ['男性', '女性'];
        return $gender[$this->gender - 1]; 
    }

}