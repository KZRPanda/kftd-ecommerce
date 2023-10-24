var id_pesanan
var username

function setuju(e){
    try {
        document.getElementById("tb-setuju").remove()
    } catch (error) {
        
    }
    let data = e.getAttribute("data")
    let dataAll = e.getAttribute("dataAll")
    dataAll = JSON.parse(dataAll)
    data = JSON.parse(data)

    let total = data[11]
    let id = data[1]

    const ket = ["Belum Disetujui","Disetujui","Ditolak"]
    const warna = ["black","#203390","red"]

    let logistik = ket[data[9]]
    let admin = ket[data[10]]
    let ketAdmin = data[16]
    let ketLogistik = data[17]

    $("#ketLog").text(ketLogistik)
    $("#ketAd").text(ketAdmin)
    $(".btn-tolak").attr("id_pesanan",id)

    $("#setujulogistik").css("color",warna[data[9]])
    $("#setujuadmin").css("color",warna[data[10]])
    $("#setujulogistik").text(logistik)
    $("#setujuadmin").text(admin)

    id_pesanan = id
    
    $(".btn-tolak").attr("admin",e.getAttribute("admin"))
    $(".btn-tolak").attr("logistik",e.getAttribute("logistik"))

    $(".setujui-pesanan").css("display","block")
    $("#kodepesanan").text(id)
    $("#totalpesanan").text("Rp."+total)
    $("#pesanTolak").val("pesanan anda dengan kode pesanan "+id+" ditolak")
}

function setujupesan(param) {
    let kode = param.getAttribute("kode")
    $(".kode-kirim").attr("kode",kode)
    $(".kode_pembayaran").css("display","block")
}
function kirim(param) {
    let kode = param.getAttribute("kode")
    let va = $("#kodePembayaran").val()
    if(va == "" || va == " "){
        Swal.fire(
          'Kode Pembayaran Tidak Dimasukkan!',
          'masukkan kode pembayaran dengan benar',
          'error'
        )
    }else{
        $.ajax({
            type: "get",
            url: "/fakturis/persetujuan/setujui",
            data: {"kode":kode,"kodeBayar":va},
            success: function (response) {
                if(response.status != "error"){
                    $(".kode_pembayaran").css("display","none")
                    $(".setujui-pesanan").css("display","none")
                    $("#tb_dataSetujuFakturis").html(response)
                }
            }
        });
    }
}
var pilihklik = []
var values = []

function hapusArray(data,hapus) {  
    return data.filter(function(el){
        return el != hapus
    })
}

$(".pilih").click(function(e){
    let ic = $(this).attr("ic")
    let v = $(this).attr("v")
    if(!(pilihklik.includes(ic))){
        pilihklik.push(ic)
        values.push(v)
        $(this).css("background-color","#6478d93f")
        $(this).css("color","#6478D9")
        $("."+ic).attr("class","fas fa-check "+ic)
    }else{
        pilihklik = hapusArray(pilihklik,ic)
        values = hapusArray(values,v)
        $(this).css("background-color","#f2f2f2")
        $(this).css("color","black")
        $("."+ic).attr("class","fas fa-times "+ic)
    }
    let pesan = values.toString()
    if(values.length > 0){
        $("#pesanTolak").val("pesanan anda dengan kode pesanan "+id_pesanan+" ditolak karena "+pesan)
    }
    else{
        $("#pesanTolak").val("pesanan anda dengan kode pesanan "+id_pesanan+" ditolak")
    }
})
function batalKirim(){
    $("#kodePembayaran").val("")
    id_pesanan = ""
    username = ""
    kodeKirim = ""
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

var pageDataSetuju = 1


function alasanTolak(params) {
    var alasan = params.value
    var pesanTolak = "Pesanan anda dengan kode pesanan "+id_pesanan+" ditolak dengan alasan "+alasan
    if(alasan == "" || alasan == " "){
        pesanTolak = "Pesanan anda dengan kode pesanan "+id_pesanan+" ditolak"
    }
    $("#pesanTolak").val(pesanTolak)
}


function batalTolak() {
    let pesanTolak = "Pesanan anda dengan kode pesanan "+id_pesanan+" ditolak"
    
    $("#alasanTolak").val("")
    $("#pesanTolak").val(pesanTolak)
    $(".tolak-pesanan").css("display","none")
}
function tolakPesan() {
    $(".tolak-pesanan").css("display","block")
}
function closeThis() {
    $(".setujui-pesanan").css("display","none")
}
function kirimTolak(params) {
    let idpesanan = params.getAttribute("id_pesanan")
    let pesanTolak = $("#pesanTolak").val()

    if(params.getAttribute("admin") == "2" || params.getAttribute("logistik")){
        $.ajax({
            type: "get",
            url: "/fakturis/persetujuan/tolak",
            data: {"msg":pesanTolak,"id":id_pesanan},
            success: function (response) {
                $("#tb_dataSetujuFakturis").html(response) 
                batalTolak()
                closeThis()
            }
        });
    }else{
        Swal.fire(
          'heading',
          'text',
          'error'
        )
    }
}