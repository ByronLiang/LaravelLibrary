<?php

namespace App\Http\Controllers;

use App\Http\Requests;
// use App\Http\Controllers\Controller;
use DB;

class ShowController extends Controller
{
    public function getbookList()
    {
        $info = DB::select('select * from booklist');
        var_dump($info);

        //echo "Hello";
        //exit();
    }
}
