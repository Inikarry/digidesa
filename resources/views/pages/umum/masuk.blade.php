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
                    <h5 class="card-title">Agenda Surat Masuk</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Surat Masuk</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor Berkas</label>
                                        <input type="text" class="form-control" id="masuk_berkas" placeholder="Nomor Berkas">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Alamat Pengirim</label>
                                        <input type="text" id="masuk_pengirim" class="form-control" placeholder="Alamat Pengirim">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tanggal</label>
                                        <input type="date" class="form-control" id="masuk_tanggal">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="formFile" class="form-label">Nomor</label>
                                        <input class="form-control" type="text" id="masuk_nomor" placeholder="Nomor">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Perihal</label>
                                        <input type="text" class="form-control" id="masuk_perihal" placeholder="Perihal">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="image" class="form-label">File</label>
                                        <input class="form-control" type="file" id="image">
                                    </div>
                                </div>
                            </div>    
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor Petunjuk</label>
                                        <input type="text" class="form-control" id="masuk_petunjuk" placeholder="Nomor Petunjuk">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nomor Paket</label>
                                        <input type="text" id="masuk_paket" class="form-control" placeholder="Nomor Paket">
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-masuk.add') }}" class="btn btn-outline-primary addMasuk">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle">No.</th>
                                <th rowspan="2" style="vertical-align:middle">No. Berkas</th>
                                <th rowspan="2" style="vertical-align:middle">Pengirim</th>
                                <th colspan="3" style="text-align:center">Dari Surat Masuk</th>
                                <th rowspan="2" style="vertical-align:middle">No. Petunjuk</th>
                                <th rowspan="2" style="vertical-align:middle">No. Paket</th>
                                <th rowspan="2" style="vertical-align:middle">File/Foto</th>
                                <th rowspan="2" style="vertical-align:middle">Aksi</th>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor</th>
                                <th>Perihal</th>
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
<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <meta name="csrf-token-edit" content="{{ csrf_token() }}">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nomor Berkas</label>
                        <input type="text" class="form-control" id="edit_berkas" placeholder="Nomor Berkas">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Alamat Pengirim</label>
                        <input type="text" id="edit_pengirim" class="form-control" placeholder="Alamat Pengirim">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="edit_tanggal">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="formFile" class="form-label">Nomor</label>
                        <input class="form-control" type="text" id="edit_nomor" placeholder="Nomor">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="edit_perihal" placeholder="Perihal">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Nomor Petunjuk</label>
                        <input type="text" class="form-control" id="edit_petunjuk" placeholder="Nomor Petunjuk">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Nomor Paket</label>
                        <input type="text" id="edit_paket" class="form-control" placeholder="Nomor Paket">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="form-label">File</label>
                        <div class="custom-control custom-switch" id="switchFoto">
                            <input type="checkbox" onchange="del()" class="custom-control-input" id="switchDelete">
                            <label class="custom-control-label" for="switchDelete">Hapus Foto ?</label>
                        </div>
                        <input class="form-control" type="file" id="edit_image">
                    </div>
                </div>
                <input type="hidden" id="edit_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary update">Simpan Perubahan</button>
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
        var table = $('.data-table').DataTable({
            initComplete: function (settings, json) {  
                $(".data-table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },
            processing  : true,
            serverSide  : true,
            ajax: "{{ route('umum.buku-masuk') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'masuk_berkas', name: 'masuk_berkas'},
                {data: 'masuk_pengirim', name: 'masuk_pengirim'},
                {data: 'masuk_tanggal', name: 'masuk_tanggal'},
                {data: 'masuk_nomor', name: 'masuk_nomor'},
                {data: 'masuk_perihal', name: 'masuk_perihal'},
                {data: 'masuk_petunjuk', name: 'masuk_petunjuk'},
                {data: 'masuk_paket', name: 'masuk_paket'},
                {data: 'foto', name: 'foto', orderable: false, searchable:false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [0,1,3,4,6,7],
                    className: 'text-center'
                },
                {
                    targets: [2,3,5],
                    className: 'text-left'
                }
            ],
            order: [ 3 , 'desc'],
        });

        $('.data-table').on('click','.edit_masuk',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_berkas = $(this).data('berkas');
            var edit_pengirim = $(this).data('pengirim');
            var edit_tanggal = $(this).data('tanggal');
            var edit_nomor = $(this).data('nomor');
            var edit_perihal = $(this).data('perihal');
            var edit_petunjuk = $(this).data('petunjuk');
            var edit_paket = $(this).data('paket');
            var edit_foto = $(this).data('foto');
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_berkas").value = edit_berkas;
            document.getElementById("edit_pengirim").value = edit_pengirim;
            document.getElementById("edit_tanggal").value = edit_tanggal;
            document.getElementById("edit_nomor").value = edit_nomor;
            document.getElementById("edit_perihal").value = edit_perihal;
            document.getElementById("edit_petunjuk").value = edit_petunjuk;
            document.getElementById("edit_paket").value = edit_paket;
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
            var url = "/buku-masuk/edit/" + uId;

            var formData = new FormData()
            if($('#edit_image').val() !== '') {
                formData.set('uImage', $('#edit_image')[0].files[0])
            }
            formData.set('deleteImage', $("#switchDelete").is(":checked"));
            formData.set('uBerkas', $('#edit_berkas').val());
            formData.set('uPengirim', $('#edit_pengirim').val());
            formData.set('uTanggal', $('#edit_tanggal').val());
            formData.set('uNomor', $('#edit_nomor').val());
            formData.set('uPerihal', $('#edit_perihal').val());
            formData.set('uPetunjuk', $('#edit_petunjuk').val());
            formData.set('uPaket', $('#edit_paket').val());
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
        });

        $('.data-table').on('click','.delete_masuk',function(e){
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
            $('.addMasuk').click(function(e){
                e.preventDefault();
                var url = $(this).data('url');
                var masuk_berkas = $('#masuk_berkas').val();
                var masuk_pengirim = $('#masuk_pengirim').val();
                var masuk_tanggal = $('#masuk_tanggal').val();
                var masuk_nomor = $('#masuk_nomor').val();
                var masuk_perihal = $('#masuk_perihal').val();
                var masuk_petunjuk = $('#masuk_petunjuk').val();
                var masuk_paket = $('#masuk_paket').val();

                var formData = new FormData()
                if($('#image').val() !== '') {
                    formData.append('image', $('#image')[0].files[0])
                }
                formData.append('masuk_berkas', masuk_berkas);
                formData.append('masuk_pengirim', masuk_pengirim);
                formData.append('masuk_tanggal', masuk_tanggal);
                formData.append('masuk_nomor', masuk_nomor);
                formData.append('masuk_perihal', masuk_perihal);
                formData.append('masuk_petunjuk', masuk_petunjuk);
                formData.append('masuk_paket', masuk_paket);

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

    });
</script>
@endpush