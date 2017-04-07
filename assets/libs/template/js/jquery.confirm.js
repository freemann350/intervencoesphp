$('#logout').click(function(){
$.confirm({
title: 'Sair',
content: 'Tem a certeza que pretende sair?',
buttons: {
Sim: function () {
window.location.href = "Logout";
},
Não: function () {

},

}
});
});

$('#submitform').click(function(){
$.confirm({
title: '<?= $echo $ttl;?>',
content: 'Tem a certeza que pretende sair?',
buttons: {
Ok: function () {

},

}
});
});
