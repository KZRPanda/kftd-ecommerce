function buatPengiriman(){
    let tanggal = $(".tglPengiriman").val()

    $.ajax({
        type: "get",
        url: "/logistik/pengiriman/buat",
        data: {"tgl":tanggal},
        success: function (response) {
            console.log(response)
            try {
                if(response.status == "error"){
                    Swal.fire(
                      'Gagal Membuat Data Pengiriman!',
                      'ada kesalahan yang terjadi',
                      'error'
                    )
                }else{
                    $(".container").html(response)
                }
            } catch (error) {
                
            }
            console.log(response)
        }
    });
}

function tutupPengiriman(){ 
    $(".buat-pengiriman").css("display","none")
}