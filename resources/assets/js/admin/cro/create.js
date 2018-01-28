$(document).ready(function () {
    $('#btn-clear-cro-address').click(function() {
        $('#cro_address, #cro_address_sup, #cro_address_notes').val('');
    });

    $('#btn-search-cro-address').click(function() {
        Puzz.getAddressForZipcode($('#cro_zipcode').val(), function(address) {
            $('#cro_address').val(address);
        });
    });
});