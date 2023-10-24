<div class="dataDisetujui">
    <script src="{{asset('js/sweet-alert2.js')}}"></script>
    <script src="{{asset('js/admin/diSetujui.js')}}"></script>
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
            <p>Kirim kode virtual account</p>
            <input type="text" name="" id="kodePembayaran" placeholder="e.x. 123456789" oninput="checking(this)">
            <button class="kode-kirim" kode="" onclick="kirim(this)" >Kirim Kode Pembayaran</button>
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
                @foreach ($data_setujui as $item)
                <tr kode="{{$item->id_pesanan}}">
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
                        <div class="keterangan">
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
                        <div class="keterangan">
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
                        <button class="btn-setuj" 
                            data='<?php 
                            $datathis = [];
                            foreach ($item as $key) {
                                array_push($datathis,$key);
                            }
                            echo(json_encode($datathis));
                            ?>' 
                            file="{{$item->nama_file}}" id_pesanan="{{$item->id_pesanan}}" username="{{$item->username}}" onclick="openKodeBayar(this)"><i class="fal fa-paper-plane"></i></button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <p style="margin-top: 4px;"><small style="font-family: poppins-bold" class="pagenumber">page 1</small></p>
    </div>
</div>

<script>
    function openKodeBayar(e){
        var data = JSON.parse(e.getAttribute("data"))
        let id = data[1]
        let username = data[5]
        $(".kode-kirim").attr("kode",id)
        $(".kode-kirim").attr("username",username)
        //console.log(data)
        document.getElementById("kodePembayaran").setAttribute("placeholder","username : "+username)
        $(".kode_pembayaran").css("display","block")
    }
</script>