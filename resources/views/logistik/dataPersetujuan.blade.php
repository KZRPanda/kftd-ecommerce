<div class="dataPersetujuan">
    <div class="tolak-pesanan">
        <h4>Tolak Pesanan</h4>
        <section>
            <div class="pilih" ic="i1" v="stok tidak ada">
                <i class="fas fa-times i1" aria-hidden="true"></i>
                <p>Stok Tidak Ada</p>
            </div>
            <div class="pilih" ic="i2" v="alamat tidak jelas">
                <i class="fas fa-times i2" aria-hidden="true"></i>
                <p>Alamat Tidak Jelas</p>
            </div>
        </section>
        <textarea name="" id="pesanTolak" cols="50" rows="5" class="isiPesan">Pesanan anda dengan kode pesanan 0 ditolak
        </textarea>
        <button id_pesanan="" class="btn-tolak" onclick="kirimTolak(this)">kirim pesan pembatalan</button>
    </div>
    <div class="setujui-pesanan">
        <i class="fad fa-times-circle" aria-hidden="true" onclick="closeThis()"></i>
        <h3>Setujui Pesanan</h3>
        <table class="tb-setujui">
            <tr>
                <td style="width: 40%">kode pesanan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 55%" id="kodepesanan">32123</td>
            </tr>
            <tr>
                <td>Total Pesanan</td>
                <td>:</td>
                <td id="totalpesanan">Rp.43213123</td>
            </tr>
            <tr>
                <td colspan="3">
                    <div class="tb-dataAll" id="tb-dataAll">

                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3"><button id="setujui" onclick="setujupesan(this)">Setujui</button></td>
            </tr>
            <tr>
                <td colspan="3"><button onclick="tolakPesan()">Tolak Pesanan Barang</button></td>
            </tr>
        </table>
    </div>
    <script src="{{asset('js/logistik/dataSetuju.js')}}"></script>
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
            <p>Kirim kode pembayaran untuk username <span id="username" style="color: red">Ajid20</span> dengan id pesanan <span style="color: red" id="id_pesanan">4998234</span></p>
            <input type="text" name="" id="kodePembayaran" placeholder="e.x. 123456789" oninput="checking(this)">
            <section class="surat" file="" onclick="opensurat(this)">
                <div class="ic">
                    <i class="fas fa-check" id="ic-surat" aria-hidden="true"></i>
                </div>
                <p class="ket">
                    Ada surat izin edar obat
                </p>
            </section>
            <button class="kode-kirim" >Kirim Kode Pembayaran</button>
            <button class="batal-kirim" onclick="batalKirim()">Batal</button>
        </div>


        <div id="tb_dataSetuju">
            @if (sizeof($data_pesanan) < 1)
                <div class="view-error">
                    <h2>Tidak Ada Data</h2>
                    <img class="img-error" src="{{asset('files/error-nd.png')}}" alt="">
                </div>
            @else
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
                        foreach ($dataAll[$i] as $key) {
                            if ($key->id_pesanan == $item->id_pesanan) {
                                    array_push($datathis,$key);
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
                <?php $i++; ?>
                @endforeach
            </table>
            @endif
        </div>
        <p style="margin-top: 4px;"><small style="font-family: poppins-bold" class="pagenumber">page 1</small></p>
    </div>
</div>

<script>
    var dataAll,dataTemp,dataCur,x = 0,y = 0
    function closeThis() {
        $(".setujui-pesanan").css("display","none")
    }

    function kirimTolak(e) {  
        let msg = $("#pesanTolak").val()
        let id = e.getAttribute("id_pesanan")
        $("#pesanTolak").val("")

        $.ajax({
            type: "get",
            url: "/logistik/persetujuan/tolak",
            data: {"msg":msg,"id":id},
            success: function (response) {
                $(".container").html(response)
                console.log(response)
                
            }
        });

        $(".tolak-pesanan").css("display","none")
    }

    function tolakPesan() {
        $(".tolak-pesanan").css("display","block")
    }


    function nextDataSetuju(){
        if(y != dataAll.length){
            if(y + 10 <= dataAll.length){
                x = y
                y += 10
            }else if(y + 10 > dataAll.length){
                x = y
                y = dataAll.length
            }

            dataCur = JSON.stringify(dataAll.slice(x,y))
            dataTemp = dataAll.slice(x,y)

            reqdata()
        }

        
        // let x = document.createElement("a")
        // x.dow
    }

    function prevDataSetuju(){
        if(x != 0){
            if(dataAll.length - 10 >= 0){
                x -= 10
                y -= dataTemp.length
            }else if(dataAll.length - 10 < 0){
                x = 0
                y = 10
            }

            dataCur = JSON.stringify(dataAll.slice(x,y))
            dataTemp = dataAll.slice(x,y)

            reqdata()
        }

    }

    function reqdata() {
        console.log(dataCur)
        $.ajax({
            type: "get",
            url: "dataSetuju/load",
            data: {"data":dataCur},
            success: function (response) {
                $("#tb_dataSetuju").html(response)
            }
        }); 
    }

    $(".kode-kirim").click(()=>{
        var kodeBayar = $("#kodePembayaran").val()
        let data = {
            "kodeBayar" : kodeBayar,
            "id_pesanan" : id_pesanan,
            "username" : username
        }

        if(cekNull(kodeBayar)){
            Swal.fire(
              'Kode Bayar Tidak Dimasukkan!',
              'masukkan data yang benar',
              'error'
            )
        }else{
            $.ajax({
            type: "get",
            url: "/dataSetuju/kodeBayar",
            data: data,
            success: function (response) {
                $("#tb_dataSetuju").html(response)
                batalKirim()
            }
        });
        }
    })

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