@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Kelembagaan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Kenaikan Pangkat Pegawai</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Buku Kenaikan Pangkat Pegawai</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Kenaikan Pangkat Pegawai</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Nama Pegawai</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama Pegawai">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">NIP Pegawai</label>
                                        <input type="text" id="nip" class="form-control" placeholder="NIP Pegawai">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Dari Pangkat</label>
                                        <input class="form-control" type="text" id="dari" placeholder="Dari">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">TMT(Dari Pangkat)</label>
                                        <input type="date" class="form-control" id="dari_tmt">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Ke Pangkat</label>
                                        <input class="form-control" type="text" id="ke" placeholder="Ke">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">TMT(Ke Pangkat)</label>
                                        <input type="date" class="form-control" id="ke_tmt">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Jabatan</label>
                                        <input class="form-control" type="text" id="jabatan" placeholder="Jabatan">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label class="form-label">TMT(Jabatan)</label>
                                        <input type="date" class="form-control" id="jabatan_tmt">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label class="form-label">Pendidikan</label>
                                        <input class="form-control" type="text" id="pendidikan" placeholder="Pendidikan">
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-kenaikan-pegawai.add') }}" class="btn btn-outline-primary addKP">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle">No.</th>
                                <th rowspan="2" style="vertical-align:middle">Nama / NIP</th>
                                <th colspan="2" style="text-align:center">Pangkat</th>
                                <th rowspan="2" style="vertical-align:middle">Jabatan T.M.T</th>
                                <th rowspan="2" style="vertical-align:middle">Pendidikan</th>
                                <th colspan="5" id="selectedYear" style="text-align:center"></th>
                                <th rowspan="2" style="vertical-align:middle">Aksi</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle">Dari<br>T.M.T</th>
                                <th style="vertical-align:middle">Ke<br>T.M.T</th>
                                <th style="vertical-align:middle">REG.</th>
                                <th style="vertical-align:middle">PIL.</th>
                                <th style="vertical-align:middle">PENY. IJAZAH</th>
                                <th style="vertical-align:middle">APR</th>
                                <th style="vertical-align:middle">OKT</th>
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
                        <label class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="edit_nama" placeholder="Nama Pegawai">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">NIP Pegawai</label>
                        <input type="text" id="edit_nip" class="form-control" placeholder="NIP Pegawai">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Dari Pangkat</label>
                        <input class="form-control" type="text" id="edit_dari" placeholder="Dari">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">TMT(Dari Pangkat)</label>
                        <input type="date" class="form-control" id="edit_dari_tmt">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Ke Pangkat</label>
                        <input class="form-control" type="text" id="edit_ke" placeholder="Ke">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">TMT(Ke Pangkat)</label>
                        <input type="date" class="form-control" id="edit_ke_tmt">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="form-label">Jabatan</label>
                        <input class="form-control" type="text" id="edit_jabatan" placeholder="Jabatan">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label">TMT(Jabatan)</label>
                        <input type="date" class="form-control" id="edit_jabatan_tmt">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-6">
                        <label class="form-label">Pendidikan</label>
                        <input class="form-control" type="text" id="edit_pendidikan" placeholder="Pendidikan">
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
        document.getElementById("selectedYear").textContent = new Date().getFullYear();
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
            ajax: "/load-kenaikan-pegawai/" + new Date().getFullYear(),
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_nip', name: 'nama_nip'},
                {data: 'dari', name: 'dari'},
                {data: 'ke', name: 'ke'},
                {data: 'jabatan', name: 'jabatan'},
                {data: 'kp_pendidikan', name: 'kp_pendidikan'},
                {data: 'reg', name: 'reg', orderable: false, searchable: false},
                {data: 'pil', name: 'pil', orderable: false, searchable: false},
                {data: 'ijazah', name: 'ijazah', orderable: false, searchable: false},
                {data: 'apr', name: 'apr', orderable: false, searchable: false},
                {data: 'okt', name: 'okt', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'kp_tanggal', name: 'kp_tanggal'},
            ],
            columnDefs: [
                {
                    targets: [0,2,3,4,5,6,7,8,9,10,11],
                    className: 'text-center align-middle'
                },
                {
                    targets: [1],
                    className: 'align-middle'
                },
                {
                    targets: [12],
                    visible: false
                }
            ],
            order: [ 12 , 'asc'],
        });
        $("div.toolbar").html(
            '<select id="input_year" onchange="getYear()" class="form-control custom-select">'+
                '<option selected value="{{ now()->year }}">Tahun {{ now()->year }}</option>'+
                '<option value="{{ now()->subYears(1)->year }}">Tahun {{ now()->subYears(1)->year }}</option>'+
                '<option value="{{ now()->subYears(2)->year }}">Tahun {{ now()->subYears(2)->year }}</option>'+
            '</select>'
        );
        $("div.download").html(
            '<div class="text-center">'+
                '<button type="button" class="btn btn-outline-danger rounded-pill py-2.5 my-1">Cetak / Simpan</button>'+
            '</div>'
        );

        $('.data-table').on('click','.edit_kp',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_nama = $(this).data('nama');
            var edit_nip = $(this).data('nip');
            var edit_dari = $(this).data('dari');
            var edit_dari_tmt = $(this).data('dari_tmt');
            var edit_ke = $(this).data('ke');
            var edit_ke_tmt = $(this).data('ke_tmt');
            var edit_jabatan = $(this).data('jabatan');
            var edit_jabatan_tmt = $(this).data('jabatan_tmt');
            var edit_pendidikan = $(this).data('pendidikan');
            
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_nama").value = edit_nama;
            document.getElementById("edit_nip").value = edit_nip;
            document.getElementById("edit_dari").value = edit_dari;
            document.getElementById("edit_dari_tmt").value = edit_dari_tmt;
            document.getElementById("edit_ke").value = edit_ke;
            document.getElementById("edit_ke_tmt").value = edit_ke_tmt;
            document.getElementById("edit_jabatan").value = edit_jabatan;
            document.getElementById("edit_jabatan_tmt").value = edit_jabatan_tmt;
            document.getElementById("edit_pendidikan").value = edit_pendidikan;
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-kenaikan-pegawai/edit/" + uId;
            var formData = new FormData()

            formData.set('id', uId);
            formData.set('uNama', $('#edit_nama').val());
            formData.set('uNip', $('#edit_nip').val());
            formData.set('uDari', $('#edit_dari').val());
            formData.set('uDari_tmt', $('#edit_dari_tmt').val());
            formData.set('uKe', $('#edit_ke').val());
            formData.set('uKe_tmt', $('#edit_ke_tmt').val());
            formData.set('uJabatan', $('#edit_jabatan').val());
            formData.set('uJabatan_tmt', $('#edit_jabatan_tmt').val());
            formData.set('uPendidikan', $('#edit_pendidikan').val());
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

        $('.data-table').on('click','.delete_kp',function(e){
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

        $('.data-table').on('click','.kt_add',function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var field = $(this).data('field');
            var year = $('#input_year').val();
            var formData = new FormData()

            formData.set('field', field);
            formData.set('year', year);
            formData.set('_method', 'PUT');
            console.log(url);
            console.log(field);
            console.log(year);
            Swal.fire({
                title: 'CHECK??',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                reverseButtons: true,
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:url,
                        data: formData,
                        method:'POST',
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data.success == 1){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Status Berhasil Diubah',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                                setTimeout(function(){
                                    y = $('#input_year').val();
                                    $('.data-table').DataTable().ajax.url("/load-kenaikan-pegawai/" + y).load();
                                }, 1000);
                            }
                        
                        }
                    });
                }
            })
        });

        $('.data-table').on('click','.kt_remove',function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var field = $(this).data('field');
            var year = $('#input_year').val();
            var formData = new FormData()

            formData.set('field', field);
            formData.set('year', year);
            formData.set('_method', 'PUT');
            console.log(url);
            Swal.fire({
                title: 'UNCHECK??',
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
                            'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:url,
                        data: formData,
                        method:'POST',
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success:function(data){
                            if(data.success == 1){
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Status Berhasil Diubah',
                                showConfirmButton: false,
                                timer: 1500,
                            });
                                setTimeout(function(){
                                    y = $('#input_year').val();
                                    $('.data-table').DataTable().ajax.url("/load-kenaikan-pegawai/" + y).load();
                                }, 1000);
                            }
                        
                        }
                    });
                }
            })
        });
        
        $(document).ready(function() {
            $('.addKP').click(function(e){
                e.preventDefault();
                var url = $(this).data('url');
                var formData = new FormData()

                formData.append('nama', $('#nama').val());
                formData.append('nip', $('#nip').val());
                formData.append('dari', $('#dari').val());
                formData.append('dari_tmt', $('#dari_tmt').val());
                formData.append('ke', $('#ke').val());
                formData.append('ke_tmt', $('#ke_tmt').val());
                formData.append('jabatan', $('#jabatan').val());
                formData.append('jabatan_tmt', $('#jabatan_tmt').val());
                formData.append('pendidikan', $('#pendidikan').val());

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

    function getYear(){
        y = $('#input_year').val();
        $('.data-table').DataTable().ajax.url("/load-kenaikan-pegawai/" + y).load();
        document.getElementById("selectedYear").textContent = y;
    }


</script>
@endpush