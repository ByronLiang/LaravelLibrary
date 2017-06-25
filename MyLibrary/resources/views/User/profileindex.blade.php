@extends('public.masterlayout')
@section('title')
个人主页
@stop
@section('style')
	<link type="text/css" href="{{ asset('assets/css/index_index.css') }}" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" 
		href="{{ asset('assets/css/profile_index.css') }}"/>
	<link rel="stylesheet" type="text/css" 
		href="{{ asset('assets/css/profile_edit.css') }}"/>
@stop
@section('content')
<div style="width: 60%;margin-left: 20%;">
@include('public.head')
	<div class="user_info">
        <div class="user_info_title">个人信息</div>
        <div class="user_info_img">
            <img src = {{ asset('UserImages') }}/{{ $data->image }} 
            	style="width: 180px;height: 180px;"/>
        </div>
        <div class="user_info_content">
            <div class="basic_info_title">基本信息</div>
            <div class="basic_info_btn"><button><a href=""> 修改</a></button></div>

            <div class="basic_info_content">

                <table class="table" style="width: 90%;font-size: 17px;">

                    <tr style="width: 90%;">
                        <td>昵 称：{{ $data->username }}</td>
                    </tr>
                    <tr style="width: 90%;">
                        <td>性 别：{{ $data->getGender() }}</td>
                    </tr>
                    <tr style="width: 90%;">
                        <td>出生日期：{{ $data->birth }}</td>
                    </tr>
                    <tr>
                        <td>联系方式(QQ/微信/手机)： {{ $data->contact }}</td>
                    </tr>

                </table>
            </div>
            <div class="basic_info_title">自我描述</div>
            <div class="basic_info_btn"><button>
            <a href="{:U('User/profile/edit')}"> 修改</a></button></div>
                <div class="basic_info_desc">{{ $data->description }}</div>
        </div>
    </div>
@stop