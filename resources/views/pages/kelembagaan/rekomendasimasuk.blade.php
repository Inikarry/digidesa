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
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <meta name="csrf-token-edit" content="{{ csrf_token() }}">
                <div class="form-group">
                    <label class="form-label">Pengirim</label>
                    <input type="text" class="form-control" id="edit_pengirim" placeholder="Pengirim">
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor</label>
                    <input type="text" class="form-control" id="edit_nomor" placeholder="Nomor">
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal</label>
                    <input type="date" id="edit_tanggal" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Perihal</label>
                    <input type="text" class="form-control" id="edit_perihal" placeholder="Perihal">
                </div>
                <div class="form-group">
                    <label for="formFile" class="form-label">File</label>
                    <div class="custom-control custom-switch" id="switchFoto">
                        <input type="checkbox" onchange="del()" class="custom-control-input" id="switchDelete">
                        <label class="custom-control-label" for="switchDelete">Hapus Foto ?</label>
                    </div>
                    <input class="form-control" type="file" id="edit_image">
                </div>
            </div>
            <input type="hidden" id="edit_id">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary update">Ubah</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<script type="text/javascript">
    function initialize() {
        var d = document.getElementById("createForm");
        var i = document.getElementById("switchFoto");
        var j = document.getElementById("edit_image");
        d.style.display = "none";
        i.style.display = "none";
        j.style.display = "none";
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

    function del(){
        event.preventDefault();
        var d = document.getElementById("edit_image");
        if(document.getElementById("switchDelete").checked){
            d.style.display = "block";
        }else{
            d.style.display = "none";
            d.value = '';
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

        $('#rekomendasiTable').on('click','.edit_rm',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_pengirim = $(this).data('pengirim');
            var edit_nomor = $(this).data('nomor');
            var edit_tanggal = $(this).data('tanggal');
            var edit_perihal = $(this).data('perihal');
            var edit_foto = $(this).data('foto');
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_pengirim").value = edit_pengirim;
            document.getElementById("edit_nomor").value = edit_nomor;
            document.getElementById("edit_tanggal").value = edit_tanggal;
            document.getElementById("edit_perihal").value = edit_perihal;
            document.getElementById("switchDelete").checked = false;
            document.getElementById("edit_image").value = '';

            var i = document.getElementById("switchFoto");
            var j = document.getElementById("edit_image");
            if(edit_foto !== ''){    
                i.style.display = "block";
                j.style.display = "none";
            }else{
                j.style.display = "block";
                i.style.display = "none";
            }
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-rekomendasimasuk/edit/" + uId;

            var formData = new FormData()
            if($('#edit_image').val() !== '') {
                formData.set('uImage', $('#edit_image')[0].files[0])
            }
            formData.set('deleteImage', $("#switchDelete").is(":checked"));
            formData.set('uPengirim', $('#edit_pengirim').val());
            formData.set('uNomor', $('#edit_nomor').val());
            formData.set('uTanggal', $('#edit_tanggal').val());
            formData.set('uPerihal', $('#edit_perihal').val());
            formData.set('_method', 'PUT');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
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