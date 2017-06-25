<?php

namespace App\Models;

use Carbon\Carbon;

class BorrowListModel extends BaseModel
{
	protected $table = 'borrowlist';
	protected $appends = ['reback_time'];

	public function getBorrowTimeAttribute($value)
	{
		if(empty($value))
			return null;
		else
			return (new Carbon($value))->toDateString();
	}
	
	public function getRebackTimeAttribute($value)
	{
		if(empty($this->borrow_time))
			return null;
		else
			return (new Carbon($this->borrow_time))->addMonths(2)->toDateString();
	}

	// public function getBookStatusAttribute($value)
	// {
	// 	$status = ["申请借出", "借出成功", "申请还书", "还书成功"];
	// 	return $status[$value - 1];	
	// }

	public function getBookStatus()
	{
		$status = ["申请借出", "借出成功", "申请还书", "还书成功"];
		return $status[$this->book_status - 1];		
	}

	
//通过bookid查出当前书本借出的总数量，还书的数目不在计算范围内
//直接返回借出的总数量
	public static function getTotal($id)
	{
		$sql = "SUM(number) as total";
		return self::selectRaw($sql)
			->where('book_id', '=', $id)
			->whereIn('book_status', [1, 2, 3])
			->first()
			->total;
	}

	public static function getRecord($id)
	{
		return self::leftJoin('booklist', 'borrowlist.book_id', '=', 'booklist.id')
			->where('user_id', '=', $id)
			->select('booklist.name', 'borrowlist.id', 
					'borrowlist.borrow_time', 'borrowlist.book_status')
			->paginate(3);
	}

	public static function cancelBorrow($id)
	{
		return self::where('id', '=', $id)->delete();
	}

	public static function rebackApply($id)
	{
		return self::where('id', '=', $id)
			->update([
						'book_status' => 3,
						'customer_status' => 1
					]);
	}

	public static function cancelreback($id)
	{
		return self::where('id', '=', $id)
			->update([
						'book_status' => 2,
						'customer_status' => 0
					]);
	}
	
}