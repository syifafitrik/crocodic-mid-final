
/* Block UI definition */
let blockUI = Swal.mixin({
    title: "Loading",
    html: "",
    timer: 0,
    allowOutsideClick: false,
    allowEscapeKey: false,
    didOpen: () => {
        Swal.showLoading();
    },
});

/* Toast object config */
let toast = {
    toast: true,
    timer: 5000,
    position: "top-end",
    showConfirmButton: false,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
};

/* Toastr function based on Swal2 */

/**
 * How to use option
 * 
 * var option = { ...toast };
 * option.timer = 2000;
 * option.didClose = function() {
 *      alert('hohoho');
 * };
 */

let toastr = new Object({
    info: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "info",
            text: message,
            showClass: {
                icon: '',
            },
            customClass: {
                icon: "text-white border-white border-3",
                popup: "bg-info",
                htmlContainer: "text-white"
            }
        });
    },
    success: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "success",
            text: message,
            showClass: {
                icon: '',
            },
            customClass: {
                popup: "bg-success",
                htmlContainer: "text-white"
            }
        });
    },
    warning: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "warning",
            text: message,
            showClass: {
                icon: '',
            },
            customClass: {
                icon: "text-white border-white border-3",
                popup: "bg-warning",
                htmlContainer: "text-white"
            }
        });
    },
    error: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "error",
            text: message,
            showClass: {
                icon: '',
            },
            customClass: {
                popup: "bg-danger",
                htmlContainer: "text-white"
            }
        });
    },
    question: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "question",
            text: message,
            showClass: {
                icon: '',
            },
        });
    },
    infoHtml: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "info",
            html: message,
            showClass: {
                icon: '',
            },
            customClass: {
                icon: "text-white border-white border-3",
                popup: "bg-info",
                htmlContainer: "text-white"
            }
        });
    },
    successHtml: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "success",
            html: message,
            showClass: {
                icon: '',
            },
            customClass: {
                popup: "bg-success",
                htmlContainer: "text-white"
            }
        });
    },
    warningHtml: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "warning",
            html: message,
            showClass: {
                icon: '',
            },
            customClass: {
                icon: "text-white border-white border-3",
                popup: "bg-warning",
                htmlContainer: "text-white"
            }
        });
    },
    errorHtml: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "error",
            html: message,
            showClass: {
                icon: '',
            },
            customClass: {
                popup: "bg-danger",
                htmlContainer: "text-white"
            }
        });
    },
    questionHtml: (message = "", option = { ...toast }) => {
        Swal.mixin(option).fire({
            icon: "question",
            html: message,
            showClass: {
                icon: '',
            },
        });
    },
});

function date2str(x, y) {
    var z = {
        M: x.getMonth() + 1,
        d: x.getDate(),
        h: x.getHours(),
        m: x.getMinutes(),
        s: x.getSeconds()
    };
    y = y.replace(/(M+|d+|h+|m+|s+)/g, function (v) {
        return ((v.length > 1 ? "0" : "") + z[v.slice(-1)]).slice(-2)
    });

    return y.replace(/(y+)/g, function (v) {
        return x.getFullYear().toString().slice(-v.length)
    });
}

// number converter
let separator_thousand = ".";
let separator_decimal = ",";

function thousandDivider(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function thousandDivider2(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function thousand2number(x) {
    return x.replace(/[^0-9]/gi, '');
}

function thousandFormatter(numbers) {
    var lastChar = numbers.slice(-1); // get last character
    var arr_numbers = numbers.split(separator_decimal); // split by decimal separator 
    var x = arr_numbers[0] ? arr_numbers[0].replace(/\D/g, '') : ''; // we want to add thousand separator here
    var y = arr_numbers[1] ? arr_numbers[1].replace(/\D/g, '') : ''; // then append decimal after separator

    // if x is empty then we dont want to calculate
    if (x.length > 0) {
        x = x.split(/(?=(?:...)*$)/); // split by regex to add thousand separator
        x = x.join(separator_thousand); // rejoin splitted array with thousand separator
        x = y || lastChar == ',' ? x + separator_decimal + y :
            x; // check if has decimal, or last character is decimal separator
    }

    return x;
}


// string helper
function capitalizeFirstLetter(str, lower = false) {
    if (lower == true) str = str.toLowerCase();
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function capitalizeEachWord(str, lower = false) {
    if (lower == true) str = str.toLowerCase();
    var words = str.split(" ");

    return words.map((w) => {
        return w.charAt(0).toUpperCase() + w.slice(1);
    }).join(' ');
}


// json helper
function jsonPropsLowerCase(jsonData) {
    var jd = new Object(); // Create Temporary Object
    for (var jx in jsonData) {
        jd[jx.toLowerCase()] = jsonData[jx]; // Convert Props Name to Lower Case, you can make it Upper Case too
    }

    return jd;
}

// Filtering object value yang memiliki criteria (array filter php)
function findInObject(object, criteria) {
    return object.filter(function (obj) {
        return Object.keys(criteria).every(function (c) {
            return obj[c] == criteria[c];
        });
    });
}