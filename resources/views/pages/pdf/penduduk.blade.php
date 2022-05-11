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
		<h6>LAPORAN KEPENDUDUKAN</h6>
        <h6>KECAMATAN DONRI-DONRI</h6>
        <h6>BULAN {{$month}} {{$year}}</h6>
	</center>
    <br>
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th rowspan="2" style="vertical-align:middle;text-align: center;">NO</th>
                <th rowspan="2" style="vertical-align:middle;text-align: center;">DESA</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">PENDUDUK AWAL BULAN</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">LAHIR BULAN INI</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">MATI BULAN INI</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">DATANG BULAN INI</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">PINDAH BULAN INI</th>
                <th colspan="3" style="vertical-align:middle;text-align: center;">JUMLAH AKHIR BULAN</th>
			</tr>
            <tr>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
                <th style="vertical-align:middle">L</th>
                <th style="vertical-align:middle">P</th>
                <th style="vertical-align:middle">L+P</th>
            </tr>
            <tr style="line-height: 8px;min-height: 8px;height: 8px;">
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
            </tr>
		</thead>
		<tbody>
            @php
                $i=1;
                $sum_awal_l     = 0;
                $sum_awal_p     = 0;
                $sum_awal_lp    = 0;
                $sum_lahir_l    = 0;
                $sum_lahir_p    = 0;
                $sum_lahir_lp   = 0;
                $sum_mati_l     = 0;
                $sum_mati_p     = 0;
                $sum_mati_lp    = 0;
                $sum_datang_l   = 0;
                $sum_datang_p   = 0;
                $sum_datang_lp  = 0;
                $sum_pindah_l   = 0;
                $sum_pindah_p   = 0;
                $sum_pindah_lp  = 0;
                $sum_jumlah_l   = 0;
                $sum_jumlah_p   = 0;
                $sum_jumlah_lp  = 0;
            @endphp
            @foreach($datas as $data)
            @php
                $awal_l     = $data->awal_l + 0;
                $awal_p     = $data->awal_p + 0;
                $awal_lp    = $data->awal_l + $data->awal_p;
                $lahir_l    = $data->lahir_l + 0;
                $lahir_p    = $data->lahir_p + 0;
                $lahir_lp   = $data->lahir_l + $data->lahir_p;
                $mati_l     = $data->mati_l + 0;
                $mati_p     = $data->mati_p + 0;
                $mati_lp    = $data->mati_l + $data->mati_p;
                $datang_l   = $data->datang_l + 0;
                $datang_p   = $data->datang_p + 0;
                $datang_lp  = $data->datang_l + $data->datang_p;
                $pindah_l   = $data->pindah_l + 0;
                $pindah_p   = $data->pindah_p + 0;
                $pindah_lp  = $data->pindah_l + $data->pindah_p;
                $jumlah_l   = $data->awal_l + $data->lahir_l + $data->mati_l + $data->datang_l + $data->pindah_l;
                $jumlah_p   = $data->awal_p + $data->lahir_p + $data->mati_p + $data->datang_p + $data->pindah_p;
                $jumlah_lp  = $data->awal_l + $data->lahir_l + $data->mati_l + $data->datang_l + $data->pindah_l + $data->awal_p + $data->lahir_p + $data->mati_p + $data->datang_p + $data->pindah_p;
            
                $sum_awal_l     += $awal_l;
                $sum_awal_p     += $awal_p;
                $sum_awal_lp    += $awal_lp;
                $sum_lahir_l    += $lahir_l;
                $sum_lahir_p    += $lahir_p;
                $sum_lahir_lp   += $lahir_lp;
                $sum_mati_l     += $mati_l;
                $sum_mati_p     += $mati_p;
                $sum_mati_lp    += $mati_lp;
                $sum_datang_l   += $datang_l;
                $sum_datang_p   += $datang_p;
                $sum_datang_lp  += $datang_lp;
                $sum_pindah_l   += $pindah_l;
                $sum_pindah_p   += $pindah_p;
                $sum_pindah_lp  += $pindah_lp;
                $sum_jumlah_l   += $jumlah_l;
                $sum_jumlah_p   += $jumlah_p;
                $sum_jumlah_lp  += $jumlah_lp;
            @endphp
            <tr>
                <td style="text-align:center">{{ $i++ }}</td>
                <td style="text-align:left">{{ $data->nama_desa }}</td>
                <td style="text-align:center">{{ number_format($awal_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($awal_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($awal_lp,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($lahir_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($lahir_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($lahir_lp,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($mati_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($mati_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($mati_lp,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($datang_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($datang_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($datang_lp,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($pindah_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($pindah_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($pindah_lp,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($jumlah_l,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($jumlah_p,0,",",".")}}</td>
                <td style="text-align:center">{{ number_format($jumlah_lp,0,",",".")}}</td>
            </tr>
            @endforeach
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr>
                <td></td>
                <td><b>JUMLAH</b></td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_awal_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_awal_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_awal_lp,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_lahir_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_lahir_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_lahir_lp,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_mati_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_mati_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_mati_lp,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_datang_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_datang_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_datang_lp,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_pindah_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_pindah_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_pindah_lp,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_jumlah_l,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_jumlah_p,0,",",".")}}</td>
                <td style="text-align:center;font-weight: bold">{{ number_format($sum_jumlah_lp,0,",",".")}}</td>
            </tr>
		</tbody>
	</table>
    <br>
    <h7>KET: Jumlah KK</h7>
    <br>
    <table style="border:1px solid black;width:30%">
        <tbody style="border:1px solid black">
            @php
                $i=1;
                $sum_kk = 0;
            @endphp
            @foreach($datas as $data)
            @php $sum_kk += $data->kk; @endphp
            <tr style="border:1px solid black">
                <td style="border:1px solid black;text-align:center;width:15%">{{ $i++ }}</td>
                <td style="border:1px solid black;text-align:left;width:65%">{{ $data->nama_desa }}</td>
                <td style="border:1px solid black;text-align:right;width:20%">{{ number_format($data->kk,0,",",".")}}</td>
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td style="border:1px solid black;text-align:left"><b>JUMLAH</b></td>
                <td style="border:1px solid black;text-align:right"><b>{{number_format($sum_kk,0,",",".")}}</b></td>
            </tr>   
        </tbody>
    </table>
</body>
</html>