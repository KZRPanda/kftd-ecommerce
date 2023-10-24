<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{asset("js/sweet-alert2.js")}}"></script>
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset("js/login.js")}}"></script>
    <link rel="stylesheet" href="{{asset("css/login/login.css")}}">
    <title>Document</title>
    <script>
    function alert_no(error){
        var text,title;

        if(error == "101"){
            title = "Permission Error"
            text = "Anda Tidak Memiliki Akses Kesini!"
        }else if(error == "102"){
            title = "Login Error"
            text = "Data Atau Password Salah, Periksa Kembali!"
        }else if(error == "103"){
            title = "Login Error"
            text = "Akun sedang digunakan!"
        }else if(error == "104"){
            title = "Login Error"
            text = "Akun belum disetujui!"
        }
        Swal.fire({
                icon: 'error',
                title: title,
                text: text
        })
    }
    function temp(){
        var eye = document.getElementById("eye")
        var pass = document.getElementById("pass")
        if(pass.type == "password"){
            pass.type = "text"
            eye.setAttribute("class","fal fa-eye-slash")
        }else{
            pass.type = "password"
            eye.setAttribute("class","fal fa-eye")
        }
    }
    </script>
</head>
<body>
    @if (session()->has("id_admin"))
        <?php redirect("/admin") ?>
    @endif
    @if (session()->has("id_user"))
        <?php redirect("/dashboard") ?>
    @endif
    @if (session()->has("id_logistik"))
        <?php redirect("/logistik") ?>
    @endif
    @if (session()->has("id_fakturis"))
        <?php redirect("/fakturis") ?>
    @endif
    <div class="container">
        <img src="{{asset("files/logo_kf.png")}}" alt="">
        <div class="wrap-form">
            <div class="form">
                <form action="{{route('login')}}" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <h1>Selamat Datang!</h1>
                    {{session("peler")}}
                    <label for="">Username atau Email atau Nomor HP</label>
                    <input type="text" placeholder="username atau email" id="user" name="data" value="{{old('data')}}" autocomplete="off" required autofocus>
                    <label for="">Password</label>
                    <input type="password" placeholder="hello world" id="pass" name="password" required autocomplete="off"> 
                    <div class="lihat" onclick="temp()">
                        <i class="fal fa-eye" id="eye"></i>    
                    </div>
                    <small><p class="lupa">Lupa password?</p></small>
                    <button type="submit" value="Login" name="submit" class="login" id="login">Login</button>
                    @if (session()->has("not_permission"))
                        <script>alert_no("101")</script>
                    @endif
                    @if (session()->has("loginError"))
                        <script>alert_no("102")</script>
                    @endif
                    @if (session()->has("hasLogin"))
                        <script>alert_no("103")</script>
                    @endif
                    @if (session()->has("notAcc"))
                        <script>alert_no("104")</script>
                    @endif
                </form>
            </div>
            <p class="signup">belum memiliki akun? <a href="/registrasi">daftar sekarang</a></p>
        </div>
    </div>
</body>
</html>