@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelembagaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Rekomendasi Pengangkatan dan Pemberhentian perangkat Desa (Surat Masuk)</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku Rekomendasi (Masuk)</h5>
                     <table id="rekomendasiTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nomor Surat</th>
                                <th>Alamat Pengirim</th>
                                <th>Perihal</th>
                                <th>Status</th>
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
        ajax: "{{ route('kelembagaan.buku-rekomendasimasuk') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'rm_tanggal', name: 'rm_tanggal'},
            {data: 'rm_nomor', name: 'rm_nomor'},
            {data: 'rm_pengirim', name: 'rm_pengirim'},
            {data: 'rm_perihal', name: 'rm_perihal'},
            {data: 'rm_status', name: 'rm_status'},
            {data: 'rm_foto', name: 'rm_foto'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [ 1 , 'desc'],
    });

    });
</script>
@endpush