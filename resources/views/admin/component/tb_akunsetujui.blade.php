<table cellpadding="0" cellspacing="0" border="0">
    <tr>
        <th>instansi</th>
        <th>nama</th>
        <th>username</th>
        <th>email</th>
        <th>nomor hp</th>
        <th>alamat</th>
        <th>waktu</th>
        <th style="width: max-content">aksi</th>
    </tr>
    @foreach ($akun as $item)
    <tr>
        <td>{{$item->instansi}}</td>
        <td>{{$item->nama}}</td>
        <td>{{$item->username}}</td>
        <td>{{$item->email}}</td>
        <td>{{$item->no_hp}}</td>
        <td>{{$item->alamat}}</td>
        <td>{{$item->updated_at}}</td>
        <td style="width: max-content">
            <button username="{{$item->username}}" onclick="setujuakun(this)">setujui</button>
            <button username="{{$item->username}}" onclick="tolakakun(this)">tolak</button>
        </td>
    </tr>
    @endforeach
</table>