$("#identity").on("keyup", function() {
    var s = $(this).attr("name"),
        r = $("label[for='" + s + "']").attr("class");
    $(this).val() ? (r = "input") && ($("div[for='" + s + "']").removeClass("has-error"), $("div[for='" + s + "']").addClass("has-success"), $("label[for='" + s + "']").css("display", "none")) : ($("label[for='" + s + "']").removeClass(""), $("div[for='" + s + "']").addClass("has-error"), $("div[for='" + s + "']").addClass("has-error"), $("label[for='" + s + "']").text("Please enter a username"), $("label[for='" + s + "']").css("display", "inline-block"))
}), $("#password").on("keyup", function() {
    var s = $(this).attr("name"),
        r = $("label[for='" + s + "']").attr("class");
    $(this).val() ? (r = "input") && ($("div[for='" + s + "']").removeClass("has-error"), $("div[for='" + s + "']").addClass("has-success"), $("label[for='" + s + "']").css("display", "none")) : ($("label[for='" + s + "']").removeClass(""), $("div[for='" + s + "']").addClass("has-error"), $("div[for='" + s + "']").addClass("has-error"), $("label[for='" + s + "']").text("Please enter a password"), $("label[for='" + s + "']").css("display", "inline-block"))
});