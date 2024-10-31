<form action="{{ url('/penjualan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Master -->
                <div class="form-group">
                    <label>PIC</label>
                    <input type="hidden" value="{{ auth()->user()->user_id }}" name="user_id" id="user_id">
                    <input type="text" value="{{ auth()->user()->nama }}" class="form-control" readonly>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Pembeli</label>
                    <input value="" type="text" name="pembeli" id="pembeli" class="form-control" required>
                    <small id="error-pembeli" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input value="" type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" required>
                    <small id="error-penjualan_kode" class="error-text form-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input value="" type="datetime-local" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" required>
                    <small id="error-penjualan_tanggal" class="error-text form-text text-danger"></small>
                </div>

                <!-- Detail Barang -->
                <div class="card mt-3">
                    <div class="card-header bg-primary text-white">
                        Detail Barang
                        <button type="button" class="btn btn-sm btn-light float-right" id="tambah-barang">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="container-barang">
                            <div class="row barang-item mb-3">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select name="barang_id[]" class="form-control barang-select" required>
                                            <option value="">- Pilih Barang -</option>
                                            @foreach($barang as $b)
                                                <option value="{{ $b->barang_id }}" data-harga="{{ $b->harga_jual }}">
                                                    {{ $b->barang_nama }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="error-text form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Jumlah</label>
                                        <input type="number" name="jumlah[]" class="form-control jumlah-input" required min="1">
                                        <small class="error-text form-text text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Subtotal</label>
                                        <input type="text" class="form-control subtotal-display" readonly>
                                        <input type="hidden" class="subtotal-value">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button type="button" class="btn btn-danger btn-block hapus-barang" disabled>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" id="total-display" class="form-control" readonly>
                                    <input type="hidden" id="total-value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    // Function untuk format number
    function formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    // Function untuk hitung subtotal
    function hitungSubtotal(row) {
        let harga = row.find('.barang-select option:selected').data('harga') || 0;
        let jumlah = row.find('.jumlah-input').val() || 0;
        let subtotal = harga * jumlah;
        
        row.find('.subtotal-value').val(subtotal);
        row.find('.subtotal-display').val('Rp ' + formatNumber(subtotal));
        
        hitungTotal();
    }

    // Function untuk hitung total
    function hitungTotal() {
        let total = 0;
        $('.subtotal-value').each(function() {
            total += Number($(this).val());
        });
        
        $('#total-value').val(total);
        $('#total-display').val('Rp ' + formatNumber(total));
    }

    // Handle perubahan barang
    $(document).on('change', '.barang-select', function() {
        hitungSubtotal($(this).closest('.barang-item'));
    });

    // Handle perubahan jumlah
    $(document).on('input', '.jumlah-input', function() {
        hitungSubtotal($(this).closest('.barang-item'));
    });

    // Handle tambah barang
    $('#tambah-barang').click(function() {
        let barangItem = $('.barang-item:first').clone();
        barangItem.find('input').val('');
        barangItem.find('select').val('');
        barangItem.find('.hapus-barang').prop('disabled', false);
        $('#container-barang').append(barangItem);
    });

    // Handle hapus barang
    $(document).on('click', '.hapus-barang', function() {
        if($('.barang-item').length > 1) {
            $(this).closest('.barang-item').remove();
            hitungTotal();
        }
    });

    // Form validation
    $("#form-tambah").validate({
        rules: {
            user_id: {
                required: true,
                number: true
            },
            pembeli: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            penjualan_kode: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            penjualan_tanggal: {
                required: true,
            },
            'barang_id[]': {
                required: true
            },
            'jumlah[]': {
                required: true,
                min: 1
            }
        },
        messages: {
            'barang_id[]': {
                required: "Silahkan pilih barang"
            },
            'jumlah[]': {
                required: "Jumlah harus diisi",
                min: "Jumlah minimal 1"
            }
        },
        submitHandler: function(form) {
            $.ajax({
                url: form.action,
                type: form.method,
                data: $(form).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        dataPenjualan.ajax.reload();
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-' + prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
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