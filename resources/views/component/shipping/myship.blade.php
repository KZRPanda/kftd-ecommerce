<link rel="stylesheet" href="{{asset('css/dashboard/myship/myship.css')}}">
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/sweet-alert2.js')}}"></script>
<script src="{{asset('js/myship.js')}}"></script>

<div class="cekpesanan">

</div>

<div class="to-top" onclick="totop()">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</div>

<div class="myship">
    <div class="header-ship">
        <div class="header-col header-active" id="semua" onclick="semua()">
            <p>Semua</p>
        </div>
        <div class="header-col" id="persetujuan" onclick="persetujuan()">
            <p>Persetujuan</p>
        </div>
        <div class="header-col" id="belum-dibayar" onclick="belumbayar()">
            <p>Telah Disetujui</p>
        </div>
        <div class="header-col" id="dikirim" onclick="dikirim()">
            <p>Dikirim</p>
        </div>
        <div class="header-col" id="selesai" onclick="selesai()">
            <p>Selesai</p>
        </div>
        <div class="header-col" id="batal" onclick="batal()">
            <p>Batal</p>
        </div>
    </div>

    <div class="wrap-container-ship">
        {{-- @include("component.shipping.component.semua") --}}
    </div>
</div>
<script>

    function persetujuan(){
        $.ajax({
            type: "get",
            url: "{{Route('persetujuan')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }

    function belumbayar(){
        $.ajax({
            type: "get",
            url: "{{Route('belumbayar')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }

    function dikirim(){
        $.ajax({
            type: "get",
            url: "{{Route('dikirim')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }
    function selesai(){
        $.ajax({
            type: "get",
            url: "{{Route('selesai')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }
    function batal(){
        $.ajax({
            type: "get",
            url: "{{Route('batal')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }
    function semua(){
        $.ajax({
            type: "get",
            url: "{{Route('ship')}}",
            success: function (response) {
                $(".wrap-container-ship").html(response)
            }
        });
    }
    $.ajax({
        type: "get",
        url: "{{Route('ship')}}",
        success: function (response) {
            $(".wrap-container-ship").html(response)
        }
    });
    $(".header-col").click(function(){
        $(".header-col").attr("class","header-col")

        $(this).attr("class","header-col header-active")
    })
</script>