@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelembagaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Rekomendasi Pengangkatan dan Pemberhentian perangkat Desa (Surat Keluar)</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku Rekomendasi (Keluar)</h5>
                     <table id="rekomendasiTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th style="vertical-align:middle">No</th>
                                <th>nomor Surat Permintaan</th>
                                <th>Tanggal</th>
                                <th>Alamat Tujuan</th>
                                <th>Keterangan</th>
                                <th>Foto/File</th>
                                <th>Aksi</th>
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
    var table = $('#rekomendasiTable').DataTable({
        initComplete: function (settings, json) {  
             $("#rekomendasiTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
        },
        processing  : true,
        serverSide  : true,
        ajax: "{{ route('kelembagaan.buku-rekomendasikeluar') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'id_masuk', name: 'id_masuk'},
            {data: 'rk_tanggal', name: 'rk_tanggal'},
            {data: 'rk_tujuan', name: 'rk_tujuan'},
            {data: 'rk_keterangan', name: 'rk_keterangan'},
            {data: 'rm_foto', name: 'rm_foto'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [ 1 , 'desc'],
    });

    });
</script>
@endpush