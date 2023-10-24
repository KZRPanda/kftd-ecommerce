<div class="suratKeterangan">
    <div class="card-penjelasan">
        <p>Surat keterangan (Surat Izin Edar Narkotika, Prekusor, dan Psikotropika) merupakan surat yang perlu dikirim oleh Customer saat akan memesan obat-obatan dengan kategori Psikotropika, Prekusor, atau Narkotika. Surat ini merupakan
            surat yang diterbitkan oleh pihak Menteri Kesehatan untuk memberikan izin pengedaran oabt-obat dengan kategori Psikotropika, Prekusor, dan Narkotika.
        </p>
    </div>
    <div class="btn-all">
        <div class="sort">
            <button>Urutkan <i class="fal fa-chevron-up"></i></button>
        </div>
        <div class="dump">
            <button onclick="viewSampahSK()">Sampah <i class="fal fa-trash"></i></button>
        </div>
    </div>
    <div class="wrap-sk">
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
</div>
<script>
function lihatFile(e){
    let surat = e.getAttribute("surat")
    var id_file = e.getAttribute("id_file")
    let link = document.createElement("a")
    link.setAttribute("href","{{asset('surat_keterangan/')}}"+"/"+surat)

    // link.click()

    window.open("{{asset('surat_keterangan/')}}"+"/"+surat,"_blank")

    $.ajax({
        type: "get",
        url: "api/file/sudahBaca",
        data: {"id_file":id_file},
        success: function (response) {
            console.log(response)
        }
    });
}
</script>