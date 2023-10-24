<link rel="stylesheet" href="{{asset('css/dashboard/myship/component-ship/semua.css')}}">
<div class="semua">
    <?php $temp = 0; ?>
    @foreach ($result as $i)
        <div class="card">
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
                    <img src="{{asset('files/borex.jpg')}}" alt="">
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
            @if ($i[0]->status == "2")
                <button>Cek Pesanan</button>
            @endif
        </div>    
    @endforeach
</div>