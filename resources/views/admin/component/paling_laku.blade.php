<table  border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th width="20%">Id Obat</th>
        <th>Nama Obat</th>
        <th width="100px">Banyak Pesanan</th>
    </tr>
    @if ($status == 'Berhasil')
        @foreach ($jum_pesan as $data)
        <tr onmouseover="changeTr1(this)" onmouseout="changeTr2(this)">
            <td>{{$data->id_obat}}</td>
            <td>{{$data->nama_obat}}</td>
            <td>{{$data->jum_pesan}}</td>
        </tr>
        @endforeach
    @else
    <tr>
        <td colspan="3"><h2 style="color: red">Data Tidak DItemukan</h2></td>
    </tr>
    @endif
</table>