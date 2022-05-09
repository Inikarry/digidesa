@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar User</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar User</h5>
                    <input type="hidden" id="user_role" value="{{ Auth::user()->role }}">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form User</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="user_nama">Nama :</label>
                                        <input type="text" class="form-control" id="user_nama" placeholder="Nama">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="nip">NIP :</label>
                                        <input type="text" class="form-control" id="user_nip" placeholder="NIP">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-3 col-4">
                                        <label for="password">Password :</label>
                                        <input type="password" class="form-control" id="password_create" name="password" required autocomplete="off">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="password_confirmation">Confirm Password :</label>
                                        <input type="password" class="form-control" id="password_confirmation_create" name="password_confirmation" required autocomplete="off">
                                    </div>
                                </div>
                            </div>                                       
                            <div class="col">
                                <div class="row justify-content-center">
                                    <div class="mb-6 col-8">
                                        <label for="keterangan">Role :</label>
                                        <select class="custom-select form-control" id="user_role">
                                            <option value="" selected disabled>-- Pilih Role --</option>
                                            @if(Auth::user()->role == "Admin"){}
                                            <option value="Admin">Admin</option>
                                            @endif
                                            @foreach($data_desa as $data)
                                            <option value="{{$data->nama_desa}}">Desa {{$data->nama_desa}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>                                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('daftar-user.add') }}" class="btn btn-outline-primary addUser">Tambah</button>
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
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Role</th>
                                <th>Last Login</th>
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
                    <label for="edit_nama">Nama :</label>
                    <input type="text" class="form-control" id="edit_nama" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="edit_nip">NIP :</label>
                    <input type="text" class="form-control" id="edit_nip" placeholder="NIP">
                </div>
                <div class="form-group">
                    <label for="edit_password">Password :</label>
                    <input type="password" class="form-control" id="password_edit" name="edit_password" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="edit_password_confirmation">Confirm Password :</label>
                    <input type="password" class="form-control" id="password_confirmation_edit" name="edit_password_confirmation" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="edit_keterangan">Role :</label>
                    <select class="custom-select form-control" id="edit_role">
                        <option value="" selected disabled>-- Pilih Role --</option>
                        <option value="Admin">Admin</option>
                        @foreach($data_desa as $data)
                        <option value="{{$data->nama_desa}}">Desa {{$data->nama_desa}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <input type="hidden" id="edit_id">
            <input type="hidden" id="old_password">
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
            ajax: "{{ route('daftar-user') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, width: '5%'},
                {data: 'name', name: 'name', width: '20%'},
                {data: 'nip', name: 'nip', width: '20%'},
                {data: 'role', name: 'role', width: '20%'},
                {data: 'last_login', name: 'last_login', width: '15%'},
                {data: 'action', name: 'action', orderable: false, searchable: false, width: '20%'},
            ],
            columnDefs: [
                {
                    targets: [0,3,4,5],
                    className: 'text-center'
                },
                {
                    targets: [1,2],
                    className: 'text-left'
                }
            ],
            order: [ 4 , 'desc'],
        });

        $('.data-table').on('click','.edit_user',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_nama = $(this).data('nama');
            var edit_nip = $(this).data('nip');
            var edit_role = $(this).data('role');
            var old_password = $(this).data('password');
            var user_role = $('#user_role').val();
            console.log(edit_role);
            if(user_role == "Admin"){
                $('#editModal').modal('show');
                document.getElementById("edit_id").value = edit_id;
                document.getElementById("edit_nip").value = edit_nip;
                document.getElementById("edit_nama").value = edit_nama;
                document.getElementById("edit_role").value = edit_role;
                document.getElementById("old_password").value = old_password;
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Maaf',
                    text: 'Anda Bukan Admin!',
                })
            }
            
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var uNip = $('#edit_nip').val();
            var uNama = $('#edit_nama').val();
            var uRole = $('#edit_role').val();
            var oldPassword = $('#old_password').val();
            var uPassword = $('#password_edit').val();
            var uPasswordConfirmation = $('#password_confirmation_edit').val();
            var url = "/daftar-user/edit/" + uId;
            console.log(uRole);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                data:{  uId:uId,
                        nip:uNip, 
                        uNama:uNama, 
                        uRole:uRole, 
                        password:uPassword,
                        password_confirmation:uPasswordConfirmation,
                        oldPassword:oldPassword,
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

        $('.data-table').on('click','.delete_user',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var user_role = $('#user_role').val();
            console.log(url);
            if(user_role == "Admin"){
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
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Maaf',
                    text: 'Anda Bukan Admin!',
                })
            }
            
        });

    });

    $(document).ready(function() {
        $('.addUser').click(function(e){
            e.preventDefault();
            var url = $(this).data('url');
            var user_nama = $('#user_nama').val();
            var user_nip = $('#user_nip').val();
            var user_role = $('#user_role').val();
            var password = $('#password_create').val();
            var password_confirmation = $('#password_confirmation_create').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token-create"]').attr('content')
                }
            });
            $.ajax({
                url:url,
                data:{  user_nama:user_nama,
                        nip:user_nip, 
                        user_role:user_role, 
                        password:password, 
                        password_confirmation:password_confirmation,
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