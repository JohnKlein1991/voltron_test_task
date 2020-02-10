let resultElement = $('#result_of_company_creating');
let resultElementSpan = $('#result_of_company_creating > span');

$('#category-and-company_modal').on('shown.bs.modal', function (e) {
    $('#category-and-company_modal_form').on('submit', function () {
        let form = $(this);
        resultElementSpan.text('');
        resultElement.removeClass('alert-success alert-danger');
        resultElement.css('display', 'none');
        $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serializeArray()
            }
        )
            .done(function(data) {
                if(data.success) {
                    $.pjax.reload({container:'#p0'});
                    console.log(data);
                    resultElementSpan.text("Операция прошла успешно)");
                    resultElement.addClass('alert-success');
                    resultElement.css('display', 'block');
                    form.trigger('reset');
                    $('#category-and-company_modal').modal('hide');
                } else {
                    $.pjax.reload({container:'#p0'});
                    resultElementSpan.text('Что-то пошло не так ...');
                    resultElement.addClass('alert-danger');
                    resultElement.css('display', 'block');
                    $('#category-and-company_modal').modal('hide');
                }
            })
            .fail(function () {
                $.pjax.reload({container:'#p0'});
                resultElementSpan.text('Что-то пошло не так ...');
                resultElement.addClass('alert-danger');
                resultElement.css('display', 'block');
                $('#category-and-company_modal').modal('hide');
            });
        return false;
    });
});