
function testing(h) { 
    $(".button").css("left",h.clientX +"px")
    $(".button").css("top",h.clientY+"px")
    console.log(window.screenX," ",h.clientX)
}