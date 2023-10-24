var pageDataPesan = 1

function prevDataPesan(){
    if(pageDataPesan > 1){
        pageDataPesan--
        $.ajax({
            type: "get",
            url: "/dataPesan/prev",
            data: {"page":pageDataPesan},
            success: function (response) {
                $(".pagenumber").text("page "+pageDataPesan)
                $("#tb_dataPesan").html(response)
            }
        });
    }
}

function nextDataPesan(){
    pageDataPesan++
    $.ajax({
        type: "get",
        url: "/dataPesan/next",
        data: {"page":pageDataPesan},
        success: function (response) {
            $(".pagenumber").text("page "+pageDataPesan)
            $("#tb_dataPesan").html(response)
        }
    });
}

function closetbView(){
    $("#view_dataPesan").css("display","none")
}

var up = false

function urutArrow(e){
    let child = document.getElementById("pengurut").childNodes

    if(!up){
        child[1].setAttribute("class","fas fa-chevron-down")
        up = true
    }else{
        up = false
        child[1].setAttribute("class","fas fa-chevron-up")
    }

    console.log(up)
}