$(function() {
    // Llamado a la función a traves del elemento data-level|data-category
    $('[data-category]').on('click', editCategoriaModal);
    $('[data-level]').on('click', editNivelModal);
});

function editCategoriaModal() {
    // id de categoria
    var idCategoria = $(this).data('category');
    $('#categoria_id').val(idCategoria);
    $('#modalEditCategoria').modal('show');

    //name de la categoria
    var nameCategoria = $(this).parent().prev().text();
    $('#categoria_name').val(nameCategoria);
}


function editNivelModal() {
    // id de nivel
    var idLevel = $(this).data('level');
    $('#nivel_id').val(idLevel);
    $('#modalEditNivel').modal('show');

    //name del nivel
    var nameNivel = $(this).parent().prev().text();
    $('#nivel_name').val(nameNivel);
}