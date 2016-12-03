/**
 * Created by farsad on 12/2/2016.
 */

if(window.jQuery) {
    (function ($) {
        function addParams(url, data) {
            if ( ! $.isEmptyObject(data) )
                url += (url.indexOf('?') > -1 ? '&' : '?') + $.param(data);

            return url;
        }

        function sendMessage(message) {
            parent.postMessage(JSON.stringify(message), window.location.href);
        }

        $(window).load(function() {
            WPBody = $('#wpbody');
            sendMessage({eventName: 'pageLoad', windowHeight: WPBody.height()});
        });

        $(document).ready(function() {
            var WPBody = $('#wpbody'),
                PageLinks = $('a');

            WPBody.siblings().hide();
            WPBody.parents().siblings().hide();

            PageLinks.each(function() {
                $(this).attr('href', addParams($(this).attr('href'), {'forceLTR': true}));
            });

            setInterval(function() {
                sendMessage({eventName: 'pageDimensionsInterval', height: $('#wpwrap').height()});
            }, 50);
        });
    }(jQuery));
} else
    console.log('This plugin is jQuery depended.');