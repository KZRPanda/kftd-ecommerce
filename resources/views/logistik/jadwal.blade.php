<link rel="stylesheet" href="{{asset('css/logistik/component/jadwal.css')}}">
<div class="jadwal">
    <div class="tambah-jadwal">
        <h3>Tambah Jadwal</h3>
        <label for="">Tanggal Pengiriman</label>
        <input type="date" name="" id="">
        <label for="">Kode Pengiriman</label>
        <input type="text" name="" id="" placeholder="ex : 89912">
        <label for="">Kendaraan</label>
        <select name="" id="">
            <option value="1">BG-2312-AS</option>
            <option value="2">BG-8762-UK</option>
        </select>
        <input type="button" name="" id="" value="kirim data">
    </div>
    <div class="tb-jadwal">
        <table style="width: 100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 30%">Hari, Tanggal Pengiriman</th>
                <th style="width: 15%">Kode Pengiriman</th>
                <th style="width: 15%">Kendaraan</th>
                <th style="width: 35%">Lokasi Pesanan</th>
            </tr>

            <tr>
                <td>1</td>
                <td>Senin, 20 Desember 2022</td>
                <td>A-128821</td>
                <td>BG-61232</td>
                <td>Talang Ratu</td>
            </tr>
        </table>
    </div>
</div>