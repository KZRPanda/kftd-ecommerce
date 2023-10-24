<link rel="stylesheet" href="{{asset('css/view_barang.css')}}">
<link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}">
<script src="{{asset('js/jquery.js')}}"></script>
<div class="komentar">
    <div class="dataKomentar">
        <div class="data">
            <h4 class="username">
                JamesAnderson12
            </h4>
            <p class="isiKomentar">
                Pengiriman cepat dan packing bagus
            </p>
            <small class="rating"><i class="fas fa-heart"></i> 5/5</small>
        </div>

        <div class="data">
            <h4 class="username">
                Apotek25
            </h4>
            <p class="isiKomentar">
                Barang yang diantar sesuai dengan pesanan
            </p>
            <small class="rating"><i class="fas fa-heart"></i> 5/5</small>
        </div>

        <div class="data">
            <h4 class="username">
                smiTh
            </h4>
            <p class="isiKomentar">
                Saya memesan 12 Dus, sedangkan yang dikirim hanya 10
            </p>
            <small class="rating"><i class="fas fa-heart"></i> 1/5</small>
        </div>
    </div>
</div>
<div class="view-barang" id="view-barang">
    <div class="gambar-barang">
        <i class="fas fa-spinner wait"></i>
        <img src="#" class="img-view" alt="">
    </div>
    <div class="body-view">
        <h3 class="nama-obat"></h3>
        <h2 class="harga-obat"></h2>
        <p class="cate" style="transform: translateY(-20px)"></p>
        <p class="stok" style="transform: translateY(-10px)"></p>

        <div class="btn-view">
            <div class="btn-t-k">
                <button class="btn-pm" onclick="kurang_jum(this)" kategori="{{$obat[0]->kategori}}" username="{{session('id_user')}}" id_obat="{{$obat[0]->id_obat}}" harga="{{$obat[0]->harga}}" nama_obat="{{$obat[0]->nama_obat}}"><i class="fas fa-minus"></i></button>
                <p class="jum" id="jum">0</p>
                <button class="btn-pm" onclick="tambah_jum(this)" kategori="{{$obat[0]->kategori}}" username="{{session('id_user')}}" id_obat="{{$obat[0]->id_obat}}" harga="{{$obat[0]->harga}}" nama_obat="{{$obat[0]->nama_obat}}"><i class="fas fa-plus"></i></button>    
            </div>
        </div>

        <button class="btn-pesan" onclick="pesan(this)" kategori="{{$obat[0]->id_kategori}}" id_obat="{{$obat[0]->id_obat}}"> <i class="fal fa-shopping-cart"></i> Masukkan Keranjang</button>
    </div>
</div>