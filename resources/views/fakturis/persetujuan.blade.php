<script src="{{asset('js/fakturis/persetujuan.js')}}"></script>
<script src="{{asset('js/sweet-alert2.js')}}"></script>
<div class="dataPersetujuan">
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

        <div class="info">
            <i class="fad fa-info" aria-hidden="true"></i>
            <div class="wrap-info">
                <h4> Pembatalan Pesanan</h4>
                <ul>
                    <li>jika lama waktu pesanan sudah mencapai atau lebih dari 2 hari</li>
                    <li>jika salah satu diantara Logistik dan Fakturis menolak pesanan</li>
                </ul>
            </div>
        </div>

        <div id="tb_dataSetujuFakturis">
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
                            
                            admin="{{$item->admin}}"
                            logistik="{{$item->logistik}}"
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

    var requestData = "{{$data_pesanan}}"

    // function setujupesan(e){
    //     $(".kode_pembayaran").css("display","block")
    //     console.log(e.getAttribute("kode"))
    // }


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

    }
</script>