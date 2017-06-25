@extends('public.masterlayout')
@section('title')
我的书单车
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
 	@include('public.head')
 	<p><h2 style="text-align: center">我的书单</h2></p>
    <div style="width: 80%;height:250px;margin-left: 10%;padding-left: 5%;background-color: white;">
        <table style='width: 90%;text-align: center;'>
            <tr style='height: 40px';>
                <td style='width: 20%;'>商品编号</td>
                <td style=' width:40%'>商品名字</td>
                <td style='width: 20%'>数量</td>
                <td style='width: 20%'>操作</td>
            </tr>
            @if(!$is_null)
            	@foreach($info as $key=>$data)
            		<tr style='height: 40px;'>
            			<td>{{ $data['book_id'] }}</td>
            			<td>{{ $data['name'] }}</td>
            			<td>1</td>
            			<td>
            			<a href="{{ action('Home\IndexController@delbook') }}?pid={{ $data['book_id'] }}" class="btn btn-primary">
                        删除</a>
                        </td>
                    </tr>
                @endforeach
            @else
            	<tr>
            		<td colspan='4' rowspan='2'><h2 style='text-align: center;line-height: 100px;'>书单为空</h2>
            		</td>
            	</tr>
            @endif
        </table>
        </div>
        @if(!$is_null)
        <p style='margin-left: 10%;'>
        <a href= {{ action('Home\IndexController@submitbook') }} class="btn btn-primary">提交</a> &nbsp;&nbsp;&nbsp;
        <a href={{ action('Home\IndexController@delallbook') }} class="btn btn-primary">删除全部</a>
        </p>
        @endif
</div>
@stop
@section('javascript')
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/page_redirect.js') }}"></script>
@stop