{{-- <script src="{{asset("js/jquery.js")}}"></script>
<script src="{{asset("js/app.js")}}"></script> --}}
<div class="jumbotron">
    <div class="text">
        <h1>Pesan Obat Obatan
            Secara Online Sekarang!<br>
            Kimia Farma TD Palembang
        </h1>
        <button>Pesan Sekarang!</button>
    </div>
    <img src="{{asset("files/iphone.png")}}" alt="">
</div>

<div class="container">
    <div class="paling-laku">
        <div class="container-title">
            <h1 class="title">Obat Yang Paling Banyak Dicari</h1>
        </div>
    
        <div class="cards">
            @foreach ($palingDicari as $data)
                <div class="card">
                    <div class="img-card">
                        <img src="{{asset("images/foto_obat")}}/{{$data->gambar}}" alt="">
                    </div>
                    <div class="text-card">
                        <p class="title-card">{{$data->nama_obat}}</p>
                        <p class="harga-card">Rp.{{$data->harga}}</p>
                        <small>dilihat {{$data->peak}} kali</small>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>

<script>
</script>
