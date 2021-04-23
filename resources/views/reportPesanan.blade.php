<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pesanan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}

		table tr th img{
			margin-top:10px;
			margin-bottom:30px;
			width:310px;
		}
	</style>

	<table>
		<thead>
			<tr>
				
				<th width="70%">
				<h5 align="center">Laporan Pesanan</h5>
				
				</th>
			</tr>
		</thead>
	</table>
	
		<p style="border-bottom: 5px double black;"></p>
	

	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>no pesanan</th>
				<th>No meja</th>
				<th>Nominal</th>
			</tr>
		</thead>

		<tbody>
				@php $i=1 @endphp
				@foreach($data as $dt)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $dt->no_pesanan }}</td>
					<td>{{$dt->no_meja}}</td>
					
					<td>Rp. {{number_format($dt->total_bayar,0,',','.')}}</td>
				</tr>
				@endforeach
				<tr>
				
				</tr>
			</tbody>
		<!--  -->
	</table>

</body>
</html>