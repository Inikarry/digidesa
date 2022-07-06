@extends('layouts.master')
@section('content')
<div class="page-info container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Administrasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="main-wrapper container">
    <div class="col d-flex justify-content-center">
        <div class="card" style="width: 50rem;">
            <div class="card-body">
                <h4 class="card-title" style="text-align: center;">Selamat Datang <b style="color:blue;">{{auth()->user()->name}}</b></h4>
                <p style="text-align:center;">Selamat datang di website Administrasi Kecamatan Donri-Donri, Kabupaten Soppeng, Sulawesi Selatan. Website ini adalah
                dirancang untuk memudahkan kegiatan administrasi dengan mengdigitalisasikan arsip-arsip administrasi sehingga dapat dengan mudah
                di akses dan disimpan untuk keperluan di masa yang akan datang.</p>
                <h6 style="text-align: center;">Selamat Menggunakan Fasilitas Ini</h6>
            </div>
        </div>
    </div>
</div>
@endsection