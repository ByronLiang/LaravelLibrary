@extends('public.masterlayout')
@section('title')
我的书单车
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
 	<p><h2 style="text-align: center">Your BookList</h2></p>
    Dear {{ Auth::user()->user_name }}: <p></p>
    <span style="font-size: 17px;">We are glade to receive your application to borrow these books. We will soon to confirm your application!</span>
    <p></p>
    <strong>This is your booklist, Please check it out, Thanks!</strong>
    <div style="width: 80%;height:250px;margin-left: 10%;padding-left: 5%;background-color: white;">
        <table style='width: 90%;text-align: center;'>
            <tr style='height: 40px';>
                <td style='width: 20%;'>商品编号</td>
                <td style=' width:40%'>商品名字</td>
                <td style='width: 20%'>数量</td>
            </tr>
            	@foreach($info as $key=>$data)
            		<tr style='height: 40px;'>
            			<td>{{ $data['id'] }}</td>
            			<td>{{ $data['name'] }}</td>
            			<td>1</td>
                    </tr>
                @endforeach
        </table>
    </div>
    <span style="font-size: 20px; color: orange ">Have a Good Day!</span>
</div>
@stop
