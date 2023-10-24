<div class="sampahSK">
    <div class="card-penjelasan">
        <p>Setiap surat yang telah dibaca, maka akan otomatis dibuang ke tempat sampah. Data surat tidak dihapus sama sekali, tetapi hanya disimpan.</p>
    </div>
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
</div>

<script>
    function lihatFileThis(e){
        let surat = e.getAttribute("surat")
        let link = document.createElement("a")
        link.setAttribute("href","{{asset('surat_keterangan/')}}"+"/"+surat)
        window.open("{{asset('surat_keterangan/')}}"+"/"+surat,"_blank")
    }
</script>