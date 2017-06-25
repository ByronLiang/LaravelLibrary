function putbook(value)
{
   location.href="./addbookcar.php?info="+value;
}

function delebook(value)
{
    //alert("./deletebooklistAction.php?"+value);
    location.href="./deletebooklistAction.php?"+value;
}

function handinbook()
{
    location.href = "./bookhandAction.php";
}
function updatebook(value)
{
    location.href = "./updatebookdbAction.php?id="+value;
}
//采用正则表达式获取地址栏参数
function GetQueryString(name)
{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)
     	return  unescape(r[2]); 
     return null;
}

//destiny是目标字符串，比如是http://www.huistd.com/?id=3&ttt=3 
//par是参数名，par_value是参数要更改的值
function changeURLPar(destiny, par, par_value) 
{ 
var pattern = par+'=([^&]*)'; 
var replaceText = par+'='+par_value; 
if (destiny.match(pattern)) 
{ 
var tmp = '/\\'+par+'=[^&]*/'; 
tmp = destiny.replace(eval(tmp), replaceText); 
return (tmp); 
} 
else 
{ 
if (destiny.match('[\?]')) 
{ 
return destiny+'&'+ replaceText; 
} 
else 
{ 
return destiny+'?'+replaceText; 
} 
} 
return destiny+'\n'+par+'\n'+par_value; 
}

function pageRedir()
{
	var pagenum = document.getElementById('pagenum').value;
	var url = location.href;
	var target = 'page';
	return changeURLPar(url, target, pagenum);
}

$(function(){
    $("#sub").click(function(){
        var book = document.cookie;
        alert(book);
    });
});