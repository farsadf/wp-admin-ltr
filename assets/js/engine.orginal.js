/**
 * Created by farsad on 12/1/2016.
 */
if (window.jQuery) {
    (function ($) {
        String.prototype.format = function() {
            var formatted = this;
            for (var i = 0; i < arguments.length; i++) {
                var regexp = new RegExp('\\{'+i+'\\}', 'gi');
                formatted = formatted.replace(regexp, arguments[i]);
            }
            return formatted;
        };

        function addParams(url, data) {
            if ( ! $.isEmptyObject(data) )
                url += (url.indexOf('?') > -1 ? '&' : '?') + $.param(data);

            return url;
        }

        function messageHandler(event) {
            var iframeInstance = $('#admin-ltr-iframe');

            if(iframeInstance.length > 0) {
                if (event.originalEvent.data != '' && event.originalEvent.data != null) {
                    event = JSON.parse(event.originalEvent.data);
                    switch (event.eventName) {
                        case 'pageLoad':
                            iframeInstance.css({minHeight: event.windowHeight});
                            break;
                        case 'pageDimensionsInterval':
                            iframeInstance.css({height: event.height});
                            break;
                    }
                }
            } else
                console.log('iFrame instance not found.');
        }

        $(document).ready(function() {
            // DEFINING VARS
            var adminLTRButtonWrap = $('#admin-ltr-wrap'),
                adminLTRButton  = $('#admin-ltr'),
                wordpressPageBody = $('#wpbody'),
                wordpressPageContent = $('#wpbody-content'),
                adminLTRIFrameString = '<div id="admin-ltr-iframe-wrap"><iframe src="{0}" id="admin-ltr-iframe"></iframe></div>',
                screenMetaLinks = $('#screen-meta-links');

            if ( screenMetaLinks.length <= 0 )
                adminLTRButtonWrap.css({marginLeft: '20px'});

            adminLTRButton.on('click', function () {
                var ajaxURL = addParams(window.location.href, {'forceLTR': true});

                wordpressPageContent.css({visibility: 'hidden'});
                wordpressPageBody.append(adminLTRIFrameString.format(ajaxURL));
            });

            $(window).on('message', messageHandler);
        })
    } ( jQuery ));
} else
    console.log('This plugin is jQuery depended.');
