<script src="{{asset('js/jquery.js')}}"></script>
<script> 
$(".btl-data").click(function(){
    $("#dataEdit").css("display","none")
    $("#dataTambah").css("display","none")
})

function openEdit(e){
    var idObat = e.getAttribute("idObat")
    $(".pilihanKategori").removeAttr("selected")
    console.log($("#kategoriObat").val())
    $.ajax({
        type: "get",
        url: "api/cari_obat",
        data: {"queries":idObat},
        success: function (response) {
            var data = response["barang"][0]
            
            for(let i = 0;i < $(".pilihanKategori").length;i++){
                if($(".pilihanKategori")[i].getAttribute("txt") == data.kategori){
                    $(".pilihanKategori")[i].setAttribute("selected","selected")
                    $("#kategoriObat").val($(".pilihanKategori")[i].getAttribute("value"))
                    //console.log($(".pilihanKategori")[i].getAttribute("txt"))
                    break
                }
            }

            $("#editkode").val(data.id_obat)
            $("#editnama").val(data.nama_obat)
            $("#editharga").val(data.harga)
            //$("#kategoriObat").val(data.kategori)
            $("#dataEdit").css("display","block")   
        }
    });     
}
$(".cari").keyup(function (e) { 
    let txt = $(this).val()
    let jum = $('.limit').val()

    console.log(txt)
    if(e.which == 13){
        $.ajax({
        type: "get",
        url: "/dataBarang/cari",
        data: {"queries":txt,"jumlah":jum,"page":indexDataBarang},
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
    }
});
</script>
<div class="dataBarang" id="dataBarang">

    <div class="dataBarang-container" id="dataEdit">
        <h3>Edit Data Barang</h3>
        <div class="contain-tambah">
            <label for="">Kode Obat</label>
            <input id="editkode" type="text" placeholder="isi disini..">
            <label for="">Nama Obat</label>
            <input id="editnama" type="text" placeholder="isi disini..">
            <label for="">Harga Obat</label>
            <input id="editharga" type="text" placeholder="isi disini..">
            <label for="">Kategori Obat</label>
            <select name="" id="kategoriObat">
                <option class="pilihanKategori" txt="obat kosmetik" value="1">Obat Kosmetik</option>
                <option class="pilihanKategori" txt="obat bebas" value="2">Obat Bebas</option>
                <option class="pilihanKategori" txt="obat bebas terbatas" value="3">Obat Bebas Terbatas</option>
                <option class="pilihanKategori" txt="obat keras" value="4">Obat Keras</option>
                <option class="pilihanKategori" txt="obat psikotropika" value="5">Obat Psikotropika</option>
                <option class="pilihanKategori" txt="obat prekusor" value="6">Obat Prekusor</option>
                <option class="pilihanKategori" txt="obat narkotika" value="7">Obat Narkotika</option>
            </select>
            <button type="submit" class="btn-data" id="btn-edit" onclick="kirimEdit(this)">Edit</button>
            <button type="button" class="btl-data">Batal</button>
        </div>
    </div>

    <div class="dataBarang-contain">
        <h3 class="judul-all">Data Barang</h3>
        <?php $i = 1?>
        <div class="pencarian" style="cursor: pointer">
            <i class="fas fa-search" onmouseover="vInfo(this)" onmouseout="vInfoOut()"></i>
            <div class="info">
                <p><small>tekan tombol <b>ENTER</b> untuk mulai pencarian</small></p>
            </div>
            <input type="text" autocomplete="off" id="cari" class="cari"  placeholder="contoh : ACYCLOVIR 200 MG (DUS 100 TAB)">
        </div>
        <input type="text" onkeydown="limitdown(this)" onkeyup="limitup(this)" name="limit" id="limit" class="limit" value="15">
        <div class="action-page">
            <button onclick="prevDataBarang()"> <i class="fas fa-chevron-left"></i> Prev Data</button>
            <Button onclick="nextDataBarang()">Next Data <i class="fas fa-chevron-right"></i> </Button>
        </div>
        <div id="tb_dataBarang">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <th>No</th>
                    <th>Id Obat</th>
                    <th>Nama Obat</th>
                    <th>Harga Obat</th>
                    <th>Kategori</th>
                </tr>
                    @foreach ($data_pesanan as $item)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$item->id_obat}}</td>
                        <td>{{$item->nama_obat}}</td>
                        <td>{{$item->harga}}</td>
                        <td>{{$item->kategori}}</td>
                    </tr>
                    <?php $i++?>
                    @endforeach
            </table>
        </div>
    </div>

</div>