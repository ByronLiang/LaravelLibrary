<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\BookListModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;  
use Illuminate\Pagination\Paginator;
use Cookie;
use Mail;
use App\Models\{UserModel, UserFileModel, BorrowListModel};
use Carbon\Carbon;

class IndexController extends Controller
{
	private $userfile;
	public function __construct(UserFileModel $userfile)
	{

		//$this->middleware('auth', ['only' => ['introduction']]);
		$this->middleware(['auth'], ['only' => ['introduction']]);
		$this->middleware(['auth.info']);
	}
	public function index(Request $request)
	{
		$res = BookListModel::getBook();
		$loginTime = Cookie::get('loginTime');
		$page = BookListModel::pagintion_array($res->currentPage(), 
			ceil($res->total() / $res->perPage()), 5, 6);
		return view('Home/index', compact('res'), ['loginTime' => $loginTime])
			->with('page', $page);
		
		// $perPage = 1;  
		// if ($request->has('page')) {  
		//     $current_page = $request->input('page');  
		//     $current_page = $current_page <= 0 ? 1 :$current_page;  
		// } 
		// else 
		// {  
		//     $current_page = 1;  
		// }  
  
		// $item = array_slice($res, ($current_page-1)*$perPage, $perPage); //按分页取数据  
		// $total = count($res);
		// //独立新建分页类，而不是在数据模型下进行建立
		// $paginator =new LengthAwarePaginator($item, $total, $perPage, $current_page, 
		//     [  
		//         'path' => Paginator::resolveCurrentPath()."/2",  
		//         //设定个要分页的url地址。也可以手动通过 $paginator ->setPath(‘路径’) 设置  
		//         'pageName' => 'page',  
		// ]);
		//$page = BookListModel::pagintion_show($paginator->currentPage(), ceil($paginator->total()/$paginator->perPage()), 5, 6);
		//dd($paginator);
		//$userlist = $paginator->toArray()['data'];
		//$perPage = $paginator->toArray();
		//dd($userlist['name']);
		
	}
	public function ajaxbook()
	{
		$res = BookListModel::getBook();
		return $res;
	}
	public function showBook()
	{
		//$book是查询数据的数组变量名
		//$bookmodel = new BookModel();
		//$book = $bookmodel->getBook();
		//$book = compact($book);
		$b = BookModel::find(4);
	   if(is_null($b))
	   {
			echo "No this book!";
			exit();
	   }
	   else
	   {    
			echo "We have this book";
			exit();
	   }
		exit();
		//$book = BookModel::getBook();

		//dd($book);
		// echo "$book->name";
		//exit();
		return view('Home.index',['books' => $book]);
		//方法一：可以将查询的数据输出到前端视图
		//compact(查询数据的数组变量名)，并且视图里的数据源都是这个名字
		//return view('Home.index',compact('book'));

		//方法二：with+自定义键名(查询数据的变量名)，也能输出到前端视图
		//自定义键名决定于视图里的for循环数据源的命名
		//return view('Home.index')->withlist($book);
	}
	public function introduction(Request $request)
	{
		$url = $request->fullurl();
		$method=$request->method();
		// $user_info = array('0' => array('name'=>'John','age'=>12),
		//                    '1' => array('name' => 'Tom', 'age'=>18)
		//                    );
		// $user = Cookie::queue('user',$user_info);

		// //$name = Cookie::get('name');
		// //dd($user);
		//$user = Cookie::queue('name', 'koko');
		//$age = Cookie::queue('age',23);

		//$style = Cookie::make('style', 'larger');
		// if(Cookie::has('bookCar'))
		// {
		//     $book = Cookie::get('bookCar');
		//     array_push($book, array('name' => 'The amazing of Coding', 
		//                             'price' => '25$', 'id' => 'I0299'));
		//     Cookie::queue('bookCar', $book);

		// }
		// else
		// {
		//     $book = array();
		//     array_push($book, array('name' => 'The Little King', 
		//                             'price' => '20$','id' => 'N0453'));
		//     Cookie::queue('bookCar', $book);
		// }
		//$data = Cookie::get();
		//$user = Cookie::has('name');
		//dd($data);
		return view('Home/bookintroduction', ['url' => $url, 'method' => $method]);
	}
//文件下载例程
	public function download($id)
	{
		return response()->download(
			realpath(base_path('public/download')).'/'.$id.'.jpg', $id.'.jpg');
	}

