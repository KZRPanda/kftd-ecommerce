@if (sizeof($data_pesanan) < 1)
<div class="view-error">
    <h2>Tidak Ada Data</h2>
    <img class="img-error" src="{{asset('files/error-nd.png')}}" alt="">
</div>
@else
<table id="table" cellpadding="0" cellspacing="0" border="0">
<tr>
    <th>Kode Pesanan</th>
    <th>Status</th>
    <th>Username Pembeli</th>
    <th>Waktu Pesanan</th>
    <th style="max-width: 50px">Lama Pesan</th>
    <th>Logistik</th>
    <th>Fakturis</th>
    <th>Aksi</th>
</tr>
<?php $i = 0; ?>
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
    <td style="text-align: center">
        {{$item->lama}} hari
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
<?php $i++; ?>
@endforeach
</table>
@endif