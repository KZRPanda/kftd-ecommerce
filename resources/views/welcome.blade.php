<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *{
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        }
        table{
            width: 100%;
            margin-bottom: 40px;
            font-size: 13px
        }
        table tr th{
            font-size: 15px !important;
            padding: 5px 0px;
            background-color: #6478d93f;
        }
        table tr td{
            padding: 7px 7px;
        }
        h4{
            padding:0;
            margin: 0
        }
    </style>
</head>
<body>
    <h3>LAPORAN PENJUALAN BULAN {{$databulan}} 2022</h3>
    @php
        $batas = 23;
        $j = 0;
        $totjum = 0;
        $total = 0;
        $total_All = 0;
    @endphp
 
    @for ($i = $j; $i < sizeof($bulanIni); $i++)
        <table class="table" cellpadding="0" cellspacing="0" border="0">
            <thead>
                <tr style="">
                    <th>No</th>
                    <th>Pembeli</th>
                    <th>Nama Obat</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @for ($x = $i; $x < $i+$batas; $x++)
                @php
                    if($x == sizeof($bulanIni)){
                        break;
                    }
                @endphp
                @if ($x % 2 == 0)
                    <tr style="background-color: #e5e5e5">
                        <td style="text-align: center;width: 30px;" scope="row">{{$x+1}}</td>
                        <td>{{$bulanIni[$x]->instansi}}</td>
                        <td style="max-width:150px ;padding: 5px">{{$bulanIni[$x]->nama_obat}}</td>
                        <td style="text-align: center">{{$bulanIni[$x]->jum_pesanan}}</td>
                        <td>Rp.{{number_format($bulanIni[$x]->harga_pesanan,0,",",".")}}</td>
                        <td style="width: 120px;text-align: center">{{$bulanIni[$x]->waktu_pesan}}</td>
                    </tr>    
                @else
                    <tr style="background-color: #f1f1f1">
                        <td style="text-align: center;width: 30px;" scope="row">{{$x+1}}</td>
                        <td>{{$bulanIni[$x]->instansi}}</td>
                        <td style="max-width:150px ;padding: 5px">{{$bulanIni[$x]->nama_obat}}</td>
                        <td style="text-align: center">{{$bulanIni[$x]->jum_pesanan}}</td>
                        <td>Rp.{{number_format($bulanIni[$x]->harga_pesanan,0,",",".")}}</td>
                        <td style="width: 130px;text-align: center">{{$bulanIni[$x]->waktu_pesan}}</td>
                    </tr>    
                @endif
                    @php
                        $totjum += $bulanIni[$x]->jum_pesanan;
                        $total += $bulanIni[$x]->harga_pesanan;
                        $total_All += $bulanIni[$x]->harga_pesanan;
                        $j++;
                    @endphp
                @endfor
        
                @php
                    $i = $j - 1;
                    $batas = 24;
                @endphp
                <tr style=""> 
                    <td colspan="5" style="background-color: #6478d93f;;padding: 5px 7px;font-style: bold;font-size: 14px" >
                        <h4 style="text-align: right">Jumlah</h4>
                    </td> 
                    <td style="font-size: 13px;background-color: #6478d93f;">{{$totjum}} barang</td>
                </tr>
                <tr>
                    <td colspan="5" style="background-color: #6478d93f;text-align: right;padding: 5px 7px;font-style: bold;font-size: 14px" >
                        <h4>Subtotal</h4>
                    </td> 
                    <td style="background-color: #6478d93f;;font-size: 13px;">Rp {{number_format($total,2,",",".")}}</td>
                </tr>
                @if ($i + 10 >= sizeof($bulanIni))
                <tr>
                    <td colspan="5" style="border-top: 3px solid rgba(193, 77, 77, 0);background-color: #6478d93f;text-align: right;padding: 5px 7px;font-style: bold;font-size: 14px" >
                        <h4>Total</h4>
                    </td> 
                    <td style="border-top: 3px solid rgba(0, 0, 0, 0);background-color: #6478d93f;;font-size: 13px;">Rp {{number_format($total_All,2,",",".")}}</td>
                </tr>
                @endif

                @php
                $totjum = 0;
                $total = 0;
                @endphp
            </tbody>
        </table>    
    @endfor
</body>
</html>