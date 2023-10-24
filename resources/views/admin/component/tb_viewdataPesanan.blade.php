<i class="fas fa-times" style="float: right;position: fixed;cursor: pointer; padding: 3px" onclick="closetbView()"></i>
<?php $total = 0; ?>
<div class="data-view">
    <table class="tb-view-data">
        <tr>
            <th>Nama Obat</th>
            <th>Jumlah Pesanan</th>
            <th>Total</th>
        </tr>
        @foreach ($data_pesanan as $item)
        <tr>
            <td>{{$item->nama_obat}}</td>
            <td>{{$item->jum_pesanan}}</td>
            <td>Rp.{{$item->harga_pesanan}}</td>
        </tr>
        <?php $total += $item->harga_pesanan; ?>
        @endforeach
    </table>
</div>
<div style="margin-top: 15px" class="sub-total">
    <p style="color: red;font-family: poppins-bold">Total Pesanan : Rp.<?php echo $total;?></p>
</div>