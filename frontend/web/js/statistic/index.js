// календари
$( function() {
    $( "#datepickerFrom" ).datepicker({
        dateFormat: "yy-mm-dd",
    });
} );
$( function() {
    $( "#datepickerTo" ).datepicker({
        dateFormat: "yy-mm-dd",
    });
} );
let currentDate = new Date();
let currentDateString = currentDate.getFullYear() + '-' + ('0' + (currentDate.getMonth() + 1)).slice(-2) + '-' + ('0' + currentDate.getDate()).slice(-2);
let datePickerFrom = $('#datepickerFrom');
let datePickerTo = $('#datepickerTo');
datePickerFrom.val('2019-06-02');
datePickerTo.val(currentDateString);

//таблица
let table = $('#statistic-table');
let tableHead = table.find('thead');
let tableBody = table.find('tbody');

//алерты с результатом запроса
let alertResultOfRequest = $('#alert_result_of_request');
let alertAdditionalInfo = $('#alert_additional_info');

$('#create_statistic_form').on('beforeSubmit', function () {
    tableBody.html('');
    tableHead.find('th').css('display', 'none');
    hideAlert(alertResultOfRequest);
    alertAdditionalInfo.hide();
    let yiiform = $(this);
    $.ajax({
            type: yiiform.attr('method'),
            url: yiiform.attr('action'),
            data: yiiform.serializeArray()
        }
    )
        .done(function(data) {
            if(data.success) {
                alertResultOfRequest.addClass('alert-success');
                alertResultOfRequest.text('Отчет успешно сформирован');
                alertResultOfRequest.show();

                if (!data.data.length) {
                    alertAdditionalInfo.show();
                } else {
                    table.css('display', 'block');
                    makeTable(data.data);
                }
            }
        })
        .fail(function () {
            alertResultOfRequest.addClass('alert-danger');
            alertResultOfRequest.text('К сожалению, что-то пошло не так');
            alertResultOfRequest.show();
        });

    return false; // отменяем отправку данных формы
});

function makeTable(data) {
    for (let i = 0; i < data.length; i++) {
        if (i === 0) {
            tableHead.find(`th.id`).css('display', 'table-cell');
            for (let key in data[0]) {
                tableHead.find(`th.${key}`).css('display', 'table-cell');
            }
        }
        let tr = tableBody.append('<tr></tr>');
        tr.append(`<th scope="row">${i + 1}</th>`)
        for (let key in data[i]) {
            tr.append(`<td>${data[i][key]}</td>`);
        }
    }
}

function hideAlert(elem) {
    elem.hide;
    elem.text('');
    elem.removeClass('alert-success');
    elem.removeClass('alert-danger');
}