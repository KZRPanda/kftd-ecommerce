<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    *{
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }
    .tb table{
        font-size: 14px;
    }
    .tb table tr td:first-child{
        padding-left: 4px;
    }
    .tb table tr td:nth-child(2){
        padding: 3px 10px;
    }
    .judul{
        margin-bottom: 5px;
        padding: 7px 4px;
        border-bottom: 2px solid black;
    }

    .tb-semua{
        width: 100%;
    }
    .tb-semua table{
        width: 100%;
        margin-top: 5px;
    }

    .tb-semua table tr th{
        font-style: normal;
        font-size: 14px;
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        padding: 10px 0px;
    }

    .tb-semua table tr td{
        padding: 10px 4px;
        font-size: 13px;
    }

    .tb-semua table .row-last1 td{
        font-size: 15px;
        padding: 10px 5px 5px 10px;
        padding-top: 10px;
        border-top: 2px solid black;
    }

    .tb-semua table .row-last2 td{
        font-size: 15px;
        padding: 5px 5px;
        padding-left: 10px;
    }
    body{
        border: 2px solid rgba(255, 0, 0, 0);
    }

    .footer{
        position: relative;
        z-index: 10;
        bottom: 0;
        width: 100%;
        padding: 0;
    }

    .footer .ttd{
        width: 300px;
        height: 100px;
        border: 2px solid rgba(255, 0, 0, 0);
    }

    .footer .ttd h5{
        margin: 0;
        text-align: center;
        padding: 0;
    }
    .footer .ttd p{
        text-align: center;
        margin-top: 70px;
    }

    main{
        height: 80%;
        width: 100%;
        border: 2px solid rgba(255, 0, 0, 0);
    }
</style>
<body>
    @php
        $j = 0;
        $batas = 0;
    @endphp

    @for ($i = $j; $i < sizeof($semua); $i++)
    <main>
        <h2 class="judul">FAKTUR</h2>
        <div class="tb">
            <table>
                <tr>
                    <td>Kode Pesanan</td>
                    <td>:</td>
                    <td>{{$semua[0]->id_pesanan}}</td>
                </tr>
                <tr>
                    <td>Pembeli</td>
                    <td>:</td>
                    <td>{{$semua[0]->instansi}}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{$semua[0]->alamat}}</td>
                </tr>
                <tr>
                    <td>Tanggal Kirim</td>
                    <td>:</td>
                    <td>{{$semua[0]->waktu}}</td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td>:</td>
                    <td style="color: red;font-style: bold">KREDIT</td>
                </tr>
            </table>
        </div>
    
        <div class="tb-semua">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <th>Kode Obat</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
                @php
                    $k = 1;
                    $jum_tot = 0;
                    $total_all = 0;
                @endphp

                @for ($x = $i; $x < $i + 8; $x++)
                @php
                    if($x == sizeof($semua)){
                        break;
                    }
                @endphp
                    <tr>
                        <td>{{$semua[$x]->id_obat}}</td>
                        <td>{{$semua[$x]->nama_obat}}</td>
                        <td style="text-align: center">{{$semua[$x]->jum_pesanan}}</td>
                        <td>Rp {{number_format($semua[$x]->harga,0,",",".")}}</td>
                        <td>Rp {{number_format($semua[$x]->harga_pesanan,0,",",".")}}</td>
                    </tr>
                    @php
                        $k++;
                        $j++;
                        $batas++;
                        $jum_tot += $semua[$x]->jum_pesanan;
                        $total_all += $semua[$x]->harga_pesanan;
                    @endphp
                @endfor
                @php
                    $i = $j-1;
                @endphp
                <tr class="row-last1">
                    <td colspan="4" style="text-align: right">Jumlah</td>
                    <td>: {{$jum_tot}} Barang</td>
                </tr>
                <tr class="row-last2">
                    <td colspan="4" style="text-align: right">Total Harga</td>
                    <td>: Rp {{number_format($total_all,2,",",".")}}</td>
                </tr>
            </table>
        </div>
    </main>
    <footer class="footer">
        <div class="ttd">
            <h5>Kimia Farma Trading And Distribution</h5>
            <p>(..............................................)</p>
        </div>
    </foot>
    @endfor
</body>
</html>