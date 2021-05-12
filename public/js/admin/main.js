$(function() {
    $('#list-of-projects').on('change', newProjectSelected);
});

function newProjectSelected() {
    var id_project = $(this).val();
    location.href = '/proyecto/seleccionado/' + id_project;
};