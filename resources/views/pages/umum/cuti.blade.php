@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Umum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Cuti</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku Cuti Kecamatan Donri-Donri</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <div class="row" id="createForm">
                        <form>
                        <meta name="csrf-token-create" content="{{ csrf_token() }}">
                        <div class="col-xl">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="cuti_nama">Nama :</label>
                                    <input type="text" class="form-control" id="cuti_nama" placeholder="Nama">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nip">NIP :</label>
                                    <input type="text" class="form-control" id="nip" placeholder="NIP">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cuti_tanggal">Tanggal :</label>
                                    <input type="date" class="form-control" id="cuti_tanggal" placeholder="Tanggal">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cuti_mulai">Mulai :</label>
                                    <input type="date" class="form-control" id="cuti_mulai" placeholder="Tanggal Mulai Cuti">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="cuti_selesai">Selesai :</label>
                                    <input type="date" class="form-control" id="cuti_selesai" placeholder="Tanggal Selesai Cuti">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="cuti_jenis">Jenis Cuti :</label>
                                    <select name="cuti_jenis" id="cuti_jenis" class="form-control custom-select">
                                        <option value="" selected disabled>--Pilih Jenis Cuti--</option>
                                        <option value="Cuti Tahunan">Cuti Tahunan</option>
                                        <option value="Cuti Tahunan">Cuti Menikah</option>
                                        <option value="Cuti Tahunan">Cuti Hamil</option>
                                        <option value="Cuti Tahunan">Cuti .....</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="keterangan">Keterangan :</label>
                                    <input type="text" class="form-control" id="keterangan" placeholder="Keterangan Cuti">
                                </div>
                            </div>
                            <button type="button" data-url="{{ route('buku-cuti.add') }}" class="btn btn-outline-primary addCuti">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <br>
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Mulai Cuti</th>
                                <th>Selesai Cuti</th>
                                <th>Macam Cuti</th>
                                <th>Keterangan</th>
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
    function initialize() {
        var d = document.getElementById("createForm");
        d.style.display = "none";
    }
    initialize();

    function create(){
        event.preventDefault();
        var d = document.getElementById("createForm");
        if(document.getElementById("switchCreate").checked){
            d.style.display = "block";
        }else{
            d.style.display = "none";
        }
    }

    $(function () {
    var table = $('.data-table').DataTable({
        initComplete: function (settings, json) {  
            $(".data-table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
        },
        processing  : true,
        serverSide  : true,
        ajax: "{{ route('umum.buku-cuti') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'cuti_tanggal', name: 'cuti_tanggal'},
            {data: 'cuti_nama', name: 'cuti_nama'},
            {data: 'nip', name: 'nip'},
            {data: 'cuti_mulai', name: 'cuti_mulai'},
            {data: 'cuti_selesai', name: 'cuti_selesai'},
            {data: 'cuti_jenis', name: 'cuti_jenis'},
            {data: 'keterangan', name: 'keterangan',  orderable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [ 1 , 'desc'],
    });

    });

    $('.data-table').on('click','.delete_cuti',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        var url = $(this).data('url');
        console.log(url);
        Swal.fire({
            title: 'Apa Anda Yakin?',
            text: "Anda Tidak Dapat Membatalkan Operasi Ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token-delete"]').attr('content')
                    }
                });
                $.ajax({
                    url:url,
                    data:{id:id},
                    method:'DELETE',
                    success:function(data){
                    Swal.fire(
                        'Dihapus!',
                        'Data Berhasil Dihapus.',
                        'success'
                    )
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                    }
                });
            }
            })
    });

    $(document).ready(function() {
        $('.addCuti').click(function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var cuti_nama = $('#cuti_nama').val();
            var nip = $('#nip').val();
            var cuti_tanggal = $('#cuti_tanggal').val();
            var cuti_mulai = $('#cuti_mulai').val();
            var cuti_selesai = $('#cuti_selesai').val();
            var cuti_jenis = $('#cuti_jenis').val();
            var keterangan = $('#keterangan').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-create"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                data:{  cuti_nama:cuti_nama,
                        nip:nip, 
                        cuti_tanggal:cuti_tanggal, 
                        cuti_mulai:cuti_mulai, 
                        cuti_selesai:cuti_selesai,
                        cuti_jenis:cuti_jenis, 
                        keterangan:keterangan, 
                    },
                method:'POST',
                success:function(data){
                    if(data.errors) {
                        var values = '';
                        $.each(data.errors, function (key, value) {
                            values = value
                        });

                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: values,
                    });
                    }else {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Berhasil Disimpan',
                        showConfirmButton: false,
                    });
                        setTimeout(function(){
                        location.reload();
                        }, 2000);
                    }
                }
            });
        })
    });
</script>
@endpush