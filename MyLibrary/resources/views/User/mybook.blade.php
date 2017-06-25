<!DOCTYPE html>
<html>
<head>
	<title>MyBookList</title>
</head>
<body>
<table>
	<tr>
		<td>Bookid</td><td>Time</td><td>Status</td>
	</tr>
	@foreach($res as $key=>$info)
		<tr>
			<td>{{ $key }} {{ $info->book_id }}</td>
			<td>{{ $info->borrow_time }}</td>
			<td>{{ $info->book_status }}</td>
		</tr>
	@endforeach
</table>
{{$res}}
</body>
</html>
