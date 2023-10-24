var jumlah_checkout = parseInt(document.getElementById("jumlahtot").innerText)
var total_checkout = document.getElementById("hargatot").innerText
total_checkout = parseInt(total_checkout.slice(3,total_checkout.length))
var data_obat = []

function tambah_jum_check(e){
    let check = false
    let id_obat = e.getAttribute("id_obat")
    let this_jum = parseInt(document.getElementById(id_obat).innerText)
    let username = e.getAttribute("username")
    let harga = parseInt(e.getAttribute("harga"))

    let total = parseInt($("#totalPesan").attr("total"))
    this_jum++

    let data = {"jumlah":this_jum,"harga":harga}

    total_checkout += harga
    jumlah_checkout++

    for(var i = 0;i < data_obat.length;i++){
        if(data_obat[i].id_obat == id_obat){
            data_obat[i].jumlah = this_jum
            data_obat[i].total = this_jum * harga
            check = true
            break
        }
    }
    if(!check){
        data_obat.push({
            "username" : username,
            "id_obat" : id_obat,
            "jumlah" : this_jum,
            "harga" : harga,
            "total" : (this_jum * harga)
        })
    }

    total = total + harga
    //e.setAttribute("jumlah",this_jum)
    $("#"+id_obat).text(this_jum)
    $("#totalPesan").text("Rp."+total)
    $("#totalPesan").attr("total",total)
    kirim_update(data_obat)
    printall()
    data_obat = []
}

function kurang_jum_check(e){
    let check = false
    let id_obat = e.getAttribute("id_obat")
    let this_jum = parseInt(document.getElementById(id_obat).innerText)
    let username = e.getAttribute("username")
    let harga = parseInt(e.getAttribute("harga"))

    let total = parseInt($("#totalPesan").attr("total"))
    let data = {"jumlah":this_jum,"harga":harga}
    total_checkout -= harga
    jumlah_checkout--
    printall()
    this_jum--
    for(var i = 0;i < data_obat.length;i++){
        if(data_obat[i].id_obat == id_obat){
            data_obat[i].jumlah = this_jum
            data_obat[i].total = this_jum * harga
            check = true
            break
        }
    }
    if(!check){
        data_obat.push({
            "username" : username,
            "id_obat" : id_obat,
            "jumlah" : this_jum,
            "harga" : harga,
            "total" : (this_jum * harga)
        })
    }
    total = total - harga

    kirim_update(data_obat)
    $("#totalPesan").text("Rp."+total)
    $("#totalPesan").attr("total",total)
    $("#"+id_obat).text(this_jum)
    data_obat = []

    if(this_jum < 1){
        $("#card"+id_obat).remove()
    }
}

function kirim_update(data){
    $("#harga"+data[0].id_obat).text("Rp."+data[0].jumlah * data[0].harga)
    $.ajax({
        type: "get",
        url: "/checkout/update",
        data: {"username":data[0].username,"id_obat":data[0].id_obat,"jumlah":data[0].jumlah,"total":data[0].total},
        success: function (response) {
            console.log(
                "kode : "+response.kode+" | "+"status : "+response.status
            )
        }
    });
}
function hapusCheckout(e){
    let id_pesanan = e.getAttribute("id_pesanan")

    $.ajax({
        type: "post",
        url: "/checkout/delete",
        data: {"id":id_pesanan},
        success: function (response) {
            if(response == "200"){
                Swal.fire(
                  'heading',
                  'text',
                  'success'
                )
            }else{
                alert(response)
            }
        }
    });
}

function pesanBarang(){
    //console.log(id_file)
    $(".card-checkout").remove()
    $("#jumlahtot").text("0")
    $("#hargatot").text("Rp.0")
    $.ajax({
        type: "get",
        url: "/checkput/pesan",
        success: function (response) {
            console.log(response)
            $.ajax({
                type: "get",
                url: "/checkout/dashboard",
                success: function (response) {
                    Swal.fire(
                      'Pesanan Berhasil Dicheckout',
                      'pesanan akan diproses, silahkan dilihat pada halaman pesanan',
                      'success'
                    )
                    //$(".wrap-body").html(response)
                }
            });
        }
    });
}

function batalcheckout(e){
    let cardkode = e.getAttribute("kodecard")
    let card = document.getElementById(cardkode)
    let harga = card.childNodes[7].childNodes[1].innerText
    harga = harga.slice(3,harga.length)

    let jumlah = card.childNodes[5].childNodes[3].innerText

    total_checkout -= harga
    jumlah_checkout -= jumlah
    
    printall()

    card.remove()
    
    console.log(card.childNodes[5].childNodes[3].innerText)
}

function ubahjumhar(data,tipe){
    if(tipe == "kurang"){
        total_checkout -= "10"
        jumlah_checkout -= "10"
    }else{
        total_checkout +=10
        jumlah_checkout += 10
    }
    console.log(data)
    printall()
}

function printall(){
    document.getElementById("jumlahtot").innerText = jumlah_checkout
    document.getElementById("hargatot").innerText = "Rp."+total_checkout
}

function checkoutall(){
    console.log(jumlah_checkout,total_checkout)
}

function kodepromo(e){
    let data = e.value


    document.onkeydown = (x)=>{
        if(x.key == "Backspace"){
            e.value = data.slice(0,2)
        }else if(data.length == 2 || data.length == 6 || data.length == 10){
            e.value = data += "-"
        }
    }
    console.log(e)
}