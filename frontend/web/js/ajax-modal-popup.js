// запускатор модальных окон. Через ajax загружает необходимые данные для форм
$(function(){
    $(document).on('click', '.showModalButton', function(){
        if ($('#category-and-company_modal').data('bs.modal').isShown) {
            $('#category-and-company_modal').find('#modalContent')
                .load($(this).attr('value'));
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            $('#category-and-company_modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});