<div class="dataDibayar">
    <div class="gambar-bukti">
        <div class="btn-ext" onclick="offgambar()">
            <i class="fas fa-times"></i>
        </div>
        <img id="gambarbukti" src="{{asset('bukti_pembayaran/')}}/b999f578402565.5ca3d7841bef2.jpg" alt="">
    </div>
    <div class="view-bukti">
        <h3>Bukti Pembayaran</h3>
        <section class="surat" onclick="setopen()">
            <div class="ic">
                <i class="fas fa-eye" aria-hidden="true"></i>
            </div>
            <p class="ket">
                Lihat bukti pembayaran
            </p>
        </section>
        <button class="btn1" id="btnSetuju" onclick="setujuDibayar(this)">setujui pesanan</button>
        <button class="btn2" onclick="offview()">batal</button>
    </div>
    <div class="container_dataDibayar">
        <section class="header">
            <div class="pencarian" style="cursor: pointer">
                <i class="fas fa-search"></i>
                <input type="text" autocomplete="off" id="cari" class="cari" placeholder="contoh : ACYCLOVIR 200 MG (DUS 100 TAB)">
            </div>
            <input type="text" onkeydown="limitdown(this)" onkeyup="limitup(this)" name="limit" id="limit" class="limit" value="10">
            <div class="action-page">
                <button onclick="prevDataSetuju()"> <i class="fas fa-chevron-left"></i> Prev Data</button>
                <Button onclick="nextDataSetuju()">Next Data <i class="fas fa-chevron-right"></i> </Button>
            </div>
        </section>

        <div id="tb_dataDibayar">
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
        </div>
    </div>
</div>

<script>
    function openImg(e){
        let id_pesanan = e.getAttribute("idPesanan")
        let file = e.getAttribute("file")
        document.getElementById("gambarbukti").setAttribute("src","{{asset('bukti_pembayaran/')}}/"+file)
        $(".view-bukti").css("display","block")
        $(".btn1").attr("kode",id_pesanan)
        $(".gambar-bukti").css("display","none")
    }

    function setopen(){
        $(".gambar-bukti").css("display","block")
    }

    function offview(){
        $(".view-bukti").css("display","none")
    }
    function offgambar(){
        $(".gambar-bukti").css("display","none")
    }
    function setujuDibayar(e){
        let id_pesanan = e.getAttribute("kode")
        $.ajax({
            type: "get",
            url: "/dataSetuju/dataDibayar/setuju",
            data: {"kode":id_pesanan},
            success: function (response) {
                console.log(response)
                try {
                    if(response.status == "error"){
                        Swal.fire(
                          'heading',
                          'text',
                          'error'
                        )
                    }else{
                        $(".view-bukti").css("display","none")
                        $("#tb_dataDibayar").html(response)
                    }
                } catch (error) {
                    
                }
            }
        });
    }
</script>