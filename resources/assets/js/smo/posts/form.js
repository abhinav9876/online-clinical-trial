$(document).ready(function () {
    $('#btn-clear-address').click(onClickClearAddress);
    $('#btn-search-address').click(onClickSearchAddress);
    $('#add-exam-schedule-item-btn').click(onClickAddTableRow.bind(this, '.exam_schedule_item'));
    $('#add-reward-item-btn').click(onClickAddTableRow.bind(this, '.reward_item'));
    initTableRowHandlers();
});

function initTableRowHandlers() {
    var DEFAULT_LOCALE = 'ja';
    $('.datetimepicker').datetimepicker({
        locale: $('html').attr('lang') || DEFAULT_LOCALE
    });

    $('.exam_schedule_item .button--delete').click(function () {
        onClickDeleteTableRow.call($(this), '.exam_schedule_item');
    });

    $('.reward_item .button--delete').click(function() {
        onClickDeleteTableRow.call($(this), '.reward_item');
    });
}

function onClickClearAddress() {
    $('#facility_address, #facility_address_sup, #facility_address_notes').val('');
}

function onClickSearchAddress() {
    var zipcode = $('#facility_zip_code').val();
    Puzz.getAddressForZipcode(zipcode, function(address) {
        $('#facility_address').val(address);
    });
}

function onClickAddTableRow(tableRowSelector) {
    var lastItem = $(tableRowSelector).filter(':last');
    var matches = /\[([0-9]+)]/.exec(lastItem.attr('id'));
    if (!matches) {
        return;
    }
    var lastIndex = _.toNumber(matches[1]);
    var nextItem = lastItem.clone();
    nextItem.find('*').add(nextItem).each(function() {
        var $self = $(this);

        if ($self.prop('tagName').toLowerCase() === 'input') {
            $self.val('');
        }

        $.each(this.attributes, function(i, attr) {
            if (_.includes(attr.value, '[' + lastIndex + ']')) {
                $self.attr(attr.name, _.replace(attr.value, '[' + lastIndex + ']', '[' + (lastIndex + 1) + ']'));
            }
        });
    });
    nextItem.insertAfter(lastItem);
    initTableRowHandlers();
}

function onClickDeleteTableRow(tableRowSelector) {
    if ($(tableRowSelector).length > 1) {
        this.closest(tableRowSelector).remove();
    }
}