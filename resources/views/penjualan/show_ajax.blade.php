@empty($penjualan)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax') }}" method="POST" id="form-show">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <th class="test-right col-3">PIC : </th>
                        <td class="col-9">{{ $penjualan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="test-right col-3">Pembeli : </th>
                        <td class="col-9">{{ $penjualan->pembeli }}</td>
                    </tr>
                    <tr>
                        <th class="test-right col-3">Kode Penjualan : </th>
                        <td class="col-9">{{ $penjualan->penjualan_kode }}</td>
                    </tr>
                    <tr>
                        <th class="test-right col-3">Tanggal Penjualan : </th>
                        <td class="col-9">{{ $penjualan->penjualan_tanggal }}</td>
                    </tr>
                </table>
            </div>
            
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalKeseluruhan = 0; // Variabel untuk menampung total keseluruhan
                        @endphp
                    
                        @foreach($detailpenjualan as $detail)
                            @php
                                $subTotal = $detail->jumlah * $detail->harga; // Hitung subtotal untuk setiap barang
                                $totalKeseluruhan += $subTotal; // Akumulasi total keseluruhan
                            @endphp
                            <tr>
                                <td>{{ $detail->barang->barang_nama }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($subTotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"><strong>Total Keseluruhan</strong></td>
                            <td><strong>Rp. {{ number_format($totalKeseluruhan, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>                    
                </table>
            </div>
            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning" id="btn-print-invoice">Cetak Invoice</button>
            </div>
            
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-show").validate({
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#modal-master').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataPenjualan.ajax.reload(); // Reload datatable
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Gagal memproses permintaan.'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#btn-print-invoice").on("click", function() {
            var invoiceContent = `
            <html>
    <head>
        <title>Invoice</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #f4f7fa;
            }
            .invoice-container {
                max-width: 800px;
                margin: auto;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                border-top: 5px solid #4CAF50;
            }
            .header {
                text-align: center;
                padding-bottom: 20px;
            }
            .header img {
                max-width: 150px;
            }
            h1 {
                color: #4CAF50;
                margin-bottom: 5px;
            }
            .invoice-info {
                margin: 20px 0;
                background-color: #f0f4f7;
                padding: 15px;
                border-radius: 8px;
            }
            .invoice-info p {
                margin: 5px 0;
                color: #333;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 12px;
                text-align: left;
            }
            th {
                background-color: #4CAF50;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            .total {
                font-weight: bold;
                background-color: #4CAF50;
                color: white;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #ddd;
                color: #555;
            }
            .footer p {
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="invoice-container">
            <div class="header">
                <img src="URL_TO_YOUR_LOGO" alt="Logo">
                <h1>Invoice Penjualan</h1>
            </div>
            <div class="invoice-info">
                <p><strong>PIC:</strong> {{{ $penjualan->user->nama }}}</p>
                <p><strong>Pembeli:</strong> {{{ $penjualan->pembeli }}}</p>
                <p><strong>Kode Penjualan:</strong> {{{ $penjualan->penjualan_kode }}}</p>
                <p><strong>Tanggal Penjualan:</strong> {{{ $penjualan->penjualan_tanggal }}}</p>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailpenjualan as $detail)
                        <tr>
                            <td>{{{ $detail->barang->barang_nama }}}</td>
                            <td>{{{ $detail->jumlah }}}</td>
                            <td>Rp. {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td>Rp. {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="total">Total Keseluruhan</td>
                        <td class="total">Rp. {{ number_format($totalKeseluruhan, 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
    </html>

            `;

            var newWindow = window.open('', '_blank');
            newWindow.document.write(invoiceContent);
            newWindow.document.close();
            newWindow.print();
            newWindow.close();
        });
    });
</script>


@endempty