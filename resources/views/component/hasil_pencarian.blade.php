<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/dashboard/hasil_pencarian.css")}}">
    <script src="{{asset("js/jquery.js")}}"></script>
    <script src="{{asset('js/temp.js')}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="input-surat">
        <form action="{{Route('upload_surat')}}" method="post" id="formSurat" enctype="multipart/form-data" >
            @csrf <!-- {{ csrf_field() }} -->
            <h3>Anda Wajib Memasukkan Surat Keterangan Untuk Memesan Obat Jenis Ini</h3>
            <input type="file" name="upload_surat"  id="upload_surat">
        </form>
        <button class="btn-kirim" onclick="kirimSurat(this)">Kirim</button>
        <button class="btn-batal" onclick="batalKirim()">Batalkan</button>
    </div>
    <div class="wrap-hasil-pencarian">
        <h3 class="title"></h3>
    </div>

</body>
<script>
    function change(){
        $(".wait").css("display","none")   
        $(".img-view").css("display","block")   
    }
    var files;

    var x = 0,y = 0;
    var temp;
    try {
        $.ajax({
            type: "get",
            url: "/cari?teks="+"{{$data}}&kategori="+"{{$kategori}}",
            success: function (response) {
                temp = response["barang"];

                if(temp.length >= 11){
                    y = 11
                }else{
                    y = temp.length - 1
                }

                console.log(y)

                $(".title").text("Tersedia "+temp.length+" barang yang anda cari")

                for (let i = x; i <= y; i++) {
                    let img = document.createElement("img")
                    img.setAttribute("class","img-card")
                    img.setAttribute("src","{{asset('images/foto_obat/')}}"+"/"+temp[i].gambar)

                    let gambar = document.createElement("div");
                    gambar.setAttribute("class","gambar")
                    gambar.setAttribute("temp",i)

                    gambar.append(img)

                    let nama_obat = document.createElement("p");
                    nama_obat.setAttribute("class","nama_obat")
                    nama_obat.innerText = temp[i].nama_obat

                    let btn = document.createElement("button")
                    btn.setAttribute("class","btn")
                    btn.setAttribute("dataAll",JSON.stringify(temp[i]))
                    btn.setAttribute("id_obat",temp[i].id_obat)
                    btn.setAttribute("kategori",temp[i].kategori)
                    btn.setAttribute("kategoriobat",temp[i].kategoriobat)
                    btn.setAttribute("onclick","view(this)")
                    btn.innerText = "Lihat"

                    let harga_obat = document.createElement("p");
                    harga_obat.setAttribute("class","harga_obat")
                    harga_obat.innerText = "Rp."+temp[i].harga

                    let card = document.createElement("div")
                    card.setAttribute("class","card")
                    card.setAttribute("kategori",temp[i].kategori)

                    card.append(gambar)
                    card.append(nama_obat)
                    card.append(harga_obat)
                    card.append(btn)

                    $(".wrap-hasil-pencarian").append(card)

                    x = i
                }
            }
        });        
    } catch (error) {
        
    }


    function view(input){
        let id_obat = input.getAttribute("id_obat")
        let js = JSON.parse(input.getAttribute("dataAll"))

        $(".wait").css("display","none")   
        $(".img-view").css("display","block")   
        $("#contain-view").css("display","block")
        $(".view-barang").css("opacity","1")

        $(".btn-pm").attr("nama_obat",js.nama_obat)
        $(".btn-pm").attr("id_obat",js.id_obat)
        $(".btn-pm").attr("harga",js.harga)
        $(".btn-pm").attr("kategori",js.kategoriobat)

        $(".nama-obat").text(js.nama_obat)
        $(".harga-obat").text("Rp."+js.harga)
        $(".cate").text(js.kategoriobat)

        $(".btn-pesan").attr("kategori",js.kategori)
        $(".btn-pesan").attr("id_obat",js.id_obat)
        $(".img-view").attr("src","{{asset('images/foto_obat/')}}"+"/"+js.gambar)
    }

    function load_data(index){
        try {
            if(x + 1 <= temp.length - 1){
            for (let i = index+1; i <= index+11; i++) {
                let img = document.createElement("img")
                img.setAttribute("class","img-card")
                img.setAttribute("src","{{asset('images/foto_obat/')}}"+"/"+temp[i].gambar)

                let gambar = document.createElement("div");
                gambar.setAttribute("class","gambar")
                gambar.setAttribute("temp",i)
                
                gambar.append(img)

                let nama_obat = document.createElement("p");
                nama_obat.setAttribute("class","nama_obat")
                nama_obat.innerText = temp[i].nama_obat

                let harga_obat = document.createElement("p");
                harga_obat.setAttribute("class","harga_obat")
                harga_obat.innerText = "Rp." + temp[i].harga

                let btn = document.createElement("button")
                btn.setAttribute("class","btn")
                btn.setAttribute("dataAll",JSON.stringify(temp[i]))
                btn.setAttribute("id_obat",temp[i].id_obat)
                btn.setAttribute("onclick","view(this)")
                btn.setAttribute("kategoriobat",temp[i].kategoriobat)
                btn.setAttribute("kategori",temp[i].kategori)
                btn.innerText = "Lihat"

                let card = document.createElement("div")
                card.setAttribute("class","card")

                card.append(gambar)
                card.append(nama_obat)
                card.append(harga_obat)
                card.append(btn)

                $(".wrap-hasil-pencarian").append(card)

                x = i
            }
        }   
        } catch (error) {
            
        }
    }

    window.onscroll = function(ev) {
        try {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                if(x <= temp.length){
                    load_data(x)
                }
            }   
        } catch (error) {
        }
};
</script>
</html>