<table style='width:100%; border:none; cellpadding:0; cellspacing:0; bgcolor:#CCCCCC' >
    <tr>
        <td bgcolor=''#FFFFFF'>
            <img src='/assets/img/headpic.jpg' style='width:100%;height:255px'; />
            <span style='font-size: 45px;font-weight:bold;position: absolute;top: 140px;left: 42%;color: darkslategrey'>图书借阅平台</span>
        </td>
        </tr>
    </table>
    <div class='top-nav'>
                <ul>
                    <li><a href = "{{ action('Home\IndexController@index') }}">主页</a></li>
                    <li><a href={{ action('Home\IndexController@introduction') }}>书单推荐</a></li>
                    <li><a href=''>图书沙龙</a></li>
                    <li><a href=''>关于借阅平台</a></li>
                    <li><a href=''>联系我们</a></li>
                </ul>
    </div>