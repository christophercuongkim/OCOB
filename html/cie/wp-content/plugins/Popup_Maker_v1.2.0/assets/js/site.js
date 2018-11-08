(function ($) {
    "use strict";

    var referrer = document.referrer,
        url = document.location.toString(),
        md = new MobileDetect(window.navigator.userAgent),
        pages_viewed = PUM.getCookie('pum_alm_pages_viewed') || [],
        current_page = parseInt(pum_atc_vars.page) || -1,
        query_args;

    if (typeof pages_viewed === 'string') {
        pages_viewed = pages_viewed.split(',');
    }

    if (pages_viewed.length) {
        for(var i = 0; pages_viewed.length > i; i++) {
            pages_viewed[i] = parseInt(pages_viewed[i].trim());
        }
    }

    if (current_page >= 0 && pages_viewed.indexOf(current_page) === -1) {
        pages_viewed.push(current_page);
        $.pm_cookie('pum_alm_pages_viewed', pages_viewed.join(','), {expires: '1 month'}, '/');
    }

    function validRegex(string) {
        var isValid = true,
            regex;

        try {
            regex = new RegExp(string);
        } catch (e) {
            isValid = false;
        }

        if (!isValid) {
            alert("Invalid regular expression");
            return false;
        }

        return regex;
    }

    function get_browser() {
        var ua = navigator.userAgent, tem, M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
        if (/trident/i.test(M[1])) {
            tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
            return {name: 'IE', version: (tem[1] || '')};
        }
        if (M[1] === 'Chrome') {
            tem = ua.match(/\bOPR\/(\d+)/);
            if (tem !== null) {
                return {name: 'Opera', version: tem[1]};
            }
        }
        M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, '-?'];
        if ((tem = ua.match(/version\/(\d+)/i)) !== null) {
            M.splice(1, 1, tem[1]);
        }
        return {
            name: M[0],
            version: M[1]
        };
    }

    function getQueryParameters(str) {
        var qso = {},
            qs = (str || document.location.search);

        // Check for an empty query string
        if (qs === "") {
            return qso;
        }

        // Normalize the query string
        qs = qs.replace(/(^\?)/, '')
            .replace(/;/g, '&');
        while (qs.indexOf("&&") != -1) {
            qs = qs.replace(/&&/g, '&');
        }
        qs = qs.replace(/([\&]+$)/, '');

        // Break the query string into parts
        qs = qs.split("&");

        function decode_string(n) {
            return decodeURIComponent(n);
        }

        // Build the query string object
        for (var i = 0; i < qs.length; i++) {
            var qi = qs[i].split("=");
            qi = $.map(qi, decode_string);
            if (qso[qi[0]] !== undefined) {

                // If a key already exists then make this an object
                if (typeof(qso[qi[0]]) == "string") {
                    var temp = qso[qi[0]];
                    if (qi[1] === "") {
                        qi[1] = null;
                    }
                    qso[qi[0]] = [];
                    qso[qi[0]].push(temp);
                    qso[qi[0]].push(qi[1]);

                } else if (typeof(qso[qi[0]]) == "object") {
                    if (qi[1] === "") {
                        qi[1] = null;
                    }
                    qso[qi[0]].push(qi[1]);
                }
            } else {
                // If no key exists just set it as a string
                if (qi[1] === "") {
                    qi[1] = null;
                }
                qso[qi[0]] = qi[1];
            }
        }

        return qso;
    }

    query_args = getQueryParameters();

    $.extend($.fn.popmake.conditions, {

        // region URL
        url_is: function (settings) {
            var search = settings.search || false,
                regex = new RegExp("^" + search + "$") || false;

            if (!search) {
                return true;
            }

            return regex.test(url);
        },
        url_contains: function (settings) {
            var search = settings.search || false,
                regex = new RegExp(search) || false;

            if (!search) {
                return true;
            }

            return regex.test(url);
        },
        url_begins_with: function (settings) {
            var search = settings.search || false,
                regex = new RegExp("^" + search);

            if (!search) {
                return true;
            }

            return regex.test(url);
        },
        url_ends_with: function (settings) {
            var search = settings.search || false,
                regex = new RegExp(search + "$");

            if (!search) {
                return true;
            }

            return regex.test(url);
        },
        url_regex: function (settings) {
            var search = settings.search || false,
                regex = validRegex(search);

            if (!search) {
                return true;
            }

            if (!regex) {
                return false;
            }

            return regex.test(url);
        },
        // endregion

        // region Query Args
        query_arg_exists: function (settings) {
            var arg = settings.arg_name || false;

            if (!arg) {
                return false;
            }

            return arg in query_args;
        },
        query_arg_is: function (settings) {
            var arg = settings.arg_name || false,
                value = settings.arg_value || false;

            if (!arg) {
                return false;
            }

            if (typeof query_args[arg] === 'undefined') {
                return false;
            }

            return query_args[arg] == value;
        },
        // endregion

        // region Browser
        browser_is: function (settings) {
            var browsers = settings.selected || [],
                i;

            for (i = 0; browsers.length > i; i++) {
                if (browsers[i] === get_browser().name) {
                    return true;
                }
            }

            return false;
        },
        browser_version: function (settings) {
            var morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false,
                version = parseFloat(get_browser().version);

            if (morethan && !lessthan) {
                return version > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > version;
            }

            if (lessthan && morethan) {
                return lessthan > version && version > morethan;
            }

            return false;
        },
        browser_width: function (settings) {
            var width = window.innerWidth,
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false;

            if (morethan && !lessthan) {
                return width > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > width;
            }

            if (lessthan && morethan) {
                return lessthan > width && width > morethan;
            }

            return !lessthan && !morethan;
        },
        browser_height: function (settings) {
            var height = window.innerHeight,
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false;

            if (morethan && !lessthan) {
                return height > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > height;
            }

            if (lessthan && morethan) {
                return lessthan > height && height > morethan;
            }

            return !lessthan && !morethan;
        },
        // endregion

        // region Device
        device_is_mobile: function () {
            return md.mobile();
        },
        device_is_phone: function () {
            return md.phone();
        },
        device_is_tablet: function () {
            return md.tablet();
        },
        device_is_brand: function (settings) {
            var brands = settings.selected || [],
                i;

            for (i = 0; brands.length > i; i++) {
                if (md.is(brands[i])) {
                    return true;
                }
            }

            return false;
        },
        device_screen_width: function (settings) {
            var width = window.screen.width,
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false;

            if (morethan && !lessthan) {
                return width > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > width;
            }

            if (lessthan && morethan) {
                return lessthan > width && width > morethan;
            }

            return !lessthan && !morethan;
        },
        device_screen_height: function (settings) {
            var height = window.screen.height,
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false;

            if (morethan && !lessthan) {
                return height > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > height;
            }

            if (lessthan && morethan) {
                return lessthan > height && height > morethan;
            }

            return !lessthan && !morethan;
        },
        // endregion

        // region Referrer
        referrer_is: function (settings) {
            var search = settings.search || false,
                regex = new RegExp("^" + search + "$") || false;

            if (!search) {
                return true;
            }

            return regex.test(referrer);
        },
        referrer_contains: function (settings) {
            var search = settings.search || false,
                regex = new RegExp(search) || false;

            console.log(referrer, search, regex, regex.test(referrer));

            if (!search) {
                return true;
            }

            return regex.test(referrer);
        },
        referrer_begins_with: function (settings) {
            var search = settings.search || false,
                regex = new RegExp("^" + search);

            if (!search) {
                return true;
            }

            return regex.test(referrer);
        },
        referrer_ends_with: function (settings) {
            var search = settings.search || false,
                regex = new RegExp(search + "$");

            if (!search) {
                return true;
            }

            return regex.test(referrer);
        },
        referrer_regex: function (settings) {
            var search = settings.search || false,
                regex = validRegex(search);

            if (!search) {
                return true;
            }

            if (!regex) {
                return false;
            }

            return regex.test(referrer);
        },
        referrer_is_search_engine: function (settings) {
            var search = settings.search || [],
                regex;

            if (typeof search !== 'string') {
                search = search.join('|');
            }

            regex = validRegex(search);

            return regex.test(referrer);
        },
        referrer_is_external: function () {
            return referrer !== '' && referrer.indexOf(location.protocol + "//" + location.host) === -1;
        },
        // endregion

        // region Cookies
        cookie_exists: function (settings) {
            var arg = settings.cookie_name || false;

            if (!arg) {
                return false;
            }

            return $.fn.popmake.cookie.process(arg) !== undefined;
        },
        cookie_is: function (settings) {
            var arg = settings.cookie_name || false,
                value = settings.cookie_value || false;

            if (!arg) {
                return false;
            }

            if ($.fn.popmake.cookie.process(arg) === undefined) {
                return false;
            }

            return $.fn.popmake.cookie.process(arg) == value;
        },
        page_views: function (settings) {
            var count = parseInt(PUM.getCookie('pum_alm_page_views')) || 0,
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false;

            if (typeof count !== 'number') {
                count = 0;
            }

            count++;

            $.pm_cookie('pum_alm_page_views', count, {expires: '1 day'}, '/');

            if (morethan && !lessthan) {
                return count > morethan;
            }

            if (lessthan && !morethan) {
                return lessthan > count;
            }

            if (lessthan && morethan) {
                return lessthan > count && count > morethan;
            }

            return !lessthan && !morethan;
        },
        time_on_site: function (settings) {

            var first_activity = PUM.getCookie('pum_alm_first_activity') || false,
                last_activity = PUM.getCookie('pum_alm_last_activity') || false,
                now = new Date(),
                morethan = parseFloat(settings.morethan) || false,
                lessthan = parseFloat(settings.lessthan) || false,
                time_on;

            // If no first activity, or the last activity is to old.
            if (!first_activity || (last_activity + 3600 < now.getTime())) {
                first_activity = new Date();
                first_activity = first_activity.getTime();
                $.pm_cookie('pum_alm_first_activity', first_activity, {expires: '1 day'}, '/');
            }

            $.pm_cookie('pum_alm_last_activity', now.getTime(), {expires: '1 day'}, '/');

            time_on = now.getTime() - first_activity;

            if (morethan && !lessthan) {
                return time_on > (morethan * 60 * 1000);
            }

            if (lessthan && !morethan) {
                return (lessthan * 60 * 1000) > time_on;
            }

            if (lessthan && morethan) {
                return (lessthan * 60 * 1000) > time_on && time_on > (morethan * 60 * 1000);
            }

            return !lessthan && !morethan;
        },
        has_viewed_page: function (settings) {
            var required = settings.selected || [];

            if (typeof required === 'string') {
                required = required.split(',');
            }

            if (required.length) {
                for(var i = 0; required.length > i; i++) {
                    var int = parseInt(required[i].trim());

                    if ( int >= 0 && pages_viewed.indexOf(int) === -1 ) {
                        return false;
                    }
                }
            }

            return true;

        },

        // endregion

        js_function: function (settings) {
            if (settings.function_name === undefined || typeof window[settings.function_name] !== 'function') {
                return false;
            }

            return window[settings.function_name]();
        }
    });

}(jQuery));