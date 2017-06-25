<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserFileModel;

class IndexController extends Controller
{
	public function index()
	{
		//$res = UserModel::find(20)->hasOneBooklist;
		$res = UserModel::getBook(20);
		// dd($res);
		// exit();
		//return view('User/mybook',compact('res'));
        return view('User/mybook', ['res' => $res]);

	}

    public function test()
    {
        //$model = new BookModel;
        $res = BookModel::getBook();
        //dd($res);
        //exit();
        return view('User/booklist', compact('res'));
    }

    public function find($id)
    {
        $res = BookModel::findOrFail($id);
        // dd($res);
        // exit();
        //返回一维数组
        return view('User/booklist')->with('res', $res);
        //return $res;
    }
    public function initprofile()
    {
        return view('User/profile');
    }

    public function uploadprofile()
    {

    }

    public function setprofile(Request $request)
    {
            if ($request->hasFile('photo')) {
                $img = (new UserFileModel)->uploadImg($request, 'photo');
                if ($img == 1) {
                    return redirect()->back()->withErrors('头像上传成功!');
                } elseif ($img == 2) {
                    return redirect()->back()->withErrors('图片类型不符合');
                } else {
                    return redirect()->back()->withErrors('头像上传失败！');
                }
            } else {
                (new UserFileModel)->createProfile($request);
                return redirect()->back()->withErrors('个人信息上传成功！');
            }
    }

    public function editprofile()
    {

    }

    public function showprofile()
    {
        $info = UserFileModel::where('userid', '=', Auth::user()->id)->first();
        //dd($info->username);
        return view('User/profileindex')->with(['data' => $info]);
    }

    public function uploadfile(Request $request)
    {
        // $file = $request->file('photo');
        // $filter = array("image/jpeg", "image/png");
        // $type = $file->getMimeType();
        // if (in_array($type, $filter)) {
        //     //在应用的public文件夹里建立publicImage文件夹
        //     $destPath = public_path('UserImages');
        //     //dd($destPath);
        //     //验证是否存在这个文件夹，若不存在，则返回false
        //     if (!realpath($destPath)) {
        //         //新建一个文件夹
        //         mkdir($destPath,0755,true);
        //     }
        //     //获得上传文件的原文件名
        //     $filename = $file->getClientOriginalName();
        //     //进行文件名替换
        //     $filename = explode(".", $filename);
        //     $filename[0] = time().rand(0,100);
        //     $filename = implode(".", $filename);
            
        //     if (! $file->move($destPath,$filename)) {
        //         return redirect()->back()->withErrors('头像更新失败！');
        //     }
        //     UserFileModel::updateValue(Auth::user()->id, ['image' => $filename]);
        //     return redirect()->back()->withErrors('头像更新成功！');
        // } else {
        //     return redirect()->back()->withErrors('图片类型不符合');
        // }
    }
}
