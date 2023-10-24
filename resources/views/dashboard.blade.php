<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}">
    <link rel="stylesheet" href="{{asset("css/dashboard/dashboard.css")}}">
    <link rel="stylesheet" href="{{asset("css/dashboard/profil/profil.css")}}">
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset("js/app.js")}}"></script>
    <script src="{{asset('js/sweet-alert2.js')}}"></script>
    <link rel="stylesheet" href="{{asset("css/dashboard/kategori.css")}}">
    <link rel="stylesheet" href="{{asset("css/header.css")}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include("component.contain_view")
    <div class="loading-view">
        <img class="logo-load" src="{{asset('files/logo_kf.png')}}" alt="">
        <div class="loading-wrap">
            <img src="{{asset('files/loading.gif')}}" alt="">
        </div>
    </div>
    <div class="snackbar" id="snackbar">
        <div class="bar"></div> <p class="title-snackbar">Input Success <i class="fas fa-check"></i> </p>
    </div>
    <div class="verif" id="verif">
        <div class="container-verif">
            <div class="header-verif">
                <h3>Verifikasi Akun</h3>
                <i class="fas fa-times" onclick="tutup_verif()"></i>
            </div>
            <ul>
                <li>Password</li>
                <li><input type="text" name="pass" id="verif-pass" class="pass" placeholder="password here"></li>
                <button class="verif-ubah" id="verif-ubah" onclick="kirim()">Ubah Data</button>
            </ul>
        </div>
    </div>
    @include("component.modal.modal")
    @include('component.header')

    <div class="notif">
        <div class="container-notif">
            @if ($jumpesan <= 0)
                <p>Tidak ada pesan</p>
            @endif
            @foreach ($notif as $item)
            <div class="card-notif" index="" id_pesanan="{{$item->id_pesanan}}">
                <div class="header-card-notif">
                    <div class="wrap-status">
                        <p class="blm-dibaca" id="{{$item->id_pesanan}}" style="font-family: poppins-bold;color: red;font-size: 15px;
                            @if ($item->dibaca == "0")
                                display:block
                            @endif">
                            belum dibaca
                        </p>

                        <p class="sdh-dibaca" id="sdh-{{$item->id_pesanan}}" style="color: rgb(81, 81, 81);font-size: 15px;
                            @if ($item->dibaca == "1")
                                display:block !important
                            @endif">
                            sudah dibaca
                        </p>
                    </div>
                    <p>tanggal : {{$item->tanggal}}</p>
                </div>
                <p class="isi {{$item->id_pesanan}}">{{$item->isi}}</p>
            </div>
            @endforeach
        </div>
        <i class="fad fa-times-circle" aria-hidden="true" onclick="tutupnotif()"></i>
    </div>

    <div class="profil-menu">
        <div class="arrow-down"></div>
        <div class="profil-body">
            <table>
                <tr id="akun-saya" class="btn-profil">
                    <td><i class="fas fa-user"></i></td>
                    <td>Akun Saya</td>
                </tr>
                <tr id="ship" class="btn-profil">
                    <td><i class="fas fa-shipping-fast"></i></td>
                    <td>Pesanan Saya</td>
                </tr>
                <tr id="msg" class="btn-profil">
                    <td><i class="fas fa-envelope"></i></td>
                    <td>Pesan <span style="color: red"><b>{{$jumpesan}}</b></span></td>
                </tr>
                <tr id="akun-logout" class="btn-profil">
                    <td><i class="fas fa-sign-out-alt"></i></td>
                    <td>Logout</td>
                </tr>
                <tr>
                    <td colspan="2" id="btn-batal">Batal</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="kategori" id="kategori">
        <h1>Kategori Obat</h1>
        <div class="isi-kategori">
            <div class="gambar" data="1">
                <img src="{{asset("files/kategori/kosmetik.jpg")}}" alt="">
                <div class="check" id="1">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Kosmetik</p>
            </div>
            <div class="gambar" data="2">
                <img src="{{asset("files/kategori/obat-bebas.png")}}" alt="">
                <div class="check" id="2">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Bebas</p>
            </div>
            <div class="gambar" data="3">
                <img src="{{asset("files/kategori/obat-bebas-terbatas.webp")}}" alt="">
                <div class="check" id="3">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Bebas Terbatas</p>
            </div>
            <div class="gambar" data="4">
                <img src="{{asset("files/kategori/obat-keras.webp")}}" alt="">
                <div class="check" id="4">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Keras</p>
            </div>
            <div class="gambar" data="5">
                <img src="{{asset("files/kategori/obat-psikotropika.jpg")}}" alt="">
                <div class="check" id="5">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Psikotropika</p>
            </div>
            <div class="gambar" data="6">
                <img src="{{asset("files/borex.jpg")}}" alt="">
                <div class="check" id="6">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Prekusor</p>
            </div>
            <div class="gambar" data="7">
                <img src="{{asset("files/kategori/obat-narkotika.jpg")}}" alt="">
                <div class="check" id="7">
                    <i class="fas fa-check"></i>
                </div>
                <p>Obat Narkotika</p>
            </div>
        </div>
        <div class="bg"></div>
    </div>
    <div class="hasil-pencarian" id="hasil">

    </div>

    <div class="wrap-body">
        @include('component.isi_dashboard')
    </div>
