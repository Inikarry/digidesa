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
                     <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Rekomendasi Masuk</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor</label>
                                        <input type="text" class="form-control" id="rm_nomor" placeholder="Nomor">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" id="rm_tanggal" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                     <div class="mb-3 col-4">
                                        <label class="form-label">Alamat Pengirim</label>
                                        <input type="text" class="form-control" id="rm_AlamatPengirim" placeholder="Alamat Pengirim">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Perihal</label>
                                        <input type="text" class="form-control" id="rm_perihal" placeholder="Perihal">
                                    </div>
                                    
                                </div>
                            </div>     
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="formFile" class="form-label">File</label>
                                        <input class="form-control" type="file" id="image">
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-rekomendasimasuk.add') }}" class="btn btn-outline-primary addRM">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                     <table id="rekomendasiTable" class="table table-bordered" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
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
            {data: 'foto', name: 'foto'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        order: [ 1 , 'desc'],
    });

    });

 $('#rekomendasiTable').on('click','.delete_rm',function(e){
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
        $('.addRM').click(function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var rm_nomor = $('#rm_nomor').val();
            var rm_tanggal = $('#rm_tanggal').val();
            var rm_AlamatPengirim = $('#rm_AlamatPengirim').val();
            var rm_perihal = $('#rm_perihal').val();

            var formData = new FormData()
            if($('#image').val() !== '') {
                formData.append('image', $('#image')[0].files[0])
            }
            formData.append('rm_nomor', rm_nomor);
            formData.append('rm_tanggal', rm_tanggal);
            formData.append('rm_AlamatPengirim', rm_AlamatPengirim);
            formData.append('rm_perihal', rm_perihal);

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