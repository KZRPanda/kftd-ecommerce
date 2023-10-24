function csvfile(e){
    $(".insert-csv").css("height","150px")
    $(".kirim-csv").css("display","block")

    if(e.files[0] == undefined){
        $(".insert-csv").css("height","100px")
        $(".kirim-csv").css("display","none")
    }else{
        var file = e.files[0]
        let nama = file.name
        let tipe = nama.split(".")
        tipe = tipe[tipe.length - 1]

        if(tipe != "csv"){
            Swal.fire(
              'Tipe File Bukan CSV!',
              'silahkan pilih tipe file yang sesuai',
              'error'
            )
            $(".insert-csv").css("height","100px")
            $(".kirim-csv").css("display","none")
            $(".nama-file").text("pilih file csv anda")
        }else{

            $(".nama-file").text(nama)

        }
        console.log(tipe)
    }
}

var imginput = null;

function inputimg(e) {
    let file = e.files[0].name
    let tipe = file.split(".")
    tipe = tipe[tipe.length - 1]
    let tipeall = ["jpg","png","webg","jpeg"]

    if(tipeall.includes(tipe)){
        try {
            imginput = e
        } catch (error) {
            imginput = null
            console.log("error : "+error)
        }
    }else{
        e.value = ""
        Swal.fire(
          'File Bukan Gambar!',
          'silahkan pilih file gambar',
          'error'
        )
    }
    console.log(tipeall.includes(tipe))
}

function sendinput() {
    var my_form = document.getElementById("form_data")
    var form_data = new FormData(my_form);          
    
    let id = $(".inputkode").val()
    let nama = $(".inputnama").val()
    let harga = $(".inputharga").val()
    let stok = $(".inputstok").val()
    let kategori = $(".kategori").val()
    let img = imginput

    let dataverif = [id,nama,harga,stok,kategori,img]
    let cek = true

    dataverif.forEach(element => {
        if(element == "" || element == null){
            cek = false
        }
    });
    
    if(cek){
        form_data.append('file', img);
        form_data.append('nama', nama);
        form_data.append('kode', id);
        form_data.append('stok', stok);
        form_data.append('harga', harga);
        form_data.append('kategori', kategori);

        $.ajax({
            type: "post",
            url: "/masterdata/insert",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                if(response.status == "success"){
                    Swal.fire(
                      'Berhasil Input Data!',
                      'data berhasil diinput ke database',
                      'success'
                    )
                    $(".input").val("")
                }else if(response.status == "error"){
                    Swal.fire(
                      'Gagal Input Data!',
                      response.msg,
                      'error'
                    )
                }
            }
        });
    }else{
        Swal.fire(
          'Data Belum Lengkap!',
          'lengkapi data inputan',
          'error'
        )
    }
    //console.log(form_data.getAll("file"))
}

function sendedit() {
    var my_form = document.getElementById("form-edit")
    var form_data = new FormData(my_form); 
    let file = $(".imgedit").attr("src")
    let filename = file.split("/")
    filename = filename[filename.length-1]

    if(imgedit != null || imgedit == ""){
        filename = imgedit
    }

    form_data.append("fileedit",filename)
    form_data.append("edited",editedimg)
    $.ajax({
            type: "post",
            url: "/masterdata/update",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response)
                if(response.status == "success"){
                    Swal.fire(
                      'Berhasil Input Data!',
                      'data berhasil diinput ke database',
                      'success'
                    )

                    $(".edit").val("")
                    $(".imgedit").css("display","none")
                }else if(response.status == "error"){
                    Swal.fire(
                      'Gagal Input Data!',
                      response.msg,
                      'error'
                    )
                }
            }
        });
}

function kirimcsv() {
    var my_form = document.getElementById("insertcsv")
    var form_data = new FormData(my_form); 

    $.ajax({
        type: "post",
        url: "/masterdata/insert/csv",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.status == "error"){
                Swal.fire(
                  'Data Sudah Ada!',
                  'gagal menginput data karena data sudah ada',
                  'error'
                )
            }else if(response.status == "success"){
                Swal.fire(
                  'Berhasil Input Data!',
                  'data sudah berhasil dimasukkan kedatabase',
                  'success'
                )
            }
            console.log(response)
        }
    });
}
$.ajax({
    type: "get",
    url: "/api/masterdata/all",
    success: function (response) {
        $(".tb-delete").html(response)
        //console.log(response)
    }
});

function hapusdata(e) {
    let data = {"kode" : e.getAttribute("kode"),"nama" : e.getAttribute("nama")}
    Swal.fire({
      title: 'Hapus Data Obat!',
      text: 'anda yakin obat dengan kode '+e.getAttribute("kode")+' ini akan dihapus?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#ec2828',
      cancelButtonColor: '#757575',
      cancelButtonText : 'Batal',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/masterdata/delete",
            data: data,
            success: function (response) {
                $(".tb-delete").html(response)
                Swal.fire(
                  'Berhasil!',
                  'obat '+e.getAttribute("kode")+' berhasil dihapus',
                  'success'
                )
            }
        });
      }
    })
    //console.log(data)
}