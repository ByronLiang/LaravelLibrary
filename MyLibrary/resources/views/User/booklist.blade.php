<!DOCTYPE html>
<html>
<head>
    <title>BookList</title>
</head>
<body>
<table>
    <tr>
        <td>Bookid</td><td>Name</td><td>Time</td><td>Type</td>
    </tr>
    @foreach($res as $info)
        <tr>
            <td> {{ $info->name }}</td>
            <td>{{ $info->uploadtime }}</td>
            <td>{{ $info->type}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
