@if ($date)
<h4 class="title_laporan">Laporan Bulan {{$date}}</h4>
@else
<h4 class="title_laporan">Laporan Bulan Ini</h4>
@endif
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
        @foreach($bulanIni as $item)
        <tr>
            <td style="text-align: center" scope="row">{{$i++}}</td>
            <td style="max-width: 100px">{{$item->id_obat}}</td>
            <td style="max-width: 200px">{{$item->nama_obat}}</td>
            <td style="text-align: center">{{$item->jumlah}}</td>
            <td style="text-align: center">{{$item->stok}}</td>
        </tr>
        @endforeach
    </tbody>
</table>