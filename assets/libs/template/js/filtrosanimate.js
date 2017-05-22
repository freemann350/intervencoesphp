$('#filtrosheader').click(function() {
    $('#filtrosdiv').slideToggle(450, function() {
        if ($(this).css("display") == "none") {
            $("#caret-spin").css("transform", "initial");
        } else {
            $("#caret-spin").css("transform", "rotateX(180deg)");
        }
    })
});
