$(document).ready(function() {

    $("#search-input").focusin(function() {
        $('#submit-button').show();
        $("#search-icon").css("color", "#000000");
        $("#search-input").css("color", "#000000");
        $("#search-input").css("background-color", "#FFFFFF");
        $("#search-input").css("border-radius", "5px 0px 0px 5px");
    });

    $("#search-input").focusout(function() {
        if ($("#search-input").val() == "") {
            $('#submit-button').hide();
            $("#search-icon").css("color", "#FFFFFF");
            $("#search-input").css("color", "#FFFFFF");
            $("#search-input").css("background-color", "rgba(255, 255, 255, 0.3)");
            $("#search-input").css("border-radius", "5px");
        } else if ($("#search-input").val() != "") {
            $("#search-input").css("background-color", "#FFFFFF");
            $("#search-input").css("border-radius", "5px 0px 0px 5px");
        }
    });

});