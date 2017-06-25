@extends('public.masterlayout')
@section('title')
图书介绍
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
 @include('public.head')
	<table class="table" style="width: 50%;">
	<caption>BookList</caption>
	<tr>
	<td>No</td><td>Name</td><td>Price</td>
	</tr>
	</table>
	@include('public.rightsidebar')
	{{ $url }}<br>
	{{$method}}<br>
	{{ session('Time') }}<br>
	<img src={{ asset('download') }}/201706061234.jpg 
		style="width: 180px; height: 180px;"/>
	<br>
	<a href={{ action('Home\IndexController@download', ['id' => '201706061234']) }} class="btn btn-primary" style="margin-left: 40px;">Download</a>
</div>
@stop