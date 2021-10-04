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
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Surat Masuk</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="cuti_nama">Nama :</label>
                                        <input type="text" class="form-control" id="cuti_nama" placeholder="Nama">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="nip">NIP :</label>
                                        <input type="text" class="form-control" id="nip" placeholder="NIP">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="cuti_tanggal">Tanggal :</label>
                                        <input type="date" class="form-control" id="cuti_tanggal" placeholder="Tanggal">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="cuti_jenis">Jenis Cuti :</label>
                                        <input type="text" class="form-control" id="cuti_jenis" placeholder="Macam Cuti">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="cuti_mulai">Mulai :</label>
                                        <input type="date" class="form-control" id="cuti_mulai" placeholder="Tanggal Mulai Cuti">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="cuti_selesai">Selesai :</label>
                                        <input type="date" class="form-control" id="cuti_selesai" placeholder="Tanggal Selesai Cuti">
                                    </div>
                                </div>
                            </div>    
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-6 col-8">
                                        <label for="keterangan">Keterangan :</label>
                                        <input type="text" class="form-control" id="keterangan" placeholder="Keterangan Cuti">
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-cuti.add') }}" class="btn btn-outline-primary addCuti">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
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
                    <label for="edit_jenis"><b>Jenis Cuti :</b></label>
                    <input type="text" class="form-control" id="edit_jenis" placeholder="Macam Cuti">
                </div>
                <div class="form-group">
                    <label for="edit_tanggal"><b>Tanggal :</b></label>
                    <input type="date" class="form-control" id="edit_tanggal" placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <label for="edit_mulai"><b>Mulai :</b></label>
                    <input type="date" class="form-control" id="edit_mulai" placeholder="Tanggal Mulai Cuti">
                </div>
                <div class="form-group">
                    <label for="edit_selesai"><b>Selesai :</b></label>
                    <input type="date" class="form-control" id="edit_selesai" placeholder="Tanggal Selesai Cuti">
                </div>
                <div class="form-group">
                    <label for="edit_keterangan"><b>Keterangan :</b></label>
                    <input type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan Cuti">
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
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '2%'},
                {data: 'cuti_tanggal', name: 'cuti_tanggal', width: '4%'},
                {data: 'cuti_nama', name: 'cuti_nama', width: '21%'},
                {data: 'nip', name: 'nip', width: '2%'},
                {data: 'cuti_mulai', name: 'cuti_mulai', width: '4%'},
                {data: 'cuti_selesai', name: 'cuti_selesai', width: '4%'},
                {data: 'cuti_jenis', name: 'cuti_jenis', width: '10%'},
                {data: 'keterangan', name: 'keterangan',  orderable: false, width: '20%'},
                {data: 'action', name: 'action', orderable: false, searchable: false, width: '15%'},
            ],
            columnDefs: [
                {
                    targets: [0,1,4,5,,7,8],
                    className: 'text-center'
                },
                {
                    targets: [2,3,6],
                    className: 'text-left'
                }
            ],
            order: [ 1 , 'desc'],
        });

        $('.data-table').on('click','.edit_cuti',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_jenis = $(this).data('jenis');
            var edit_tanggal = $(this).data('tanggal');
            var edit_mulai = $(this).data('mulai');
            var edit_selesai = $(this).data('selesai');
            var edit_keterangan = $(this).data('keterangan');
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_jenis").value = edit_jenis;
            document.getElementById("edit_tanggal").value = edit_tanggal;
            document.getElementById("edit_mulai").value = edit_mulai;
            document.getElementById("edit_selesai").value = edit_selesai;
            document.getElementById("edit_keterangan").value = edit_keterangan;
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var uTanggal = $('#edit_tanggal').val();
            var uMulai = $('#edit_mulai').val();
            var uSelesai = $('#edit_selesai').val();
            var uJenis = $('#edit_jenis').val();
            var uKeterangan = $('#edit_keterangan').val();
            var url = "/buku-cuti/edit/" + uId;
            console.log(uId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                data:{  uJenis:uJenis,
                        uTanggal:uTanggal, 
                        uMulai:uMulai, 
                        uSelesai:uSelesai, 
                        uKeterangan:uKeterangan,
                    },
                method:'PUT',
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
                        title: 'Data Berhasil Diubah',
                        showConfirmButton: false,
                    });
                        setTimeout(function(){
                        location.reload();
                        }, 2000);
                    }
                }
            });
        })

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