// Script for subject list view
(function() {
  if ($('#smo-subject-list').length) {
    $('.puzz-table__action-link').each(function() {
      $(this).click(function() {
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
          success: function(json) {
            var label = json.subject_status_label;
            $('#smo-subject-status-' + subject_id).html(label);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            // todo: handle error
            console.error(errorThrown);
          }
        });
      });
    });
  }
})();
