// $(document).onload();

$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
    });
} );
$currentDate = new Date();
$currentDateString = $currentDate.getFullYear() + '-' + ('0' + ($currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + $currentDate.getDate()).slice(-2);
document.getElementById('datepicker').value = $currentDateString;


let resultOfCreatingElem = $('#result_of_creating');
let resultOfCreatingElemTestSpan = $('#result_of_creating > span');

$('#create_transaction_form').on('beforeSubmit', function () {
    let yiiform = $(this);
    resultOfCreatingElemTestSpan.text('');
    resultOfCreatingElem.removeClass('alert-success alert-danger');
    resultOfCreatingElem.css('display', 'none');
    $.ajax({
            type: yiiform.attr('method'),
            url: yiiform.attr('action'),
            data: yiiform.serializeArray()
        }
    )
        .done(function(data) {
            if(data.success) {
                $.pjax.reload({container:'#p0'});
                console.log(data);
                resultOfCreatingElemTestSpan.text(`Транзакция с id:${data.id} успешно создана`);
                resultOfCreatingElem.addClass('alert-success');
                resultOfCreatingElem.css('display', 'block');
                yiiform.trigger('reset');
            } else {
                $.pjax.reload({container:'#p0'});
                resultOfCreatingElemTestSpan.text('Не удалось создать транзакцию');
                resultOfCreatingElem.addClass('alert-danger');
                resultOfCreatingElem.css('display', 'block');
            }
        })
        .fail(function () {
            $.pjax.reload({container:'#p0'});
            resultOfCreatingElemTestSpan.text('Не удалось создать транзакцию');
            resultOfCreatingElem.addClass('alert-danger');
            resultOfCreatingElem.css('display', 'block');
        });

    return false; // отменяем отправку данных формы
});