</body>
<script>
var klik = false;

var klik_gambar = false;
var hasil_klik_gambar = [];
var x = ["hello world","hai","yahaha"]
var tempt = []

function arrayRemove(arr, value) {
    var temp = []
    var j = 0
    for(var i = 0;i < arr.length;i++){
        if(arr[i] == value){
            continue
        }else{
            temp[j] = arr[i]
            j++
        }
    }
    return temp
}


$(".gambar").click(function(){
    var data = $(this).attr("data")
    var temp1 = hasil_klik_gambar.includes(data)

    if(!tempt.includes(data)){
        tempt.push(data)
    }
    if(!temp1){
        $("#"+data).css("display","block")
        hasil_klik_gambar.push(data)
        klik_gambar = true
    }else{
        $("#"+data).css("display","none")
        hasil_klik_gambar = arrayRemove(hasil_klik_gambar,data)
        klik_gambar = false
    }
})

function loadingB(){
    $(".loading-view").css("display","block")
}
function loadingN(){
    $(".loading-view").css("display","none")
}
    $("#akun-saya").click(function(){
        loadingB()
        $.ajax({
            type: "get",
            url: "/profil/user",
            success: function (response) {
                $(".wrap-body").html(response)
                loadingN()
            }
        });
    })

    $("#ship").click(function(){
        loadingB()
        $.ajax({
            type: "get",
            url: "/myship/dashboard",
            success: function (response) {
                $(".wrap-body").html(response)
            
                loadingN()
            }
        });
    })



    $("#btn-batal").click(function(){
        $(".profil-menu").css("display","none")
    })

    $("#akun-logout").click(function(){
        var a = document.createElement("a")
        a.setAttribute("href","/auth/logout")
        a.click()
    })

    $(".gambar-profile").mouseover(function(){
        $(".profil-menu").css("display","block")
    })

    $(".btn-profil").click(function(){
        if(widthscreen){
            $(".kategori").css("display","none")
        }
        $(".profil-menu").css("display","none")
    })

    $(".card-notif").mouseover(function(){
        var id_pesanan = $(this).attr("id_pesanan")
        let status = $("#"+id_pesanan).attr("class")

        if(status == "blm-dibaca")
        {
            $("#"+id_pesanan).css("display","none")
            $("#sdh-"+id_pesanan).css("display","block")

            $.ajax({
                type: "get",
                url: "/dibaca",
                data: {"id":id_pesanan},
                success: function (response) {
                    
                }
            });
        }
    })

    // $(".card-notif").mouseout(function () { 
    //     var kelas = $(this).attr("id")
    //     $("."+kelas).css("white-space","nowrap");
    // });

    function tutupnotif() {
        $(".notif").css("display","none")
    }

    $("#msg").click(function () {
        $(".notif").css("display","grid")
    })

    
</script>
</html>