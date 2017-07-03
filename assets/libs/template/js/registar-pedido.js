function getSalas(option) {
  let id = option.value;

  $.ajax({
    method: "GET",
    url: "ajax/getSalas.php?id=" + id,
    success: function(data) {
      $("#sala").html(data).removeAttr("disabled");
      $("#equipamento").html('<option value="" selected hidden>Escolha um equipamento...</option>');
    }
  })
}

$(function () {
  let id;

  id = $("#bloco").val();

  $.ajax({
    method: "GET",
    url: "ajax/getSalas.php?id=" + id,
    success: function(data) {
      $("#sala").html(data).removeAttr("disabled");
    }
  })

  id = $("#sala").val();

  $.ajax({
    method: "GET",
    url: "ajax/getEquip.php?id=" + id,
    success: function(data) {
      $("#equipamento").html(data).removeAttr("disabled");
    }
  });
}); //document.ready

function getEquip(option) {
  let id = option.value;

  $.ajax({
    method: "GET",
    url: "ajax/getEquip.php?id=" + id,
    success: function(data) {
      $("#equipamento").html(data).removeAttr("disabled");
    }
  })
}
