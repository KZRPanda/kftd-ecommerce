<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}">
    <link rel="stylesheet" href="{{asset("css/dashboard/dashboard.css")}}">
    <link rel="stylesheet" href="{{asset("css/dashboard/profil/profil.css")}}">
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset('js/temp.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/dashboard/kategori.css")}}">
    <link rel="stylesheet" href="{{asset("css/header.css")}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('guest.component.header')
    <div class="profil-menu">
        <div class="arrow-down"></div>
        <div class="profil-body">
            <table>
                <tr id="akun-saya">
                    <td><i class="fas fa-user"></i></td>
                    <td>Login</td>
                </tr>
                <tr id="akun-logout">
                    <td><i class="fas fa-sign-out-alt"></i></td>
                    <td>Keluar</td>
                </tr>
                <tr>
                    <td colspan="2" id="btn-batal">Batal</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="kategori">
        <h1>Kategori Obat</h1>
        @include('guest.component.kategori')
        <div class="bg"></div>
    </div>
    <div class="hasil-pencarian" id="hasil">

    </div>

    <div class="wrap-body">
        @include('guest.component.isi_dashboard')
    </div>
</body>
<script>
    $("#akun-saya").click(function(){
        $.ajax({
            type: "get",
            url: "/profil/user",
            success: function (response) {
                $(".wrap-body").html(response)
            }
        });
    })

    $("#ship").click(function(){
        $.ajax({
            type: "get",
            url: "{{Route('myship')}}",
            success: function (response) {
                $(".wrap-body").html(response)
            }
        });
    })

    $(".btn-kategori").click(function () { 
        if(!klik){
            $(".kategori").css("height","245px")
            $(".kategori").css("padding","40px 0")
            klik = true
        }else{
            $(".kategori").css("height","0px")
            $(".kategori").css("padding","0 0")
            klik = false
        }
    });
</script>
</html>