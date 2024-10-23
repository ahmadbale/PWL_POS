@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/user') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/user/' . $user->user_id . '/detail_ajax') }}" method="POST" id="form-show">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kategori User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped">
                    <table class="table table-sm table-bordered table-striped">
                        <tr><th class="test-right col-3">Level Pengguna : </th><td class="col-9">{{ $user->level->level_nama }}</td></tr>
                        <tr><th class="test-right col-3">Username : </th><td class="col-9">{{ $user->username }}</td></tr>
                        <tr><th class="test-right col-3">Nama : </th><td class="col-9">{{ $user->nama }}</td></tr>
                        <tr>
                            <th class="test-right col-3">Password : </th>
                            <td class="col-9">
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" value="{{ $user->password }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i id="icon-eye" class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        
                    </table>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
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
                            dataUser.ajax.reload(); // Reload datatable
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
        // Toggle visibility of password
        $('#togglePassword').on('click', function() {
            let passwordField = $('#password');
            let passwordFieldType = passwordField.attr('type');
            
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text'); // Mengubah input type menjadi text
                $('#icon-eye').removeClass('fa-eye').addClass('fa-eye-slash'); // Mengganti ikon ke eye-slash
            } else {
                passwordField.attr('type', 'password'); // Mengembalikan input type menjadi password
                $('#icon-eye').removeClass('fa-eye-slash').addClass('fa-eye'); // Mengganti ikon ke eye
            }
        });
    });
</script>

@endempty
