function format_currency(number, fraction = 0) {
    if (number == null) {
        return ''
    }

    let formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: parseInt(fraction),
    });

    return formatter.format(parseFloat(number))
}

function highlight_search(data, search) {
    let result = data
    if (search != '') {
        let re = new RegExp(search, "g"); // search for all instances
        result = data.replace(re, `<span class="bg-warning">${search}</span>`);
    }
    return result
}

function redirectWithFlash(url, message, type, title) {
    $('#form-redirect').find('input[name=toastr_message]').val(message)
    $('#form-redirect').find('input[name=toastr_type]').val(type)
    $('#form-redirect').find('input[name=toastr_title]').val(title)
    $('#form-redirect').find('input[name=url]').val(url)
    $('#form-redirect').submit()
}

/**
 * Calculates the difference between two dates.
 * 
 * @param {string} startDate start date
 * @param {string} endDate end date
 * @param {string} units expected result units. default = day. Available units: day, hour
 * @param {boolean} isRoundUp true if round up the result
 * @returns {Number} the difference
 */
function getDateDiff(startDate, endDate, units = 'day', isRoundUp = true) {
    let result = 0
    if (startDate != '' && endDate != '') {
        let diffInMillisecond = new Date(endDate) - new Date(startDate)
        let diff = diffInMillisecond / 1000 / 60 / 60 / 24
        if (units == 'hour') {
            diff = diff * 24
        }
        result = isRoundUp ? Math.ceil(diff) : diff
    }
    return result
}