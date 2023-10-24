<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("css/dashboard/hasil_pencarian.css")}}">
    <script src="{{asset("js/jquery.js")}}"></script>
    <title>Document</title>
</head>
<body>
    <div class="wrap-hasil-pencarian">
        <h3 class="title"></h3>
        {{$data}}
    </div>
</body>
<script>
    var x = 0;
    var temp;
    $.ajax({
        type: "get",
        url: "/cari?teks="+"{{$data}}&kategori="+"{{$kategori}}",
        success: function (response) {
            temp = response["barang"];

            $(".title").text("Tersedia "+temp.length+" barang yang anda cari")

            try {
                for (let i = x; i <= 11; i++) {
                let img = document.createElement("img")
                img.setAttribute("class","img-card")
                img.setAttribute("src","{{asset('files/kategori/kosmetik.jpg')}}")

                let gambar = document.createElement("div");
                gambar.setAttribute("class","gambar")
                gambar.setAttribute("temp",i)

                gambar.append(img)

                let nama_obat = document.createElement("p");
                nama_obat.setAttribute("class","nama_obat")
                nama_obat.innerText = temp[i].nama_obat

                let btn = document.createElement("button")
                btn.setAttribute("class","btn")
                btn.setAttribute("id_obat",temp[i].id_obat)
                btn.setAttribute("onclick","view(this)")
                btn.innerText = "Pesan"

                let harga_obat = document.createElement("p");
                harga_obat.setAttribute("class","harga_obat")
                harga_obat.innerText = "Rp."+temp[i].harga

                let card = document.createElement("div")
                card.setAttribute("class","card")

                card.append(gambar)
                card.append(nama_obat)
                card.append(harga_obat)
                card.append(btn)

                $(".wrap-hasil-pencarian").append(card)

                x = i
            }   
            } catch (error) {
                
            }
        }
    });

    function load_data(index){
        if(x + 1 <= temp.length - 1){
            for (let i = index+1; i <= index+11; i++) {
                let img = document.createElement("img")
                img.setAttribute("class","img-card")
                img.setAttribute("src","{{asset('files/kategori/kosmetik.jpg')}}")

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
                btn.setAttribute("id_obat",temp[i].id_obat)
                btn.setAttribute("onclick","view(this)")
                btn.innerText = "Pesan"

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
    }

    // $("button").on('scroll',function(){
    //     if()
    //     load_data(x)
    // })

    window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        if(x <= temp.length){
            load_data(x)
        }
    }
};
</script>
</html>