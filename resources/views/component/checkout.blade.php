<link rel="stylesheet" href="{{asset('css/checkout/checkout.css')}}">
<script language="JavaScript" src="{{asset('js/checkout.js')}}"></script>
<style>
.btn-t-k{
    background-color: transparent;
    width: max-content;
    display: grid;
    border: 1px solid rgb(225, 225, 225);
    height: 35px;
    margin-left: 50%;
    transform: translateX(-50%);
    grid-template-areas: 'left mid right';
    grid-template-columns: 35px 50px 35px;
    grid-template-rows: 35px;
}
.btn-t-k button{
    height: 35px;
    border: 0px solid rgb(214, 214, 214);
    cursor: pointer;
    color: grey;
}
.btn-t-k .jum{
    background-color:transparent;
    height:35px;
    width: 50px;
    margin: 0;
    margin-top: 5px; 
    text-align: center;
    font-size: 16px;
    padding: 0;
}
</style>
<div class="checkout">
    <div class="body-checkout">
        @foreach ($pesanan as $item)
        <div class="card-checkout" id="card{{$item->id_obat}}">
            <div class="gambar-checkout">
                <img src="{{asset('images/foto_obat/')}}/{{$item->gambar}}" alt="">
            </div>
            <div class="nama-checkout">
                <p>{{$item->nama_obat}}</p>
                <p>{{$item->harga}}</p>
            </div>
            <div class="btn-t-k">
                <button class="btn-pm" onclick="kurang_jum_check(this)" username="{{session('id_user')}}" id_obat="{{$item->id_obat}}" harga="{{$item->harga}}" jumlah="{{$item->jumlah}}"><i class="fas fa-minus"></i></button>
                <p class="jum" id="{{$item->id_obat}}">{{$item->jumlah}}</p>
                <button class="btn-pm" onclick="tambah_jum_check(this)" username="{{session('id_user')}}" id_obat="{{$item->id_obat}}" harga="{{$item->harga}}" jumlah="{{$item->jumlah}}"><i class="fas fa-plus"></i></button>    
            </div>
            <div class="harga">
                <p class="harga-barang {{$item->id_obat}}" id="harga{{$item->id_obat}}">Rp.{{$item->total}}</p>
            </div>
            <div class="batal">
                <i class="fas fa-times" kodecard="card{{$item->id_obat}}" onclick="batalcheckout(this)"></i>
                {{-- <button class="btn-hapus-checkout" id_obat="{{$item->id_obat}}" onclick="hapusCheckout(this)">Hapus Pesanan</button> --}}
            </div>
        </div>
        @endforeach
    </div>

    <div class="summary">
        <h3>Checkout Info</h3>
        <div class="body-summary">
            <section>
                <h5>Jumlah barang</h5>
                <p id="jumlahtot">{{$jumlah}}</p>
            </section>

            <section>
                <h5>Kode Promo</h5>
                <input type="text" onkeyup="kodepromo(this)" name="promo" id="promo" placeholder="00-000-000-000">
            </section>

            <section>
                <h5>Total Belanja</h5>
                <p id="hargatot">Rp.{{$total}}</p>
            </section>
        </div>
        <button onclick="pesanBarang()">checkout</button>
    </div>
    {{-- <div class="footer-checkout">
        <h2>Total</h2>
        <h3 id="totalPesan" total="{{$total}}">Rp.{{$total}}</h3>
        <button onclick="pesanBarang()">Pesan Semua</button>
    </div> --}}
</div>

<script>
</script>