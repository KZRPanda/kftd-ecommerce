<link rel="stylesheet" href="{{asset('css/logistik/component/dashboard.css')}}">
<script src="{{asset('js/logistik/dashboard.js')}}"></script>
<div class="dashboard">
    <div class="col">
        <div class="dataPesanBulan">
            <p>Data Pemesanan Bulan Ini</p>
            <canvas id="canvas1">
            </canvas>
        </div>
        <div class="avg-barang-pesanan">
            <p>Rata-Rata Jumlah Barang Dipesan</p>
            <h2>10.5 Dus</h2>
        </div>
        <div class="pesananDikirim">
            <p>Pesanan Dikirim Bulan Ini</p>
            <h2>312</h2>
        </div>
    </div>

    <div class="col2">
        <div class="barang-kosong">
            <p>Barang Stok Kosong</p>
            <table>
                <tr>
                    <th>id obat</th>
                    <th>nama obat</th>
                    <th>stok obat</th>
                    <th>kategori</th>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
                <tr>
                    <td>9832344</td>
                    <td>Asfead afea</td>
                    <td>0</td>
                    <td>Narkotika</td>
                </tr>
            </table>
        </div>

        <div class="user-pesan-terbanyak">
            <p>User Dengan Barang Pesanan Terbanyak Bulan Ini</p>
            <div class="data-user">
                <img src="{{asset('images/lisa-blackpink.jpg')}}" alt="">
                <p>Lisa Blackpink</p>
                <p>300</p>
            </div>
            <div class="data-user">
                <img src="{{asset('images/lisa-blackpink.jpg')}}" alt="">
                <p>Lisa Blackpink</p>
                <p>300</p>
            </div>
            <div class="data-user">
                <img src="{{asset('images/lisa-blackpink.jpg')}}" alt="">
                <p>Lisa Blackpink</p>
                <p>300</p>
            </div>
            <div class="data-user">
                <img src="{{asset('images/lisa-blackpink.jpg')}}" alt="">
                <p>Lisa Blackpink</p>
                <p>300</p>
            </div>
        </div>
    </div>
</div>
<script>
const ctx = document.getElementById('canvas1').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
        datasets: [{
            data: [12, 19, 10, 20],
            backgroundColor: [
                'rgb(251, 125, 125)',
                'rgb(251, 125, 125)',
                'rgb(251, 125, 125)',
                'rgb(251, 125, 125)'
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
                text: 'Statistik Pemesanan',
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