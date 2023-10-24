function requestBulanIni(e){
    let bulan = e.getAttribute("bulan")
    let tahun = e.getAttribute("tahun")
    let dates = e.getAttribute("date")

    var data = {
        "bulan" : bulan,
        "tahun" : tahun,
        "date" : dates
    }

    $.ajax({
        type: "get",
        url: "fakturis/laporan/bulanIni",
        data: data,
        success: function (response) {
            $("#bulanini").html(response)
            console.log(response)     
        }
    });
}

function cetaklaporan() {
    var bulan = $("#bulan").val()
    var tahun = $("#tahun").val()

    var data = {"bulan" : bulan,"tahun" : tahun}

    $.ajax({
        type: "get",
        url: "/pdf/test",
        data: data,
        success: function (response) {
            if(response == "404"){
                Swal.fire(
                  'Data Tidak Ditemukan!',
                  'Tidak Ada Data Laporan Bulan Tersebut',
                  'error'
                )
            }else{
                window.open("/pdf/test?bulan="+bulan+"&tahun="+tahun)
            }
        }
    });
}