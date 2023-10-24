<div class="akunuser">
    <div class="container-akunuser">
        <h3>Data Akun User Aplikasi</h3>
        <div class="tb-akunuser">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <th>instansi</th>
                    <th>nama</th>
                    <th>username</th>
                    <th>email</th>
                    <th>nomor hp</th>
                    <th>alamat</th>
                </tr>
                @foreach ($akun as $item)
                <tr>
                    <td>{{$item->instansi}}</td>
                    <td>{{$item->nama}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->no_hp}}</td>
                    <td>{{$item->alamat}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>