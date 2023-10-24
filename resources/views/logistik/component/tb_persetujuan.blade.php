<table id="table">
    <tr>
        <th>Kode Pesanan</th>
        <th>Status</th>
        <th>Username Pembeli</th>
        <th>Waktu Pesanan</th>
        <th>Logistik</th>
        <th>Admin</th>
        <th>Aksi</th>
    </tr>
    <?php $i = sizeof($all) - 1; ?>
    @foreach ($data_pesanan as $item)
    <tr kode="{{$item->id_pesanan}}"">
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
            {{$item->waktu}}
        </td>
        <td>
            @if ($item->logistik == 0)
            <div class="keterangan"  style="background-color: #f2f2f2; color: rgb(0, 0, 0);">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </div>
            @endif
            @if($item->logistik == 1)
            <div class="keterangan">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            @endif
            @if($item->logistik == 2)
            <div class="keterangan" style="background-color: #ff000037; color: red;">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            @endif
        </td>
        <td>
            @if ($item->admin == 0)
            <div class="keterangan"  style="background-color: #f2f2f2; color: rgb(0, 0, 0);">
                <i class="fa fa-minus" aria-hidden="true"></i>
            </div>
            @endif
            @if($item->admin == 1)
            <div class="keterangan">
                <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            @endif
            @if($item->admin == 2)
            <div class="keterangan" style="background-color: #ff000037; color: red;">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
            @endif
        </td>
        <td>
            <button class="btn-setuju" 
            dataAll= '<?php 
            $datathis = [];
            foreach ($all as $itemA) {
                foreach ($itemA as $key) {
                    if ($key->id_pesanan == $item->id_pesanan) {
                        array_push($datathis,$key);
                    }
                }
                
            }
            echo(json_encode($datathis));
            ?>' 

                @if ($item->logistik != 0)
                disabled
                @endif

                data='<?php 
                $datathis = [];
                foreach ($item as $key) {
                    array_push($datathis,$key);
                }
                echo(json_encode($datathis));
                ?>' 
                file="{{$item->nama_file}}" id_pesanan="{{$item->id_pesanan}}" username="{{$item->username}}" onclick="setuju(this)"><i class="fas fa-check"></i></button>
        </td>
    </tr>
    <?php $i--; ?>
    @endforeach
</table>