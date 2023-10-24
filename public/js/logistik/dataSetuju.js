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
    let total = data[9]
    let id = data[1]

    id_pesanan = id

    $("#pesanTolak").val("pesanan anda dengan kode pesanan "+id+" ditolak")
    var table = document.createElement("table")
    table.setAttribute("id","tb-setuju")
    var tr
    let i = 0
    let td1 = document.createElement("td")
    let td2 = document.createElement("td")
    let td3 = document.createElement("td")
    tr = document.createElement("tr")

    td1.innerText = "kode"
    td2.innerText = "nama"
    td3.innerText = "jumlah"

    tr.appendChild(td1)
    tr.appendChild(td2)
    tr.appendChild(td3)

    table.appendChild(tr)

    dataAll.forEach(element => {
        tr = document.createElement("tr")
        let listTd = ["kode","nama","jumlah"]
        let listEl = [element.id_obat,element.nama_obat,element.jum_pesanan]
        
        td1 = document.createElement("td")
        td2 = document.createElement("td")
        td3 = document.createElement("td")

        td1.innerText = element.id_obat
        td2.innerText = element.nama_obat
        td3.innerText = element.jum_pesanan

        tr.appendChild(td1)
        tr.appendChild(td2)
        tr.appendChild(td3)
    
        table.appendChild(tr)

    });
    document.getElementById("tb-dataAll").appendChild(table)
    $(".username").text(username)
    $(".id_pesanan").text(id_pesanan)
    $("#kodepesanan").text(id)
    $("#setujui").attr("kode",id)
    $("#totalpesanan").text("Rp."+total)
    $(".setujui-pesanan").css("display","block")
    $(".btn-tolak").attr("id_pesanan",id)
}

var pilihklik = []
var values = []

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
    console.log(values)
})

function hapusArray(data,hapus) {  
    return data.filter(function(el){
        return el != hapus
    })
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
    //$(".kode_pembayaran").css("display","block")
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

var pageDataSetuju = 1

