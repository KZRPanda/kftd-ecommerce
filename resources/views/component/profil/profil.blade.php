<link rel="stylesheet" href="{{asset("css/dashboard/profil/profil.css")}}">
<script src="{{asset("js/sweet-alert2.js")}}"></script>
<script src="{{asset("js/edit_profil.js")}}"></script>
<div class="profil">
    <div class="container-profil">
        <div class="form">
            <h3>Profil Saya</h3>
            <div class="title">Kelola Akun Anda dan Mengontrol Informasi</div>
            <table>
                <tr>
                    <td>
                        <label for="">Username</label>
                    </td>
                    <td>
                        <p>{{$user_login->username}}</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Nama Lengkap</label>
                    </td>
                    <td>
                        <input type="text" name="" id="nama" value="{{$user_login->nama}}" class="ubah_nama">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Email</label>
                    </td>
                    <td>
                        <input type="email" name="" id="email" value="{{$user_login->email}}" class="ubah_email">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Password</label>
                    </td>
                    <td>
                        <input type="password" name="" id="password" value="{{$user_login->password}}" class="ubah_pass">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Nomor Handphone</label>
                    </td>
                    <td>
                        <input type="text" name="" id="no_hp" value="{{$user_login->no_hp}}">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Alamat</label>
                    </td>
                    <td>
                        <input type="text" name="" id="alamat" value="{{$user_login->alamat}}">
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="">Kecamatan</label>
                    </td>
                    <td>
                        <select name="" id="kec" class="kec select" >
                            @foreach ($kecamatan as $item)
                            @if ($item->id_kecamatan == $user_login->kecamatan)
                                <option value="{{$item->id_kecamatan}}" selected>{{$item->nama_kecamatan}}</option>                                                              
                            @else
                                <option value="{{$item->id_kecamatan}}">{{$item->nama_kecamatan}}</option>
                            @endif
                            @endforeach
                        </select><i class="fas fa-chevron-down bt"></i>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Kelurahan</label>
                    </td>
                    <td>
                        <select name="" id="kel" class="kel select">
                            @foreach ($kelurahan as $item)
                            @if ($item->id_kelurahan == $user_login->kelurahan)
                                <option value="{{$item->id_kelurahan}}" class="kelurahan" selected>{{$item->nama_kelurahan}}</option>                                
                            @else
                                <option value="{{$item->id_kelurahan}}" class="kelurahan">{{$item->nama_kelurahan}}</option>
                            @endif
                            @endforeach
                        </select><i class="fas fa-chevron-down bt"></i>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <button class="ubah" id="ubah_pass" username="{{$user_login->username}}" onclick="ubah(this)">Ubah Data</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>
    <div class="divider"></div>
    <div class="body-profil">
        <img src="{{ asset('images/'.$foto_profil[0]->nama_foto)}}" id="blah" alt="">
        <div class="files">
            <form action="/testing" method="post" enctype="multipart/form-data" id="form_data">
                @csrf <!-- {{ csrf_field() }} -->
                <input type="file" id="file" onchange="readURL(this)" class="file" name="temp">
                <i class="far fa-upload"></i>
            </form>
        </div>
    </div>
</div>
<script>   

</script>