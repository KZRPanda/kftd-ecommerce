<i class="fas fa-times" onclick="batalpesan()"></i>
<h2>Cek Pesanan</h2>
<div class="data">
    <table>
        <tr>
            <td width="170px">Username</th>
            <td width="20px">:</td>
            <td width="500px">{{$dataAll[0]->username}}</td>
        </tr>
        <tr>
            <td>Kode Pesanan</td>
            <td>:</td>
            <td>{{$dataAll[0]->id_pesanan}}</td>
        </tr>
        <tr>
            <td>Tanggal Pesanan</td>
            <td>:</td>
            <td>{{$dataAll[0]->tgl_pesan}}</td>
        </tr>
    </table>

    <div class="isiCek">
        @for ($i = 0; $i < sizeof($dataAll) - 3; $i++)
            @if ($i == 0)
                <div class="row">
                    <div class="col main-c"></div>
                    <div class="col">
                        <h3 class="main">{{$dataAll[$i]->tgl_proses}}</h3>
                        <p>{{$dataAll[$i]->keterangan}}</p>
                    </div>
                </div>
            @endif
            @if($i != 0)
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <h3 class="main">{{$dataAll[$i]->tgl_proses}}</h3>
                        <p>{{$dataAll[$i]->keterangan}}</p>
                    </div>
                </div>            
            @endif
        @endfor

    </div>
</div>

<button>Barang Diterima</button>