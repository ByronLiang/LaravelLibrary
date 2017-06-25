<?php

namespace App\Models;

use App\Models\Model;
use DB;

class BookListModel extends BaseModel
{
	protected $table = 'booklist';

    public static function getBook()
    {
        $res = self::paginate(3);
        return $res;
    }

    // public static function getBook()
    // {
    //     $res = DB::table('booklist')->take(5)->get();
    //     return $res;
    // }
    //获取剩余书本，利用公式 总库存-借出书本数量
    public function getRestNum()
    {
        $total = BorrowListModel::getTotal($this->id);
        return $this->total - $total;
    }
    public static function pagintion_array($current_page = 1, $total_page, $plus, $boundary)
    {

        if($current_page > $boundary && $total_page > 10)
        {
            if ($plus + $current_page > $total_page)
            {
                $begin = $total_page - $plus * 2;
            }
            else
            {
                $begin = $current_page - $plus;
            }
            for ($i = $begin; $i <= $begin + $plus * 2; $i++)
            {
                if ($i > $total_page)
                    break;
            $pagintion[] = $i;
            }
        }
        else
        {
            if($total_page<10)
            {
                for ($i = 1; $i <= $total_page; $i++)
                {
                    $pagintion[] = $i;
                }
            }
            else
            {
                for ($i = 1; $i <= 10; $i++)
                {
                    $pagintion[] = $i;
                }
            }
        }
        return $pagintion;
    }
}
