@extends('public.masterlayout')
@section('title')
图书借阅记录
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
@include('public.head')
<p><h2 style="text-align: center">我的借书记录</h2></p>
    <div style="width: 100%;height:250px; 
    padding-top: 20px;background-color: white;">
        <table style="width: 100%;text-align: center;">
            <tr>
                <td>书名</td><td>借出时间</td>
                <td>归还时间</td><td>书本状态</td><td>操作</td>
            </tr>
            @if(! $is_null)
                @foreach($res as $data)
                    <tr style="height: 70px;">
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->borrow_time }}</td>
                        <td>{{ $data->reback_time }}</td>
                        <td>{{ $data->getBookStatus() }}</td>
                        <td>
                        @if($data->book_status == 1)
                            <a href={{ action('Home\IndexController@customerApply') }}?pid={{ $data->id }}&order=1 class="btn btn-primary">撤销操作</a>
                        @elseif($data->book_status == 2)
                            <a href={{ action('Home\IndexController@customerApply') }}?pid={{ $data->id }}&order=2 class="btn btn-primary">申请还书</a>
                        @elseif($data->book_status == 3)
                            <a href={{ action('Home\IndexController@customerApply') }}?pid={{ $data->id }}&order=3 class="btn btn-primary">撤销操作</a>
                        @else
                            <a href={{ action('Home\IndexController@customerApply') }}?pid={{ $data->id }}&order=4 class="btn btn-primary">写下书评</a>
                        @endif
                        </td>
                    </tr>
                @endforeach
            @else
            <tr>
            	<td  colspan='4' rowspan='4' style='font-size: 20px;
            			font-weight: bold;text-align: center;line-height: 100px;'>
            		没有相关记录
            	</td>
            </tr>
            @endif
        </table>
    </div>
     @if(! $is_null)
    <div style="float:left; display:inline-block; margin-left:20%;">
        <ul class="pagination">
        @if($res->currentPage()>1)
			<li><a href={{ $res->previousPageUrl() }}>&laquo;</a></li>
		@endif
		@foreach($page as $key=>$da)
                    @if($res->currentPage() == $da)
                    <li class="active">
                        <a href={{ $res->url($da) }}>
                        	{{ $da }}</a>
                    </li>
                    @else
                    <li>
                        <a href={{ $res->url($da) }}>{{ $da }}</a>
                    </li>
                    @endif
                @endforeach
                @if($res->currentPage() < ceil($res->total()/$res->perPage()))
                    <li><a href = {{ $res->nextPageUrl() }}>&raquo;</a></li>
                @endif
        </ul>
    </div>
    @endif
</div>
