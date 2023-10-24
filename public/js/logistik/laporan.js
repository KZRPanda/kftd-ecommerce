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
        url: "logistik/laporan/bulanIni",
        data: data,
        success: function (response) {
            $("#bulanini").html(response)
            console.log(response)     
        }
    });
}