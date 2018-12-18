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
			<th>Created_at</th>
		</tr>
		<tr>
			@if(count($statuses))
				@foreach($statuses as $status)
					<tr>
						<td>{{$status['id']}}</td>
					</tr>
				@endforeach
			@else
				<p style="color: red;">No find results !</p>
			@endif
		</tr>
	</table>
</body>
</html>