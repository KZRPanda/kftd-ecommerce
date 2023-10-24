<tr>
    <td>
        <label for="">Alamat</label>
    </td>
    <td>
        <p class="lat" id="lat"></p>
        <p class="long" id="long"></p>
    </td>
</tr>
<button id="btn">Click Me</button>
<script>
    let button = document.getElementById("btn")

    button.addEventListener("click", function() {
    navigator.geolocation.getCurrentPosition(function(position) {
        let lat = position.coords.latitude;
        let long = position.coords.longitude;

        document.getElementById("lat").innerText = lat
        document.getElementById("long").innerText = long
        console.log(lat,long)
    });
    });
</script>