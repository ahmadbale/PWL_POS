@extends('layouts.template')

@section('content')

<div class="container-fluid">
    <!-- Row 1: Kartu Statistik -->
    <div class="row">
        <!-- Kartu Jumlah Pengguna -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalUser }}</h3>
                    <p>Jumlah Data Pengguna</p>
                </div>
                <div class="icon">
                    <i class="nav-icon far fa-user"></i>
                </div>
                <a href="{{ url('/user') }}" class="small-box-footer">
                    Lihat Detail 
                </a>
            </div>
        </div>
        <!-- Kartu Jumlah Barang -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalBarang }}</h3>
                    <p>Jumlah Data Barang</p>
                </div>
                <div class="icon">
                    <i class="nav-icon far fa-list-alt"></i>
                </div>
                <a href="{{ url('/barang') }}" class="small-box-footer">
                    Lihat Detail 
                </a>
            </div>
        </div>
        <!-- Kartu Jumlah Supplier -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalSupplier }}</h3>
                    <p>Jumlah Data Supplier</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fa fa-store"></i>
                </div>
                <a href="{{ url('/supplier') }}" class="small-box-footer">
                    Lihat Detail  
                </a>
            </div>
        </div>
          <!-- Kartu Penjualan -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-blue">
                <div class="inner">
                    <h3>{{ $totalPenjualan }}</h3>
                    <p>Jumlah Data Penjualan</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-cash-register"></i>
                </div>
                <a href="{{ url('/penjualan') }}" class="small-box-footer">
                    Lihat Detail 
                </a>
            </div>
        </div>
          <!-- Kartu Detail Penjualan-->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-yellow">
                <div class="inner">
                    <h3>{{ $totalDetailPenjualan }}</h3>
                    <p>Jumlah Data Detail Penjualan</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-plus-square"></i>
                </div>
                <a href="{{ url('/detailpenjualan') }}" class="small-box-footer">
                    Lihat Detail 
                </a>
            </div>
        </div>
          <!-- Kartu Detail Stok-->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-maroon">
                <div class="inner">
                    <h3>{{ $totalStok }}</h3>
                    <p>Jumlah Data Stok</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-cubes"></i>
                </div>
                <a href="{{ url('/stok') }}" class="small-box-footer">
                    Lihat Detail 
                </a>
            </div>
        </div>
    </div>
@endsection

@push('js')
<!-- Chart.js -->
@endpush