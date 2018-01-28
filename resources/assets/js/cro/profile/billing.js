$(document).ready(function () {
    $('#btn-clear-billing-address').click(function() {
        $('#billing_address, #billing_address_sup, #billing_address_notes').val('');
    });

    $('#btn-search-billing-address').click(function() {
        Puzz.getAddressForZipcode($('#billing_zipcode').val(), function(address) {
            $('#billing_address').val(address);
        });
    });
});