<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/fakturis/laporan.js')}}"></script>
<script src="{{asset('js/sweet-alert2.js')}}"></script>
<div class="laporan-container">
    <h3>Laporan Penjualan</h3>
    <div class="cetaklaporan">
        <select name="" id="bulan" class="bln">
            @for ($i = 1; $i <= 12; $i++)
                <option value="{{$i}}" 
                    @if (date('m') == $i)
                        selected
                    @endif
                >{{$i}}</option>
            @endfor
        </select>
        <select name="" id="tahun" class="thn">
            @for ($i = 2021; $i <= 2022; $i++)
                <option value="{{$i}}"
                    @if (date('y') == substr(strval($i),2,3))
                        selected
                    @endif
                >{{$i}}</option>
            @endfor
        </select>
        <button onclick="cetaklaporan()">Cetak Laporan</button>
    </div>
    <div class="wrap-contain">
        <div class="tb-laporan bulanan">
            <h4>Laporan Bulanan</h4>
            <table class="table" cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
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
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    @if (sizeof($bulanIni) < 1)
                        <tr>
                            <td colspan="6">
                                <h3 style="text-align: center">Tidak Ada Data Bulan Ini!</h3>
                            </td>
                        </tr>                        
                    @else
                        @foreach($bulanIni as $item)
                        <tr>
                            <td style="text-align: center" scope="row">{{$i++}}</td>
                            <td style="max-width: 100px">{{$item->id_obat}}</td>
                            <td>{{$item->nama_obat}}</td>
                            <td style="text-align: center">{{$item->jum_pesanan}}</td>
                            <td>Rp.{{$item->harga_pesanan}}</td>
                            <td style="max-width: 50px">{{$item->waktu_pesan}}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>