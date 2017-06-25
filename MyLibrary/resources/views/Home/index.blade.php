@extends('public.masterlayout')
@section('title')
图书管理系统
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
 	@include('public.head')
 	<div class="main-content">
        <div class="search-nav">
            <form action="index.php" method=post>
                <table style="width: 100%;height: 50px;">
                    <tr>
                        <td>
                            <select name="searchtype" style="width: 100%;height: 25px;">
                                <option value="">查询范围</option>
                                <option value="type">类型</option>
                                <option value="name">书名</option>
                                <option value="author">作者</option>
                            </select>
                        </td>
                        <td style="width: 40%;">
                            <input type="search" name="searchkey" style="width: 90%;"/>
                        </td>
                        <td style="width: 30%">
                            <input type="submit" name="submit" value="查询"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="booklist">
            <table style="width: 100%;text-align: center;" id="book_content">
                <tr style="height: 30px;">
                    <td style="width: 30%">书名</td>
                    <td style="width: 30%">上架时间</td>
                    <td style="width: 15%">类别</td>
                    <td style="width: 10%">数量</td>
                    <td style="width: 13%">操作</td>
                </tr>
                @foreach($res as $book)
                    <tr style='height: 70px' class="data_content">
                        <td><a href={{ action('Home\BookDetailController@getDetail', ['id' => $book->id]) }}>{{ $book->name }}</a></td>
                        <td>{{ $book->uploadtime }}</td>
                        <td>{{ $book->type }}</td>
                        <td>{{ $book->getRestNum() }}</td>
                        <td>
                        <a href="./addbook?pid={{ $book->id }}&name={{ $book->name }}" class="btn btn-primary">
                        放进书单</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ session('Time') }}
            <!-- {{ $loginTime }} -->
        </div>
        @include('public.rightsidebar')
        <div style="float:left;display:inline-block;
        margin-left:20%;">
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
        		
	
        <!-- <div class="page-number flex justify-between">
            <div class="page-right" id="pagecoentent" 
            style="position: relative;bottom: 25px;left: 150px">
            @if($res->currentPage()>1)
                <a href= {{ $res->previousPageUrl() }}>
                    <<
                </a>
            @endif
                @foreach($page as $key=>$da)
                    @if($res->currentPage() == $da)
                        <a class="page-number-a-active" 
                        href={{ $res->appends(array('key' => 'novel'))->url($da) }}>{{ $da }}</a>
                    @else
                        <a href={{ $res->url($da) }}>{{ $da }}</a>
                    @endif
                @endforeach
                @if($res->currentPage() < ceil($res->total()/$res->perPage()))
                    <a href = {{ $res->nextPageUrl() }}>
                    >>
                    </a>
                @endif
                <span class="number-after">到第</span>
                <input type="text" name="number-of-page" id='pagenum' value={{$res->currentPage()}}>
                <span>页</span>
                <button type="button" class="normal-button" 
                onclick="location.href=pageRedir();">确定</button>
            </div>
        </div> -->
    </div>
</div>
@stop
@section('javascript')
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/page_redirect.js') }}"></script>
@stop
