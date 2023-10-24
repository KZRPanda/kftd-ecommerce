<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset("js/sweet-alert2.js")}}"></script>
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset("js/login.js")}}"></script>
    <link rel="stylesheet" href="{{asset("css/login/regis.css")}}">
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
    <div class="container">
        <img src="{{asset("files/logo_kf.png")}}" alt="">
        <div class="form">
            <form action="{{route('login')}}" method="post">
                @csrf
                <h1>Registration</h1>
                <label for="">Username</label>
                <input type="text" placeholder="username" id="user" name="data" value="{{old('data')}}" required autofocus>
                <label for="">Password</label>
                <input type="password" placeholder="******" id="pass" name="password" required> 
                <div class="lihat" onclick="temp()">
                    <i class="fal fa-eye" id="eye"></i>    
                </div>
                <label for="">Email</label>
                <input type="email" placeholder="email" id="pass" name="password" required> 
                <label for="">Nomor HP</label>
                <input type="text" placeholder="0872123812" id="pass" name="password" required> 
                <label for="">Alamat</label>
                <input type="text" placeholder="alamat" id="pass" name="password" required> 
                <label for="">Kecamatan</label>
                <select style="display:block; margin-left:20px;margin-bottom:10px;margin-top:10px">
                    <option value="">Alang Alang Lebar</option>
                </select>
                <label for="" >Kelurahan</label>
                <select style="display:block; margin-left:20px;margin-bottom:10px;margin-top:10px">
                    <option value="">Alang Alang Lebar</option>
                </select>
                <button type="submit" value="Login" name="submit" class="login" id="login">Register Now</button>
                @if (session()->has("not_permission"))
                    <script>alert_no("101")</script>
                @endif
                @if (session()->has("loginError"))
                    <script>alert_no("102")</script>
                @endif
                @if (session()->has("hasLogin"))
                    <script>alert_no("103")</script>
                @endif
                <div class="footer">
                    <small>
                        <p>@Copyright Kimia Farma Trading And Distribution Palembang, 2022</p>
                    </small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>