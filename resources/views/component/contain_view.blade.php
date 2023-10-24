<link rel="stylesheet" href="{{asset('css/view_barang.css')}}">
<link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}">
<div id="contain-view" class="contain-view">
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
            <img src="{{asset('images/foto_obat/')}}/img2.png" class="img-view" alt="">
        </div>
        <div class="body-view">
            <h3 class="nama-obat">Hello world</h3>
            <h2 class="harga-obat">Rp.10000</h2>
            <p class="cate" style="transform: translateY(-20px)">adw</p>
            <p class="stok">Stok 2000</p>
    
            <div class="btn-view">
                <div class="btn-t-k">
                    <button class="btn-pm" onclick="kurang_jum(this)" kategori="awfaw" username="{{session('id_user')}}" id_obat="a" harga="53443" nama_obat="fsef"><i class="fas fa-minus"></i></button>
                    <p class="jum" id="jum">0</p>
                    <button class="btn-pm" onclick="tambah_jum(this)" kategori="awfaw" username="{{session('id_user')}}" id_obat="a" harga="53443" nama_obat="fsef"><i class="fas fa-plus"></i></button>    
                </div>
            </div>
    
            <button class="btn-pesan" onclick="pesan(this)" kategori="dqq" id_obat="3232"> <i class="fal fa-shopping-cart"></i> Masukkan Keranjang</button>
        </div>
    </div>
</div>