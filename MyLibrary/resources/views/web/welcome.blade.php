<!DOCTYPE html>
<html>
<head>
    <title>welcome</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/welcome.css')}}">
</head>
<body>
<h3>Welcome to Enter</h3>
<p>
<a href="./test">Test</a>
<br>
<a href="{{ action('Home\IndexController@showBook') }}">Check my booklist</a>
</p>
<p>
<a href="{{ action('User\IndexController@index') }}">Check my booklist</a>
</p>
<span class="s1">CSRF_Code: </span> {{csrf_token()}}
</body>
</html>
