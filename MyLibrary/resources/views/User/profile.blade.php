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
        <div style="float: right; margin-right: 4%;font-size: 18px">
        	<a href="{{ action('Home\IndexController@index') }}" class="btn btn-default">
                跳过此设置
            </a>
        </div>
        <div class="btn-pos">
            <div class="basic_info_title">更改图像</div>
            <div style="margin-top: 5px;margin-left: 10%;">
                <form role="form" action="{{ action('User\IndexController@setprofile') }}" 
                	method="post" enctype="multipart/form-data">
                	<input type="hidden" name="_token" value={{ csrf_token() }} />
                    <div class="form-group">
                        <input type="file" id="inputfile" name="photo">
                        <p class="help-block">最大100KB，支持jpg，gif，png格式。</p>
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                    </form>
            </div>
            <!--<span style="margin-left: 35%;;">最大100KB，支持jpg，gif，png格式。</span>-->
        </div>
        <div class="user_info_content">
            <div class="basic_info_title">基本信息</div>
                <div class="basic_info_content">
                	<div style="width:65%; margin-left: 20%;">
                    <form role="form" action="{{ action('User\IndexController@setprofile') }}" method="post">
                        <input type="hidden" name="_token" value={{ csrf_token() }} />
                	 	<div class="form-group">
                	 		<label for="name">昵称</label>
     						<input type="text" class="form-control" name="nickname" 
         					placeholder="请输入名称">
   						</div>
   						<label for="name">性别</label>
   						<div class="radio">
                	 		<label class="checkbox-inline">
      						<input type="radio" name="gender" id="optionsRadios3" 
         						value="1" checked> 男
   							</label>
							<label class="checkbox-inline">
						    	<input type="radio" name="gender" id="optionsRadios4" 
						        	value="2"> 女
							</label>
						</div>
						<div class="form-group">
                	 		<label for="name">出生日期：</label>
     						<input type="date" class="form-control" name="birth" />
   						</div>
   						<div class="form-group">
                	 		<label for="name">联系方式：</label>
     						<input type="text" class="form-control" name="contact" 
         					placeholder="电话/邮箱">
   						</div>
					</div>
				</div>
   				
                    <!-- <table class="table" style="width: 90%;font-size: 17px;">
                    <tr style="width: 90%;">
                        <td>昵 &nbsp;&nbsp;称：<input type="text" name="username"/></td>
                    </tr>
                    <tr style="width: 90%;">
                        <td>性 &nbsp;&nbsp;别：<input type="text" name="sexual"/></td>
                    </tr>
                    <tr style="width: 90%;">
                        <td><lable for="name">出生日期：</lable><input type="date" name="birthday"/></td>
                    </tr>
                    <tr>
                        <td>联系方式：<input type="text" name="contact" maxlength="11"/></td>
                    </tr>
                </table> -->
            <!-- </div> -->
            <div class="basic_info_title">自我描述</div>
            <div class="basic_info_desc">
                <input type="text" name="desc" style="width: 95%;height: 120px;"/></div>
                <input  class="btn btn-primary" type="submit" value="保存" 
                	style="margin-left:32%;margin-top: 10px;"/>
                    <a href="{{ action('Home\IndexController@index') }}" 
                        class="btn btn-primary" style="margin-left:10%;margin-top: 10px;">
                        取消
                    </a>
            </form>

               	</div>
            </div>
        </div>
    </div>
</div>
@stop
