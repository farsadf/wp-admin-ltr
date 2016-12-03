window.jQuery ? ! function(e) {
    function n(n, i) {
        return e.isEmptyObject(i) || (n += (n.indexOf("?") > -1 ? "&" : "?") + e.param(i)), n
    }

    function i(n) {
        var i = e("#admin-ltr-iframe");
        if (i.length > 0) {
            if ("" != n.originalEvent.data && null != n.originalEvent.data) switch (n = JSON.parse(n.originalEvent.data), n.eventName) {
                case "pageLoad":
                    i.css({
                        minHeight: n.windowHeight
                    });
                    break;
                case "pageDimensionsInterval":
                    i.css({
                        height: n.height
                    })
            }
        } else console.log("iFrame instance not found.")
    }
    String.prototype.format = function() {
        for (var e = this, n = 0; n < arguments.length; n++) {
            var i = new RegExp("\\{" + n + "\\}", "gi");
            e = e.replace(i, arguments[n])
        }
        return e
    }, e(document).ready(function() {
        var a = e("#admin-ltr-wrap"),
            t = e("#admin-ltr"),
            r = e("#wpbody"),
            o = e("#wpbody-content"),
            d = '<div id="admin-ltr-iframe-wrap"><iframe src="{0}" id="admin-ltr-iframe"></iframe></div>',
            s = e("#screen-meta-links");
        s.length <= 0 && a.css({
            marginLeft: "20px"
        }), t.on("click", function() {
            var e = n(window.location.href, {
                forceLTR: !0
            });
            o.css({
                visibility: "hidden"
            }), r.append(d.format(e))
        }), e(window).on("message", i)
    })
}(jQuery) : console.log("This plugin is jQuery depended.");