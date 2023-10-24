<div class="dataTransaksi">
    <div class="container-transaksi">
        <h3>Data Transaksi</h3>
        <div id="tb-container-transaksi" class="tb">
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Pembeli</th>
                    <th>Nama Obat</th>
                    <th>Harga Obat</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Tanggal Pesan</th>
                </tr>
                <?php $i = 1;?>
                @foreach ($semua as $item)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->nama_obat}}</td>
                    <td>Rp.<?php echo(number_format($item->harga,0,",",".")) ?></td>
                    <td>{{$item->jum_pesanan}}</td>
                    <td>Rp.<?php echo(number_format($item->harga_pesanan,0,",",".")) ?></td>
                    <td>{{$item->tanggal}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>