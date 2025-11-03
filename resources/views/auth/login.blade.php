<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="{{ asset('loginpage/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>TOEIC Log In</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container page2">
            <form id="loginForm" method="POST" action="{{ route('postlogin') }}">
                @csrf
                <h1>Login</h1>
                <span>untuk masuk kedalam sistem</span><br>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <br>
                <a style="background-color: transparent; border-color: #2449AD; color:#2449AD"
                    href="{{ route('landingpage') }}">
                    <b><u>Kembali Ke Halaman Utama</u></b>
                </a>
            </form>
        </div>
        <div class="form-container page1">
            <form>
                <img src="{{ asset('loginpage/img/login.png') }}" style="width: 250px; height: auto;">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Tentang Kami</h1>
                    <p>Sistem Pendaftaran Ujian TOEIC adalah sistem yang dirancang untuk pendaftaran serta pengelolaan
                        ujian TOEIC (Test of English for International Communication) bagi mahasiswa Politeknik Negeri
                        Malang.</p>
                    <button class="hidden" id="login">Kembali</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <br><br>
                    <h1>Selamat Datang</h1>
                    <p style="font-size: 18px">di Sistem Pendaftaran Ujian TOEIC Politeknik Negeri Malang.</p>
                    <br>
                    <button class="hidden" id="register">Lanjut</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('loginpage/script.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4,
                        maxlength: 20
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 20
                    }
                },
                submitHandler: function(form) { // ketika valid, maka bagian yg akan dijalankan
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) { // jika sukses
                                // Swal.fire({
                                //     icon: 'success',
                                //     title: 'Berhasil',
                                //     text: response.message,
                                // }).then(function() {
                                    window.location = response.redirect;
                                // });
                            } else { // jika error
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
                    element.closest('.input-group').append(error);
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
</body>

</html>