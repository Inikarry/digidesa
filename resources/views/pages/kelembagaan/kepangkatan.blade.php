@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Daftar Urut Kepangkatan</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">DAFTAR URUT KEPANGKATAN (DUK) PEGAWAI NEGERI SIPIL<br>
                                           Pemerintah Kabupaten Soppeng Tahun {{ now()->year }}
                    </h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="create()" class="custom-control-input" id="switchCreate">
                        <label class="custom-control-label" for="switchCreate">Tambah Data</label>
                    </div>
                    <!-- Form Tambah  -->
                    <div class="card-body" id="createForm">
                        <form>
                            <h5 class="text-center">Form Daftar Urut Kepangkatan</h5>
                            <meta name="csrf-token-create" content="{{ csrf_token() }}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" placeholder="Nama Pegawai">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="nip">NIP</label>
                                    <input type="text" class="form-control" id="nip" placeholder="NIP">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="karpeg">KARPEG</label>
                                    <input type="text" class="form-control" id="karpeg" placeholder="KARPEG">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="pangkat_gol">GOL Pangkat:</label>
                                    <input type="text" class="form-control" id="pangkat_gol" placeholder="GOL Pangkat">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pangkat_tnt">TMT Pangkat:</label>
                                    <input type="date" class="form-control" id="pangkat_tnt" placeholder="TNT Pangkat">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="jabatan_nama">Nama Jabatan</label>
                                    <select id="jabatan_nama" class="form-control">
                                        <option value="" disabled>--Nama Jabatan--</option>
                                        @foreach($data_jabatan as $data)
                                        <option value="{{$data->id}}">{{$data->jabatan_nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="jabatan_tnt">TMT Jabatan</label>
                                    <input type="date" class="form-control" id="jabatan_tnt" placeholder="TNT Jabatan">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="jabatan_eselon">Eselon Jabatan</label>
                                    <input type="text" class="form-control" id="jabatan_eselon" placeholder="Jabatan Eselon">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="masa_kerja_tahun">Masa Kerja (Tahun)</label>
                                    <input type="number" class="form-control" min="0" id="masa_kerja_tahun" placeholder="Tahun" onkeyup=imposeMinMax(this)>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="masa_kerja_bulan">Masa Kerja (Bulan)</label>
                                    <input type="number" max="12" min="0" class="form-control" id="masa_kerja_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="diklat_jabatan_nama">Nama Diklat Jabatan</label>
                                    <input type="text" class="form-control" id="diklat_jabatan_nama" placeholder="Nama">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="diklat_jabatan_bulan">Bulan Diklat Jabatan</label>
                                    <input type="number" max="12" min="0" class="form-control" id="diklat_jabatan_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="diklat_jabatan_tahun">Tahun Diklat Jabatan</label>
                                    <input type="number" max="99" min="0" class="form-control" id="diklat_jabatan_tahun" onkeyup=imposeMinMax(this) placeholder="Tahun">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="diklat_jabatan_jam">Jumlah Jam Diklat Jabatan</label>
                                    <input type="number" min="0" class="form-control" id="diklat_jabatan_jam" onkeyup=imposeMinMax(this) placeholder="Jumlah Jam">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pendidikan_nama">Nama Jurusan Pendidikan</label>
                                    <input type="text" class="form-control" id="pendidikan_nama" placeholder="Nama Jurusan">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pendidikan_lulus">Tahun Lulus Pendidikan</label>
                                    <input type="number" max="9999" min="0" class="form-control" id="pendidikan_lulus" onkeyup=imposeMinMax(this) placeholder="Tahun Lulus">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pendidikan_ijazah">Tingkat Ijazah Pendidikan</label>
                                    <input type="text" class="form-control" id="pendidikan_ijazah" placeholder="Tingkat Ijazah">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="usia_tahun">Usia Per Bulan Des (Tahun)</label>
                                    <input type="number" max="99" min="0" class="form-control" id="usia_tahun" onkeyup=imposeMinMax(this) placeholder="Tahun">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="usia_bulan">Usia Per Bulan Des (Bulan)</label>
                                    <input type="number" max="12" min="0" class="form-control" id="usia_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" placeholder="keterangan">
                                </div>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" data-url="{{ route('buku-pangkat.add') }}" class="btn btn-outline-primary addPangkat">Tambah</button>
                            </div>                                                
                        </form>
                    </div>
                    <!-- end of form tambah -->
                    <table class="table table-bordered data-table" style="width:100%">
                    <meta name="csrf-token-delete" content="{{ csrf_token() }}">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle" style="text-align:center">No</th>
                                <th rowspan="2" style="vertical-align:middle" style="text-align:center">Nama Pegawai; Tempat / Tanggal Lahir</th>
                                <th rowspan="2" style="vertical-align:middle" style="text-align:center">NIP; Karpeg</th>
                                <th colspan="2" style="text-align:center" style="text-align:center">Pangkat</th>
                                <th colspan="3" style="text-align:center" style="text-align:center">Jabatan</th>
                                <th rowspan="2" style="vertical-align:middle" style="text-align:center">Masa Kerja (THN/BLN)</th>
                                <th rowspan="2" style="vertical-align:middle" style="text-align:center">Aksi</th>
                            </tr>
                            <tr>
                                <th style="text-align:center">GOL</th>
                                <th style="text-align:center">TMT</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">TMT</th>
                                <th style="text-align:center">Eselon</th>
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
                <div class="form-row">
                <meta name="csrf-token-edit" content="{{ csrf_token() }}">
                    <div class="form-group col-md-6">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" placeholder="Nama Pegawai">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_tempat_lahir">Tempat Lahir</label>
                        <input type="text" class="form-control" id="edit_tempat_lahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tanggal_lahir" placeholder="Tanggal Lahir">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="edit_nip">NIP</label>
                        <input type="text" class="form-control" id="edit_nip" placeholder="NIP">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_karpeg">KARPEG</label>
                        <input type="text" class="form-control" id="edit_karpeg" placeholder="KARPEG">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_pangkat_gol">GOL Pangkat:</label>
                        <input type="text" class="form-control" id="edit_pangkat_gol" placeholder="GOL Pangkat">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_pangkat_tnt">TMT Pangkat:</label>
                        <input type="date" class="form-control" id="edit_pangkat_tnt" placeholder="TNT Pangkat">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_jabatan_nama">Nama Jabatan</label>
                        <select id="edit_jabatan_nama" class="form-control">
                            <option value="" disabled>--Nama Jabatan--</option>
                            @foreach($data_jabatan as $data)
                            <option value="{{$data->id}}">{{$data->jabatan_nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_jabatan_tnt">TMT Jabatan</label>
                        <input type="date" class="form-control" id="edit_jabatan_tnt" placeholder="TNT Jabatan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_jabatan_eselon">Eselon Jabatan</label>
                        <input type="text" class="form-control" id="edit_jabatan_eselon" placeholder="Jabatan Eselon">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_masa_kerja_tahun">Masa Kerja (Tahun)</label>
                        <input type="number" class="form-control" min="0" id="edit_masa_kerja_tahun" placeholder="Tahun" onkeyup=imposeMinMax(this)>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_masa_kerja_bulan">Masa Kerja (Bulan)</label>
                        <input type="number" max="12" min="0" class="form-control" id="edit_masa_kerja_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="edit_diklat_jabatan_nama">Nama Diklat Jabatan</label>
                        <input type="text" class="form-control" id="edit_diklat_jabatan_nama" placeholder="Nama">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_diklat_jabatan_bulan">Bulan Diklat Jabatan</label>
                        <input type="number" max="12" min="0" class="form-control" id="edit_diklat_jabatan_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edit_diklat_jabatan_tahun">Tahun Diklat Jabatan</label>
                        <input type="number" max="99" min="0" class="form-control" id="edit_diklat_jabatan_tahun" onkeyup=imposeMinMax(this) placeholder="Tahun">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="edit_diklat_jabatan_jam">Jumlah Jam Diklat Jabatan</label>
                        <input type="number" min="0" class="form-control" id="edit_diklat_jabatan_jam" onkeyup=imposeMinMax(this) placeholder="Jumlah Jam">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edit_pendidikan_nama">Nama Jurusan Pendidikan</label>
                        <input type="text" class="form-control" id="edit_pendidikan_nama" placeholder="Nama Jurusan">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_pendidikan_lulus">Tahun Lulus Pendidikan</label>
                        <input type="number" max="9999" min="0" class="form-control" id="edit_pendidikan_lulus" onkeyup=imposeMinMax(this) placeholder="Tahun Lulus">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_pendidikan_ijazah">Tingkat Ijazah Pendidikan</label>
                        <input type="text" class="form-control" id="edit_pendidikan_ijazah" placeholder="Tingkat Ijazah">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="edit_usia_tahun">Usia Per Bulan Des (Tahun)</label>
                        <input type="number" max="99" min="0" class="form-control" id="edit_usia_tahun" onkeyup=imposeMinMax(this) placeholder="Tahun">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edit_usia_bulan">Usia Per Bulan Des (Bulan)</label>
                        <input type="number" max="12" min="0" class="form-control" id="edit_usia_bulan" onkeyup=imposeMinMax(this) placeholder="Bulan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edit_keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="edit_keterangan" placeholder="keterangan">
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
            ajax: "{{ route('kelembagaan.buku-pangkat') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'nama_ttl', name: 'nama_ttl'},
                {data: 'nip_karpeg', name: 'nip_karpeg'},
                {data: 'pangkat_gol', name: 'pangkat_gol'},
                {data: 'pangkat_tmt', name: 'pangkat_tmt'},
                {data: 'nama_jabatan', name: 'nama_jabatan'},
                {data: 'jabatan_tmt', name: 'jabatan_tmt'},
                {data: 'jabatan_eselon', name: 'jabatan_eselon'},
                {data: 'thn_bln', name: 'thn_bln'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {data: 'jabatan_id', name: 'jabatan_id'},
            ],
            columnDefs: [
                {
                    targets: [10],
                    visible: false
                }
            ],
            order: [ 10 , 'asc'],
        });

        $('.data-table').on('click','.edit_pangkat',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_nama = $(this).data('nama');
            var edit_tempat_lahir = $(this).data('tempat_lahir');
            var edit_tanggal_lahir = $(this).data('tanggal_lahir');
            var edit_nip = $(this).data('nip');
            var edit_karpeg = $(this).data('karpeg');
            var edit_pangkat_gol = $(this).data('pangkat_gol');
            var edit_pangkat_tnt = $(this).data('pangkat_tnt');
            var edit_jabatan_nama = $(this).data('jabatan_nama');
            var edit_jabatan_tnt = $(this).data('jabatan_tnt');
            var edit_jabatan_eselon = $(this).data('jabatan_eselon');
            var edit_masa_kerja_tahun = $(this).data('masa_kerja_tahun');
            var edit_masa_kerja_bulan = $(this).data('masa_kerja_bulan');
            var edit_diklat_nama = $(this).data('diklat_nama');
            var edit_diklat_bulan = $(this).data('diklat_bulan');
            var edit_diklat_tahun = $(this).data('diklat_tahun');
            var edit_diklat_jam = $(this).data('diklat_jam');
            var edit_pendidikan_nama = $(this).data('pendidikan_nama');
            var edit_pendidikan_lulus = $(this).data('pendidikan_lulus');
            var edit_pendidikan_tingkat = $(this).data('pendidikan_tingkat');
            var edit_usia_tahun = $(this).data('usia_tahun');
            var edit_usia_bulan = $(this).data('usia_bulan');
            var edit_keterangan = $(this).data('keterangan');
            
            console.log(edit_diklat_bulan);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_nama").value = edit_nama;
            document.getElementById("edit_tempat_lahir").value = edit_tempat_lahir;
            document.getElementById("edit_tanggal_lahir").value = edit_tanggal_lahir;
            document.getElementById("edit_nip").value = edit_nip;
            document.getElementById("edit_karpeg").value = edit_karpeg;
            document.getElementById("edit_pangkat_gol").value = edit_pangkat_gol;
            document.getElementById("edit_pangkat_tnt").value = edit_pangkat_tnt;
            document.getElementById("edit_jabatan_nama").value = edit_jabatan_nama;
            document.getElementById("edit_jabatan_tnt").value = edit_jabatan_tnt;
            document.getElementById("edit_jabatan_eselon").value = edit_jabatan_eselon;
            document.getElementById("edit_masa_kerja_tahun").value = edit_masa_kerja_tahun;
            document.getElementById("edit_masa_kerja_bulan").value = edit_masa_kerja_bulan;
            document.getElementById("edit_diklat_jabatan_nama").value = edit_diklat_nama;
            document.getElementById("edit_diklat_jabatan_bulan").value = edit_diklat_bulan;
            document.getElementById("edit_diklat_jabatan_tahun").value = edit_diklat_tahun;
            document.getElementById("edit_diklat_jabatan_jam").value = edit_diklat_jam;
            document.getElementById("edit_pendidikan_nama").value = edit_pendidikan_nama;
            document.getElementById("edit_pendidikan_lulus").value = edit_pendidikan_lulus;
            document.getElementById("edit_pendidikan_ijazah").value = edit_pendidikan_tingkat;
            document.getElementById("edit_usia_tahun").value = edit_usia_tahun;
            document.getElementById("edit_usia_bulan").value = edit_usia_bulan;
            document.getElementById("edit_keterangan").value = edit_keterangan;
        
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-pangkat/edit/" + uId;
            var formData = new FormData()

            formData.set('id', uId);
            formData.set('Unama', $('#edit_nama').val());
            formData.set('Utempat_lahir', $('#edit_tempat_lahir').val());
            formData.set('Utanggal_lahir', $('#edit_tanggal_lahir').val());
            formData.set('Unip', $('#edit_nip').val());
            formData.set('Ukarpeg', $('#edit_karpeg').val());
            formData.set('Upangkat_gol', $('#edit_pangkat_gol').val());
            formData.set('Upangkat_tnt', $('#edit_pangkat_tnt').val());
            formData.set('Ujabatan_nama', $('#edit_jabatan_nama').val());
            formData.set('Ujabatan_tnt', $('#edit_jabatan_tnt').val());
            formData.set('Ujabatan_eselon', $('#edit_jabatan_eselon').val());
            formData.set('Umasa_kerja_tahun', $('#edit_masa_kerja_tahun').val());
            formData.set('Umasa_kerja_bulan', $('#edit_masa_kerja_bulan').val());
            formData.set('Udiklat_jabatan_nama', $('#edit_diklat_jabatan_nama').val());
            formData.set('Udiklat_jabatan_bulan', $('#edit_diklat_jabatan_bulan').val());
            formData.set('Udiklat_jabatan_tahun', $('#edit_diklat_jabatan_tahun').val());
            formData.set('Udiklat_jabatan_jam', $('#edit_diklat_jabatan_jam').val());
            formData.set('Upendidikan_nama', $('#edit_pendidikan_nama').val());
            formData.set('Upendidikan_lulus', $('#edit_pendidikan_lulus').val());
            formData.set('Upendidikan_ijazah', $('#edit_pendidikan_ijazah').val());
            formData.set('Uusia_tahun', $('#edit_usia_tahun').val());
            formData.set('Uusia_bulan', $('#edit_usia_bulan').val());
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

        $('.data-table').on('click','.delete_pangkat',function(e){
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
            $('.addPangkat').click(function(e){
                e.preventDefault();
                var url = $(this).data('url');
                var formData = new FormData()

                formData.append('nama', $('#nama').val());
                formData.append('tempat_lahir', $('#tempat_lahir').val());
                formData.append('tanggal_lahir', $('#tanggal_lahir').val());
                formData.append('nip', $('#nip').val());
                formData.append('karpeg', $('#karpeg').val());
                formData.append('pangkat_gol', $('#pangkat_gol').val());
                formData.append('pangkat_tnt', $('#pangkat_tnt').val());
                formData.append('jabatan_nama', $('#jabatan_nama').val());
                formData.append('jabatan_tnt', $('#jabatan_tnt').val());
                formData.append('jabatan_eselon', $('#jabatan_eselon').val());
                formData.append('masa_kerja_tahun', $('#masa_kerja_tahun').val());
                formData.append('masa_kerja_bulan', $('#masa_kerja_bulan').val());
                formData.append('diklat_jabatan_nama', $('#diklat_jabatan_nama').val());
                formData.append('diklat_jabatan_bulan', $('#diklat_jabatan_bulan').val());
                formData.append('diklat_jabatan_tahun', $('#diklat_jabatan_tahun').val());
                formData.append('diklat_jabatan_jam', $('#diklat_jabatan_jam').val());
                formData.append('pendidikan_nama', $('#pendidikan_nama').val());
                formData.append('pendidikan_lulus', $('#pendidikan_lulus').val());
                formData.append('pendidikan_ijazah', $('#pendidikan_ijazah').val());
                formData.append('usia_tahun', $('#usia_tahun').val());
                formData.append('usia_bulan', $('#usia_bulan').val());
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