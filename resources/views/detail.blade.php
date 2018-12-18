<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="container">
	<table class="table table-responsive" style="margin-top: 50px;">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Screen_name</th>
			<th>Location</th>
			<th>url</th>
			<th>followers_count</th>
			<th>friends_count</th>
			<th>favourites_count</th>
			<th>statuses_count</th>
			<th>Created_at</th>
			<th>Action</th>
		</tr>
		<tr>
			@if(count($tweets))
				<td>{{ $tweets[0]['id'] }}</td>
				<td>{{ $tweets[0]['name'] }}</td>
				<td>{{ $tweets[0]['screen_name'] }}</td>
				<td>{{ $tweets[0]['location'] }}</td>
				<td>{{ $tweets[0]['url'] }}</td>
				<td>{{ $tweets[0]['followers_count'] }}</td>
				<td>{{ $tweets[0]['friends_count'] }}</td>
				<td>{{ $tweets[0]['favourites_count'] }}</td>
				<td>{{ $tweets[0]['statuses_count'] }}</td>
				<td>{{ $tweets[0]['created_at'] }}</td>
				<td><a href="/display/chart/{{$tweets[0]['id']}}"><button>Click me</button></a></td>
			@else
				<p style="color: red;">No find results !</p>
			@endif
		</tr>
	</table>
</body>
</html>