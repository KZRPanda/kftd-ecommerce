<div class="datapiutang">
    <div class="container-datapiutang">
        <h3>Data Piutang</h3>

        <div class="tb-datapiutang">
            <table cellpadding="0" border="0">
                <tr>
                    <th>id piutang</th>
                    <th>id pesanan</th>
                    <th>username</th>
                    <th>total</th>
                    <th style="max-width: 100px">lama piutang (bulan)</th>
                </tr>
    
                @foreach ($all as $item)
                    <tr>
                        <td>{{$item->id_piutang}}</td>
                        <td>{{$item->id_pesanan}}</td>
                        <td>{{$item->username}}</td>
                        <td>Rp.{{$item->total}}</td>
                        <td style="text-align: center">{{$item->lama}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>