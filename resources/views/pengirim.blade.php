<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/pengirim/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome/css/all.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <h3>Website Cekpoin Pengiriman</h3>

            <div class="prof">
                <img src="{{asset('files/default_prof.jpg')}}" alt="">
            </div>
        </div>
        <div class="setpoin">
            <div class="ic">
                <i class="fad fa-map-marker-alt" aria-hidden="true"></i>
            </div>
            <p>update cekpoin</p>
        </div>
        
        <div class="update-cekpoin">
            <label for="">Proses</label>
            <input type="text" name="" id="">
            <label for="">Keterangan</label>
            <textarea name="" id="" style="width: 100%" rows="5"></textarea>

            <button class="btn-update">update cekpoin</button>
            <button class="btn-batal">batal</button>
        </div>

        <table>
            <tr>
                <th>Username</th>
                <th>Nomor HP</th>
                <th>Proses</th>
                <th>Keterangan</th>
                <th>Alamat</th>
            </tr>
            @foreach ($all as $item)
                <tr>
                    <td>
                        <p>
                            {{$item->nama}}        
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$item->no_hp}}        
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$item->proses}}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$item->keterangan}}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{$item->alamat}}
                        </p>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>