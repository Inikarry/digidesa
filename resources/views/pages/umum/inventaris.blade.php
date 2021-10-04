@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Umum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Inventaris</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">KABUPATEN SOPPENG TAHUN ANGGARAN {{ now()->year }}<br>
                                           KECAMATAN DONRI-DONRI</h5>
                    <table class="table table-bordered data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th colspan="3" style="text-align:center">Nomor</th>
                                <th colspan="4" style="text-align:center">Spesifikasi Barang</th>
                                <th rowspan="3" style="vertical-align:middle">Asal Usul</th>
                                <th rowspan="3" style="vertical-align:middle">Tahun Beli/Perolehan</th>
                                <th rowspan="3" style="vertical-align:middle">Ukuran Barang/Konstruksi (P,SP,D)</th>
                                <th rowspan="3" style="vertical-align:middle">Satuan</th>
                                <th rowspan="3" style="vertical-align:middle">Kondisi (B,RR,RB)</th>
                                <th colspan="2" rowspan="2" style="vertical-align:middle" style="text-align:center">Jumlah Awal (1 Juli {{ now()->year }})</th>
                                <th colspan="4" style="text-align:center">Mutasi / Perubahan</th>
                                <th colspan="2" rowspan="2" style="vertical-align:middle" style="text-align:center">Jumlah Akhir (31 Des {{ now()->year }})</th>
                                <th rowspan="3" style="vertical-align:middle">Ket</th>
                            </tr>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle">No. Urut</th>
                                <th rowspan="2" style="vertical-align:middle">Kode Barang</th>
                                <th rowspan="2" style="vertical-align:middle">Register</th>
                                <th rowspan="2" style="vertical-align:middle">Nama / Jenis Barang</th>
                                <th rowspan="2" style="vertical-align:middle">Merek Type</th>
                                <th rowspan="2" style="vertical-align:middle">No Sertfikat, No Pabrik, No Mesin</th>
                                <th rowspan="2" style="vertical-align:middle">Bahan</th>
                                <th colspan="2" style="text-align:center">Berkurang</th>
                                <th colspan="2" style="text-align:center">Bertambah</th>
                            </tr>
                            <tr>
                                <th>Brg</th>
                                <th>Harga</th>
                                <th>Jml Brg</th>
                                <th>Jumlah Harga</th>
                                <th>Jml Brg</th>
                                <th>Jumlah Harga</th>
                                <th>Brg</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            initComplete: function (settings, json) {  
                $(".data-table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },
        });
    });

</script>
@endpush