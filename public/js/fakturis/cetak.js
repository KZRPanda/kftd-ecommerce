function caridata() {
    var data = $(".input-cari").val()
    $.ajax({
        type: "get",
        url: "/fakturis/datafaktur/cari",
        data: {"data":data},
        success: function (response) {
            $("#tb-cetak-faktur").html(response)
        }
    });
}

function cetakfaktur(e){
    var kode = e.getAttribute("kode")
    window.open("/pdf/faktur?id="+kode)
}