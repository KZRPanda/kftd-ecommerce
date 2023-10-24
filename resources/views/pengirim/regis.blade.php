<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/pengirim/regis.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="wrap">
        <div class="logo">
            <img src="{{asset('files/logo_kf.png')}}" alt="">
        </div>
        <h3>registrasi akun website aplikasi pengirim</h3>

        <form action="{{route('regisakun')}}" method="post" class="form">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <label for="">nama lengkap</label>
            <input type="text" name="nama" id="" value="{{old('nama')}}">

            @if (session()->has("nama"))
                <small>nama anda sudah terdaftar</small>
            @endif

            <label for="">email</label>
            <input type="email" name="email" id="" value="{{old('email')}}">

            @if (session()->has("email"))
                <small>email anda sudah terdaftar</small>
            @endif

            <label for="">password</label>
            <input minlength="7" type="password" name="password" id="" value="{{old('password')}}">
            <label for="">nomor hp</label>
            <input type="text" name="nohp" id="" value="{{old('nohp')}}">

            @if (session()->has("nohp"))
                <small>nomor hp anda sudah terdaftar</small>
            @endif
            
            <input type="submit" class="submit" value="login sekarang">

            @if (session()->has("error"))
                <h3>{{session()->get("error")}}</h3>
            @endif
        </form>


    </div>
</body>
</html>