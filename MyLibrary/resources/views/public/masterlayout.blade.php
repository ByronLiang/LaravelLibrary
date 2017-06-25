<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}"/>
@yield('style')
</head>
<body>
@yield('content')
<script src="{{ asset('assets/js/jquery-3.1.1.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
@yield('javascript')
<script>
        @if ($errors->count())
            @foreach ($errors->all() as $message)
                window.alert('{{ $message }}');
            @endforeach
        @endif
    </script>
</body>
</html>