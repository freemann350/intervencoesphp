$('#filtrosheader').click(function() {
    $('#filtrosdiv').slideToggle(450, function() {
        if ($(this).css("display") == "none") {
            $("#filtrosdown").css("transform", "initial");
        } else {
            $("#filtrosdown").css("transform", "rotateX(180deg)");
        }
    })
});
