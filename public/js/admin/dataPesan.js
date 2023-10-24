var pageDataPesan = 1

function prevDataPesan(){
    if(pageDataPesan > 1){
        pageDataPesan--
        let tipeUrutan = $("#urut").val()
        let txt = document.getElementById("cari").value
        let limit = document.getElementById("limit").value
        let urut = $(".pengurut").attr("urut")
        let dataAll = {
            "tipe" : tipeUrutan,
            "txt" : txt,
            "limit" :limit,
            "up" : up,
            "page" : pageDataPesan
        }
    
        try {
            $.get("/dataPesan/cari", dataAll,
                function (data, textStatus, jqXHR) {
                    console.log(dataAll)
                    $("#tb_dataPesan").html(data)
                }
            );
        } catch (error) {
            console.log("error : "+error)
        }
    }
}

function nextDataPesan(){
    pageDataPesan++
    let tipeUrutan = $("#urut").val()
    let txt = document.getElementById("cari").value
    let limit = document.getElementById("limit").value
    let urut = $(".pengurut").attr("urut")
    let dataAll = {
        "tipe" : tipeUrutan,
        "txt" : txt,
        "limit" :limit,
        "up" : up,
        "page" : pageDataPesan
    }

    try {
        $.get("/dataPesan/cari", dataAll,
            function (data, textStatus, jqXHR) {
                console.log(dataAll)
                $("#tb_dataPesan").html(data)
            }
        );
    } catch (error) {
        console.log("error : "+error)
    }
    // $.ajax({
    //     type: "get",
    //     url: "/dataPesan/next",
    //     data: {"page":pageDataPesan},
    //     success: function (response) {
    //         $(".pagenumber").text("page "+pageDataPesan)
    //         $("#tb_dataPesan").html(response)
    //     }
    // });
}

function closetbView(){
    $("#view_dataPesan").css("display","none")
}

var up = true

function urutArrow(e){
    let child = document.getElementById("pengurut").childNodes
    
    if(!up){
        child[1].setAttribute("class","fas fa-chevron-down")
        e.setAttribute("urut","asc")
        up = true
    }else{
        up = false
        e.setAttribute("urut","desc")
        child[1].setAttribute("class","fas fa-chevron-up")
    }

    let tipeUrutan = $("#urut").val()
    let txt = document.getElementById("cari").value
    let limit = document.getElementById("limit").value
    let urut = $(".pengurut").attr("urut")
    let dataAll = {
        "tipe" : tipeUrutan,
        "txt" : txt,
        "limit" :limit,
        "up" : up,
        "page" : pageDataPesan
    }

    try {
        $.get("/dataPesan/cari", dataAll,
            function (data, textStatus, jqXHR) {
                //console.log(dataAll)
                $("#tb_dataPesan").html(data)
            }
        );
    } catch (error) {
        
    }

    //console.log(up)
}

function ubahUrutan(e){
    let tipeUrutan = e.value
    let txt = document.getElementById("cari").value
    let limit = document.getElementById("limit").value
    let urut = $(".pengurut").attr("urut")
    let dataAll = {
        "tipe" : tipeUrutan,
        "txt" : txt,
        "limit" :limit,
        "up" : up,
        "page" : pageDataPesan
    }

    try {
        $.get("/dataPesan/cari", dataAll,
            function (data, textStatus, jqXHR) {
                //console.log(dataAll)
                $("#tb_dataPesan").html(data)
            }
        );
    } catch (error) {
        
    }
}