Puzz.getAddressForZipcode = function(zipcode, callback) {
    var query = $.param({lang: 'en', zipcode: zipcode});
    $.ajax('https://api.zipaddress.net?' + query, {
        method: 'GET',
        async: true,
        crossDomain: true,
        dataType: 'json',
        error: onSearchAddressError,
        success: function(data, textStatus, jqXHR) {
            onSearchAddressSuccess(data, textStatus, jqXHR, callback);
        },
        timeout: 3000
    });
};

function onSearchAddressSuccess(data, textStatus, jqXHR, callback) {
    if (!data) {
        return onSearchAddressError(jqXHR, '500', 'data not found', '不明なエラーが発生しました。');
    }

    if (data.code && (data.code >= 400 && data.code < 500)) {
        return onSearchAddressError(jqXHR, data.code, data.message, '郵便番号をconfirmationしてもう一度お試しください。');
    }

    if (_.has(data, 'data.fullAddress')) {
        callback(data.data.fullAddress);
    } else {
        return onSearchAddressError(jqXHR, '500', 'data.fullAddress not found', '不明なエラーが発生しました。');
    }
}

function onSearchAddressError(jqXHR, textStatus, errorThrown, errorDisplayed) {
    console.error('[' + textStatus + '] ' + errorThrown);
    window.alert(errorDisplayed);
}
