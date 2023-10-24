<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/pengirim/login.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="wrap">
        <div class="logo">
            <img src="{{asset('files/logo_kf.png')}}" alt="">
        </div>
        <h3>login website aplikasi pengirim</h3>
        @if (session()->has("daftar"))
        <div class="info">
            <small>akun berhasil dibuat! silahkan menunggu akun anda disetujui oleh Admin. akun akan disetujui dalam waktu sekitar 1 x 24 jam</small>
        </div>
        @endif
        <div class="form">
            <label for="">email</label>
            <input type="email" name="" id="">
            <label for="">password</label>
            <input type="password" name="" id="">

            <input type="button" value="login sekarang">

            <p><small>tidak ada akun? <a href="regis">daftar disini</a></small></p>
        </div>


    </div>
</body>
</html>