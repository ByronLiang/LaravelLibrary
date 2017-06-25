@extends('public.masterlayout')
@section('title')
登录与注册
@stop
@section('style')
    <link href="assets/css/login_index.css" type="text/css" rel="stylesheet">
    <link href="assets/css/index_index.css" type="text/css" rel="stylesheet"/>
@stop
@section('content')
<div style="width: 59.5%;margin-left: 20%;">
    @include('public/head')
    <div class="select-nav">
        <ul>
            <li id="log-btn" value="login" onmouseover="check(id)">登录</li>
            <li id="reg-btn" value="register" onmouseover="check(id)">注册</li>
        </ul>
    </div>
    <div id="loginshow" class="loginframe">
        <form action = {{action('Auth\LoginController@login') }} method="post">
        {{ csrf_field() }}
        <table id="logintable" style="width: 100%;height:230px;text-align: center;">
            <tr style="height: 60px;">
                <td style="width: 25%;">用户名：</td><td><input type="text" name="username"/></td>
            </tr>
            <tr style="height: 60px;">
                <td style="width: 25%;">密码：</td><td><input type="password" name="pwd" /></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" value="登录" style="margin-left: 1%;"/>&nbsp;&nbsp;&nbsp;
                    <input type=reset name="reset"/></td>
            </tr>
        </table>
        </form>
    </div>
    <div class="registerframe" id="registershow">
        <form action={{ action('Auth\RegisterController@signup') }} method="post">
        {{ csrf_field() }}
        <table id="registertable" style="width: 100%;height:230px;">
            <tr style="height: 35px;">
                <td style="width: 30%;"> 用户名：</td><td><input type="text" name="username" value="{{ old('username') }}" /></td>
            </tr>
            <tr style="height: 35px;">
                <td style="width: 30%;">密 &nbsp;码：</td><td><input type="password" name="pwd" /></td>
            </tr>
            <tr style="height: 35px;">
                <td style="width: 30%;">确认密码：</td><td><input type="password" name="pwd2" /></td>
            </tr>
            <tr style="height: 35px;">
                <td style="width: 30%;">验证码：</td><td><input type="text" name="captcha" /></td>
            </tr>
            <tr style="height: 40px;">
                <td><img src="{{ captcha_src() }}" style="height: 40px;" onclick="this.src='./captcha/default?'+Math.random();"/></td>
                <td><div id="msg"></div></td>
            </tr>
            <tr style="text-align: center">
                <td colspan="2">
                    <input type="submit" name="submit" value="注册" style="margin-left: 1%;"/>&nbsp;&nbsp;&nbsp;
                    <input type=reset name="reset"/>
                </td>
            </tr>
        </table>
    </form>
    </div>
</div>
@stop
@section('javascript')
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/login_index.js') }}"></script>
@stop
