<link rel="stylesheet" href="{{asset('css/dashboard/myship/component-ship/semua.css')}}">
<div class="semua">
    <?php $temp = 0; ?>
    @foreach ($result as $i)
        <div class="card" id="{{$i[0]->id_pesanan}}">
            <div class="header-pesanan">
                <div class="status-paket">
                    <p class="title-status">Status Pesanan :</p>
                    <p style="color: #203390;font-family: poppins-bold">
                        {{$i[0]->nama_status}}
                    </p>
                    <p style="float: right">{{$i[0]->waktu}}</p>
                </div>
            </div>
        @foreach ($i as $j)
            <div class="body-pesanan">
                <div class="gambar-pesanan">
                    <img src="{{asset('images/foto_obat/')}}/{{$j->gambar}}" alt="">
                </div>
                <div class="detail-pesanan">
                    <div class="detail1">
                        <p class="nama-obat">{{$j->nama_obat}}</p>
                        <p class="jumlah-obat">Jumlah pesanan : x{{$j->jum_pesanan}}</p>
                    </div>
                    <div class="detail2">
                        <p class="harga-obat">Rp.{{$j->harga_pesanan}}</p>
                    </div>
                </div>
            </div>  
        @endforeach
            <div class="footer-pesanan">
                <p class="title-total">Total Pesanan</p>
                <h3 class="total-pesanan">Rp.{{$j->total_pesanan}}</h3>
            </div>
            @if ($i[0]->status == "5")
                <div class="wrap-ket">
                    <p class="keterangan">
                        {{$i[0]->ket_tolak}}
                    </p>
                </div>
            @endif
            @if ($i[0]->status == "4")
                <button id_pesanan="{{$i[0]->id_pesanan}}">Beri Nilai Dan Rating</button>
            @endif  
            @if ($i[0]->status == "3")
                <button id_pesanan="{{$i[0]->id_pesanan}}" onclick="cekpesanan(this)">Cek Pesanan</button>
            @endif
            @if ($i[0]->status == "1")
                <button id_pesanan="{{$i[0]->id_pesanan}}" onclick="hapusCheckout(this)">Batalkan Pesanan</button>
            @endif  
        </div>    
    @endforeach
</div>