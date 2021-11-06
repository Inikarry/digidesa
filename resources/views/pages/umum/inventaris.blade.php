@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Umum</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buku Inventaris</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">KABUPATEN SOPPENG TAHUN ANGGARAN {{ now()->year }}<br>
                                           KECAMATAN DONRI-DONRI</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Daftar Inventaris</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="kode">Nomor Kode Barang</label>
                                    <input type="text" class="form-control" id="kode" placeholder="Kode Barang">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="register">Nomor Register</label>
                                    <input type="text" class="form-control" id="register" placeholder="Nomor Register">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama/Jenis Barang</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama/Jenis Barang">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="merek">Merek/Type</label>
                                    <input type="text" class="form-control" id="merek" placeholder="Merek/Type">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="sertifikat">No. Sertifikat/No.Pabrik/No.Mesin</label>
                                    <input type="text" class="form-control" id="sertifikat" placeholder="No.Sertifikat/No.Pabrik/No.Mesin">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="bahan">Bahan</label>
                                    <input type="text" class="form-control" id="bahan" placeholder="Bahan">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="asal_usul">Asal Usul</label>
                                    <input type="text" class="form-control" id="asal_usul" placeholder="Asal Usul">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="tahun_beli">Tahun Beli/Perolehan</label>
                                    <input type="number" max="2050" min="0" class="form-control" id="tahun_beli" placeholder="Tahun Beli/Perolehan" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="ukuran">Ukuran Barang/Konstruksi (P,SP,D)</label>
                                    <input type="text" class="form-control" id="ukuran" placeholder="Ukuran Barang/Konstruksi">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" id="satuan" placeholder="Satuan">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kondisi">Kondisi (B,RR,RB)</label>
                                    <input type="text" class="form-control" id="kondisi" placeholder="Kondisi">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="awal_jumlah">Jumlah Barang (1 Juli {{ now()->year }})</label>
                                    <input type="number" max="9999" min="0" class="form-control" id="awal_jumlah" placeholder="Jumlah Awal Barang" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="awal_harga">Jumlah Harga (1 Juli {{ now()->year }})</label>
                                    <input type="number" min="0" class="form-control" id="awal_harga" placeholder="Jumlah Awal Harga" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="akhir_jumlah">Jumlah Barang (31 Desember {{ now()->year }})</label>
                                    <input type="number" max="9999" min="0" class="form-control" id="akhir_jumlah" placeholder="Jumlah Akhir Barang" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="akhir_harga">Jumlah Harga (31 Desember {{ now()->year }})</label>
                                    <input type="number" min="0" class="form-control" id="akhir_harga" placeholder="Jumlah Akhir Harga" onkeyup=imposeMinMax(this)>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="kurang_jumlah">Jumlah Barang Berkurang</label>
                                    <input type="number" max="9999" min="0" class="form-control" id="kurang_jumlah" placeholder="Jumlah Barang berkurang" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="kurang_harga">Jumlah Harga Berkurang</label>
                                    <input type="number" min="0" class="form-control" id="kurang_harga" placeholder="Jumlah Harga Berkurang" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tambah_jumlah">Jumlah Barang Bertambah</label>
                                    <input type="number" max="9999" min="0" class="form-control" id="tambah_jumlah" placeholder="Jumlah Barang Bertambah" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tambah_harga">Jumlah Harga Bertambah</label>
                                    <input type="number" min="0" class="form-control" id="tambah_harga" placeholder="Jumlah Harga Bertambah" onkeyup=imposeMinMax(this)>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" placeholder="Keterangan Barang")>
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-inventaris.add') }}" class="btn btn-outline-primary addInventaris">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th style="vertical-align:middle">No. Urut</th>
                                <th style="vertical-align:middle">Kode Barang</th>
                                <th style="vertical-align:middle">Register</th>
                                <th style="vertical-align:middle">Nama / Jenis Barang</th>
                                <th style="vertical-align:middle">Bahan</th>
                                <th style="vertical-align:middle">Asal Usul</th>
                                <th style="vertical-align:middle">Tahun Beli / Perolehan</th>
                                <th style="vertical-align:middle">Kondisi (B,RR,RB)</th>
                                <th style="vertical-align:middle">Aksi</th>
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
<!-- Edit Modal -->
<div class="modal fade bd-example-modal-xl" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
                    <div class="form-group col-md-3">
                        <label for="edit_kode">Nomor Kode Barang</label>
                        <input type="text" class="form-control" id="edit_kode" placeholder="Kode Barang">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_register">Nomor Register</label>
                        <input type="text" class="form-control" id="edit_register" placeholder="Nomor Register">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_nama">Nama/Jenis Barang</label>
                        <input type="text" class="form-control" id="edit_nama" placeholder="Nama/Jenis Barang">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_merek">Merek/Type</label>
                        <input type="text" class="form-control" id="edit_merek" placeholder="Merek/Type">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="edit_sertifikat">No. Sertifikat/No.Pabrik/No.Mesin</label>
                        <input type="text" class="form-control" id="edit_sertifikat" placeholder="No.Sertifikat/No.Pabrik/No.Mesin">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_bahan">Bahan</label>
                        <input type="text" class="form-control" id="edit_bahan" placeholder="Bahan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_asal_usul">Asal Usul</label>
                        <input type="text" class="form-control" id="edit_asal_usul" placeholder="Asal Usul">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_tahun_beli">Tahun Beli/Perolehan</label>
                        <input type="number" max="2050" min="0" class="form-control" id="edit_tahun_beli" placeholder="Tahun Beli/Perolehan" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_ukuran">Ukuran Barang/Konstruksi (P,SP,D)</label>
                        <input type="text" class="form-control" id="edit_ukuran" placeholder="Ukuran Barang/Konstruksi">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_satuan">Satuan</label>
                        <input type="text" class="form-control" id="edit_satuan" placeholder="Satuan">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_kondisi">Kondisi (B,RR,RB)</label>
                        <input type="text" class="form-control" id="edit_kondisi" placeholder="Kondisi">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_awal_jumlah">Jumlah Barang (1 Juli {{ now()->year }})</label>
                        <input type="number" max="9999" min="0" class="form-control" id="edit_awal_jumlah" placeholder="Jumlah Awal Barang" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_awal_harga">Jumlah Harga (1 Juli {{ now()->year }})</label>
                        <input type="number" min="0" class="form-control" id="edit_awal_harga" placeholder="Jumlah Awal Harga" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_akhir_jumlah">Jumlah Barang (31 Desember {{ now()->year }})</label>
                        <input type="number" max="9999" min="0" class="form-control" id="edit_akhir_jumlah" placeholder="Jumlah Akhir Barang" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_akhir_harga">Jumlah Harga (31 Desember {{ now()->year }})</label>
                        <input type="number" min="0" class="form-control" id="edit_akhir_harga" placeholder="Jumlah Akhir Harga" onkeyup=imposeMinMax(this)>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_kurang_jumlah">Jumlah Barang Berkurang</label>
                        <input type="number" max="9999" min="0" class="form-control" id="edit_kurang_jumlah" placeholder="Jumlah Barang berkurang" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_kurang_harga">Jumlah Harga Berkurang</label>
                        <input type="number" min="0" class="form-control" id="edit_kurang_harga" placeholder="Jumlah Harga Berkurang" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_tambah_jumlah">Jumlah Barang Bertambah</label>
                        <input type="number" max="9999" min="0" class="form-control" id="edit_tambah_jumlah" placeholder="Jumlah Barang Bertambah" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_tambah_harga">Jumlah Harga Bertambah</label>
                        <input type="number" min="0" class="form-control" id="edit_tambah_harga" placeholder="Jumlah Harga Bertambah" onkeyup=imposeMinMax(this)>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="edit_keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" placeholder="Keterangan Barang")>
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
    function imposeMinMax(el){
        if(el.value != ""){
            if(parseInt(el.value) < parseInt(el.min)){
            el.value = el.min;
            }
            if(parseInt(el.value) > parseInt(el.max)){
            el.value = el.max;
            }
        }
    }
    $(function () {
        var table = $('.data-table').DataTable({
            initComplete: function (settings, json) {  
                $(".data-table").wrap("<div style='overflow:auto; width:100%;position:relative;'></div>");            
            },
            processing  : true,
            serverSide  : true,
            ajax: "{{ route('umum.buku-inventaris') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'inventaris_kode', name: 'inventaris_kode'},
                {data: 'inventaris_register', name: 'inventaris_register'},
                {data: 'inventaris_nama', name: 'inventaris_nama'},
                {data: 'inventaris_bahan', name: 'inventaris_bahan'},
                {data: 'inventaris_asal_usul', name: 'inventaris_asal_usul'},
                {data: 'inventaris_tahun_beli', name: 'inventaris_tahun_beli'},
                {data: 'inventaris_kondisi', name: 'inventaris_kondisi'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [ 1 , 'asc'],
        });

        $('.data-table').on('click','.edit_inventaris',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_kode = $(this).data('kode');
            var edit_register = $(this).data('register');
            var edit_nama = $(this).data('nama');
            var edit_merek = $(this).data('merek');
            var edit_sertifikat = $(this).data('sertifikat');
            var edit_bahan = $(this).data('bahan');
            var edit_asal_usul = $(this).data('asal_usul');
            var edit_tahun_beli = $(this).data('tahun_beli');
            var edit_ukuran = $(this).data('ukuran');
            var edit_satuan = $(this).data('satuan');
            var edit_kondisi = $(this).data('kondisi');
            var edit_awal_jumlah = $(this).data('awal_jumlah');
            var edit_awal_harga = $(this).data('awal_harga');
            var edit_kurang_jumlah = $(this).data('kurang_jumlah');
            var edit_kurang_harga = $(this).data('kurang_harga');
            var edit_tambah_jumlah = $(this).data('tambah_jumlah');
            var edit_tambah_harga = $(this).data('tambah_harga');
            var edit_akhir_jumlah = $(this).data('akhir_jumlah');
            var edit_akhir_harga = $(this).data('akhir_harga');
            var edit_keterangan = $(this).data('keterangan');
            
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_kode").value = edit_kode;
            document.getElementById("edit_register").value = edit_register;
            document.getElementById("edit_nama").value = edit_nama;
            document.getElementById("edit_merek").value = edit_merek;
            document.getElementById("edit_sertifikat").value = edit_sertifikat;
            document.getElementById("edit_bahan").value = edit_bahan;
            document.getElementById("edit_asal_usul").value = edit_asal_usul;
            document.getElementById("edit_tahun_beli").value = edit_tahun_beli;
            document.getElementById("edit_ukuran").value = edit_ukuran;
            document.getElementById("edit_satuan").value = edit_satuan;
            document.getElementById("edit_kondisi").value = edit_kondisi;
            document.getElementById("edit_awal_jumlah").value = edit_awal_jumlah;
            document.getElementById("edit_awal_harga").value = edit_awal_harga;
            document.getElementById("edit_kurang_jumlah").value = edit_kurang_jumlah;
            document.getElementById("edit_kurang_harga").value = edit_kurang_harga;
            document.getElementById("edit_tambah_jumlah").value = edit_tambah_jumlah;
            document.getElementById("edit_tambah_harga").value = edit_tambah_harga;
            document.getElementById("edit_akhir_jumlah").value = edit_akhir_jumlah;
            document.getElementById("edit_akhir_harga").value = edit_akhir_harga;
            document.getElementById("edit_keterangan").value = edit_keterangan;
        
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-inventaris/edit/" + uId;
            var formData = new FormData()

            formData.set('Ukode', $('#edit_kode').val());
            formData.set('Uregister', $('#edit_register').val());
            formData.set('Unama', $('#edit_nama').val());
            formData.set('Umerek', $('#edit_merek').val());
            formData.set('Usertifikat', $('#edit_sertifikat').val());
            formData.set('Ubahan', $('#edit_bahan').val());
            formData.set('Uasal_usul', $('#edit_asal_usul').val());
            formData.set('Utahun_beli', $('#edit_tahun_beli').val());
            formData.set('Uukuran', $('#edit_ukuran').val());
            formData.set('Usatuan', $('#edit_satuan').val());
            formData.set('Ukondisi', $('#edit_kondisi').val());
            formData.set('Uawal_jumlah', $('#edit_awal_jumlah').val());
            formData.set('Uawal_harga', $('#edit_awal_harga').val());
            formData.set('Ukurang_jumlah', $('#edit_kurang_jumlah').val());
            formData.set('Ukurang_harga', $('#edit_kurang_harga').val());
            formData.set('Utambah_jumlah', $('#edit_tambah_jumlah').val());
            formData.set('Utambah_harga', $('#edit_tambah_harga').val());
            formData.set('Uakhir_jumlah', $('#edit_akhir_jumlah').val());
            formData.set('Uakhir_harga', $('#edit_akhir_harga').val());
            formData.set('Uketerangan', $('#edit_keterangan').val());
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

        $('.data-table').on('click','.delete_inventaris',function(e){
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
            $('.addInventaris').click(function(e){
                e.preventDefault();
                var url = $(this).data('url');
                var formData = new FormData()

                formData.append('kode', $('#kode').val());
                formData.append('register', $('#register').val());
                formData.append('nama', $('#nama').val());
                formData.append('merek', $('#merek').val());
                formData.append('sertifikat', $('#sertifikat').val());
                formData.append('bahan', $('#bahan').val());
                formData.append('asal_usul', $('#asal_usul').val());
                formData.append('tahun_beli', $('#tahun_beli').val());
                formData.append('ukuran', $('#ukuran').val());
                formData.append('satuan', $('#satuan').val());
                formData.append('kondisi', $('#kondisi').val());
                formData.append('awal_jumlah', $('#awal_jumlah').val());
                formData.append('awal_harga', $('#awal_harga').val());
                formData.append('kurang_jumlah', $('#kurang_jumlah').val());
                formData.append('kurang_harga', $('#kurang_harga').val());
                formData.append('tambah_jumlah', $('#tambah_jumlah').val());
                formData.append('tambah_harga', $('#tambah_harga').val());
                formData.append('akhir_jumlah', $('#akhir_jumlah').val());
                formData.append('akhir_harga', $('#akhir_harga').val());
                formData.append('keterangan', $('#keterangan').val());

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