<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/logistik/dataBarang.js')}}"></script>
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
function vInfo(e) {
    $(".info").css("display","grid")
}

function vInfoOut(e) {
    $(".info").css("display","none")
}
$(".cari").keyup(function (e) { 
    let txt = $(this).val()
    let jum = $('.limit').val()

    console.log(txt)
    if(e.which == 13){
        $.ajax({
        type: "get",
        url: "logistik/databarang/cari",
        data: {"queries":txt,"jumlah":jum,"page":indexDataBarang},
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
    }
});

var timeLimit

function limitdown(){   
    clearTimeout(timeLimit)
}

function limitup(e){
    let jum = e.value
    clearTimeout(timeLimit)
    
    if((jum != 0) && (jum != "")){
        timeLimit = setTimeout(()=>{
            sendLimit(jum)
        },500)
    }
}

function sendLimit(jum){
    let txt = $(".cari").val()
    $.ajax({
        type: "get",
        url: "/dataBarang/cari",
        data:{"page":indexDataBarang,"jumlah":jum,"queries":txt},
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
}

var indexDataBarang = 1
function nextDataBarang(){
    indexDataBarang++
    let jum = document.getElementById("limit").value
    let txt = $("#cari").val()
    let data = {"page":indexDataBarang,"jumlah":jum,"txt":txt}
    console.log(data)
    $.ajax({
        type: "get",
        url: "/logistik/databarang/nextprev",
        data:data,
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
}

function prevDataBarang(){
    let jum = document.getElementById("limit").value
    let txt = $("#cari").val()
    let data = {"page":indexDataBarang,"jumlah":jum,"txt":txt}
    console.log(data)
    if(indexDataBarang > 1){
        indexDataBarang--
        $.ajax({
            type: "get",
            url: "/logistik/databarang/nextprev",
            data:{"page":indexDataBarang,"jumlah":jum,"txt":txt},
            success: function (response) {
                $("#tb_dataBarang").html(response)
            }
        });
    }
}
</script>
<div class="dataBarang" id="dataBarang">
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
                    <th>Stok</th>
                    <th>Harga Obat</th>
                    <th>Kategori</th>
                </tr>
                    @foreach ($data_pesanan as $item)
                    <tr onclick="testing(event)">
                        <td>{{$i}}</td>
                        <td>{{$item->id_obat}}</td>
                        <td>{{$item->nama_obat}}</td>
                        <td>{{$item->stok}}</td>
                        <td>Rp.<?php echo(number_format($item->harga,0,",",".")) ?></td>
                        <td>{{$item->kategori}}</td>
                    </tr>
                    <?php $i++?>
                    @endforeach
            </table>
        </div>
    </div>

</div>