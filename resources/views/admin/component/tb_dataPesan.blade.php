<table id="table">
    <tr>
        <th>Kode Pesanan</th>
        <th>Status</th>
        <th>Username Pembeli</th>
        <th>Total Pesanan</th>
        <th>Waktu Pesanan</th>
    </tr>
    @foreach ($data_pesanan as $item)
    <tr kode="{{$item->id_pesanan}}" onclick="test(this)">
        <td>
            {{$item->id_pesanan}}
        </td>
        <td>
            {{$item->nama_status}}
        </td>
        <td>
            {{$item->username}}
        </td>
        <td>
            Rp.{{$item->total}}
        </td>
        <td>
            {{$item->waktu}}
        </td>
    </tr>
    @endforeach
</table>