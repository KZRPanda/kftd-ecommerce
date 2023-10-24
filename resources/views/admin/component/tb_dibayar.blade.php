<table id="table" border="0" cellspacing="0">
    <tr>
        <th style="width: 20%">Id Pesanan</th>
        <th style="width: 20%">Username</th>
        <th style="width: 25%">Total Pesanan</th>
        <th style="width: auto">Bukti Pembayaran</th>
        <th style="width: 15%">Aksi</th>
    </tr>
    @foreach ($dibayar as $item)
    <tr>
        <td>{{$item->id_pesanan}}</td>
        <td>{{$item->username}}</td>
        <td>{{$item->total}}</td>
        <td>
            <p>
                {{$item->file_bukti}}
            </p>
        </td>    
        <td>
            <div class="ac" onclick="openImg(this)"
                idPesanan="{{$item->id_pesanan}}"
                username="{{$item->username}}"
                total="{{$item->total}}"
                file="{{$item->file_bukti}}"
            >
                <i style="text-align: center" class="fa fa-check" aria-hidden="true"></i>
            </div>
        </td>
    </tr>    
    @endforeach
</table>