<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{asset("js/jquery.js")}}"></script>
    <link rel="stylesheet" href="{{asset("css/regisview.css")}}">
    <link rel="stylesheet" href="{{asset("css/fontawesome/css/all.css")}}">
    <style>
        .kiri{
            background-size: cover;
            background-position: center;
            background-image: url('{{asset("files/cobaaaa.png")}}');
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="kiri">
            <h1>Daftar Akun Sekarang!</h1>
        </div>

        @for($i = 0; $i < 10; $i++)
            <p>hello world</p>
        @endfor

        <form class="kanan" action="{{route('daftarakun')}}" method="post" name="form_data" id="form_data">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="satu" id="satu">
                <div class="wrap-sign">
                    <div class="logo">
                        <img src="{{asset('files/logo_kf.png')}}" alt="">
                    </div>
                    <h1>Daftar Akun</h1>
                    <label for="username">username</label>
                    <input type="text" class="username" name="username" placeholder="contoh : myusername20">
                    <i class="fal fa-spinner" id="usr" input="username" ket="cek-usr"></i>
                    <p class="cek-usr">username sudah digunakan!</p>

                    <label for="email">password</label>
                    <input type="password" class="pass" name="pass" placeholder="contoh : pass12">

                    <label for="pass">konfirmasi password</label>
                    <input type="password" autocomplete="no" class="confirm-pass" name="confirm-pass" placeholder="contoh : pass12">
                    <p class="cek-pass">password tidak sama!</p>

                    <div class="wrap-step">
                        <div class="step">
                            <div class="bulat" id="first-bulat">
                                <span class="fas fa-times" id="bulat"></span>
                            </div>
                            <div class="garis"></div>
                            <div class="bulat"></div>
                            <div class="garis"></div>
                            <div class="bulat"></div>
                        </div>
                    </div>

                    <input type="button" class="next" onclick="klik()" value="next"></input>
                    <div class="xy"></div>
                </div>
            </div>
            <div class="dua" id="dua">
                <div class="wrap-sign">
                    <div class="logo">
                        <img src="{{asset('files/logo_kf.png')}}" alt="">
                    </div>
                    <label for="email">nama toko / apotek / rumah sakit</label>
                    <input type="text" class="instansi" name="instansi" placeholder="apotik maju mundur">

                    <label for="email">nama lengkap</label>
                    <input type="text" class="nama" name="nama" placeholder="nama saya">

                    <label for="email">email</label>
                    <input type="email" class="email" name="email" placeholder="myemail@gmail.com">
                    <i class="fal fa-spinner" id="eml" input="email" ket="cek-eml"></i>
                    <p class="cek-eml">email sudah digunakan!</p>

                    <label for="nohp">nomor hp</label>
                    <input type="text" class="nohp" name="nohp" placeholder="08714584552">

                    <label for="username">alamat</label>
                    <input type="text" class="alamat" name="alamat" placeholder="jl.example">

                    <label for="email">kecamatan</label>
                    <select name="kec" class="kec" id="">
                        @foreach ($kec["kecamatan"] as $item)
                            <option value="{{$item->id_kecamatan}}">{{$item->nama_kecamatan}}</option>
                        @endforeach
                    </select>

                    <label for="email">kelurahan</label>
                    <select name="kel" class="kel" id="kel">
                        @foreach ($kel as $item)
                        <option class="kelurahan" value="{{$item->id_kelurahan}}">{{$item->nama_kelurahan}}</option>
                        @endforeach
                    </select>

                    <div class="wrap-step">
                        <div class="step-dua">
                            <div class="bulat">
                                <span class="fas fa-check"></span>
                            </div>
                            <div class="garis" style="background-color:#110a44 "></div>
                            <div class="bulat" id="second-bulat">
                                <span class="fas fa-times" id="bulat-dua"></span>
                            </div>
                            <div class="garis"></div>
                            <div class="bulat"></div>
                        </div>
                    </div>

                    <input type="button" class="next" onclick="klikdua()" value="next"></inp>
                    <div class="xy"></div>
                </div> 
            </div>
            <div class="tiga" id="tiga">
                <div class="wrap-sign">
                    <div class="logo">
                        <img src="{{asset('files/logo_kf.png')}}" alt="">
                    </div>

                    <label for="prof">foto profil</label>
                    <input type="file"  id="prof" onchange="profimg(this)" name="prof">

                    <div class="foto-preview" style="display: none">
                        <img id="img-prev" alt="">
                    </div>

                    <div class="wrap-step">
                        <div class="step-tiga">
                            <div class="bulat">
                                <span class="fas fa-check"></span>
                            </div>
                            <div class="garis" style="background-color:#110a44 "></div>
                            <div class="bulat">
                                <span class="fas fa-check"></span>
                            </div>
                            <div class="garis" style="background-color:#110a44 "></div>
                            <div class="bulat" id="third-bulat">
                                <span class="fas fa-times" id="bulat-tiga"></span>
                            </div>
                        </div>
                    </div>

                    <input type="button" onclick="kliktiga()" value="next" class="next"></input>
                    <div class="xy"></div>
                </div>
            </div>  
        </form>
    </div>
</body>
<script src="{{asset("js/sweet-alert2.js")}}"></script>
<script src="{{asset("js/signup.js")}}"></script>
</html>