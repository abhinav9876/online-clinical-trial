// Script for project create view
(function () {
    $('#cro_project_update_form, #cro_project_create_form').submit(function(e) {
        var $panel = $(this).find('.oscr-panel').not('.oscr-panel--template');

        var $dropdownItems = $panel.find('.oscr-dropdown-item').not('.oscr-dropdown-item--template');
        var $dropdownTextFields = $dropdownItems.find('input[type=text]');
        var $dropdownCheckboxFields = $dropdownItems.find('input[type=checkbox]');
        var $dropdownHiddenFields = $dropdownItems.find('input[type=hidden]');

        $dropdownCheckboxFields.each(function(i) {
            if ($(this).is(':checked')) {
                var $textFieldVal = $($dropdownTextFields[i]).val();
                $($dropdownHiddenFields[i]).val($textFieldVal);
            }
        });

        var $checkboxItems = $panel.find('.oscr-checkbox-item').not('.oscr-dropdown-item--template');
        var $checkboxTextFields = $checkboxItems.find('input[type=text]');
        var $checkboxCheckboxFields = $checkboxItems.find('input[type=checkbox]');
        var $checkboxHiddenFields = $checkboxItems.find('input[type=hidden]');

        $checkboxCheckboxFields.each(function(i) {
            if ($(this).is(':checked')) {
                var $textFieldVal = $($checkboxTextFields[i]).val();
                $($checkboxHiddenFields[i]).val($textFieldVal);
            }
        });

        var $matrixItems = $panel.find('.oscr-matrix-item').not('.oscr-dropdown-item--template');
        var $matrixTextFields = $matrixItems.find('input[type=text]');
        var $matrixCheckboxFields = $matrixItems.find('input[type=checkbox]');
        var $matrixHiddenFields = $matrixItems.find('input[type=hidden]');

        $matrixCheckboxFields.each(function(i) {
            if ($(this).is(':checked')) {
                var $textFieldVal = $($matrixTextFields[i]).val();
                $($matrixHiddenFields[i]).val($textFieldVal);
            }
        });
    });


    $('#add-oscr-panel').click(function () {
        var oscr_count = get_oscr_count();
        var oscr = $('.oscr-panel--template').clone(true);
        var oscr_id = oscr_count;
        oscr.data('oscr-id', oscr_id);
        oscr.find('.oscr-answer-type').each(function () {
            $(this).find('input').attr('name', 'oscr_panel[' + oscr_id + '][answer_type]');
        });
        oscr.find('.oscr-panel__question-text').attr('name', 'oscr_panel[' + oscr_id + '][question]').prop('required', true);

        oscr.find('.oscr-dropdown-item input[type=text]').last().attr('name', 'oscr_panel[' + oscr_id + '][dropdown_item][]').prop('required', true);
        oscr.find('.oscr-dropdown-item input[type=hidden]').last().attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');

        oscr.find('.oscr-checkbox-item input[type=text]').last().attr('name', 'oscr_panel[' + oscr_id + '][checkbox_item][]'); // dropdown first selected, required is needless
        oscr.find('.oscr-checkbox-item input[type=hidden]').last().attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');

        oscr.find('.oscr-matrix-item input[type=text]').last().attr('name', 'oscr_panel[' + oscr_id + '][matrix_item][]');
        oscr.find('.oscr-matrix-item input[type=hidden]').last().attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');

        oscr.removeClass('oscr-panel--template');
        oscr.find('.oscr-panel__question-label').html('A question' + (oscr_id + 1));
        oscr.insertBefore($(this));
        update_oscr();
    });
    $('#remove-oscr-panel').click(function () {
        if (get_oscr_count() == 0) return;
        $('.oscr-panel').last().remove();
        update_oscr();
    });

    $('.oscr-dropdown').each(function () {
        var dropdown = $(this);
        var add_button = dropdown.find('.add-oscr-dropdown-item').first();
        var remove_button = dropdown.find('.remove-oscr-dropdown-item').first();

        $(add_button).click(function () {
            var dropdown = $(this).parents('.oscr-dropdown').first();
            var tools = $(this).parents('.oscr-dropdown-tools').first();
            var item = dropdown.find('.oscr-dropdown-item--template').first().clone(true);
            var item_id = dropdown.find('.oscr-dropdown-item').length - 1;
            var oscr_id = dropdown.parents('.oscr-panel').first().data('oscr-id');
            item.find('input[type=text]').attr('name', 'oscr_panel[' + oscr_id + '][dropdown_item][]').prop('required', true);
            item.find('input[type=hidden]').attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');
            item.removeClass('oscr-dropdown-item--template');
            item.insertBefore(tools);
            update_dropdown(dropdown);
        });

        $(remove_button).click(function () {
            var dropdown = $(this).parents('.oscr-dropdown').first();
            var item_count = dropdown.find('.oscr-dropdown-item').length - 1;
            if (item_count == 0) return;
            dropdown.find('.oscr-dropdown-item').last().remove();
            update_dropdown(dropdown);
        });

        function update_dropdown(dropdown) {
            var item_count = dropdown.find('.oscr-dropdown-item').length - 1;
            var remove_button = dropdown.find('.remove-oscr-dropdown-item').first();
            if (item_count >= 2) {
                remove_button.show();
            } else {
                remove_button.hide();
            }
        }
    });

    $('.oscr-checkbox').each(function () {
        var checkbox = $(this);
        var add_button = checkbox.find('.add-oscr-checkbox-item').first();
        var remove_button = checkbox.find('.remove-oscr-checkbox-item').first();

        $(add_button).click(function () {
            var checkbox = $(this).parents('.oscr-checkbox').first();
            var tools = $(this).parents('.oscr-checkbox-tools').first();
            var item = checkbox.find('.oscr-checkbox-item--template').first().clone(true);
            var item_id = checkbox.find('.oscr-checkbox-item').length - 1;
            var oscr_id = checkbox.parents('.oscr-panel').first().data('oscr-id');
            item.find('input[type=text]').attr('name', 'oscr_panel[' + oscr_id + '][checkbox_item][]').prop('required', true);
            item.find('input[type=hidden]').attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');
            item.removeClass('oscr-checkbox-item--template');
            item.insertBefore(tools);

            update_checkbox(checkbox);
        });

        $(remove_button).click(function () {
            var checkbox = $(this).parents('.oscr-checkbox').first();
            var item_count = checkbox.find('.oscr-checkbox-item').length - 1;
            if (item_count == 0) return;
            checkbox.find('.oscr-checkbox-item').last().remove();
            update_checkbox(checkbox);
        });

        function update_checkbox(checkbox) {
            var item_count = checkbox.find('.oscr-checkbox-item').length - 1;
            var remove_button = checkbox.find('.remove-oscr-checkbox-item').first();
            if (item_count >= 2) {
                remove_button.show();
            } else {
                remove_button.hide();
            }
        }
    });

    $('.oscr-matrix').each(function () {
        var matrix = $(this);
        var add_button = matrix.find('.add-oscr-matrix-item').first();
        var remove_button = matrix.find('.remove-oscr-matrix-item').first();

        $(add_button).click(function () {
            var matrix = $(this).parents('.oscr-matrix').first();
            var tools = $(this).parents('.oscr-matrix-tools').first();
            var item = matrix.find('.oscr-matrix-item--template').first().clone(true);
            var item_id = matrix.find('.oscr-matrix-item').length - 1;
            var oscr_id = matrix.parents('.oscr-panel').first().data('oscr-id');
            item.find('input[type=text]').attr('name', 'oscr_panel[' + oscr_id + '][matrix_item][]').prop('required', true);
            item.find('input[type=hidden]').attr('name', 'oscr_panel[' + oscr_id + '][ng_item][]');
            item.removeClass('oscr-matrix-item--template');
            item.insertBefore(tools);

            update_matrix(matrix);
        });

        $(remove_button).click(function () {
            var matrix = $(this).parents('.oscr-matrix').first();
            var item_count = matrix.find('.oscr-matrix-item').length - 1;
            if (item_count == 0) return;
            matrix.find('.oscr-matrix-item').last().remove();
            update_matrix(matrix);
        });

        function update_matrix(matrix) {
            var item_count = matrix.find('.oscr-matrix-item').length - 1;
            var remove_button = matrix.find('.remove-oscr-matrix-item').first();
            if (item_count >= 2) {
                remove_button.show();
            } else {
                remove_button.hide();
            }
        }
    });

    $('.oscr-answer-type').each(function () {
        $(this).click(function () {
            var oscr = $(this).parents('.oscr-panel').first();
            var id = oscr.data('oscr-id');
            var dropdown = oscr.find('.oscr-dropdown');
            var checkbox = oscr.find('.oscr-checkbox');
            var freetext = oscr.find('.oscr-freetext');
            var matrix = oscr.find('.oscr-matrix');
            var v = $('input[name="oscr_panel[' + id + '][answer_type]"]:checked').val();
            if (v == 0) {
                // dropdown
                showAnswerItem(dropdown);
                hideAnswerItem(checkbox);
                hideAnswerItem(freetext);
                hideAnswerItem(matrix);

            } else if (v == 1) {
                // checkbox
                hideAnswerItem(dropdown);
                showAnswerItem(checkbox);
                hideAnswerItem(freetext);
                hideAnswerItem(matrix);

            } else if (v == 2) {
                // freetext
                hideAnswerItem(dropdown);
                hideAnswerItem(checkbox);
                showAnswerItem(freetext);
                hideAnswerItem(matrix);
            } else if (v == 3) {
                // matrix
                hideAnswerItem(dropdown);
                hideAnswerItem(checkbox);
                hideAnswerItem(freetext);
                showAnswerItem(matrix);
            }
        });
    });

    function hideAnswerItem(answerItem) {
        $(answerItem).find('input').each(function (i, e) {
            if ($(e).parents('.oscr-matrix-item--template').length) return true;
            if ($(e).parents('.oscr-checkbox-item--template').length) return true;
            if ($(e).parents('.oscr-dropdown-item--template').length) return true;
            $(e).removeAttr('required');
        });
        answerItem.hide();
    }

    function showAnswerItem(answerItem) {
        $(answerItem).find('input[type=text]').each(function (i, e) {
            if ($(e).parents('.oscr-matrix-item--template').length) return true;
            if ($(e).parents('.oscr-checkbox-item--template').length) return true;
            if ($(e).parents('.oscr-dropdown-item--template').length) return true;
            $(e).prop('required', true);
        });
        answerItem.show();
    }

    function get_oscr_count() {
        return $('.oscr-panel').length - 1; // -1 is template
    }

    function update_oscr() {
        if (get_oscr_count() == 0) {
            $('#remove-oscr-panel').hide();
        } else {
            $('#remove-oscr-panel').show();
        }
    }

    $('#add-smo-panel').click(function () {
        var smo = $('.smo-panel--template').clone(true);
        smo.find('select').attr('name', 'smo[]');
        smo.removeClass('smo-panel--template');
        smo.insertBefore($(this));
        update_smo();
    });
    $('#remove-smo-panel').click(function () {
        if (get_smo_count() == 0) return;
        $('.smo-panel').last().remove();
        update_smo();
    });

    function get_smo_count() {
        return $('.smo-panel').length - 1; // -1 is template
    }

    function update_smo() {
        if (get_smo_count() == 0) {
            $('#remove-smo-panel').hide();
        } else {
            $('#remove-smo-panel').show();
        }
    }

    $('#add-notification-email-panel').click(function () {
        var email = $('.notification-email-panel--template').clone(true);
        email.find('input').attr('name', 'notification_email[]');
        email.find('input').prop('required', true);
        email.removeClass('notification-email-panel--template');
        email.insertBefore($(this));
        update_email();
    });
    $('#remove-notification-email-panel').click(function () {
        if (get_email_count() == 0) return;
        $('.notification-email-panel').last().remove();
        update_email();
    });

    function get_email_count() {
        return $('.notification-email-panel').length - 1; // -1 is template
    }

    function update_email() {
        if (get_email_count() == 0) {
            $('#remove-notification-email-panel').hide();
        } else {
            $('#remove-notification-email-panel').show();
        }
    }

    update_oscr();
    update_smo();
    update_email();
})();

// Script for project list view
(function () {
    if ($('#cro-project-list').length) {
        $('.puzz-table__action-link').each(function () {
            $(this).click(function () {
                var status = $(this).data('status');
                var project_id = $(this).data('project-id');
                var url = '/cro/project/status/edit/' + project_id + '/' + status;
                var keys = [];

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: "json",
                    success: function (json) {
                        var label = json.project_status_label;
                        $('#cro-project-status-' + project_id).html(label);
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        // todo: handle error
                        console.error(errorThrown);
                    }
                });
            });
        });
    }
})();
