function kirim(param) {
    let kode_pembayaran = document.getElementById("kodePembayaran").value
    let id_pesanan = param.getAttribute("kode")
    let username = param.getAttribute("username")

    $.ajax({
        type: "get",
        url: "/dataSetuju/kodeBayar",
        data: {
            "kode" : id_pesanan,
            "kodeBayar" : kode_pembayaran
        },
        success: function (response) {
            console.log(response)
        }
    });
    //console.log(kode_pembayaran)
}

function batalKirim(){
    document.getElementById("kodePembayaran").value = ""
    $(".kode_pembayaran").css("display","none")
}

function checking(e){
    if(!isNaN(e.value)){
        e.value = e.value
        return true
    }else{
        e.value = e.value.substring(0,e.value.length - 1)
        return false
    }
}