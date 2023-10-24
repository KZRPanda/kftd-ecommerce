<nav>
    <div class="logo" onclick="home()">
        <img src="{{asset("files/logo_kf.png")}}" alt="">
    </div>
    <div class="pencarian" id="pencarian">
        <i class="far fa-search"></i>
        <input type="text" class="cari" placeholder="cari barang disini" id="cari" autocomplete="off">
        <button class="btn-kategori" id="btn-kategori">Kategori</button>
    </div>
    <div class="cart" onclick="chart()">
        <i class="far fa-shopping-cart"></i>
    </div>
    <div class="profile">
        <div class="gambar-profile">
            <img id="img-profil-header" style="width: 100%;height: 100%;" src="../images/{{$foto_profil->nama_foto}}" alt="">
        </div>
    </div> 
</nav>
<script src="{{asset("js/jquery.js")}}"></script>
<script src="{{asset("js/app.js")}}"></script>