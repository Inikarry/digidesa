@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Induk Penduduk</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku Induk Penduduk</h5>
                    <table id="gajiTable" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nomor Surat</th>
                                <th>Alamat Tujuan</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
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
    var table = $('#gajiTable').DataTable({
        initComplete: function (settings, json) {  
            $("#gajiTable").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
        },
        processing  : true,
        serverSide  : true,
        ajax: "{{ route('kelembagaan.buku-gaji') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'gaji_nomor', name: 'gaji_nomor'},
            {data: 'gaji_tujuan', name: 'gaji_tujuan'},
            {data: 'gaji_tanggal', name: 'gaji_tanggal'},
            {data: 'gaji_nama', name: 'gaji_nama'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [ 1 , 'desc'],
    });

    });

</script>
@endpush