<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/sweet-alert2.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/logistik/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/logistik/component/laporan.css')}}">
    <script src="{{asset('js/chart.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="button">
    
    </div>
    <div class="buat-pengiriman">
        <h3>Buat Pengiriman</h3>
        <input type="date" name="" id="" class="tglPengiriman">
        <button onclick="buatPengiriman()">Buat Sekarang</button>
        <button onclick="tutupPengiriman()">Batal</button>
    </div>
    <nav>
        <p class="title-admin">Logistik Dashboard</p>
        <ul>
            <div class="menu active" index="0">
                <div class="simbol">
                    <i class="fal fa-boxes"></i>
                </div>
                <p class="text-simbol">Data Barang</p>
            </div>
            <div class="sub-menu sm0">
                <p onclick="laporan()"><small>Laporan Transaksi</small></p>
                <p onclick="masterdata()"><small>Master Data</small></p>
                <p onclick="barangkosong()"><small>Barang Kosong</small></p>
            </div>

            <div class="menu" index="1">
                <div class="simbol">
                    <i class="fal fa-check"></i>
                </div>
                <p class="text-simbol">Persetujuan Pesanan</p>
            </div>
            

            <div class="menu" index="2">
                <div class="simbol">
                    <i class="fal fa-shipping-fast"></i>
                </div>
                <p class="text-simbol">Pengiriman Barang</p>
            </div>
        </ul>

        <div class="logout" onclick="logout()">
            <div class="out">
                <p>logout akun</p>
                <i class="fa fa-arrow-left" aria-hidden="true"></i> 
            </div> 
        </div>
    </nav>
    <div class="container">
        @include('logistik.dataBarang')
    </div>
</body>
<script>


    $(".sm0").css("height","152px")

    $(".menu").click(function(){
        let index = $(this).attr("index")

        $(".menu").attr("class","menu")
        $(this).attr("class","menu active")
        $(".sub-menu").css("height","0px")

        if(index == "0"){
            $.ajax({
                type: "get",
                url: "{{Route('lg_databarang')}}",
                success: function (response) {
                    $(".container").html(response)
                }
            }); 
            $(".sm0").css("height","152px")
        }else if(index == "1"){
            $.ajax({
                type: "get",
                url: "/logistik/persetujuan",
                success: function (response) {
                    $(".container").html(response)
                }
            });  
            $(".sm"+index).css("height","102px")
        }else if(index == "2"){
            $.ajax({
                type: "get",
                url: "/logistik/pengiriman",
                success: function (response) {
                    $(".container").html(response)
                }
            });     
            $(".sm"+index).css("height","102px")        
        }
    })

    function masterdata() {
        $.ajax({
            type: "get",
            url: "/logistik/masterdata",
            success: function (response) {
                $(".container").html(response)
            }
        }); 
    }

    function laporan() {
        $.ajax({
            type: "get",
            url: "{{Route('laporan_logistik')}}",
            success: function (response) {
                $(".container").html(response)
            }
        }); 
    }

    function barangkosong(){
        $.ajax({
            type: "get",
            url: "/logistik/databarang/barangkosong",
            success: function (response) {
                $(".container").html(response)
            }
        }); 
    }

    function logout() {
        let link = document.createElement("a")
        link.setAttribute("href","/logistik/logout")
        link.click()
    }
</script>
</html>