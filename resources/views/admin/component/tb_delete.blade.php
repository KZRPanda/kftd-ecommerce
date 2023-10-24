    <table border="0" cellspacing="0" cellpadding="0">
        <tr style="padding:10px 0px 10px 0px">
            <th style="width: 30%;text-align: center">kode obat</th>
            <th style="width: 70%;text-align: center">nama obat</th>
        </tr>
        <?php
            $i = 0;
        ?>
        @foreach ($all as $item)
            @if ($i % 2 == 0)
                <tr onclick="hapusdata(this)" kode="{{$item->id_obat}}" nama="{{$item->nama_obat}}" style="background-color: #f2f2f2">
                    <td>{{$item->id_obat}}</td>
                    <td>{{$item->nama_obat}}</td>
                </tr>
            @else
                <tr onclick="hapusdata(this)" kode="{{$item->id_obat}}" nama="{{$item->nama_obat}}" style="background-color: #dfdfdf">
                    <td>{{$item->id_obat}}</td>
                    <td>{{$item->nama_obat}}</td>
                </tr>
            @endif

            <?php
                $i = $i + 1;
            ?>
        @endforeach
    </table>