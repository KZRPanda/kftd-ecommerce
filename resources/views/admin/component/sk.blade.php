@foreach ($surats as $surat)
<div class="card-surat">
    <input type="checkbox" name="klik" id="">
    <div class="id_pesanan">
        <p>{{$surat->id_pesanan}}</p>
    </div>
    <div class="id_obat">
        <p>{{$surat->nama_obat}}</p>
    </div>
    <div class="nama_obat">
        <p>{{$surat->username}}</p>
    </div>
    <div class="username">
        <p>{{$surat->tanggal}}</p>
    </div>
    <div class="nama_file">
        <p>{{$surat->nama_file}}</p>
    </div>
    <div class="lihat" surat="{{$surat->nama_file}}" id_file="{{$surat->id_file}}" onclick="lihatFile(this)">
        <i class="far fa-file"></i>
    </div>
</div>
@endforeach