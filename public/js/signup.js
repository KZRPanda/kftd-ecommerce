    var lanjut = false
    var user_dilarang = []
    var emaildilarang = []

    class datauser{
        userdata = {}

        set_username(data){
            this.userdata.username = data
        }
        set_password(data){
            this.userdata.password = data
        }
        set_email(data){
            this.userdata.email = data
        }
        set_nohp(data){
            this.userdata.nohp = data
        }
        set_nama(data){
            this.userdata.nama = data
        }
        set_instansi(data){
            this.userdata.instansi = data
        }
        set_alamat(data){
            this.userdata.alamat = data
        }
        set_kec(data){
            this.userdata.kec = data
        }
        set_kel(data){
            this.userdata.kel = data
        }
        set_prof(data){
            this.userdata.prof = data
        }

        getdata(){
            return this.userdata
        }
    }

    var dataUsers = new datauser()

    dataUsers.set_kec($(".kec").val())
    dataUsers.set_kel($(".kel").val())

    function klik(){
        let satu = document.getElementById("satu");
        let dua = document.getElementById("dua");
        let tiga = document.getElementById("tiga");

        let user = $(".username").val()
        let pass = $(".pass").val()

        if(lanjut){
            dataUsers.set_username(user)
            dataUsers.set_password(pass)
            // satu.style.transform = "translatex(-100%)"
            // dua.style.transform = "translatex(-100%)"
            // tiga.style.transform = "translatex(-100%)"

            dua.style.display = "block"
            satu.style.display = "none"

            lanjut = false
            console.log(dataUsers.getdata())
        }else{
            Swal.fire(
              'Data Belum Lengkap!',
              'silahkan lengkapi data anda terlebih dahulu',
              'error'
            )
        }
    }

    function klikdua() {
        let satu = document.getElementById("satu");
        let dua = document.getElementById("dua");
        let tiga = document.getElementById("tiga");

        let email = $(".email").val()
        let nohp = $(".nohp").val()
        let alamat = $(".alamat").val()
        let nama = $(".nama").val()
        let instansi = $(".instansi").val()

        if(lanjut){
            dataUsers.set_email(email)
            dataUsers.set_nohp(nohp)
            dataUsers.set_alamat(alamat)
            dataUsers.set_kec($(".kec").val())
            dataUsers.set_kel($(".kel").val())

            // satu.style.transform = "translatex(-200%)"
            // dua.style.transform = "translatex(-200%)"
            // tiga.style.transform = "translatex(-200%)"

            tiga.style.display = "block"
            dua.style.display = "none"

            lanjut = false
            console.log(dataUsers.getdata())
        }else{
            Swal.fire(
              'Data Belum Lengkap!',
              'silahkan lengkapi data anda terlebih dahulu',
              'error'
            )
        }
    }

    function kliktiga() {
        var my_form = document.getElementById("form_data")
        var form_data = new FormData(my_form);

        if(lanjut){
            $.ajax({
                type: "post",
                url: "/regis/daftar",
                data: form_data,
                processData: false,
                contentType: false,
                success: function (response) {
                    if(response.status == "1"){
                        let link = document.createElement("a")
                        link.setAttribute("href","/")
                        link.click()
                    }else if(response.status == "0"){
                        Swal.fire(
                            'Error Mendaftar Akun!',
                            response.msg,
                            'error'
                        )
                    }
                    console.log(response)
                }
            });
        }else{
            Swal.fire(
                'Data Belum Lengkap!',
                'silahkan lengkapi data anda terlebih dahulu',
                'error'
            )
        }
        //console.log(form_data)

    }

    var pencet
    var pencet1
    var datacek_page1 = {"username":false,"pass":false}
    var datacek_page2 = {   "email":false,"nohp":false,
                            "alamat":false,"instansi":false,
                            "nama":false}

    function donetype(data,tipe){
        if(tipe == "username"){
            $.ajax({
                type: "get",
                url: "/regis/auth",
                data: {"tipe":"username","data":data},
                success: function (response) {
                    $("#usr").css("display","block")
                    if(response.kode == "1"){
                        let values = $(".username").val()
                        user_dilarang.push(data)
                        datacek_page1.username = false
                        bataluser(values)
                        // $(".cek-usr").css("color","red")
                        // $(".cek-usr").css("display","block")
                        // $("#usr").attr("class","fal fa-times")
                    }else{ 
                        inputan.username = true
                        datacek_page1.username = true
                        $(".cek-usr").css("color","black")
                        $(".cek-usr").css("display","none")
                        $("#usr").attr("class","fal fa-check")
                    }
    
                    checking1(datacek_page1)
                    if($(".username").val() == "" || $(".username").val() == " "){
                        $("#usr").css("display","none")
                    }
                }
            });
        }else if(tipe == "email"){
            $.ajax({
                type: "get",
                url: "/regis/auth",
                data: {"tipe":"email","data":data},
                success: function (response) {
                    $("#eml").css("display","block")
                    if(response.kode == "1"){
                        let values = $(".email").val()
                        emaildilarang.push(data)
                        datacek_page2.email = false
                        cekemail(values)
                    }else{ 
                        datacek_page2.email = true
                        $(".cek-eml").css("color","black")
                        $(".cek-eml").css("display","none")
                        $("#eml").attr("class","fal fa-check")
                    }
    
                    checking2(datacek_page2)
                    if($(".email").val() == "" || $(".email").val() == " "){
                        $("#eml").css("display","none")
                    }
                }
            });
        }
    }

    function pencetinput(data){
        clearTimeout(pencet)
        if(data != "" && data != " "){
            pencet = setTimeout(()=>{
                donetype(data,"username")
            },1000)
        }else{
            $("#usr").css("display","none")
            $(".cek-usr").css("color","black")
            $(".cek-usr").css("display","none")
        }
    }

    function pencetemail(data){
        clearTimeout(pencet1)
        if(data != "" && data != " "){
            pencet1 = setTimeout(()=>{
                donetype(data,"email")
            },1000)
        }else{
            $("#eml").css("display","none")
            $(".cek-eml").css("color","black")
            $(".cek-eml").css("display","none")
        }
        console.log(data)
    }


    class mydata{
        data = []

        cekthis(e){
            let cek = false

            for (let index = 0; index < this.data.length; index++) {
                if(this.data[index].kelas == e){
                    cek = true
                    break
                }else{
                    cek = false
                }
            }
            return cek
        }

        cekdata(param) {
            if(!this.cekthis(param)){
                this.data.push({"kelas":param})
            }
            return this.data
        }
    }

    var inputan = {}
    let mydatas = new mydata()

    function bataluser(e){
        if(user_dilarang.includes(e)){
            inputan.username = false
            datacek_page1.username = false
            clearTimeout(pencet)
            $(".cek-usr").css("color","red")
            $(".cek-usr").css("display","block")
            $("#usr").attr("class","fal fa-times")
        }else{
            datacek_page1.username = true
            $("#usr").attr("class","fal fa-spinner")
            $("#usr").css("display","block")
            pencetinput(e)
        }
    }

    function cekemail(e) {
        if(emaildilarang.includes(e)){
            datacek_page2.email = false
            clearTimeout(pencet1)
            $(".cek-eml").css("color","red")
            $(".cek-eml").css("display","block")
            $("#eml").attr("class","fal fa-times")
        }else{
            datacek_page2.email = true
            $("#eml").attr("class","fal fa-spinner")
            $("#eml").css("display","block")
            pencetemail(e)
        }
    }

    $("input").keyup((e)=>{
        let myclass = e.target.className
        let values = e.target.value

        mydatas.cekdata(myclass)

        if(myclass == "username" ){
            if($("."+myclass).val() == ""){
                inputan.username = false
                datacek_page1.username = false
            }else{
                bataluser(values)
            }
            checking1(datacek_page1)
        }else if(myclass == "confirm-pass" || myclass == "pass"  ){
            let passwords = $(".pass").val()
            let thispass = $(".confirm-pass").val()

            if(((passwords != " ") && (thispass != " "))){
                if(passwords != thispass){
                    datacek_page1.pass = false
                    $(".cek-pass").css("display","block")
                }else{
                    datacek_page1.pass = true
                    $(".cek-pass").css("display","none")
                }
            }
            checking1(datacek_page1)
        }else if(myclass == "email"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.email = false
                $("#eml").css("display","none")
            }else{
                //console.log($("."+myclass).val())
                cekemail($("."+myclass).val())
            }
            checking2(datacek_page2)
        }else if(myclass == "nohp"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.nohp = false
            }else{
                datacek_page2.nohp = true
            }

            checking2(datacek_page2)
        }else if(myclass == "alamat"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.alamat = false
            }else{
                datacek_page2.alamat = true
            }

            checking2(datacek_page2)
        }else if(myclass == "instansi"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.instansi = false
            }else{
                datacek_page2.instansi = true
            }

            checking2(datacek_page2)
        }else if(myclass == "nama"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.nama = false
            }else{
                datacek_page2.nama = true
            }

            checking2(datacek_page2)
        }
    })

    $("input").change((e)=>{
        let myclass = e.target.className
        let values = e.target.value

        mydatas.cekdata(myclass)

        if(myclass == "username" ){
            if($("."+myclass).val() == ""){
                inputan.username = false
                datacek_page1.username = false
            }else{
                bataluser(values)
            }
            checking1(datacek_page1)
        }else if(myclass == "confirm-pass" || myclass == "pass"  ){
            let passwords = $(".pass").val()
            let thispass = $(".confirm-pass").val()

            if(((passwords != " ") && (thispass != " "))){
                if(passwords != thispass){
                    datacek_page1.pass = false
                    $(".cek-pass").css("display","block")
                }else{
                    datacek_page1.pass = true
                    $(".cek-pass").css("display","none")
                }
            }
            checking1(datacek_page1)
        }else if(myclass == "email"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.email = false
                $("#eml").css("display","none")
            }else{
                //console.log($("."+myclass).val())
                cekemail($("."+myclass).val())
            }
            checking2(datacek_page2)
        }else if(myclass == "nohp"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.nohp = false
            }else{
                datacek_page2.nohp = true
            }

            checking2(datacek_page2)
        }else if(myclass == "alamat"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.alamat = false
            }else{
                datacek_page2.alamat = true
            }

            checking2(datacek_page2)
        }else if(myclass == "instansi"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.instansi = false
            }else{
                datacek_page2.instansi = true
            }

            checking2(datacek_page2)
        }else if(myclass == "nama"){
            if($("."+myclass).val() == "" || $("."+myclass).val() == " "){
                datacek_page2.nama = false
            }else{
                datacek_page2.nama = true
            }

            checking2(datacek_page2)
        }
    })

    function checking1(data){
        if(data.username && data.pass){
            lanjut = true
            $("#bulat").attr("class","fas fa-check")
            $("#first-bulat").css("background-color","rgb(17, 10, 68)")
        }else{
            lanjut = false
            $("#bulat").attr("class","fas fa-times")
            $("#first-bulat").css("background-color","red")
        }
    }

    function checking2(data){
        if(data.email && data.nohp && data.alamat && data.instansi && data.nama){
            lanjut = true
            $("#bulat-dua").attr("class","fas fa-check")
            $("#second-bulat").css("background-color","rgb(17, 10, 68)")
        }else{
            lanjut = false
            $("#bulat-dua").attr("class","fas fa-times")
            $("#second-bulat").css("background-color","red")
        }
    }

    $("i").click(function(){
        let kelas = $(this).attr("class")
        let id = $(this).attr("id")
        let keterangan = $(this).attr("ket")
        let inputant = $(this).attr("input")

        if(kelas == "fal fa-times"){
            $("."+inputant).val("")
            $("."+keterangan).css("display","none")
            $(this).css("display","none")
        }

    })

$(".kec").on("change",function (params) {
    let kec = $(this).val()

    var kel = document.getElementById("kel")


    $.ajax({
        type: "get",
        url: "/api/kelurahan/where?id_kecamatan="+kec,
        success: function (response) {
            var temp = 0;
            if(document.getElementsByClassName("kelurahan")){
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


function profimg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        lanjut = true
        reader.onload = function (e) {
            $('#img-prev')
            .attr('src', e.target.result)
        };
        $(".foto-preview").css("display","block")
        $("#third-bulat").css("background-color","#110a44")
        $("#bulat-tiga").attr("class","fas fa-check")
        reader.readAsDataURL(input.files[0]);
    }    
}