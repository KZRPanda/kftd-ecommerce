<script src="{{asset('js/admin/dataPesan.js')}}"></script>
<div class="dataPesanan">
    <div class="view_dataPesan" id="view_dataPesan">

    </div>
    <div class="container_dataPesanan">
        <div class="wrap-datapesan">
            <div class="pencarian" style="cursor: pointer">
                <i class="fas fa-search"></i>
                <input type="text" autocomplete="off" id="cari" class="cari" placeholder="contoh : 34872343">
            </div>
            <input type="text" onkeydown="limitdown(this)" onkeyup="limitup(this)" name="limit" id="limit" class="limit" value="10">
            <div class="action-page">
                <button onclick="prevDataPesan()"> <i class="fas fa-chevron-left"></i> Prev Data</button>
                <Button onclick="nextDataPesan()">Next Data <i class="fas fa-chevron-right"></i> </Button>
            </div>
    
        </div>
        <div class="urutkan">
            <select name="urut" id="urut" onchange="ubahUrutan(this)">
                <option value="0">Kode Pesanan</option>
                <option selected="true" value="1">Waktu Pesanan</option>
                <option value="2">Total Pesanan</option>
            </select>

            <div class="pengurut" onclick="urutArrow(this)" urut="asc" id="pengurut">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
        <div id="tb_dataPesan">
            <table id="table">
                <tr>
                    <th>Kode Pesanan</th>
                    <th>Status</th>
                    <th>Username Pembeli</th>
                    <th>Total Pesanan</th>
                    <th>Waktu Pesanan</th>
                </tr>
                @foreach ($data_pesanan as $item)
                <tr kode="{{$item->id_pesanan}}" onclick="test(this)">
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
                        Rp.{{$item->total}}
                    </td>
                    <td>
                        {{$item->waktu}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <p style="margin-top: 10px;"><small style="font-family: poppins-bold" class="pagenumber">page 1</small></p>
    </div>
</div>

<script>
function test(e){
    let id = e.getAttribute("kode")
    $.ajax({
        type: "get",
        url: "{{Route('view_datapesan')}}",
        data: {"id": id},
        success: function (response) {
            $("#view_dataPesan").html(response)
            $("#view_dataPesan").css("display","block")
        }
    });
}

</script>