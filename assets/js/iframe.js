window.jQuery ? ! function(e) {
    function n(n, i) {
        return e.isEmptyObject(i) || void 0 == n || (n += (n.indexOf("?") > -1 ? "&" : "?") + e.param(i)), n
    }

    function i(e) {
        parent.postMessage(JSON.stringify(e), window.location.href)
    }
    e(window).load(function() {
        WPBody = e("#wpbody"), i({
            eventName: "pageLoad",
            windowHeight: WPBody.height()
        })
    }), e(document).ready(function() {
        var t = e("#wpbody"),
            o = e("a");
        t.siblings().hide(), t.parents().siblings().hide(), o.each(function() {
            e(this).attr("href", n(e(this).attr("href"), {
                forceLTR: !0
            }))
        }), setInterval(function() {
            i({
                eventName: "pageDimensionsInterval",
                height: e("#wpwrap").height()
            })
        }, 50)
    })
}(jQuery) : console.log("This plugin is jQuery depended.");