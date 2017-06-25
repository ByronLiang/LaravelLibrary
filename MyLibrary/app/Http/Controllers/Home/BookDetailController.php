<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BookDetailModel;

class BookDetailController extends Controller
{
	public function getDetail($id)
	{
		$data = BookDetailModel::getBookDetail($id);
		//$author = json_decode($data->author_info);
		$img = json_decode($data->book_image);
		//return $data;
		//$img = explode(",", $img[1]->image);
		$a = $img[1]->paper;
		dd($a);
		dd($data);
	}
}