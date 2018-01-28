$(document).ready(function () {
    $('#application_exam_date_update_button').click(onClickUpdateExamDate);
    $('#send-subject-booking-notification').click(onClickSendReservationCompleteEmail);

    if ($('#smo-subject-show').length) {
        $('.puzz-table__action-link').each(function () {
            $(this).click(function () {
                var status = $(this).data('status');
                var subject_id = $(this).data('subject-id');
                var url = '/smo/subjects/' + subject_id + '/status';
                var data = {
                    status: status
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    contentType: 'application/json',
                    data: JSON.stringify(data),
                    success: function (json) {
                        var label = json.subject_status_label;
                        $('#smo-subject-status').html(label);
                        alertSuccess('Statusを Changeしました');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        // todo: handle error
                        alertDanger('Statusの Changeに失敗しました');
                        console.error(errorThrown);
                    }
                });
            });
        });

        function reset_alert() {
            $('.alert').each(function () {
                $(this).hide();
            });
        }
    }
});

function onClickUpdateExamDate() {
    var $btn = $(this);
    var subjectId = $('#subjectId').val();
    var url = '/smo/subjects/' + subjectId + '/exam_date';
    var examDate = $('#application_exam_date').val();
    var data = {application_exam_date: examDate};

    $btn.button('loading');
    window.axios.post(url, data).then(function (response) {
        $btn.button('reset');
        alertSuccess(response.data.message);
    }).catch(function (e) {
        $btn.button('reset');
        alertDanger(e.response.data.message);
    });
}

function onClickSendReservationCompleteEmail() {
    var $btn = $(this);
    var subjectId = $('#subjectId').val();
    var url = ['/smo', 'subjects', subjectId, 'notify'].join('/');

    $btn.button('loading');
    window.axios.post(url).then(function (response) {
        $btn.button('reset');
        showAlert('#send_subject_booking_alert', _.defaultTo(response.data.message, '成功しました。'), 'alert-success');
    }).catch(function (e) {
        $btn.button('reset');
        showAlert('#send_subject_booking_alert', _.defaultTo(e.response.data.message, 'エラーが発生しました。'), 'alert-danger');
    });
}

function alertDanger(message) {
    var $alert = $('#alert-danger');
    $alert.html(message || 'エラーが発生しました。');
    $alert.show();
}

function alertSuccess(message) {
    var $alert = $('#alert-info');
    $alert.html(message || '成功しました。');
    $alert.show();
}

function showAlert(placeholder, message, type) {
    $(placeholder).append(
        '<div class="alert ' + type + '">' + message + '\n' +
        '    <button type="button" class="close" data-dismiss="alert" aria-label="閉じる">\n' +
        '        <span aria-hidden="true">&times;</span>\n' +
        '    </button>\n' +
        '</div>'
    );

    $(placeholder).alert();
}
