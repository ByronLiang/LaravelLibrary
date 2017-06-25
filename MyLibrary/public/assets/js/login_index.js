function check(id)
{
    var loginframe = document.getElementById('log-btn');
    var registerframe = document.getElementById('reg-btn');

    var flag = document.getElementById(id);
//    var msg = document.getElementById("showmsg");

    if(flag.innerHTML === "登录")
    {
//        msg.innerHTML="这里能实现登录功能！";
        flag.style.backgroundColor="#CCCCCC";
        registerframe.style.backgroundColor="white";
        document.getElementById("loginshow").style.display="block";
        document.getElementById("registershow").style.display="none";
        document.getElementById('logintable').style.backgroundColor="#CCCCCC";

    }
    if(flag.innerHTML === "注册")
    {
//        msg.style.backgroundColor="blue";
        flag.style.backgroundColor="gainsboro";
//        msg.innerHTML="这里能实现注册功能！";
        loginframe.style.backgroundColor="white";
        document.getElementById("loginshow").style.display="none";
        document.getElementById("registershow").style.display="block";
        document.getElementById('registertable').style.backgroundColor="gainsboro";
    }

}

function reback(id)
{
    var flag = document.getElementById(id);

    if(flag.innerHTML === "登录")
    {
        flag.style.backgroundColor="white";
    }
    if(flag.innerHTML === "注册")
    {
        flag.style.backgroundColor="white";
    }

}
