@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a href="{{ url('/detailpenjualan/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i>  Export Stok (XLSX)</a>
                <a href="{{ url('/detailpenjualan/export_pdf') }}" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export Stok (PDF)</a> 
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select name="barang_id" id="barang_id" class="form-control" required>
                                <option value="">- Semua -</option>
                                @foreach ($barang as $b)
                                    <option value="{{ $b->barang_id }}">{{ $b->barang_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Nama Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-border table-striped table-hover table-sm" id="table_detailpenjualan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Penjualan</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Total Pembelian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = ''){
            $('#myModal').load(url,function(){
                $('#myModal').modal('show');
            });
        }

        var dataDetailPenjualan;
        $(document).ready(function(){
            dataDetailPenjualan = $('#table_detailpenjualan').DataTable({
                //serverSide: true, jika ingin menggunakan server side processing
                serverSide: true,
                ajax:{
                    "url": "{{ url('detailpenjualan/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function (d){
                        d.barang_id = $('#barang_id').val();
                    }
                },
                columns:[
                    {
                        //nomor urut dari laravel datatable addIndexColumn()
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },{
                        data: "penjualan.penjualan_kode",
                        className: "",
                        orderable: false,
                        searchable: false
                    },{
                        data: "barang.barang_nama",
                        className: "",
                        orderable:false,
                        searchable: false
                    },{
                        // mengambil data level dari hasil ORM berelasi
                        data: "harga",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "jumlah",
                        className: "",
                        orderable: true,
                        searchable: true
                    },{
                        data: "aksi",
                        className: "",
                        orderable:false,
                        searchable: false
                    }
                ]
            });
            $('#barang_id').on('change', function(){
                dataDetailPenjualan.ajax.reload();
            });
        });
    </script>
@endpush