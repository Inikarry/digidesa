<?php 
    $current_user = auth()->user();
?>
<div class="modal fade" id="editProfile{{$current_user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </buttn>
            </div>
            <div class="modal-body">
                    <meta name="csrf-token-editprofile" content="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="username">Nama :</label>
                        <input type="text" class="form-control" id="current_name" value="{{$current_user->name}}" name="name" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="name">NIP :</label>
                        <input type="text" class="form-control" id="current_nip" value="{{$current_user->nip}}" name="nip" required autofocus autocomplete="off">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary editprofile" data-url="{{ route('editProfile', $current_user->id) }}">Ubah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editPassword{{$current_user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </buttn>
            </div>
            <div class="modal-body">
                    <meta name="csrf-token-editpassword" content="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name">Current Password :</label>
                        <input type="password" class="form-control" id="password_before" name="password_before" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="name">New Password :</label>
                        <input type="password" class="form-control" id="password_new" name="password_new" required autofocus autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="name">Confirm Password :</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required autofocus autocomplete="off">
                    </div>
                    <input type="hidden" name="password_check" id="password_check" value="{{$current_user->password}}">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary editpassword" data-id="{{$current_user->id}}" data-url="{{ route('editPassword', $current_user->id) }}">Ubah</button>
            </div>
        </div>
    </div>
</div>
@push('addon-script')
<script type="text/javascript">
$(document).ready(function() {
    $('.editprofile').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var id = $(this).data('id');
        var name = $('#current_name').val();
        var nip = $('#current_nip').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-editprofile"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            data:{name:name, nip:nip, id:id},
            method:'PUT',
            success:function(data){
                console.log(data.nothing);
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
                }else if(data.nothing){
                    Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: data.nothing,
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }else {
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data User Berhasil Diubah!',
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }
            }
        });
    });
    $('.editpassword').click(function(e){
        e.preventDefault();
        var url = $(this).data('url');
        var id = $(this).data('id');
        var old_password = $('#password_check').val();
        var current_password = $('#password_before').val();
        var new_password = $('#password_new').val();
        var confirm_password = $('#password_confirm').val();
        console.log(old_password);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-editpassword"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            data:{id:id, current_password:current_password, new_password:new_password, confirm_password:confirm_password, old_password:old_password},
            method:'PUT',
            success:function(data){
                console.log(data.nothing);
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
                }else if(data.nothing){
                    Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian',
                    text: data.nothing,
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }else {
                    Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data User Berhasil Diubah!',
                });
                    setTimeout(function(){
                    location.reload();
                    }, 1000);
                }
            }
        });
    });
});
</script>
@endpush