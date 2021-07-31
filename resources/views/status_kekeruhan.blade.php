<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Laravel #24 : Relasi One To Many Eloquent</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
				<h3 class="text-center"><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>
				<h5 class="text-center my-4">Eloquent One To Many Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
                        <tr>
                            <th>Status Kekeruhan</th>
                            <th>Kekeruhan</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($status_kekeruhan as $item)
                            <tr>
                                <td>{{ $item->jenis_kekeruhan }}</td>
                                <td>{{ $item->kekeruhan->NTU }}</td>

                            </tr>
                        @endforeach
                        </tbody>
				</table>
			</div>
		</div>
	</div>

</body>
</html>
