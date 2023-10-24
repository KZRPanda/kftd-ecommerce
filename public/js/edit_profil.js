var data;

function ubah(e){
    document.getElementById("verif").style.display = "block"
    //var data_ubah = $("."+e.getAttribute("id")).val()

    var nama = document.getElementById("nama").value
    var email = document.getElementById("email").value
    var password = document.getElementById("password").value
    var no_hp = document.getElementById("no_hp").value
    var alamat = document.getElementById("alamat").value
    var kecamatan = document.getElementById("kec").value
    var kelurahan = document.getElementById("kel").value

    var username = e.getAttribute("username")
    //var tipe = e.getAttribute("id")


    data = {
        "username" : username,
        "nama" : nama,
        "email" : email,
        "password" : password,
        "no_hp" : no_hp,
        "alamat" : alamat,
        "kecamatan" : kecamatan,
        "kelurahan" : kelurahan
    }

}

function kirim(){
    var pass = document.getElementById("verif-pass").value
    data["password"] = pass

    $.ajax({
        type: "get",
        url: "/data/input",
        data: data,
        success: function (response) {
            if(response.status == "berhasil"){
                Swal.fire({
                    icon: 'success',
                    title: response.status,
                    text: response.text
                })
            }

            $("#verif-pass").val("")
            console.log(response,data)
        }
    });
}


var temp;
$(".kec").change(function(){
    var kec = $(this).val()
    var kel = document.getElementById("kel")


    $.ajax({
        type: "get",
        url: "/api/kelurahan/where?id_kecamatan="+kec,
        success: function (response) {
            var temp = 0;
            if(document.getElementsByClassName("kelurahan")){
                // while (document.getElementsByClassName("kelurahan")) {
                //     document.getElemenstByClassName("kelurahan")[temp].remove() 
                //     temp++  
                // }

                    $(".kelurahan").remove()
            }
            for (let index = 0; index < response.kelurahan.length; index++) {
                var opt = document.createElement("option")
                opt.setAttribute("value",response.kelurahan[index].id_kelurahan) 
                opt.setAttribute("class","kelurahan")
                opt.innerText = response.kelurahan[index].nama_kelurahan
                kel.append(opt)
                
            }
        }
    });
})

function xxx(input) {
    if (input.files && input.files[0]) {
        $(".modal").css("display","block")
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#prev')
            .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
    }        
}


function readURL(input) {
    if(input.files[0].size > 2194304){
        Swal.fire(
          'Ukuran File Terlalu Besar!',
          'Pilih gambar lain dengan ukuran kurang dari 2mb!',
          'error'
        )
    }else{
        temp = document.getElementById("file").files[0]
        xxx(input)
    }
    // temp = input
    // xxx(temp)

}

$(".klik").click(function(){
    var file_data = $('.file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
})

function set_pict(img){
    var reader = new FileReader();
        reader.onload = function (e) {
            $('#blah')
            .attr('src', e.target.result)
        };
        reader.readAsDataURL(img);
}

function set_pict2(img){
    var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-profil-header')
            .attr('src', e.target.result)
        };
        reader.readAsDataURL(img);
}

function set_prof(){
    var my_form = document.getElementById("form_data")
    var form_data = new FormData(my_form);

    $.ajax({
        type: "post",
        url: "/testing",
        data: form_data,
        processData: false,
        contentType: false,
        success: function (response) {
            set_pict(temp);
            set_pict2(temp)
            console.log(response)
        }
    });
}

$(".btn-modal").click(function(){
    var id = $(this).attr("id")
    if(id == "yes"){
    //console.log(temp.name)
    set_prof()
    $(".modal").css("display","none")
    }else{
        $(".modal").css("display","none")
    }
})
