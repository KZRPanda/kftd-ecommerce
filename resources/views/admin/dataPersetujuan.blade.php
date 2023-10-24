<div class="dataPersetujuan">
    <script src="{{asset('js/admin/dataSetuju.js')}}"></script>
    <script src="{{asset('js/sweet-alert2.js')}}"></script>
    <div class="container_dataPersetujuan">
        <div class="pencarian" style="cursor: pointer">
            <i class="fas fa-search"></i>
            <input type="text" autocomplete="off" id="cari" class="cari" placeholder="contoh : ACYCLOVIR 200 MG (DUS 100 TAB)">
        </div>
        <input type="text" onkeydown="limitdown(this)" onkeyup="limitup(this)" name="limit" id="limit" class="limit" value="10">
        <div class="action-page">
            <button onclick="prevDataSetuju()"> <i class="fas fa-chevron-left"></i> Prev Data</button>
            <Button onclick="nextDataSetuju()">Next Data <i class="fas fa-chevron-right"></i> </Button>
        </div>

        <div class="kode_pembayaran">
            <p>Setujui barang pesanan untuk username <span id="username" style="color: red">Ajid20</span> dengan id pesanan <span style="color: red" id="id_pesanan">4998234</span></p>
            <section class="surat" file="" onclick="opensurat(this)">
                <div class="ic">
                    <i class="fas fa-check" id="ic-surat" aria-hidden="true"></i>
                </div>
                <p class="ket">
                    Ada surat izin edar obat
                </p>
            </section>
            <button class="kode-kirim" >Setujui Pesanan</button>
            <button class="tolak">Tolak Pesanan</button>
            <button class="batal-kirim" onclick="batalKirim()">Batal</button>
        </div>

        <div id="tb_dataSetuju">
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
                        <button class="btn-setuju" data='<?php 
                            $datathis = [];
                            foreach ($item as $key) {
                                array_push($datathis,$key);
                            }
                            echo(json_encode($datathis));
                            ?>'
                            @if ($item->admin != 0)
                                disabled
                            @endif
                            file="{{$item->nama_file}}" id_pesanan="{{$item->id_pesanan}}" username="{{$item->username}}" onclick="setuju(this)"><i class="fas fa-check"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <p style="margin-top: 4px;"><small style="font-family: poppins-bold" class="pagenumber">page 1</small></p>
    </div>
</div>

<script>
    var dataAll,dataTemp,dataCur,x = 0,y = 0

    $(".kode-kirim").click(function(){
        let kode = $(this).attr("kodepesanan")
        $.ajax({
            type: "get",
            url: "/dataSetuju/setujui",
            data: {"kode":kode},
            success: function (response) {
                try {
                    if(response.status == "error"){
                        Swal.fire(
                          'Batal Melakukan Persetujuan!',
                          'data sudah disetujui',
                          'error'
                        )
                    }else{
                        $("#tb_dataSetuju").html(response)
                        $(".kode_pembayaran").css("display","none")
                    }
                } catch (error) {
                    
                }
            }
        });
    })

    $(".tolak").click(function(){
        let kode = $(this).attr("kodepesanan")
        console.log(kode)
        $(".btn-tolak").attr("id_pesanan",kode)
        $("#pesanTolak").val("pesanan dengan id pesanan "+kode+" ditolak")
        $(".tolak-pesanan").css("display","block")
    })

    function kirimTolak(params) {
        let id = params.getAttribute("id_pesanan");
        let msg = $("#pesanTolak").val()

        $.ajax({
            type: "get",
            url: "/dataSetuju/tolakPesanan",
            data: {'id':id,'msg':msg},
            success: function (response) {
                try {
                    if(response.status == "error"){
                        Swal.fire(
                          'heading',
                          'text',
                          'error'
                        )
                    }else{
                        $("#tb_dataSetuju").html(response)
                        $(".kode_pembayaran").css("display","none")
                        $(".tolak-pesanan").css("display","none")
                    }
                } catch (error) {
                    
                }
            }
        });
    }

    function batalTolak() {
        $(".tolak-pesanan").css("display","none")
    }

    function cekNull(e){
        if(e == ""){
            return true
        }
        for (let index = 0; index < e.length; index++) {
            if(e[index] != " "){
                return false
                break
            }
        }

        return true
    }

    function opensurat(e) {
        let datafile = e.getAttribute("file")
        let a = document.createElement("a")

        if(datafile != ""){
            a.setAttribute("href","{{asset('surat_keterangan')}}/"+datafile)
            a.click()   
        }

        console.log(datafile)
    }
</script>