	public function addbook(Request $request)
	{
		$bookid = $request->pid;
		$bookname = $request->name;

		if (Cookie::has('bookCar')) {
			$book = Cookie::get('bookCar');
			array_push($book, array('name' => $bookname, 
									'book_id' => $bookid));
			Cookie::queue('bookCar', $book);
		} else {
			$book = array();
			array_push($book, array('name' => $bookname, 
									'book_id' => $bookid));
			Cookie::queue('bookCar', $book);
		}

		return view('public/success')->with([
					'message'=>'加入书单成功!',
					'url' =>'/', 
					'jumpTime'=>2,
				]);
	}
	public function showmybook()
	{
		if (Cookie::has('bookCar') && !empty(Cookie::get('bookCar'))) {
			$data = Cookie::get('bookCar');
			return view('Home/showmybook', ['is_null' => 0, 'info' => $data]); 
		} else {
			return view('Home/showmybook', ['is_null' => 1]);
		}
	}
	public function delbook(Request $request)
	{
		$id = $request->pid;
		$book = Cookie::get('bookCar');
		foreach ($book as $key=>$value) 
		{
			if($value['book_id'] == $id)
			{
				unset($book[$key]);
			}
		}
		Cookie::queue('bookCar', $book);
		return redirect()->action('Home\IndexController@showmybook');
	}
	public function delallbook(Request $request)
	{
		if(Cookie::has('bookCar'))
		{
			$cookie = Cookie::forget('bookCar');
			//设置完cookie之后需要重定向一下才会生效,带上withCookie($cookie)
			return redirect()->action('Home\IndexController@index')
			->withCookie($cookie);
		}
	}

	public function submitbook()
	{
		$book = Cookie::get('bookCar');
		foreach ($book as $key => $value) {
			$book[$key] = array(
								'book_id' => $value['book_id'], 
								'user_id' => Auth::user()->id
								);
		}
		$flag = BorrowListModel::insert($book);
		if ($flag) {
			$cookie = Cookie::forget('bookCar');
			return redirect()->action('Home\IndexController@index')
				->withCookie($cookie)
				->withErrors('提交借书申请成功!');
		} else {
			return view('public/success')->with([
					'message'=>'提交借书申请失败!',
					'url' =>'/', 
					'jumpTime'=>2,
				]);
		}
		//return view('Mail.email', ['info' => $book]);
		//邮件发送提醒功能
		// $flag = Mail::send('Mail.email',['info' => $book], function($message) {
		//     $to = 'byron@ganguo.hk';
		//     $message ->to($to)->subject('booklistEmail');
		// });
		// if ($flag) {
		//     view('public/success')->with([
		//             'message'=>'图书借阅申请成功!',
		//             'url' =>'/', 
		//             'jumpTime'=>2,
		//         ]);
		// } else {
		//     echo '发送邮件失败，请重试！';
		//     exit();
		// }
	}

	public function checkBookRecord()
	{
		$res = BorrowListModel::getRecord(Auth::user()->id);
		
		if ($res->count()) {
			$page = BookListModel::pagintion_array($res->currentPage(), 
			ceil($res->total() / $res->perPage()), 5, 6);
			
			return view('Home/borrowRecord')
				->with([
							'res' => $res,
							'page' =>$page,
							'is_null' => 0
						]);
		} else {
			return view('Home/borrowRecord')->with(['is_null' => 1]);
		}

	}
	/*
	order:
	1.申请借出但撤销借书操作；
	2.申请还书
	3.申请还书但撤销还书操作
	4.成功还书，可以写上书评
	*/
	public function customerApply(Request $request)
	{
		switch ($request->order) {
			
			case 1:
				BorrowListModel::cancelBorrow($request->pid);
				return redirect()->back()->withErrors('撤销申请借书成功！');
			break;
			
			case 2:
				BorrowListModel::rebackApply($request->pid);
				return redirect()->back()->withErrors('还书申请成功！');
			break;

			case 3:
				BorrowListModel::cancelreback($request->pid);
				return redirect()->back()->withErrors('撤销还书申请成功！');
			break;

			default:
				# code...
			break;
		}
		
	}

}
