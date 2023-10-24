<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/font.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">
    <script src="{{asset('js/chart.js')}}"></script>
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/admin/setujuiakun.js')}}"></script>
    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/request/request.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="tolak-pesanan">
        <h4>Tolak Pesanan</h4>
        <section>
            <div class="pilih" ic="i1" v="stok tidak ada">
                <i class="fas fa-times i1" aria-hidden="true"></i>
                <p>Stok Tidak Ada</p>
            </div>
            <div class="pilih" ic="i2" v="alamat tidak jelas">
                <i class="fas fa-times i2" aria-hidden="true"></i>
                <p>Alamat Tidak Jelas</p>
            </div>
        </section>
        <textarea name="" id="pesanTolak" cols="50" rows="5" class="isiPesan">Pesanan anda dengan kode pesanan 0 ditolak
        </textarea>
        <button id_pesanan="" class="btn-tolak" onclick="kirimTolak(this)">kirim pesan pembatalan</button>
        <button class="btn-batal" onclick="batalTolak()">Batal</button>
    </div>
    <div class="wrap-all">
        <nav>
            <p class="title-admin">Admin Dashboard</p>
            <ul>
                <div class="menu active" index="0" onclick="dashboard_admin(this)">
                    <div class="simbol">
                        <i class="fal fa-chart-line"></i>
                    </div>
                    <p class="text-simbol">Dashboard</p>
                </div>
                <div class="menu" index="1" onclick="dataBarang_admin(this)">
                    <div class="simbol">
                        <i class="fal fa-boxes"></i>
                    </div>
                    <p class="text-simbol">Data Barang</p>
                </div>
                <div class="menu" index="2" onclick="dataPesanan_admin(this)">
                    <div class="simbol">
                        <i class="fal fa-shipping-fast"></i>
                    </div>
                    <p class="text-simbol">Data Pesanan</p>
                </div>
                <div class="sub-menu sm2">
                    <p onclick="pesanSetuju(this)"><small>Setujui Pesanan</small></p>
                </div>

                <div class="menu" index="3" onclick="dataPiutang_admin(this)">
                    <div class="simbol">
                        <i class="fal fa-money-bill"></i>
                    </div>
                    <p class="text-simbol">Data Piutang</p>
                </div>

                <div class="menu" index="4" onclick="dataUser(this)">
                    <div class="simbol">
                        <i class="fal fa-user"></i>
                    </div>
                    <p class="text-simbol">Akun User</p>
                </div>
                <div class="sub-menu sm4">
                    <p onclick="akunsetuju(this)"><small>Acc Akun</small></p>
                </div>
            </ul>

            <div class="logout" onclick="logout()">
                <div class="out">
                    <p>logout akun</p>
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> 
                </div> 
            </div>
        </nav>
    
        <div class="container" onscroll="scrollMe()">
            @include('admin.dashboard')
        </div>
    
        <div class="detail">
            <div class="isi-detail">
                <h4>Data Semua</h4>
                <div class="data">
                    <div class="card">
                        <i class="far fa-dollar-sign"></i>
                        <div class="card-detail">
                            <p>Rp.{{$tot["total"]}} {{$tot["j"]}}</p>
                            <small>Pendapatan</small>
                        </div>
                    </div>
                    <div class="card">
                        <i class="far fa-boxes"></i>
                        <div class="card-detail">
                            <p>{{$jenis_b}}</p>
                            <small>Jenis Barang</small>
                        </div>
                    </div>
                    <div class="card">
                        <i class="far fa-user"></i>
                        <div class="card-detail">
                            <p>{{$users}}</p>
                            <small>Users</small>
                        </div>
                    </div>
                    <div class="data" id="data">
                        <canvas id="myChart" width="200px" height="300px"></canvas>
                    </div>
            </div>
        </div>
    </div>
</body>
<script>

$(".menu").click(function(){
    let index = parseInt($(this).attr("index"))
    //console.log(clearInterval(reqdata))
    if((index != 2)){
        $(".sm2").css("height","0px")
        $(".sm2").css("margin-bottom","0px")
    }
    if((index != 1)){
        $(".sm1").css("height","0px")
        $(".sm1").css("margin-bottom","0px")
    }
    if((index != 4)){
        $(".sm4").css("margin-bottom","0px")
        $(".sm4").css("height","0px")
    }

    console.log(index)
})

    //     $.ajax({
    //     type: "get",
    //     url: "/containerAdmin/dataBarang",
    //     success: function (response) {
    //         console.log(response)
    //         $(".container").html(response)     
    //     }
    // });
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                data: [12, 19, 10, 20],
                backgroundColor: [
                    'rgba(255, 255, 255)',
                    'rgba(255, 255, 255)',
                    'rgba(255, 255, 255)',
                    'rgba(255, 255, 255)'
                ]
            }]
        },
        options: {
            borderRadius :3,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Statistik Penjualan',
                    padding: {
                        top: 10,
                        bottom: 30
                    }
                },
                legend:{
                    display:false
                }
            }
        }
    });
</script>
</html>