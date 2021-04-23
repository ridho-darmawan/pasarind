<!DOCTYPE html>
<html>
<head>
	<title>Laporan Transaksi Mobil</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		},
		.yayasan {
			font-size:10pt;
		}
		.yayasan p{
			text-align:center;
			border-bottom: 5px solid red;
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
				<th>
					<img 
						
						src="data:image/png;base64,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" alt="logo" title="">
	
	
				</th>
				<th width="70%">
				<h5 align="center">Laporan Transaksi Mobil</h5>
				<h6 align="center">Melancong Tour & Travel</h6>
				</th>
			</tr>
		</thead>
	</table>

	<!-- <center> -->
		<!-- <h5>Laporan Transaksi Mobil</h5><br/>
		<h6>Melancong Tour & Travel</h6><br/> -->
		<p style="border-bottom: 5px double black;"></p>
		
		
	<!-- </center> -->
	<!-- <img src="{{ url('storage/img/logo-melancong.png') }}" alt="hjh" title="" /> -->
	<p>Periode :  {{ date('d-m-Y',strtotime($start)) }} s/d {{ date('d-m-Y',strtotime($end)) }}</p>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Kode Transaksi</th>
				<th>Nama Pemesan</th>
				<th>Nama Mobil</th>
				<th>Nama Supir</th>
				<th>Lama Peminjaman</th>
				<th>Diskon</th>
				<th>Harga</th>
				<th>Total</th>
			</tr>
		</thead>

		<tbody>
				@php $i=1 @endphp
				@foreach($data as $dt)
				<tr>
					<td>{{ $i++ }}</td>
					<td>{{ $dt->kode_transaksi }}</td>
					<td>{{$dt->atas_nama}}</td>
					<td>{{$dt->dataKatalogMobil->nama_mobil}}</td>
					<td>{{$dt->dataSupir->nama}}</td>
					<td>
						@php
							$start = date_create($dt->start);
							$end = date_create($dt->end);
							$diff = date_diff($start, $end);
							
						@endphp
						{{$diff->days}} Hari
					</td>
					
					<td>

						@php
							$harga = $dt->dataKatalogMobil->harga;
							$diskon = $dt->dataKatalogMobil->diskon;

							$totalDiskon = $harga * ($diskon / 100 );
						@endphp
					
						Rp. {{number_format($totalDiskon ,0,',','.')}}
					
					</td>
					<td>Rp. {{number_format($dt->harga,0,',','.')}}</td>
					
					
					<td>

						@php
							$start = date_create($dt->start);
							$end = date_create($dt->end);
							$diff = date_diff($start, $end);
						
							

							$harga = $dt->dataKatalogMobil->harga;
							$diskon = $dt->dataKatalogMobil->diskon;


							$total = $diff->days * $dt->dataKatalogMobil->harga; 
							$totalBayar = $total - $totalDiskon;

						@endphp

					
						Rp. {{number_format($dt->total,0,',','.')}}
					<!-- Rp. {{number_format($totalBayar,0,',','.')}} -->
					</td>
				</tr>
				@endforeach
				<tr>
				<td colspan="8">Total</td>
				
				<td>
		
					Rp. {{number_format($nominalTotal,0,',','.')}}
				
				</td>
				</tr>
			</tbody>
		<!--  -->
	</table>

</body>
</html>