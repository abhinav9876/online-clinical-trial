$(document).ready(function () {
    $('#btn-clear-smo-address').click(function() {
        $('#smo_address, #smo_address_sup, #smo_address_notes').val('');
    });

    $('#btn-search-smo-address').click(function() {
        Puzz.getAddressForZipcode($('#smo_zipcode').val(), function(address) {
            $('#smo_address').val(address);
        });
    });
});