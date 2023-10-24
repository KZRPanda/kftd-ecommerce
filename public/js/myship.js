function bayar(e){
    let kode_pembayaran = e.getAttribute("kodeBayar")
    let id_pesanan = e.getAttribute("id_pesanan")
    $(".form-bayar").css("display","block")
    $("#kirimBukti").attr("id_pesanan",id_pesanan)
    $("#kodePembayaran").text(kode_pembayaran)
}
function hapusCheckout(e){
    let id_pesanan = e.getAttribute("id_pesanan")
    Swal.fire({
      title: 'Hapus Pesanan',
      text: 'apakah anda yakin menghapus pesanan ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#fffff',
      confirmButtonText: 'hapus'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
            type: "get",
            url: "/myship/batalpesan",
            data: {"id":id_pesanan},
            success: function (response) {
                console.log(response)
                if(response == "200"){
                    Swal.fire(
                      'Pesanan Berhasil Dihapus!',
                      'pesanan dengan kode '+id_pesanan+" telah dihapus",
                      'success'
                    )
    
                    document.getElementById(id_pesanan).remove()
                }else{
                    alert(response)
                }
            }
        });
      }
    })

}

function kirim_bukti(e){
    var namafile = null
    let id_pesanan = e.getAttribute("id_pesanan")
    const tipeData = ["jpeg","jpg","png"]

    var file = $("#upload_bukti").prop('files')[0];  
    var my_form = document.getElementById("formKirimBukti")
    var form_data = new FormData(my_form);
    form_data.append("id_pesanan",id_pesanan);

    try{
        namafile = file.name
    }catch(error){

    } 

    if(namafile != null){
        var splitfile = namafile.split(".")
        let tipeFile = splitfile[splitfile.length - 1]  
        if(!tipeData.includes(tipeFile)){
            Swal.fire(
              'Tipe File Salah!',
              'Pastikan File Yang Anda Masukkan Betipe JPEG, PDF, PNG, Ataupun JPG.',
              'error'
            )

            $("#upload_bukti").val("")
        }else{
            console.log(form_data.getAll("upload_bukti"))
            $.ajax({
                type: "post",
                url: "/myship/kirimbukti",
                data: form_data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response == "true"){
                        Swal.fire(
                            'Berhasil!',
                            'File Berhasil Dikirim.',
                            'success'
                        ) 
    
                        $.ajax({
                            type: "get",
                            url: "/myship/belumbayar",
                            success: function (response) {
                                $(".wrap-container-ship").html(response)
                            }
                        });
    
                        $(".form-bayar").css("display","none")
                    }
                }
            });
        }
    }else{
        Swal.fire(
          'Data Tidak Ditemukan!',
          'data yang anda kirim tidak ditemukan, silahkan cari lagi',
          'error'
        )
    }
}

function tutupFormBayar(){
    $(".form-bayar").css("display","none")
}

function cekpesanan(e) {
    let kode = e.getAttribute("id_pesanan")

    $.ajax({
        type: "get",
        url: "/myship/cekPesanan",
        data: {"id_pesanan":kode},
        success: function (response) {
            $(".cekpesanan").css("display","block")
            $(".cekpesanan").html(response)
        }
    });
}

function batalpesan() {
    $(".cekpesanan").css("display","none")
}

function sudahBayar(e) {
    Swal.fire(
      'Pesanan Sudah Dibayar!',
      'pesanan ini sudah anda bayar',
      'error'
    )
}

function totop() {
    $(window).scrollTop(0)
}

$(window).scroll(function (e) { 
    if(window.scrollY > 100){
        $(".to-top").css("margin-right","120px")
        $(".to-top").css("transform","rotate(360deg)")
    }
    else if(window.scrollY <= 100){
        $(".to-top").css("margin-right","-50px")
        $(".to-top").css("transform","rotate(90deg)")
    }
});