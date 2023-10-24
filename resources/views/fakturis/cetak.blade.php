<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/fakturis/cetak.js')}}"></script>
<div class="data-faktur">
    <div class="container-transaksi">
        <h3>Data Faktur</h3>
        <div class="cari">
            <input type="text" class="input-cari" name="" placeholder="cari data disini" id="">
            <button onclick="caridata()">cari</button>
        </div>
        <div id="tb-cetak-faktur" class="tb">
            <table>
                <tr>
                    <th>No</th>
                    <th>Id Pesanan</th>
                    <th>Nama Pembeli</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal Pesan</th>
                    <th>Buat Faktur</th>
                </tr>
                <?php $i = 1;?>
                @foreach ($semua as $item)
                <tr>
                    <td style="text-align: center">{{$i++}}</td>
                    <td>{{$item->id_pesanan}}</td>
                    <td>{{$item->instansi}}</td>
                    <td style="text-align: center">{{$item->jum_pesanan}}</td>
                    <td>Rp.<?php echo(number_format($item->total_pesanan,0,",",".")) ?></td>
                    <td>{{$item->tanggal}}</td>
                    <td>
                        <div class="ic" kode="{{$item->id_pesanan}}" onclick="cetakfaktur(this)">
                            <i class="fal fa-file-pdf    "></i>
                        </div>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>