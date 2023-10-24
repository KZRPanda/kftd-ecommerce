<table>

    @if (count($barang) > 0)
        @foreach ($barang as $item)

        <tr>
            <td onclick="recomend(this)" id="{{$item->kode_obat}}" namaObat="{{$item->nama_obat}}">{{$item->nama_obat}}</td>
        </tr>

        @endforeach
    @else
        <p style="color:red;"> <i class="fal fa-frown" style="padding-right:20px"></i> Barang tidak ditemukan</p>
    @endif
</table>

<script>
    function recomend(e){
        let nama = e.getAttribute("namaObat")
        $("#cari").val(nama)
        var teks = nama
        console.log(teks)
            $(".wrap-loading").css("display","block")
            $.ajax({
                type: "get",
                url: "/x",
                data:{"data":teks,"kategori":hasil_klik_gambar.toString()},
                success: function (response) {
                    $(".wrap-loading").css("display","none")
                    $(".wrap-body").html(response)
                }
            })  
            $(".hasil-pencarian").css("display","none")
            $(this).val("")
    }
</script>