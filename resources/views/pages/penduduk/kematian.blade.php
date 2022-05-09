@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Pencatatan Kematian</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Pencatatan Kematian Bulan <b id="selectedMonth"></b></h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Pencatatan Kematian</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nama Lengkap :</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">NIK :</label>
                                        <input type="text" id="nik" class="form-control" placeholder="NIK">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tempat Lahir :</label>
                                        <input class="form-control" type="text" id="tempat_lahir" placeholder="Tempat Lahir">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tanggal Lahir :</label>
                                        <input type="date" class="form-control" id="tanggal_lahir">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">No. Ket. Kematian :</label>
                                        <input class="form-control" type="text" id="no_ket_meninggal" placeholder="No. Buku Nikah">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Tanggal Meninggal :</label>
                                        <input type="date" class="form-control" id="tanggal_meninggal">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="form-label">Nama Desa :</label>
                                        <select class="custom-select form-control" id="desa">
                                            <option value="" selected disabled>-- Pilih Desa --</option>
                                            @foreach($data_desa as $data)
                                            <option value="{{$data->id}}">Desa {{$data->nama_desa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-kematian.add') }}" class="btn btn-outline-primary addKematian">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Nama Desa</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Meninggal</th>
                                <th>No. Ket. Kematian</th>
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
                        <label class="form-label">Nama Lengkap :</label>
                        <input type="text" class="form-control" id="edit_nama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">NIK :</label>
                        <input type="text" id="edit_nik" class="form-control" placeholder="NIK">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Tempat Lahir :</label>
                        <input class="form-control" type="text" id="edit_tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Tanggal Lahir :</label>
                        <input type="date" class="form-control" id="edit_tanggal_lahir">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">No. Buku Nikah :</label>
                        <input class="form-control" type="text" id="edit_no_ket_meninggal" placeholder="No. Ket. Kematian">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">Tanggal Meninggal :</label>
                        <input type="date" class="form-control" id="edit_tanggal_meninggal">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label for="form-label">Nama Desa :</label>
                        <select class="custom-select form-control" id="edit_desa">
                            <option value="" selected disabled>-- Pilih Desa --</option>
                            @foreach($data_desa as $data)
                            <option value="{{$data->id}}">Desa {{$data->nama_desa}}</option>
                            @endforeach
                        </select>
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
        document.getElementById("selectedMonth").innerHTML = new Date().toLocaleString('default', { month: 'long' });
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
            dom : "<'row'<'col-sm-2'l><'col-sm-2 download'><'col-sm-6'f><'col-sm-2 toolbar'>>" +
                  "<'row'<'col-sm-12'tr>>" +
                  "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            processing  : true,
            serverSide  : true,
            ajax: "/load-kematian/" + new Date().getMonth(),
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'kematian_nik', name: 'kematian_nik'},
                {data: 'kematian_nama', name: 'kematian_nama'},
                {data: 'nama_desa', name: 'nama_desa'},
                {data: 'kematian_tempat_lahir', name: 'kematian_tempat_lahir'},
                {data: 'kematian_tanggal_lahir', name: 'kematian_tanggal_lahir'},
                {data: 'kematian_tanggal_meninggal', name: 'kematian_tanggal_meninggal'},
                {data: 'kematian_ket_kematian', name: 'kematian_ket_kematian'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: [0,2,3,4,5,6,7,8],
                    className: 'text-center align-middle'
                },
                {
                    targets: [1],
                    className: 'align-middle'
                },
            ],
            order: [ 3 , 'asc'],
        });
        $("div.toolbar").html(
            '<select id="input_month" onchange="getMonth()" class="form-control custom-select">'+
                '<option selected value="{{ now()->month - 1 }}">Bulan {{ now()->formatLocalized('%B')}}</option>'+
                '<option value="{{ now()->subMonths(1)->month - 1 }}">Bulan {{ now()->subMonths(1)->formatLocalized('%B') }}</option>'+
                '<option value="{{ now()->subMonths(2)->month - 1 }}">Bulan {{ now()->subMonths(2)->formatLocalized('%B') }}</option>'+
            '</select>'
        );
        $("div.download").html(
            '<div class="text-center">'+
                '<button type="button" class="btn btn-outline-danger rounded-pill py-2.5 my-1">Cetak / Simpan</button>'+
            '</div>'
        );

        $('.data-table').on('click','.edit_kematian',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_nama = $(this).data('nama');
            var edit_nik = $(this).data('nik');
            var edit_desa = $(this).data('id_desa');
            var edit_tempat_lahir = $(this).data('tempat_lahir');
            var edit_tanggal_lahir = $(this).data('tanggal_lahir');
            var edit_tanggal_meninggal = $(this).data('tanggal_meninggal');
            var edit_ket_kematian = $(this).data('ket_kematian');
            
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_nama").value = edit_nama;
            document.getElementById("edit_nik").value = edit_nik;
            document.getElementById("edit_desa").value = edit_desa;
            document.getElementById("edit_tempat_lahir").value = edit_tempat_lahir;
            document.getElementById("edit_tanggal_lahir").value = edit_tanggal_lahir;
            document.getElementById("edit_tanggal_meninggal").value = edit_tanggal_meninggal;
            document.getElementById("edit_no_ket_meninggal").value = edit_ket_kematian;
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-kematian/edit/" + uId;
            var formData = new FormData()

            formData.set('id', uId);
            formData.set('uNama', $('#edit_nama').val());
            formData.set('uNik', $('#edit_nik').val());
            formData.set('uDesa', $('#edit_desa').val());
            formData.set('uTanggal_lahir', $('#edit_tanggal_lahir').val());
            formData.set('uTempat_lahir', $('#edit_tempat_lahir').val());
            formData.set('uTanggal_meninggal', $('#edit_tanggal_meninggal').val());
            formData.set('uKet_kematian', $('#edit_no_ket_meninggal').val());
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

        $('.data-table').on('click','.delete_kematian',function(e){
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
                confirmButtonText: 'Yes',
                reverseButtons: true,
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
            $('.addKematian').click(function(e){
                e.preventDefault();
                var url = $(this).data('url');
                var formData = new FormData()

                formData.append('nama', $('#nama').val());
                formData.append('nik', $('#nik').val());
                formData.append('tempat_lahir', $('#tempat_lahir').val());
                formData.append('tanggal_lahir', $('#tanggal_lahir').val());
                formData.append('no_ket_kematian', $('#no_ket_meninggal').val());
                formData.append('tanggal_meninggal', $('#tanggal_meninggal').val());
                formData.append('desa', $('#desa').val());

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

    function getMonth(){
        months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        y = $('#input_month').val();
        $('.data-table').DataTable().ajax.url("/load-kematian/" + y).load();
        document.getElementById("selectedMonth").innerHTML = months[y];
    }
</script>
@endpush