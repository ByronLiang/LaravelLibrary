<?php

namespace App\Models;

use App\Models\BaseModel;

class BookDetailModel extends BaseModel
{
	protected $table = 'bookdetail';

	public function getAuthorInfoAttribute($value)
	{
		return json_decode($value);
	}

	public static function getBookDetail($id)
	{
		return self::where('book_id', $id)->first();
	}
}