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
                                <th>No</th>
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
            $(".data-table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
        },
        processing  : true,
        serverSide  : true,
        ajax: "{{ route('umum.buku-keputusan') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%'},
            {data: 'sk_nomor', name: 'sk_nomor', width: '15%'},
            {data: 'sk_tanggal', name: 'sk_tanggal', width: '15%'},
            {data: 'sk_perihal', name: 'sk_perihal', width: '30%'},
            {data: 'sk_foto', name: 'sk_foto', width: '20%'},
            {data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
        ],
        columnDefs: [
            {
                targets: [0,2,4,5],
                className: 'text-center'
            },
            {
                targets: [1,3],
                className: 'text-left'
            }
        ],
        order: [ 2 , 'desc'],
    });

    });
</script>
@endpush