
var n = [20,12,15,30,37,5];
var i = 15;
let indexDataBarang = 1;
var reqdata = null;
// setInterval(() => {
//     document.getElementById("myChart").remove()
//     let canvas = document.createElement("canvas")
//     canvas.setAttribute("id","myChart")
//     canvas.setAttribute("width","200px")
//     canvas.setAttribute("height","300px")

//     let nilai = Math.floor(Math.random() * 5)
//     document.getElementById("data").append(canvas)

//     statistik(n[nilai])
//     i++
// }, 3000);

function klikme(e){
    e.style.width = "90px"
    $(".menu").css("width","30px")
}

var page = 1

function next_page(e){
    let cur = e.getAttribute("cur")
    let last = e.getAttribute("last")

    if(cur < last){
        page++
        $.ajax({
            type: "get",
            url: "/api/data_login",
            data: {"page":page},
            success: function (response) {
                $(".table-login-user").html(response)
            }
        });
    }
}

function prev_page(){
    if(page > 1){
        page--
        $.ajax({
            type: "get",
            url: "/api/data_login",
            data: {"page":page},
            success: function (response) {
                $(".table-login-user").html(response)
            }
        });
    }
}

function kategori_jum(e){
    var category = e.value;
    $(".spin").css("display","block")
    if(category){
        $.ajax({
            type: "get",
            url: "/palingLaku/"+category,
            success: function (response) {
                $("#wr").html(response)
                $(".spin").css("display","none")
            }
        });
    }
}

function changeTr1(e){
    e.style.backgroundColor = "#f5f5f5"
}

function changeTr2(e){
    e.style.backgroundColor = "white"
}

function dashboard_admin(e){
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $.ajax({
        type: "get",
        url: "/containerAdmin/dashboard",
        success: function (response) {
            $(".container").html(response)     
            $(".dataBarang").remove()
        }
    });
}

function dataBarang_admin(e){
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $(".sm1").css("height","50px")
    $(".sm1").css("margin-bottom","10px")
    $.ajax({
        type: "get",
        url: "/containerAdmin/dataBarang",
        success: function (response) {
            $(".container").html(response)    
        }
    });
}

function dataPiutang_admin(params) {
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    params.setAttribute("class","menu active")
    $.ajax({
        type: "get",
        url: "/containerAdmin/dataPiutang",
        success: function (response) {
            $(".container").html(response)  
        }
    });
}

function masterdata() {
    $.ajax({
        type: "get",
        url: "/masterdata",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function dataPesanan_admin(e){
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $(".sm2").css("height","50px")
    $(".sm2").css("margin-bottom","10px")
    $.ajax({
        type: "get",
        url: "/containerAdmin/dataPesanan",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function dataPersetujuan_admin(e){
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $.ajax({
        type: "get",
        url: "/containerAdmin/dataPersetujuan",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function dataUser(e) {
    clearInterval(reqdata)
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $(".sm4").css("margin-bottom","10px")
    $(".sm4").css("height","50px")
    $.ajax({
        type: "get",
        url: "/containerAdmin/akunuser",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}
function akunsetuju(e) {
    $.ajax({
        type: "get",
        url: "/containerAdmin/akunsetujui",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function logout() {
    let link = document.createElement("a")
    link.setAttribute("href","/admin/logout")
    link.click()
}

function openTambah(){
    $("#dataTambah").css("display","block")
    //document.getElementById("as").setAttribute
}
var hasilres = null
function pesanSetuju(e) {
    clearInterval(reqdata)
    $.ajax({
        type: "get",
        url: "/containerAdmin/dataPersetujuan",
        success: function (e) {
            $(".container").html(e)   
            hasilres = e

            reqdata = setInterval(() => {
                //console.log("peler")
                $.ajax({
                    type: "get",
                    url: "/containerAdmin/dataPersetujuan",
                    success: function (response) {
                        console.log(response == hasilres )
                        if(response != hasilres){
                            hasilres = response
                            $(".container").html(response) 
                        }    
                    }
                });
            }, 5000);

        }
    });
}

function pesanDisetujui(e){
    clearInterval(reqdata)
    $.ajax({
        type: "get",
        url: "/dataSetuju/dataDisetujui",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function pesanDibayar(e) {
    clearInterval(reqdata)
    $.ajax({
        type: "get",
        url: "/dataSetuju/dataDibayar",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

var timer = null;

function scrollMe(){
    try {
        document.getElementById("dataBarangActions").style.marginBottom = "-60px"

        if(timer !== null) {
            clearTimeout(timer);        
        }
        timer = setTimeout(function() {
            document.getElementById("dataBarangActions").style.marginBottom = "20px"
        }, 700);   
    } catch (error) {
        
    }
}

function nextDataBarang(){
    indexDataBarang++
    let jum = document.getElementById("limit").value
    let txt = $("#cari").val()
    let data = {"page":indexDataBarang,"jumlah":jum,"txt":txt}
    console.log(data)
    $.ajax({
        type: "get",
        url: "/dataBarang/nextprev",
        data:data,
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
}

function prevDataBarang(){
    let jum = document.getElementById("limit").value
    let txt = $("#cari").val()
    let data = {"page":indexDataBarang,"jumlah":jum,"txt":txt}
    console.log(data)
    if(indexDataBarang > 1){
        indexDataBarang--
        $.ajax({
            type: "get",
            url: "/dataBarang/nextprev",
            data:{"page":indexDataBarang,"jumlah":jum,"txt":txt},
            success: function (response) {
                $("#tb_dataBarang").html(response)
            }
        });
    }
}

var timeLimit

function limitdown(){   
    clearTimeout(timeLimit)
}

function limitup(e){
    let jum = e.value
    clearTimeout(timeLimit)
    
    if((jum != 0) && (jum != "")){
        timeLimit = setTimeout(()=>{
            sendLimit(jum)
        },500)
    }
}


function sendLimit(jum){
    let txt = $(".cari").val()
    $.ajax({
        type: "get",
        url: "/dataBarang/cari",
        data:{"page":indexDataBarang,"jumlah":jum,"queries":txt},
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
}


function caridata(e){
    let txt = e.value
    let jum = $('.limit').val()

    console.log(e.which)
    $.ajax({
        type: "get",
        url: "/dataBarang/cari",
        data: {"queries":txt,"jumlah":jum,"page":indexDataBarang},
        success: function (response) {
            $("#tb_dataBarang").html(response)
        }
    });
}

function vInfo(e) {
    $(".info").css("display","grid")
}

function vInfoOut(e) {
    $(".info").css("display","none")
}

function kirimEdit(e){
    let kode = $("#editkode").val()
    let nama = $("#editnama").val()
    let harga = $("#editharga").val()
    let kate = $("#kategoriObat").val()

    console.log({
        "kode" : kode,
        "nama" : nama,
        "harga" : harga,
        "kate" :kate
    })

    $.ajax({
        type: "get",
        url: "api/dataContain/editData",
        data: {
            "kode" : kode,
            "nama" : nama,
            "harga" : harga,
            "kate" :kate
        },
        success: function (response) {
            //console.log(response)
            $("#tb_dataBarang").html(response)
            $("#dataEdit").css("display","none")
            
            $("#dataTambah").css("display","none")
        }
    });
}

function suratKeterangan_admin(e){
    $(".menu").attr("class","menu")
    e.setAttribute("class","menu active")
    $.ajax({
        type: "get",
        url: "/containerAdmin/suratKeterangan",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

function viewSampahSK(){
    $.ajax({
        type: "get",
        url: "/containerAdmin/suratKeterangan/sampahSK",
        success: function (response) {
            $(".container").html(response)     
        }
    });
}

