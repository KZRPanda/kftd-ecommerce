<script src="{{asset('js/logistik/pengiriman.js')}}"></script>
<div class="dataPengiriman">
    <div class="pengiriman">
        <div class="kiri">
            <button onclick="openBuat()">Buat Pengiriman</button>
            <table style="width: 99%" cellpadding="0" cellspacing="0">
                <tr>
                    <th>kode pesanan</th>
                    <th>username</th>
                    <th>kode pengiriman</th>
                    <th>alamat</th>
                    <th>tanggal pesan</th>
                </tr>
    
                @if (sizeof($pengiriman) < 1)
                    <tr>
                        <td colspan="4" style="font-size: 30px; text-align: center;font-family: poppins-bold">Data Kosong</td>
                    </tr>
                @endif
                @foreach ($pengiriman as $item)
                <tr>
                    <td>{{$item->id_pesanan}}</td>
                    <td>{{$item->username}}</td>
                    <td style="width: max-content; text-align: center">{{$item->kp}}</td>
                    <td>{{$item->alamat}}</td>
                    <td>{{$item->tanggal}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="kanan">
            <section class="cards">
                @for ($i = 0; $i < sizeof($dataAll); $i++)
                    <div class="row">
                    @for ($j = 1; $j <= 2; $j++)
                        <div class="col">
                            <div class="card">
                                <label for="">Kode Pengiriman</label>
                                <p>{{$dataAll[$i]->kode_pengiriman}}</p>
                                <label for="">Total Pesanan</label>
                                <p>{{$dataAll[$i]->jumlah}}</p>
                                <label for="">Proses</label>
                                <p>{{$dataAll[$i]->proses}}</p>
                                <label for="">Keterangan</label>
                                <p>{{$dataAll[$i]->keterangan}}</p>
                            </div>
                        </div>
                        @if ($i == sizeof($dataAll) - 1)
                            <?php break ?>
                        @endif
                        @if ($j != 2)
                            <?php $i++ ?>
                        @endif
                    @endfor
                    </div>
                @endfor

            </section>
        </div>
    </div>
</div>

<script>
    $(".card").click(function(){
    })

    function test() {
        for (let i = 0; i < 20; i++) {
            for (let j = 0; j < 3; j++) {
                console.log(i)
                i++
            }
            
        }
    }

    function openBuat(){
        $(".buat-pengiriman").css("display","block")
    }
</script>