<div class="right-nav">
    @if(! Auth::check())           
        <div class='right-nav-title'>
            <a href="{{ action('Auth\LoginController@index') }}"> 请登录/注册</a>
        </div>
    @else            
        <div style='font-size: 18px;height: 50px;width: 100%;padding-left: 5%;'>您好,
        <br>{{ Auth::user()->user->username }}
        </div>
        <ul>
            <li><a href={{ action('User\IndexController@showprofile') }}>用户中心</a></li>
            <li><a href={{ action('Home\IndexController@checkBookRecord') }}>我的记录</a></li>
            <li><a href={{ action('Home\IndexController@showmybook') }}>我的书单</a></li>
            <li><a href={{ action('Auth\LoginController@getLogout') }}>安全退出</a></li>
        </ul>
    @endif    
</div>