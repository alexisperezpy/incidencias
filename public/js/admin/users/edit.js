$(function() {

    $('#select-project').on('change', onSelectProjectChange);

});


function onSelectProjectChange() {
    var id_project = $(this).val();

    if (!id_project) {
        $('#select-level').html('<option value="">Seleccione nivel</option>');
        return;
    }
    //Petición AJAX
    $.get('/api/proyecto/' + id_project + '/niveles', function(data) {
        var html_select = '<option value="">Seleccione nivel</option>';
        for (var i = 0; i < data.length; ++i)
            html_select += '<option value="' + data[i].id + '">' + data[i].name + '</option>';

        $('#select-level').html(html_select);
    });
}