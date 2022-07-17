$(document).ready(function () {
  let mode = localStorage.getItem("mode") || "light";
  if (mode == "light") {
    $("html").attr("data-mode", "light");
    $("#theme-switch").prop("checked", false);
  } else {
    $("html").attr("data-mode", "dark");
    $("#theme-switch").prop("checked", true);
  }
});

$("#theme-switch").change(function () {
  if ($(this).is(":checked")) {
    $("html").attr("data-mode", "dark");
    localStorage.setItem("mode", "dark");
  } else {
    $("html").attr("data-mode", "light");
    localStorage.setItem("mode", "light");
  }
});

$(".account").click(function (e) {
  $(".dropdown").toggleClass("active");
});
