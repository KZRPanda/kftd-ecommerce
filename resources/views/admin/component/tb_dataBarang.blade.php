

<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th>No</th>
        <th>Id Obat</th>
        <th>Nama Obat</th>
        <th>Harga Obat</th>
        <th>Kategori</th>
    </tr>
    <div>
        <?php $i = $data_pesanan->toArray()["from"] ?>
        @foreach ($data_pesanan as $item)
        <tr>
            <td>{{$i}}</td>
            <td>{{$item->id_obat}}</td>
            <td>{{$item->nama_obat}}</td>
            <td>{{$item->harga}}</td>
            <td>{{$item->kategori}}</td>
        </tr>
        <?php $i++?>
        @endforeach
    </div>
</table>