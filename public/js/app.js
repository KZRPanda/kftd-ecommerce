// if(sessionStorage.getItem("user") == null){
//     alert("YOU DON'T HAVE PERMISSION!")
//     window.location.href = "/"
// }

var id_file = 0

function home(){
    $("#load-isi").attr("class","load-isi animation-load")
    setTimeout(() => {
        $("#load-isi").attr("class","load-isi")
        $(".loading-view").css("display","none")
    }, 3000);
    $.ajax({
        type: "get",
        url: "/home",
        success: function (response) {
            $(".wrap-body").html(response)
            $(".kategori").css("display","block")
        }
    });  
}

var typingTimer;                //timer identifier
var doneTypingInterval = 400;  //time in ms, 5 seconds for example
var $input = $('input');

//on keyup, start the countdown
$("#cari").keyup(function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

$("#cari").keydown(function () {
    clearTimeout(typingTimer)
});

function doneTyping () {
    var teks = document.getElementById("cari").value
    if(teks != ""){
        $.ajax({
        type: "get",
        url: "/recomend",
        data:{"teks":teks,"kategori":hasil_klik_gambar.toString()},
        success: function (response) {
            $(".hasil-pencarian").css("display","block")
            $(".hasil-pencarian").html(response)
            $(".wrap-loading").css("display","none")
        }
    })
    }else{
        $(".hasil-pencarian").css("display","none")           
    }
}


$("#cari").keyup(function(event){
    var teks = $(this).val()
    if(event.which == 13){
        $(".wrap-loading").css("display","block")
        $.ajax({
            type: "get",
            url: "/x",
            data:{"data":teks,"kategori":hasil_klik_gambar.toString()},
            success: function (response) {
                $(".wrap-loading").css("display","none")
                $(".wrap-body").html(response)
            }
        })  
        $(".hasil-pencarian").css("display","none")
        $(this).val("")
    }
})


function tutup_verif(){
    document.getElementById("verif").style.display = "none"
}

function chart(){
    $("#load-isi").attr("class","load-isi animation-load")
    setTimeout(() => {
        $("#load-isi").attr("class","load-isi")
        $(".loading-view").css("display","none")
    }, 3000);
    $.ajax({
        type: "get",
        url: "/checkout/dashboard",
        success: function (response) {
            $(".wrap-body").html(response)
            if(widthscreen){
                $(".kategori").css("display","none")
            }
        }
    });
}

var widthscreen = (document.documentElement.clientWidth <= 450)?true:false;

window.addEventListener('mousedown',function(e){
    if(document.getElementById('btn-kategori').contains(e.target)){
        kategori_btn(e)
    }else if(!(document.getElementById('btn-kategori').contains(e.target)) && !widthscreen){
        if (document.getElementById('kategori').contains(e.target)){
            $(".kategori").css("height","245px")
            $(".kategori").css("padding","40px 0")
            klik = true
        }else{
            $(".kategori").css("height","0px")
            $(".kategori").css("padding","0 0")
            klik = false
        }
    }
    else if(document.getElementById("pencarian").contains(e.target)){
        //cekinput($("#cari").val())
        if(cekinput($("#cari").val())){
            hasil_pencarian(e)
        }
    }
    else{
        $(".hasil-pencarian").css("display","none")
    }
})
$(".btn-kategori").click(function () { 
    if(!klik){
        $(".kategori").css("height","245px")
        $(".kategori").css("padding","40px 0")
        klik = true
    }else{
        $(".kategori").css("height","0px")
        $(".kategori").css("padding","0 0")
        klik = false
    }

    console.log({"klik":klik})
});
var klik_hasil = false

function hasil_pencarian(e){
    if($("#cari").val() == "" || $("#cari").val() == " "){
        $(".hasil-pencarian").css("display","none")
    }
    if(!(document.getElementById("hasil").contains(e.target))){
        $(".hasil-pencarian").css("display","none")
    }
    if(document.getElementById("pencarian").contains(e.target)){
        $(".hasil-pencarian").css("display","block") 
    }
}

function kategori_btn(e){
    if (document.getElementById('btn-kategori').contains(e.target)){
        if(klik == true){
            $(".kategori").css("height","245px")
            $(".kategori").css("padding","40px 0")
            klik = false
        }else{
            $(".kategori").css("height","0px")
            $(".kategori").css("padding","0 0")
            klik = true
        }
        $(".hasil-pencarian").css("display","none")

    }else if (document.getElementById('kategori').contains(e.target)){
        $(".kategori").css("padding","0px 0")
        klik = true
    } else{

    }

    console.log(document.getElementById('btn-kategori').contains(e.target))
}

function cekinput(data){
    for(var i = 0;i < data.length;i++){
        if(data[i] != " "){
            return true;
            break;
        }
    }
    return false
}