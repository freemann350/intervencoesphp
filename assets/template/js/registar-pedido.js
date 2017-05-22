function getSalas(option) {
  let id = option.value;

  $.ajax({
    method: "GET",
    url: "ajax/getSalas.php?id=" + id,
    success: function(data) {
      $("#sala").html(data).removeAttr("disabled");
    }
  })
}
$(function () {
  let id = $("#bloco").val();

  $.ajax({
    method: "GET",
    url: "ajax/getSalas.php?id=" + id,
    success: function(data) {
      $("#sala").html(data).removeAttr("disabled");
    }
  })
});
