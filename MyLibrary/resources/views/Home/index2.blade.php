<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>图书借阅平台</title>
    <link type="text/css" href="{{ asset('assets/css/app.css') }}" rel="stylesheet"/>
    <link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
    <script src="{{ asset('assets/js/jquery-3.1.1.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/page_redirect.js') }}"></script>
</head>
<body>
<div style="width: 60%;margin-left: 20%;">
    @include('public.head')
    <div class="main-content">
        <div class="search-nav">
            <form action="index.php" method=post>
                <table style="width: 100%;height: 50px;;">
                    <tr>
                        <td style="width: 30%;">
                            <select name="searchtype" style="width: 100%;">
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
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->uploadtime }}</td>
                        <td>{{ $book->type }}</td>
                        <td>{{ $book->leave_number }}</td>
                        <td>
                        <button value='{{ $book->id }},{{ $book->name }}' 
                            onclick='putbook(this.value)'>
                            放进书单
                        </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        @include('public.rightsidebar')
        <div class="page-number flex justify-between">
            <div class="page-right" id="pagecoentent" style="position: relative;bottom: 25px;left: 150px">
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
                <a data="1" >Page1</a>
                <a data="2" >Page2</a>
                <span class="number-after">到第</span>
                <input type="text" name="number-of-page" id='pagenum' value={{$res->currentPage()}}>
                <span>页</span>
                <button type="button" class="normal-button" 
                onclick="location.href=pageRedir();">确定</button>
                <button type="button" class="normal-button" id="test">Ajax Page</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>