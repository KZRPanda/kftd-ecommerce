var data_all = []
var index = 0

function popout(){
    $("#snackbar").attr("class","snackbar snackbar_display")

    setTimeout(function(){ $("#snackbar").attr("class","snackbar") }, 2500);
}


function change(){
        $(".wait").css("display","none")   
        $(".img-view").css("display","block")   
        $("#contain-view").css("display","block")
        $(".view-barang").css("opacity","1")
}



function keranjang(username,id_obat,harga,nama,jum){
    var check = false;
    var total = parseInt(harga) * parseInt(jum);
    for (let i = 0; i < data_all.length; i++) {
        if(data_all[i].id_obat == id_obat){
            data_all[i].jumlah = jum
            total = data_all[i].jumlah * harga
            data_all[i].total = total
            check = true;
            break
        }
    }

    if(!check){
        data_all.push(
            {
                "username" : username,
                "id_obat" : id_obat,
                "nama_obat" : nama,
                "harga" : harga,
                "jumlah" : jum,
                "total" : total
            }
        )
    }

}


var jumlah = 0

function kurang_jum(data){
    var username = data.getAttribute("username")
    var id_obat = data.getAttribute("id_obat")
    var harga = data.getAttribute("harga")
    var nama = data.getAttribute("nama_obat")
    if(jumlah > 0){
        jumlah--
    }

    $(".jum").text(jumlah)

    keranjang(username,id_obat,harga,nama,jumlah)
}

function tambah_jum(data){
    var username = data.getAttribute("username")
    var id_obat = data.getAttribute("id_obat")
    var harga = data.getAttribute("harga")
    var nama = data.getAttribute("nama_obat")

    jumlah++
    $(".jum").text(jumlah)

    keranjang(username,id_obat,harga,nama,jumlah)
}

function pesan(e){
    let kategori = e.getAttribute("kategori")
    $(".view-barang").css("opacity","0")
    $("#contain-view").css("display","none")
    let id_obat = e.getAttribute("id_obat")
    if(jumlah > 0){
        if(kategori == "5" || kategori == "6" || kategori == "7"){
            $(".input-surat").css("display","block")
            $(".btn-kirim").attr("id_obat",id_obat)
        }else{
            data_all[0].id_file = 0
            $.ajax({
                type: "get",
                url: "/view/jumlah",
                data: data_all[0],
                success: function (response) {
                    popout();
                    data_all = []
                    jumlah = 0
                }
            });
        }
    }

    $.ajax({
        type: "get",
        url: "peakView",
        data: {"kodeBarang":id_obat}
    });

    $(".wait").css("display","block")   
    $(".img-view").css("display","none")   
    jumlah = 0;
    $(".jum").text(jumlah)    
}

function kirimSurat(e){
    var id_obat = e.getAttribute("id_obat")
    var file = $("#upload_surat").prop('files')[0];  
    var my_form = document.getElementById("formSurat")
    var form_data = new FormData(my_form);
    form_data.append("id_file",id_file);
    var namafile = file.name
    var splitfile = namafile.split(".")
    let tipeFile = splitfile[splitfile.length - 1]
    let tipeFileAll = ["pdf","word"]

    form_data.append("id_obat",id_obat)
    if(tipeFileAll.includes(tipeFile)){
        $.ajax({
            type: "post",
            url: "/kirim",
            data: form_data,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".input-surat").css("display","none")
                id_file = response;
                console.log(response)
                change()

                data_all[0].id_file = id_file

                $.ajax({
                    type: "get",
                    url: "/view/jumlah",
                    data: data_all[0],
                    success: function (response) {
                        popout();
                        console.log(response)
                        data_all = []
                        jumlah = 0
                        id_file = 0
                    }
                });
            }
        });
    
    }else{
        Swal.fire(
          'Tipe File Salah !',
          'File Harus Bertipe .PDF',
          'error'
        )
    }
}

function batalKirim(){
    $(".input-surat").css("display","none")
}