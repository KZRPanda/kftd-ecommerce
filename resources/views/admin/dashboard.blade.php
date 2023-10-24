<div class="dashboard">
    <div class="top-dashboard">
        <div class="login-user">
            <p>Login Users</p>
            <div class="table-login-user">
                <table border="0">
                    <?php $i = $users_login->toArray()['from'];?>
                    @foreach ($users_login as $user)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->waktu_login}}</td>
                        </tr>
                        <?php $i++;;?>
                    @endforeach
                </table>
            </div>
            <div class="footer-login-user">
                <button onclick="prev_page()">Prev Data</button>
                <button onclick="next_page(this)" cur="{{$users_login->toArray()['to']}}" last="{{$users_login->toArray()['total']}}">Next Data</button>
            </div>
        </div>

        <div class="jum-barang-pesan">
            <div class="wrap-jum-barang">
                <p>5 Barang Paling Laku</p>
                <select name="" id="kategori_jum" onchange="kategori_jum(this)">
                    <option value="all">Semua</option>
                    <option value="bulan">Bulan Ini</option>
                    <option value="minggu">Minggu Ini</option>
                </select>
                <i class="fad fa-spinner spin"></i>
            </div>
            <div class="wr" id="wr">
                <table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <th width="20%">Id Obat</th>
                        <th>Nama Obat</th>
                        <th width="100px">Banyak Pesanan</th>
                    </tr>
                    <div id="jum_pesan_data">
                        @foreach ($jum_pesan as $data)
                        <tr onmouseover="changeTr1(this)" onmouseout="changeTr2(this)">
                            <td>{{$data->id_obat}}</td>
                            <td>{{$data->nama_obat}}</td>
                            <td>{{$data->jum_pesan}}</td>
                        </tr>
                        @endforeach
                    </div>
                </table>
            </div>
        </div>
    </div>
    <div class="bottom-dashboard">
        <div class="card" style="background: #E6F5FA;">
            <div class="w">
                <div class="detail-card">
                    <h3>Barang Diorder</h3>
                    <p>Barang diorder minggu ini</p>
                    <h2>{{$barang_seminggu}}</h2>
                </div>
            </div>
            <div class="statistik-card">
                <i class="fal fa-store"></i>
            </div>
        </div>
    
        <div class="card" style="background: #eefcef;">
            <div class="w">
                <div class="detail-card">
                    <h3>Online User</h3>
                    <p>User yang aktif</p>
                    <h2>1</h2>
                </div>
            </div>
            <div class="statistik-card">
                <i class="fal fa-user"></i>
            </div>
        </div>
    </div>

</div>