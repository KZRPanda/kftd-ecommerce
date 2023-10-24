<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/admin/masterdata.js')}}"></script>
<script src="{{asset('js/sweet-alert2.js')}}"></script>
<section class="masterdata">
    <h3>Master Data</h3>
    <div class="container-masterdata">
        <section>
            <h5>Insert Data</h5>

            <div class="insert-csv">
                <form action="" method="post" id="insertcsv">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="wrap">
                        <p><small class="nama-file">pilih file csv anda</small></p>
                        <i class="fad fa-file-upload"></i>
                    </div>
                    <input onchange="csvfile(this)" type="file" name="temp" id="">
                </form>

                <button class="kirim-csv" onclick="kirimcsv()">kirim file csv</button>
            </div>

            <div class="wrap-garis">
                <p>atau</p>
            </div>

            <form method="POST" action="/masterdata/insert" class="form-input" id="form_data" enctype="multipart/form-data">
                @csrf <!-- {{ csrf_field() }} -->
                <label for="">Kode Obat</label>
                <input class="inputkode input" type="text" name="" id="">
                <label for="">Nama Obat</label>
                <input class="inputnama input" type="text" name="" id="">
                <label for="">Harga Obat</label>
                <input class="inputharga input" type="text" name="" id="">
                <label for="">Stok Obat</label>
                <input class="inputstok input" type="text" name="" id="">
                <label for="">Kategori Obat</label>
                <select name="" class="kategori" id="">
                    <option value="1">obat kosmetik</option>
                    <option value="2">obat bebas</option>
                    <option value="3">obat bebas terbatas</option>
                    <option value="4">obat keras</option>
                    <option value="5">obat psikotropika</option>
                    <option value="6">obat prekusor</option>
                    <option value="7">obat narkotika</option>
                </select>
                <label for="">Gambar Obat</label>
                <input type="file" class="inputimg input" onchange="inputimg(this)" name="thisfile" id="">

                <input type="button" onclick="sendinput()" value="Kirim Data">
            </form>
        </section>
        <section>
            <h5>Edit Data</h5>
            <div class="wrap-edit">
                <section class="cari">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="text" class="cariedit" name="" id="" placeholder="cari data disini">
                </section>

                <div class="garis"></div>

                <form method="POST" class="form-input" name="form-edit" id="form-edit">
                    @csrf <!-- {{ csrf_field() }} -->
                    <label for="">Kode Obat</label>
                    <input class="editkode edit" type="text" name="editkode" id="">
                    <label for="">Nama Obat</label>
                    <input class="editnama edit" type="text" name="editnama" id="">
                    <label for="">Harga Obat</label>
                    <input class="editharga edit" type="text" name="editharga" id="">
                    <label for="">Stok Obat</label>
                    <input class="editstok edit" type="text" name="editstok" id="">
                    <label for="">Kategori Obat</label>
                    <select name="editkategori" class="kategori" id="editkategori">
                        <option value="1">obat kosmetik</option>
                        <option value="2">obat bebas</option>
                        <option value="3">obat bebas terbatas</option>
                        <option value="4">obat keras</option>
                        <option value="5">obat psikotropika</option>
                        <option value="6">obat prekusor</option>
                        <option value="7">obat narkotika</option>
                    </select>
                    <label for="">Gambar Obat</label>
                    <img class="imgedit" src="{{asset('/images/foto_obat/img2.png')}}" name="editimg" alt="">
                    <input onchange="importEdit(this)" type="file" name="file" class="importedit edit" id="">
    
                    <input type="button" onclick="sendedit()" value="Kirim Data">
                </form>
            </div>
        </section>
        <section>
            <h5>Delete Data</h5>
            <div class="wrap-delete">
                <section class="cari">
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="text" class="caridelete" name="" id="" placeholder="cari data disini">
                </section>

                <div class="info-delete">
                    <i class="fad fa-info-circle" aria-hidden="true"></i>
                    <p>
                        klik kolom data pada tabel yang ingin dihapus,
                        lalu akan muncul kotak dialog untuk melakukan penghapusan data
                    </p>
                </div>

                <div class="tb-delete">
                    <table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <th style="width: 30%">kode obat</th>
                            <th style="width: 70%">nama obat</th>
                        </tr>
                        <tr style="background-color: #f2f2f2">
                            <td>43222</td>
                            <td>ACYCLOVIR 200 MG (DUS 100 TAB)</td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
</section>

<script>

var imgedit = null, editedimg = false

function importEdit(e) {
    let namafile = e.files[0].name
    imgedit = namafile
    editedimg = true
    //let datafile = "{{asset('/images/foto_obat/')}}/"+namafile

    setImg(e)
    //$(".imgedit").attr("src",datafile)
}

function setImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            // $('#prev')
            // .attr('src', e.target.result)
            $(".imgedit").css("display","block")
            $(".imgedit").attr("src",e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }        
}
var carieditset

$(".cariedit").keyup(function(){
    clearTimeout(carieditset)
    let dataobat
    let data = $(this).val()
    if(data != ""){
        carieditset = setTimeout(()=>{
            $.ajax({
                type: "get",
                url: "/api/masterdata/cari",
                data : {"txt":data},
                success: function (response) {
                    dataobat = response[0]

                    $(".editkode").val(dataobat.id_obat)
                    $(".editnama").val(dataobat.nama_obat)
                    $(".editstok").val(dataobat.stok)
                    $(".editharga").val(dataobat.harga)
                    $("#editkategori").val(dataobat.kategori)
                    $(".imgedit").css("display","block")
                    $(".imgedit").attr("src","{{asset('/images/foto_obat/')}}/"+dataobat.gambar)

                    imgedit = null
                    editedimg = false
                    $(".importedit").val("")
                }
            }); 
        }, 1000);
    }else if(data=="" || data== " "){
        $(".edit").val("")
        $(".imgedit").css("display","none")
    }
})


</script>