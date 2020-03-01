const formatTime = date => {
    date = new Date(date * 1000);
    const year = date.getFullYear()
    const month = date.getMonth() + 1
    const day = date.getDate()
    const hour = date.getHours()
    const minute = date.getMinutes()
    const second = date.getSeconds()

    return [year, month, day].map(formatNumber).join('-') + ' ' + [hour, minute, second].map(formatNumber).join(':')
}

const formatNumber = n => {
    n = n.toString()
    return n[1] ? n : '0' + n
}

function ksort(inputArr, sort_flags) {
    var tmp_arr = {},
        keys = [],
        sorter,
        i,
        k,
        that = this,
        strictForIn = false,
        populateArr = {};

    switch (sort_flags) {
        case 'SORT_STRING':
            // compare items as strings
            sorter = function (a, b) {
                return that.strnatcmp(a, b);
            };
            break;
        case 'SORT_LOCALE_STRING':
            // compare items as strings, original by the current locale (set with  i18n_loc_set_default() as of PHP6)
            var loc = this.i18n_loc_get_default();
            sorter = this.php_js.i18nLocales[loc].sorting;
            break;
        case 'SORT_NUMERIC':
            // compare items numerically
            sorter = function (a, b) {
                return ((a + 0) - (b + 0));
            };
            break;
        // case 'SORT_REGULAR': // compare items normally (don't change types)
        default:
            sorter = function (a, b) {
                var aFloat = parseFloat(a),
                    bFloat = parseFloat(b),
                    aNumeric = aFloat + '' === a,
                    bNumeric = bFloat + '' === b;
                if (aNumeric && bNumeric) {
                    return aFloat > bFloat ? 1 : aFloat < bFloat ? -1 : 0;
                } else if (aNumeric && !bNumeric) {
                    return 1;
                } else if (!aNumeric && bNumeric) {
                    return -1;
                }
                return a > b ? 1 : a < b ? -1 : 0;
            };
            break;
    }

    // Make a list of key names
    for (k in inputArr) {
        if (inputArr.hasOwnProperty(k)) {
            keys.push(k);
        }
    }
    keys.sort(sorter);

    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};
    this.php_js.ini = this.php_js.ini || {};
    // END REDUNDANT
    strictForIn = this.php_js.ini['phpjs.strictForIn'] && this.php_js.ini['phpjs.strictForIn'].local_value && this.php_js
        .ini['phpjs.strictForIn'].local_value !== 'off';
    populateArr = strictForIn ? inputArr : populateArr;

    // Rebuild array with sorted key names
    for (i = 0; i < keys.length; i++) {
        k = keys[i];
        tmp_arr[k] = inputArr[k];
        if (strictForIn) {
            delete inputArr[k];
        }
    }
    for (i in tmp_arr) {
        if (tmp_arr.hasOwnProperty(i)) {
            populateArr[i] = tmp_arr[i];
        }
    }

    return strictForIn || populateArr;
}

function urlencode(str) {
    str = (str + '').toString();
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
};

/**
 * 将数组转成http格式
 * @param formdata
 * @param numeric_prefix
 * @param arg_separator
 * @returns {string}
 */
function http_build_query(formdata, numeric_prefix, arg_separator) {
    var value,
        key,
        tmp = [],
        that = this;

    var _http_build_query_helper = function (key, val, arg_separator) {
        var k,
            tmp = [];
        if (val === true) {
            val = "1";
        } else if (val === false) {
            val = "0";
        }
        if (val !== null && typeof(val) === "object") {
            for (k in val) {
                if (val[k] !== null) {
                    tmp.push(_http_build_query_helper(key + "[" + k + "]", val[k], arg_separator));
                }
            }
            return tmp.join(arg_separator);
        } else if (typeof(val) !== "function") {
            return urlencode(key) + "=" + urlencode(val);
        } else if (typeof(val) == "function") {
            return '';
        } else {
            throw new Error('There was an error processing for http_build_query().');
        }
    };

    if (!arg_separator) {
        arg_separator = "&";
    }
    for (key in formdata) {
        value = formdata[key];
        if (numeric_prefix && !isNaN(key)) {
            key = String(numeric_prefix) + key;
        }
        tmp.push(_http_build_query_helper(key, value, arg_separator));
    }

    return tmp.join(arg_separator);
};
//倒计时
var length = 60;
function countdown(that) {
    var seconds = that.data.seconds;
    var captchaLabel = that.data.captchaLabel;
    if (seconds <= 1) {
        captchaLabel = '发送验证码';
        seconds = length;
        that.setData({
            captchaDisabled: false
        });
    } else {
        captchaLabel = --seconds + '秒'
    }
    that.setData({
        seconds: seconds,
        captchaLabel: captchaLabel
    });
}
/*验证手机号*/
function checkPhone(phone)
{
    var rule_phone = /^[1][3-9]\d{9}$|^([4|5|6|7|8|9])\d{7}$|^[0][9]\d{8}$|^[6]([8|6])\d{5}$/;
    if(!rule_phone.test(phone))
    {
        wx.showToast({
            title:'请正确输入手机号码！',
            icon: 'none',
            duration: 3000,
            mask:true
        })
        return false;
    }
    return phone;
}
function showError(msg){
    wx.showToast({
        title:msg,
        icon: 'none',
        duration: 3000,
        mask:true
    })
    return false;
}
module.exports = {
    formatTime: formatTime,
    ksort: ksort,
    build_query: http_build_query,
    countdown:countdown,
    length:length,
    checkPhone:checkPhone,
    showError:showError
}
