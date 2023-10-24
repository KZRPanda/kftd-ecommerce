function setujuakun(params) {
    let user = params.getAttribute("username")

    $.ajax({
        type: "get",
        url: "/accakun/aksi",
        data: {"username":user,"aksi":"setuju"},
        success: function (response) {
            $(".tb-akunsetujui").html(response)
        }
    });
}

function tolakakun(params) {
    let user = params.getAttribute("username")

    $.ajax({
        type: "get",
        url: "/accakun/aksi",
        data: {"username":user,"aksi":"tolak"},
        success: function (response) {
            $(".tb-akunsetujui").html(response)
        }
    });
}