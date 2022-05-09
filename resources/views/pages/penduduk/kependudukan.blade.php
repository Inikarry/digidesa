@extends('layouts.master')
@section('content')
<div class="page-info container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Penduduk</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Kependudukan</li>
        </ol>
    </nav>
</div>
<div class="main-wrapper container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Laporan Kependudukan Kecamatan Donri-Donri</h5>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" onchange="detail()" class="custom-control-input" id="switchDetail">
                        <label class="custom-control-label" for="switchDetail">Detail Data</label>
                    </div>
                    <!-- Detail Data  -->
                    <div class="card-body" id="detailData">
                    <h5 class="card-title" id="month_title"></h5>
                        <dl class="row">
                            <dt class="col-sm-3">Jumlah Penduduk Awal Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="a1">{{number_format($datas->awall,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="a2">{{number_format($datas->awalp,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="a3">{{number_format($datas->awall+$datas->awalp,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah Penduduk Lahir Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="l1">{{number_format($datas->lahirl,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="l2">{{number_format($datas->lahirp,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="l3">{{number_format($datas->lahirl+$datas->lahirp,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah Penduduk Mati Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="m1">{{number_format($datas->matil,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="m2">{{number_format($datas->matip,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="m3">{{number_format($datas->matil+$datas->matip,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah Penduduk Datang Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="d1">{{number_format($datas->datangl,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="d2">{{number_format($datas->datangp,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="d3">{{number_format($datas->datangl+$datas->datangl,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah Penduduk Pindah Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="p1">{{number_format($datas->pindahl,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="p2">{{number_format($datas->pindahp,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="p3">{{number_format($datas->datangl+$datas->datangp,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah Penduduk Akhir Bulan Ini</dt>
                            <dd class="col-sm-9">
                                <p>: <b id="j1">{{number_format($datas->awall+$datas->lahirl-$datas->matil+$datas->datangl-$datas->pindahl,0,",",".")}}</b> (Laki-laki)</p>
                                <p>: <b id="j2">{{number_format($datas->awalp+$datas->lahirp-$datas->matip+$datas->datangp-$datas->pindahp,0,",",".")}}</b> (Perempuan)</p>
                                <p>: <b id="j3">{{number_format($datas->awall+$datas->lahirl-$datas->matil+$datas->datangl-$datas->pindahl+$datas->awalp+$datas->lahirp-$datas->matip+$datas->datangp-$datas->pindahp,0,",",".")}}</b> (Laki-laki & Perempuan)</p>
                            </dd>

                            <dt class="col-sm-3">Jumlah KK</dt>
                            <dd class="col-sm-9">: <b id="kk1">{{number_format($datas->jumlah_kk,0,",",".")}}</b></dd>
                        </dl>
                    </div>
                    <!-- end of Detail Data -->
                    <table class="table table-bordered data-table" style="width:100%">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align:middle;text-align: center;">Desa</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Penduduk Awal Bulan</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Lahir Bulan ini</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Mati Bulan ini</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Datang Bulan ini</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Pindah Bulan ini</th>
                                <th colspan="3" style="vertical-align:middle;text-align: center;">Jumlah Akhir Bulan</th>
                                <th rowspan="2" style="vertical-align:middle">KK</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
                                <th style="vertical-align:middle">L</th>
                                <th style="vertical-align:middle">P</th>
                                <th style="vertical-align:middle">L+P</th>
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <meta name="csrf-token-edit" content="{{ csrf_token() }}"
                <h5 class="modal-title" id="exampleModalCenterTitle">Ubah Data &nbsp;<b id="edit_desa"></b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-row justify-content-center">
                    <div class="form-group col-md-10">
                        <label for="edit_value" id="edit_label"></label>
                        <input class="form-control" type="text" name="nomor" id="edit_value">
                    </div>
                </div>
                <input type="hidden" id="edit_id">
                <input type="hidden" id="edit_field">
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
        document.getElementById("month_title").innerHTML = "Bulan " + new Date().toLocaleString('default', { month: 'long' });
        var d = document.getElementById("detailData");
        d.style.display = "none";
    }
    initialize();
    $(function() { 
        $("input[name='nomor']").on('input', function(e) { 
            $(this).val($(this).val().replace(/[^0-9 & -]/g, '')); 
        }); 
    });
    function detail(){
        event.preventDefault();
        var d = document.getElementById("detailData");
        if(document.getElementById("switchDetail").checked){
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
            ajax: "/load-penduduk/" + new Date().getMonth(),
            columns: [
                {data: 'nama_desa', name: 'nama_desa'},
                {data: 'awall', name: 'awall', searchable: false},
                {data: 'awalp', name: 'awalp', searchable: false},
                {data: 'awallp', name: 'awallp', searchable: false, orderable: false},
                {data: 'lahirl', name: 'lahirl', searchable: false},
                {data: 'lahirp', name: 'lahirp', searchable: false},
                {data: 'lahirlp', name: 'lahirlp', searchable: false, orderable: false},
                {data: 'matil', name: 'matil', searchable: false},
                {data: 'matip', name: 'matip', searchable: false},
                {data: 'matilp', name: 'matilp', searchable: false, orderable: false},
                {data: 'datangl', name: 'datangl', searchable: false},
                {data: 'datangp', name: 'datangp', searchable: false},
                {data: 'datanglp', name: 'datanglp', searchable: false, orderable: false},
                {data: 'pindahl', name: 'pindahl', searchable: false},
                {data: 'pindahp', name: 'pindahp', searchable: false},
                {data: 'pindahlp', name: 'pindahlp', searchable: false, orderable: false},
                {data: 'jumlahl', name: 'jumlahl', searchable: false, orderable: false},
                {data: 'jumlahp', name: 'jumlahp', searchable: false, orderable: false},
                {data: 'jumlahlp', name: 'jumlahlp', searchable: false, orderable: false},
                {data: 'jumlah_kk', name: 'jumlah_kk', searchable: false},

            ],
            columnDefs: [
                {
                    targets: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19],
                    className: 'text-center align-middle'
                },
                {
                    targets: [0],
                    className: 'align-middle'
                },
            ],
            order: [ 0 , 'asc'],
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

        $('.data-table').on('click','.edit_penduduk',function(e){
            e.preventDefault();
            var edit_id = $(this).data('id');
            var edit_value = $(this).data('value');
            var edit_label = $(this).data('label');
            var edit_field = $(this).data('field');
            var edit_desa = $(this).data('desa');
            
            console.log(edit_id);
            $('#editModal').modal('show');
            document.getElementById("edit_id").value = edit_id;
            document.getElementById("edit_label").innerHTML = edit_label;
            document.getElementById("edit_value").value = edit_value;
            document.getElementById("edit_desa").innerHTML = "Desa " + edit_desa;
            document.getElementById("edit_field").value = edit_field;
        });

        $('.update').click(function(e){
            e.preventDefault();
            var uId = $('#edit_id').val();
            var url = "/buku-penduduk/edit/" + uId;
            var formData = new FormData()

            console.log($('#edit_field').val());
            console.log($('#input_month').val());
            console.log($('#edit_value').val());
            formData.set('id', uId);
            formData.set('uValue', $('#edit_value').val());
            formData.set('uField', $('#edit_field').val());
            formData.set('uMonth', $('#input_month').val());
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
        
    });

    function getMonth(){
        months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        y = $('#input_month').val();
        $('.data-table').DataTable().ajax.url("/load-penduduk/" + y).load();
        document.getElementById("month_title").innerHTML = "Bulan " + months[y];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-edit"]').attr('content')
            }
        });
        $.ajax({
           type :'POST',
           url  :"/load-detail-penduduk/" + y,
           data :{y:y},
           success:function(data){
            console.log(data)
            if(data.awall == null){
                document.getElementById("a1").innerHTML = 0;
            }else{
                document.getElementById("a1").innerHTML = data.awall.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.awalp == null){
                document.getElementById("a2").innerHTML = 0;
            }else{
                document.getElementById("a2").innerHTML = data.awalp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.awall == null && data.awalp == null){
                document.getElementById("a3").innerHTML = 0;
            }else{
                document.getElementById("a3").innerHTML = (parseInt(data.awall) + parseInt(data.awalp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.lahirl == null){
                document.getElementById("l1").innerHTML = 0;
            }else{
                document.getElementById("l1").innerHTML = data.lahirl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.lahirp == null){
                document.getElementById("l2").innerHTML = 0;
            }else{
                document.getElementById("l2").innerHTML = data.lahirp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.lahirl == null && data.lahirp == null){
                document.getElementById("l3").innerHTML = 0;
            }else{
                document.getElementById("l3").innerHTML = (parseInt(data.lahirl) + parseInt(data.lahirp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.matil == null){
                document.getElementById("m1").innerHTML = 0;
            }else{
                document.getElementById("m1").innerHTML = data.matil.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.matip == null){
                document.getElementById("m2").innerHTML = 0;
            }else{
                document.getElementById("m2").innerHTML = data.matip.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.matil == null && data.matip == null){
                document.getElementById("m3").innerHTML = 0;
            }else{
                document.getElementById("m3").innerHTML = (parseInt(data.matil) + parseInt(data.matip)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.datangl == null){
                document.getElementById("d1").innerHTML = 0;
            }else{
                document.getElementById("d1").innerHTML = data.datangl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.datangp == null){
                document.getElementById("d2").innerHTML = 0;
            }else{
                document.getElementById("d2").innerHTML = data.datangp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.datangl == null && data.datangp == null){
                document.getElementById("d3").innerHTML = 0;
            }else{
                document.getElementById("d3").innerHTML = (parseInt(data.datangl) + parseInt(data.datangp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.pindahl == null){
                document.getElementById("p1").innerHTML = 0;
            }else{
                document.getElementById("p1").innerHTML = data.pindahl.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.pindahp == null){
                document.getElementById("p2").innerHTML = 0;
            }else{
                document.getElementById("p2").innerHTML = data.pindahp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.pindahl == null && data.pindahp == null){
                document.getElementById("p3").innerHTML = 0;
            }else{
                document.getElementById("p3").innerHTML = (parseInt(data.pindahl) + parseInt(data.pindahp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.awall == null && data.lahirl == null && data.matil == null && data.datangl == null && data.pindahl == null){
                document.getElementById("j1").innerHTML = 0;
            }else{
                document.getElementById("j1").innerHTML = (parseInt(data.awall) + parseInt(data.lahirl) + parseInt(data.matil) + parseInt(data.datangl) + parseInt(data.pindahl)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.awalp == null && data.lahirp == null && data.matip == null && data.datangp == null && data.pindahp == null){
                document.getElementById("j2").innerHTML = 0;
            }else{
                document.getElementById("j2").innerHTML = (parseInt(data.awalp) + parseInt(data.lahirp) + parseInt(data.matip) + parseInt(data.datangp) + parseInt(data.pindahp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            if(data.awall == null && data.lahirl == null && data.matil == null && data.datangl == null && data.pindahl == null && data.awalp == null && data.lahirp == null && data.matip == null && data.datangp == null && data.pindahp == null){
                document.getElementById("j3").innerHTML = 0;
            }else{
                document.getElementById("j3").innerHTML = (parseInt(data.awall) + parseInt(data.lahirl) + parseInt(data.matil) + parseInt(data.datangl) + parseInt(data.pindahl) + parseInt(data.awalp) + parseInt(data.lahirp) + parseInt(data.matip) + parseInt(data.datangp) + parseInt(data.pindahp)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            if(data.jumlah_kk == null){
                document.getElementById("kk1").innerHTML = 0;
            }else{
                document.getElementById("kk1").innerHTML = data.jumlah_kk.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            
           }
        });
    }


</script>
@endpush