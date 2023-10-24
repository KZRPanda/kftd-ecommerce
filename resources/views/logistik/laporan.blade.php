<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/logistik/laporan.js')}}"></script>
<div class="laporan-container">
    <h3>Laporan Penjualan</h3>

    <div class="wrap-contain">
        <div class="tb-laporan bulanan">
            <h4>Laporan Bulanan</h4>
            <table class="table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Bulan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                        $databulan = [null,"januari","februari","maret","april","mei","juni",
                        "juli","agustus","september","oktober","november","desember"];
                    ?>
                    @foreach($bulanan as $item)
                    <tr>
                        <td style="text-align: center" scope="row">{{$i++}}</td>
                        <td style="text-align: center">{{$item->jumlah}}</td>
                        <td>Rp.{{$item->total}}</td>
                        <td>{{$databulan[$item->bulan]}} {{$item->tahun}}</td>
                        <td><button onclick="requestBulanIni(this)" date="{{$databulan[$item->bulan]}} {{$item->tahun}}" tahun="{{$item->tahun}}" bulan="{{$item->bulan}}"><i class="fas fa-eye" aria-hidden="true"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tb-laporan bulanan" id="bulanini">
            <h4>Laporan Bulan Ini</h4>
            <table class="table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Obat</th>
                        <th>Nama Obat</th>
                        <th>Jumlah Terjual</th>
                        <th>Stok Sekarang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @if (sizeof($bulanIni) >= 1)
                        @foreach($bulanIni as $item)
                        <tr>
                            <td style="text-align: center" scope="row">{{$i++}}</td>
                            <td style="max-width: 100px">{{$item->id_obat}}</td>
                            <td style="max-width: 200px">{{$item->nama_obat}}</td>
                            <td style="text-align: center">{{$item->jumlah}}</td>
                            <td style="text-align: center">{{$item->stok}}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align: center">
                                <h3>Data Transaksi Bulan Ini Belum Ada!</h3>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>