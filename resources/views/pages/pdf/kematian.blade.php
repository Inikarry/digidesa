<!DOCTYPE html>
<html>
<head>
	<title>Laporan Bulanan Pencatatan Kematian Penduduk</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		body {
            font-family: Arial;
        },
        table {
            border-collapse: collapse;
        },
        table tr td,
		table tr th{
			font-size: 9pt;
		},
        table.table-bordered{
            border:1px solid black;
        }
        table.table-bordered > thead > tr > th{
            border:1px solid black;
        }
        table.table-bordered > tbody > tr > td{
            border:1px solid black;
        }
	</style>
	<center>
		<h6>LAPORAN BULANAN PENCATATAN KEMATIAN PENDUDUK</h6>
        <table style="margin-left:auto;margin-right:auto;width:30%">
            <tr>
                <td style="width:60%;font-weight: bold;">KECAMATAN</td>
                <td style="width:40%;font-weight: bold;">: DONRI DONRI</td>
            </tr>
            <tr>
                <td style="font-weight: bold;">BULAN</td>
                <td style="font-weight: bold;">: {{$month}}</td>
            </tr>
        </table>
	</center>
    <br>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>NO</th>
				<th>NIK</th>
				<th>NAMA LENGKAP</th>
				<th>TEMPAT LAHIR</th>
				<th>TANGGAL LAHIR</th>
				<th>TANGGAL MENINGGAL</th>
                <th>NO. KET. KEMATIAN</th>
			</tr>
            <tr style="line-height: 8px;min-height: 8px;height: 8px;">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
            </tr>
		</thead>
		<tbody>
            @foreach($data_desa as $desa)
            <tr>
                <td></td>
                <td><b><u>DESA {{ $desa->nama_desa }}</b></u></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @php
                $i=1;
            @endphp
            @foreach($datas as $data)
            <tr>
                @if($data->id_desa == $desa->id)
				<td style="text-align:center">{{ $i++ }}</td>
				<td style="text-align:left">{{ $data->kematian_nik}}</td>
				<td style="text-align:center">{{ $data->kematian_nama}}</td>
				<td style="text-align:center">{{ $data->kematian_tempat_lahir}}</td>
				<td style="text-align:center">{{ \Carbon\Carbon::parse($data->kematian_tanggal_lahir)->formatLocalized('%d %B %Y')}}</td>
				<td style="text-align:center">{{ \Carbon\Carbon::parse($data->kematian_tanggal_meninggal)->formatLocalized('%d %B %Y')}}</td>
                <td style="text-align:center">{{ $data->kematian_ket_kematian}}</td>
                @endif
			</tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
		</tbody>
	</table>
</body>
</html>