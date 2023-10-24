<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/fakturis/main.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="setujui-pesanan">
        <i class="fad fa-times-circle" aria-hidden="true" onclick="closeThis()"></i>
        <h3>Setujui Pesanan</h3>
        <table class="tb-setujui">
            <tr>
                <td style="width: 40%">kode pesanan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 55%" id="kodepesanan">32123</td>
            </tr>
            <tr>
                <td>Total Pesanan</td>
                <td>:</td>
                <td id="totalpesanan">Rp.43213123</td>
            </tr>
            <tr>
                <td colspan="3">
                    <h3>Status Persetujuan</h3>
                </td>
            </tr>
            <tr>
                <td>Logistik</td>
                <td>:</td>
                <td id="setujulogistik"></td>
            </tr>
            <tr>
                <td style="font-family: poppins-reg" id="ketLog" colspan="3">
                    Null
                </td>
            </tr>
            <tr>
                <td>Admin</td>
                <td>:</td>
                <td id="setujuadmin"></td>
            </tr>
            <tr>
                <td style="font-family: poppins-reg" id="ketAd" colspan="3">
                    Null
                </td>
            </tr>
            <tr>
                <td colspan="3"><button onclick="tolakPesan()">Batalkan Pesanan</button></td>
            </tr>
        </table>

    </div>
    <div class="tolak-pesanan">
        <h4>Tolak Pesanan</h4>
        <textarea name="" oninput="alasanTolak(this)" id="alasanTolak" cols="50" rows="2" class="isiAlasan" placeholder="Alasan penolakan disini...."></textarea>        
        <textarea name="" id="pesanTolak" cols="50" rows="5" class="isiPesan">Pesanan anda dengan kode pesanan 0 ditolak
        </textarea>
        <button id_pesanan="" class="btn-tolak" onclick="kirimTolak(this)">kirim pesan pembatalan</button>
        <button class="btn-batal" onclick="batalTolak()">batal tolak</button>
    </div>
    <nav>
        <p class="title-admin">Fakturis Dashboard</p>
        <div class="navigasi">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr onclick="persetujuan()">
                    <td><i class="fal fa-check"></i></td>
                    <td>Persetujuan Pesanan</td>
                </tr>
                <tr onclick="transaksi()">
                    <td><i class="fal fa-paper-plane"></i></td>
                    <td>Data Transaksi</td>
                </tr>
                <tr onclick="laporan()">
                    <td><i class="fal fa-file"></i></td>
                    <td>Laporan Transaksi</td>
                </tr>
                <tr onclick="faktur()">
                    <td><i class="fal fa-folder" aria-hidden="true"></i></td>
                    <td>Faktur</td>
                </tr>
            </table>
        </div>
        <button class="logout" onclick="logout()"><i class="fa fa-arrow-left" aria-hidden="true"></i>Logout</button>
    </nav>

    <div class="container">

    </div>
</body>
<script>
    var tempcontainer = null
    var tempket = "persetujuan"

    $.ajax({
        type: "get",
        url: "/fakturis/persetujuan",
        cache:false,
        success: function (response) {
            $(".container").html(response)
            tempket = "persetujuan"
            tempcontainer = response
        }
    });

    var req = setInterval(() => {
        $.ajax({
            type: "get",
            url: "/fakturis/persetujuan",
            cache:false,
            success: function (response) {
                if(tempcontainer != response){
                    $(".container").html(response)
                }
            }
        });

    }, 5000);

    function transaksi() {
        clearInterval(req)
        $.ajax({
            type: "get",
            url: "/fakturis/datatransaksi",
            cache:false,
            success: function (response) {
                $(".container").html(response)
            }
        });        
    }

    function laporan(){
        clearInterval(req)
        $.ajax({
            type: "get",
            url: "/fakturis/laporan",
            cache:false,
            success: function (response) {
                $(".container").html(response)
            }
        });
    }


    function faktur(){
        clearInterval(req)
        $.ajax({
            type: "get",
            url: "/fakturis/datafaktur",
            cache:false,
            success: function (response) {
                $(".container").html(response)
            }
        });
    }

    function persetujuan(){
        clearInterval(req)
        $.ajax({
            type: "get",
            url: "/fakturis/persetujuan",
            success: function (response) {
                $(".container").html(response)
                tempcontainer = response

                req = setInterval(() => {
                    $.ajax({
                        type: "get",
                        url: "/fakturis/persetujuan",
                        cache:false,
                        success: function (response) {
                            tempcontainer = response
                            if(tempcontainer != response){
                                $(".container").html(response)
                            }
                        }
                    });
                }, 5000);
            }
        });
    }

    function logout() {
        let a = document.createElement("a")
        a.setAttribute("href","/fakturis/logout")
        a.click()
    }
</script>
</html>