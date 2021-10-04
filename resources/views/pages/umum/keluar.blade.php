@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Umum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Agenda</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Agenda Surat Keluar</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Surat Keluar</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor Berkas</label>
                                        <input type="text" class="form-control" id="keluar_berkas" placeholder="Nomor Berkas">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Alamat Penerima</label>
                                        <input type="text" id="keluar_penerima" class="form-control" placeholder="Alamat Penerima">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="keluar_tanggal">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="formFile" class="form-label">Perihal</label>
                                        <input class="form-control" type="text" id="keluar_Perihal" placeholder="Nomor">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor Petunjuk</label>
                                        <input type="text" class="form-control" id="keluar_petunjuk" placeholder="Petunjuk">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor</label>
                                        <input type="text" class="form-control" id="keluar_nomor" placeholder="Nomor">
                                    </div>
                                </div>
                            </div>    
                            <div class="col">
                                <div class="row justify-content-center"> 
                                    <div class="mb-3 col-4">
                                        <label for="image" class="form-label">File</label>
                                        <input class="form-control" type="file" id="image">
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-keluar.add') }}" class="btn btn-outline-primary addKeluar">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table id="tableKeluar" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Berkas</th>
                                <th>Alamat Penerima</th>
                                <th>Tanggal</th>
                                <th>Perihal</th>
                                <th>No. Petunjuk</th>
                                <th>Nomor</th>
                                <th>file/foto</th>
                                <th>Aksi</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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
    var table = $('#tableKeluar').DataTable({
        initComplete: function (settings, json) {  
            $("#tableKeluar").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
        },
        processing  : true,
        serverSide  : true,
        ajax: "{{ route('umum.buku-keluar') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'keluar_berkas', name: 'keluar_berkas'},
            {data: 'keluar_tujuan', name: 'keluar_tujuan'},
            {data: 'keluar_tanggal', name: 'keluar_tanggal'},
            {data: 'keluar_perihal', name: 'keluar_perihal'},
            {data: 'keluar_petunjuk', name: 'keluar_petunjuk'},
            {data: 'keluar_nomor', name: 'keluar_nomor'},
            {data: 'keluar_foto', name: 'keluar_foto', orderable: false, searchable:false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
       
        order: [ 3 , 'desc'],
    });
    });

    $(document).ready(function() {
        $('.addKeluar').click(function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var keluar_berkas = $('#keluar_berkas').val();
            var keluar_penerima = $('#keluar_penerima').val();
            var keluar_tanggal = $('#keluar_tanggal').val();
            var keluar_perihal = $('#keluar_perihal').val();
            var keluar_petunjuk = $('#keluar_petunjuk').val();
            var keluar_nomor = $('#keluar_nomor').val();

            var formData = new FormData()
            if($('#image').val() !== '') {
                formData.append('image', $('#image')[0].files[0])
            }
            formData.append('keluar_berkas', keluar_berkas);
            formData.append('keluar_penerima', keluar_penerima);
            formData.append('keluar_tanggal', keluar_tanggal);
            formData.append('keluar_perihal', keluar_perihal);
            formData.append('keluar_petunjuk', keluar_petunjuk);
            formData.append('keluar_nomor', keluar_nomor);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-create"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                data: formData,
                method: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success:function(data){
                    if(data.success == 0){
                        var values = '';
                        $.each(data.error, function (key, value) {
                            values = value
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: values,
                        });
                    } else if(data.success == 1){
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