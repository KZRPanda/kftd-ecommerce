var id_pesanan
var username

function setuju(e){
    let data = e.getAttribute("data")
    let x = ""
    for (let index = 1; index < data.length - 1; index++) {
        if(data[index] == '"'){
            continue
        }else{
            x += data[index];
        }
        
        
    }
    //data = data.splice(1,data.length - 1)
    data = x.split(",")

    id_pesanan = e.getAttribute("id_pesanan")
    username = e.getAttribute("username")
    let file = e.getAttribute("file")

    $("#username").text(username)
    $("#id_pesanan").text(id_pesanan)
    $(".kode-kirim").attr("kodePesanan",id_pesanan)
    $(".tolak").attr("kodePesanan",id_pesanan)
    $(".surat").attr("file",e.getAttribute("file"))

    console.log(file)
    if(file == ""){
        $(".ic").css("background-color","#ff000037")
        $("#ic-surat").css("color","red")
        $("#ic-surat").attr("class","fas fa-times")
        $(".ket").text("Tidak ada surat izin edar")
    }else{
        $(".ic").css("background-color","#d8ddf6")
        $("#ic-surat").css("color","#6478D9")
        $("#ic-surat").attr("class","fas fa-check")
        $(".ket").text("Ada surat izin edar obat")
    }

    e.style.backgroundColor = "blue"

    $(".kode_pembayaran").css("display","block")
}

// function kodeKirim(e){
//     try{
//         let kode_pembayaran = $("#kodePembayaran").val()
//         let kodePesanan = e.getAttribute("kodePesanan")

//         $.ajax({
//             type: "get",
//             url: "/dataSetuju/kodeBayar",
//             data: {"id_pesanan":kodePesanan,"kodeBayar":kode_pembayaran},
//             success: function (response) {
//                 $(".tb_dataSetuju").html(response)
//                 batalKirim()
//             }
//         });
//     }catch(error){
//         console.log(error)
//     }
// }
function setujupesan(param) {
    let kode = param.getAttribute("kode")
    $.ajax({
        type: "get",
        url: "/logistik/persetujuan/setujui",
        data: {"kode":kode},
        success: function (response) {
            $(".container").html(response)
        }
    });
}
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
var index = 1

function nextDataSetuju(){
    index++
    reqdata(index)
}

function prevDataSetuju(){
    index--
    reqdata(index)

}

function reqdata(idx) {
    $.ajax({
        type: "get",
        url: "dataSetuju/load",
        data: {"page":idx},
        success: function (response) {
            console.log(response)
            $("#tb_dataSetuju").html(response)
        }
    }); 
}
var pageDataSetuju = 1

