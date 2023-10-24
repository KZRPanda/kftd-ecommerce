<div class="barangKosong">
    <h3>Barang Kosong</h3>

    <div class="tb-barangkosong">
        @if (sizeof($semua) < 1)
            <div class="view-error">
                <h2>Tidak Ada Barang Kosong</h2>
                <img class="img-error" src="{{asset('files/error-nd.png')}}" alt="">
            </div>
        @else
            <table>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Harga Obat</th>
                    <th>Jumlah</th>
                </tr>
                <?php $i = 1; ?>
                @foreach ($semua as $item)
                    <tr>
                        <td style="text-align: center">{{$i++}}</td>
                        <td>{{$item->nama_obat}}</td>
                        <td>Rp.<?php echo(number_format($item->harga,0,",",".")) ?></td>
                        <td style="text-align: center">{{$item->stok}}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
</div>