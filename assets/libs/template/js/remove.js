$('.deleteRecord').click(function() {
    $.confirm({
        title: 'Sair',
        content: 'Tem a certeza que pretende eliminar este registo (Nº: 1)',
        buttons: {
            Sim: function() {
                $.alert('A eliminar...');
            },
            Não: function() {

            },

        }
    });
});
