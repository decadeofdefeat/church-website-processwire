
    </div>   <!-- end Main -->



     <div id='footer-social-bar'>

            <div class='container'>

                <div class='row'>

                  <!--div class='col-xs-6 col-md-10 col-sm-9' -->

                          <div class='item'>
                            <a class="mg-l-xs" href="#share-your-story" data-toggle="modal" data-target="#share-your-story">Share Your Story</a></div>

                          <div class='item'><a href="#">812.882.2737</a></div>

                          <div class='item'><a class="mg-l-xs" href="#contact-us" data-toggle="modal" data-target="#contact-us">Contact Us</a></div>

                          <div class="item"><a class="mg-l-s" href="#tech-support" data-toggle="modal" data-target="#tech-support">Tech Support</a></div>

                          <div class="item"><a class="mg-l-xs" href="#prayer-request" data-toggle="modal" data-target="#prayer-request">Need prayer?</a></div>

                          <div class="item"><a class="mg-l-xs" href="#prayer-request" data-toggle="modal" data-target="#share-this">Share this page</a></div>

                  </div>

                  <!--div class='col-xs-6 col-md-2 col-sm-3' >
                        <div class='pull-right'>
                           <a target="_blank" href='https://facebook.com' class='social-fb'><i class="icon-facebook  "></i></a>
                           <a target="_blank" href='https://twitter.com' class='social-tw'><i class="icon-twitter"></i></a>
                           <a target="_blank" href='https://instagram.com' class='social-in'><i class="icon-instagram "></i></a>
                           <a target="_blank" href='https://youtube.com' class='social-yt'><i class="icon-youtube "></i></a>
                        </div>
                  </div-->
              </div>
          </div>
    </div>

    <!-- FOOTER -->
    <div id='footer'>
       <div class='container '>
              <div class='row mg-t-md mg-b-md'>
                  <div class='col-md-12'>
                    <p>&copy; 2008-<?php echo date("Y");?> Thursday Church</p>
                  </div>
              </div>
          </div>
    </div>

    <!-- window resize helper -->
    <span id="mq-detector">
        <span class="visible-xs"></span>
        <span class="visible-sm"></span>
        <span class="visible-md"></span>
        <span class="visible-lg"></span>
    </span>
 </div> <!-- / wrapper -->

    <!-- Javascript ================================================== -->
    <!--script src="/site/templates/js/plugins/jquery/jquery.min.js"></script-->
    <script src="/site/templates/js/jquery-2.1.4.min.js"></script>
    <script src='/site/templates/js/bootstrap.min.js'></script>
    <script src='/site/templates/js/jquery.magnific-popup.js'></script>
    <script src='/site/templates/js/plugins/fastbutton/google.fastbutton.js'></script>
    <script src='/site/templates/js/plugins/fastbutton/jquery.google.fastbutton.js'></script>
    <script src='/site/templates/js/share.js'></script>
    <script src='/site/templates/js/plugins/fitvids/jquery.fitvids.min.js'></script>
    <script src='/site/templates/js/plugins/validate/jquery.validate.js'></script>
    <script src='/site/templates/js/main.js'></script>
    <script>
(function () {
    var j = false;
    window.JQClass = function () {};
    JQClass.classes = {};
    JQClass.extend = function extender(f) {
        var g = this.prototype;
        j = true;
        var h = new this();
        j = false;
        for (var i in f) {
            h[i] = typeof f[i] == 'function' && typeof g[i] == 'function' ? (function (d, e) {
                return function () {
                    var b = this._super;
                    this._super = function (a) {
                        return g[d].apply(this, a || [])
                    };
                    var c = e.apply(this, arguments);
                    this._super = b;
                    return c
                }
            })(i, f[i]) : f[i]
        }

        function JQClass() {
            if (!j && this._init) {
                this._init.apply(this, arguments)
            }
        }
        JQClass.prototype = h;
        JQClass.prototype.constructor = JQClass;
        JQClass.extend = extender;
        return JQClass
    }
})();
(function ($) {
    JQClass.classes.JQPlugin = JQClass.extend({
        name: 'plugin',
        defaultOptions: {},
        regionalOptions: {},
        _getters: [],
        _getMarker: function () {
            return 'is-' + this.name
        },
        _init: function () {
            $.extend(this.defaultOptions, (this.regionalOptions && this.regionalOptions['']) || {});
            var c = camelCase(this.name);
            $[c] = this;
            $.fn[c] = function (a) {
                var b = Array.prototype.slice.call(arguments, 1);
                if ($[c]._isNotChained(a, b)) {
                    return $[c][a].apply($[c], [this[0]].concat(b))
                }
                return this.each(function () {
                    if (typeof a === 'string') {
                        if (a[0] === '_' || !$[c][a]) {
                            throw 'Unknown method: ' + a;
                        }
                        $[c][a].apply($[c], [this].concat(b))
                    } else {
                        $[c]._attach(this, a)
                    }
                })
            }
        },
        setDefaults: function (a) {
            $.extend(this.defaultOptions, a || {})
        },
        _isNotChained: function (a, b) {
            if (a === 'option' && (b.length === 0 || (b.length === 1 && typeof b[0] === 'string'))) {
                return true
            }
            return $.inArray(a, this._getters) > -1
        },
        _attach: function (a, b) {
            a = $(a);
            if (a.hasClass(this._getMarker())) {
                return
            }
            a.addClass(this._getMarker());
            b = $.extend({}, this.defaultOptions, this._getMetadata(a), b || {});
            var c = $.extend({
                name: this.name,
                elem: a,
                options: b
            }, this._instSettings(a, b));
            a.data(this.name, c);
            this._postAttach(a, c);
            this.option(a, b)
        },
        _instSettings: function (a, b) {
            return {}
        },
        _postAttach: function (a, b) {},
        _getMetadata: function (d) {
            try {
                var f = d.data(this.name.toLowerCase()) || '';
                f = f.replace(/'/g, '"');
                f = f.replace(/([a-zA-Z0-9]+):/g, function (a, b, i) {
                    var c = f.substring(0, i).match(/"/g);
                    return (!c || c.length % 2 === 0 ? '"' + b + '":' : b + ':')
                });
                f = $.parseJSON('{' + f + '}');
                for (var g in f) {
                    var h = f[g];
                    if (typeof h === 'string' && h.match(/^new Date\((.*)\)$/)) {
                        f[g] = eval(h)
                    }
                }
                return f
            } catch (e) {
                return {}
            }
        },
        _getInst: function (a) {
            return $(a).data(this.name) || {}
        },
        option: function (a, b, c) {
            a = $(a);
            var d = a.data(this.name);
            if (!b || (typeof b === 'string' && c == null)) {
                var e = (d || {}).options;
                return (e && b ? e[b] : e)
            }
            if (!a.hasClass(this._getMarker())) {
                return
            }
            var e = b || {};
            if (typeof b === 'string') {
                e = {};
                e[b] = c
            }
            this._optionsChanged(a, d, e);
            $.extend(d.options, e)
        },
        _optionsChanged: function (a, b, c) {},
        destroy: function (a) {
            a = $(a);
            if (!a.hasClass(this._getMarker())) {
                return
            }
            this._preDestroy(a, this._getInst(a));
            a.removeData(this.name).removeClass(this._getMarker())
        },
        _preDestroy: function (a, b) {}
    });

    function camelCase(c) {
        return c.replace(/-([a-z])/g, function (a, b) {
            return b.toUpperCase()
        })
    }
    $.JQPlugin = {
        createPlugin: function (a, b) {
            if (typeof a === 'object') {
                b = a;
                a = 'JQPlugin'
            }
            a = camelCase(a);
            var c = camelCase(b.name);
            JQClass.classes[c] = JQClass.classes[a].extend(b);
            new JQClass.classes[c]()
        }
    }
})(jQuery);
(function ($) {
    var w = 'countdown';
    var Y = 0;
    var O = 1;
    var W = 2;
    var D = 3;
    var H = 4;
    var M = 5;
    var S = 6;
    $.JQPlugin.createPlugin({
        name: w,
        defaultOptions: {
            until: null,
            since: null,
            timezone: null,
            serverSync: null,
            format: 'dHMS',
            layout: '',
            compact: false,
            padZeroes: false,
            significant: 0,
            description: '<?php echo $page->series_title; ?>',
            expiryUrl: '',
            expiryText: ' ',
            alwaysExpire: true,
            onExpiry: null,
            onTick: null,
            tickInterval: 1
        },
        regionalOptions: {
            '': {
                labels: ['Years', 'Months', 'Weeks', 'Days', 'Hours', 'Minutes', 'Seconds'],
                labels1: ['Year', 'Month', 'Week', 'Day', 'Hour', 'Minute', 'Second'],
                compactLabels: ['y', 'm', 'w', 'd'],
                whichLabels: null,
                digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                timeSeparator: ':',
                isRTL: false
            }
        },
        _getters: ['getTimes'],
        _rtlClass: w + '-rtl',
        _sectionClass: w + '-section',
        _amountClass: w + '-amount',
        _periodClass: w + '-period',
        _rowClass: w + '-row',
        _holdingClass: w + '-holding',
        _showClass: w + '-show',
        _descrClass: w + '-descr',
        _timerElems: [],
        _init: function () {
            var c = this;
            this._super();
            this._serverSyncs = [];
            var d = (typeof Date.now == 'function' ? Date.now : function () {
                return new Date().getTime()
            });
            var e = (window.performance && typeof window.performance.now == 'function');

            function timerCallBack(a) {
                var b = (a < 1e12 ? (e ? (performance.now() + performance.timing.navigationStart) : d()) : a || d());
                if (b - g >= 1000) {
                    c._updateElems();
                    g = b
                }
                f(timerCallBack)
            }
            var f = window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || null;
            var g = 0;
            if (!f || $.noRequestAnimationFrame) {
                $.noRequestAnimationFrame = null;
                setInterval(function () {
                    c._updateElems()
                }, 980)
            } else {
                g = window.animationStartTime || window.webkitAnimationStartTime || window.mozAnimationStartTime || window.oAnimationStartTime || window.msAnimationStartTime || d();
                f(timerCallBack)
            }
        },
        UTCDate: function (a, b, c, e, f, g, h, i) {
            if (typeof b == 'object' && b.constructor == Date) {
                i = b.getMilliseconds();
                h = b.getSeconds();
                g = b.getMinutes();
                f = b.getHours();
                e = b.getDate();
                c = b.getMonth();
                b = b.getFullYear()
            }
            var d = new Date();
            d.setUTCFullYear(b);
            d.setUTCDate(1);
            d.setUTCMonth(c || 0);
            d.setUTCDate(e || 1);
            d.setUTCHours(f || 0);
            d.setUTCMinutes((g || 0) - (Math.abs(a) < 30 ? a * 60 : a));
            d.setUTCSeconds(h || 0);
            d.setUTCMilliseconds(i || 0);
            return d
        },
        periodsToSeconds: function (a) {
            return a[0] * 31557600 + a[1] * 2629800 + a[2] * 604800 + a[3] * 86400 + a[4] * 3600 + a[5] * 60 + a[6]
        },
        resync: function () {
            var d = this;
            $('.' + this._getMarker()).each(function () {
                var a = $.data(this, d.name);
                if (a.options.serverSync) {
                    var b = null;
                    for (var i = 0; i < d._serverSyncs.length; i++) {
                        if (d._serverSyncs[i][0] == a.options.serverSync) {
                            b = d._serverSyncs[i];
                            break
                        }
                    }
                    if (b[2] == null) {
                        var c = ($.isFunction(a.options.serverSync) ? a.options.serverSync.apply(this, []) : null);
                        b[2] = (c ? new Date().getTime() - c.getTime() : 0) - b[1]
                    }
                    if (a._since) {
                        a._since.setMilliseconds(a._since.getMilliseconds() + b[2])
                    }
                    a._until.setMilliseconds(a._until.getMilliseconds() + b[2])
                }
            });
            for (var i = 0; i < d._serverSyncs.length; i++) {
                if (d._serverSyncs[i][2] != null) {
                    d._serverSyncs[i][1] += d._serverSyncs[i][2];
                    delete d._serverSyncs[i][2]
                }
            }
        },
        _instSettings: function (a, b) {
            return {
                _periods: [0, 0, 0, 0, 0, 0, 0]
            }
        },
        _addElem: function (a) {
            if (!this._hasElem(a)) {
                this._timerElems.push(a)
            }
        },
        _hasElem: function (a) {
            return ($.inArray(a, this._timerElems) > -1)
        },
        _removeElem: function (b) {
            this._timerElems = $.map(this._timerElems, function (a) {
                return (a == b ? null : a)
            })
        },
        _updateElems: function () {
            for (var i = this._timerElems.length - 1; i >= 0; i--) {
                this._updateCountdown(this._timerElems[i])
            }
        },
        _optionsChanged: function (a, b, c) {
            if (c.layout) {
                c.layout = c.layout.replace(/&lt;/g, '<').replace(/&gt;/g, '>')
            }
            this._resetExtraLabels(b.options, c);
            var d = (b.options.timezone != c.timezone);
            $.extend(b.options, c);
            this._adjustSettings(a, b, c.until != null || c.since != null || d);
            var e = new Date();
            if ((b._since && b._since < e) || (b._until && b._until > e)) {
                this._addElem(a[0])
            }
            this._updateCountdown(a, b)
        },
        _updateCountdown: function (a, b) {
            a = a.jquery ? a : $(a);
            b = b || this._getInst(a);
            if (!b) {
                return
            }
            a.html(this._generateHTML(b)).toggleClass(this._rtlClass, b.options.isRTL);
            if ($.isFunction(b.options.onTick)) {
                var c = b._hold != 'lap' ? b._periods : this._calculatePeriods(b, b._show, b.options.significant, new Date());
                if (b.options.tickInterval == 1 || this.periodsToSeconds(c) % b.options.tickInterval == 0) {
                    b.options.onTick.apply(a[0], [c])
                }
            }
            var d = b._hold != 'pause' && (b._since ? b._now.getTime() < b._since.getTime() : b._now.getTime() >= b._until.getTime());
            if (d && !b._expiring) {
                b._expiring = true;
                if (this._hasElem(a[0]) || b.options.alwaysExpire) {
                    this._removeElem(a[0]);
                    if ($.isFunction(b.options.onExpiry)) {
                        b.options.onExpiry.apply(a[0], [])
                    }
                    if (b.options.expiryText) {
                        var e = b.options.layout;
                        b.options.layout = b.options.expiryText;
                        this._updateCountdown(a[0], b);
                        b.options.layout = e
                    }
                    if (b.options.expiryUrl) {
                        window.location = b.options.expiryUrl
                    }
                }
                b._expiring = false
            } else if (b._hold == 'pause') {
                this._removeElem(a[0])
            }
        },
        _resetExtraLabels: function (a, b) {
            for (var n in b) {
                if (n.match(/[Ll]abels[02-9]|compactLabels1/)) {
                    a[n] = b[n]
                }
            }
            for (var n in a) {
                if (n.match(/[Ll]abels[02-9]|compactLabels1/) && typeof b[n] === 'undefined') {
                    a[n] = null
                }
            }
        },
        _adjustSettings: function (a, b, c) {
            var d = null;
            for (var i = 0; i < this._serverSyncs.length; i++) {
                if (this._serverSyncs[i][0] == b.options.serverSync) {
                    d = this._serverSyncs[i][1];
                    break
                }
            }
            if (d != null) {
                var e = (b.options.serverSync ? d : 0);
                var f = new Date()
            } else {
                var g = ($.isFunction(b.options.serverSync) ? b.options.serverSync.apply(a[0], []) : null);
                var f = new Date();
                var e = (g ? f.getTime() - g.getTime() : 0);
                this._serverSyncs.push([b.options.serverSync, e])
            }
            var h = b.options.timezone;
            h = (h == null ? -f.getTimezoneOffset() : h);
            if (c || (!c && b._until == null && b._since == null)) {
                b._since = b.options.since;
                if (b._since != null) {
                    b._since = this.UTCDate(h, this._determineTime(b._since, null));
                    if (b._since && e) {
                        b._since.setMilliseconds(b._since.getMilliseconds() + e)
                    }
                }
                b._until = this.UTCDate(h, this._determineTime(b.options.until, f));
                if (e) {
                    b._until.setMilliseconds(b._until.getMilliseconds() + e)
                }
            }
            b._show = this._determineShow(b)
        },
        _preDestroy: function (a, b) {
            this._removeElem(a[0]);
            a.empty()
        },
        pause: function (a) {
            this._hold(a, 'pause')
        },
        lap: function (a) {
            this._hold(a, 'lap')
        },
        resume: function (a) {
            this._hold(a, null)
        },
        toggle: function (a) {
            var b = $.data(a, this.name) || {};
            this[!b._hold ? 'pause' : 'resume'](a)
        },
        toggleLap: function (a) {
            var b = $.data(a, this.name) || {};
            this[!b._hold ? 'lap' : 'resume'](a)
        },
        _hold: function (a, b) {
            var c = $.data(a, this.name);
            if (c) {
                if (c._hold == 'pause' && !b) {
                    c._periods = c._savePeriods;
                    var d = (c._since ? '-' : '+');
                    c[c._since ? '_since' : '_until'] = this._determineTime(d + c._periods[0] + 'y' + d + c._periods[1] + 'o' + d + c._periods[2] + 'w' + d + c._periods[3] + 'd' + d + c._periods[4] + 'h' + d + c._periods[5] + 'm' + d + c._periods[6] + 's');
                    this._addElem(a)
                }
                c._hold = b;
                c._savePeriods = (b == 'pause' ? c._periods : null);
                $.data(a, this.name, c);
                this._updateCountdown(a, c)
            }
        },
        getTimes: function (a) {
            var b = $.data(a, this.name);
            return (!b ? null : (b._hold == 'pause' ? b._savePeriods : (!b._hold ? b._periods : this._calculatePeriods(b, b._show, b.options.significant, new Date()))))
        },
        _determineTime: function (k, l) {
            var m = this;
            var n = function (a) {
                var b = new Date();
                b.setTime(b.getTime() + a * 1000);
                return b
            };
            var o = function (a) {
                a = a.toLowerCase();
                var b = new Date();
                var c = b.getFullYear();
                var d = b.getMonth();
                var e = b.getDate();
                var f = b.getHours();
                var g = b.getMinutes();
                var h = b.getSeconds();
                var i = /([+-]?[0-9]+)\s*(s|m|h|d|w|o|y)?/g;
                var j = i.exec(a);
                while (j) {
                    switch (j[2] || 's') {
                        case 's':
                            h += parseInt(j[1], 10);
                            break;
                        case 'm':
                            g += parseInt(j[1], 10);
                            break;
                        case 'h':
                            f += parseInt(j[1], 10);
                            break;
                        case 'd':
                            e += parseInt(j[1], 10);
                            break;
                        case 'w':
                            e += parseInt(j[1], 10) * 7;
                            break;
                        case 'o':
                            d += parseInt(j[1], 10);
                            e = Math.min(e, m._getDaysInMonth(c, d));
                            break;
                        case 'y':
                            c += parseInt(j[1], 10);
                            e = Math.min(e, m._getDaysInMonth(c, d));
                            break
                    }
                    j = i.exec(a)
                }
                return new Date(c, d, e, f, g, h, 0)
            };
            var p = (k == null ? l : (typeof k == 'string' ? o(k) : (typeof k == 'number' ? n(k) : k)));
            if (p) p.setMilliseconds(0);
            return p
        },
        _getDaysInMonth: function (a, b) {
            return 32 - new Date(a, b, 32).getDate()
        },
        _normalLabels: function (a) {
            return a
        },
        _generateHTML: function (c) {
            var d = this;
            c._periods = (c._hold ? c._periods : this._calculatePeriods(c, c._show, c.options.significant, new Date()));
            var e = false;
            var f = 0;
            var g = c.options.significant;
            var h = $.extend({}, c._show);
            for (var i = Y; i <= S; i++) {
                e |= (c._show[i] == '?' && c._periods[i] > 0);
                h[i] = (c._show[i] == '?' && !e ? null : c._show[i]);
                f += (h[i] ? 1 : 0);
                g -= (c._periods[i] > 0 ? 1 : 0)
            }
            var j = [false, false, false, false, false, false, false];
            for (var i = S; i >= Y; i--) {
                if (c._show[i]) {
                    if (c._periods[i]) {
                        j[i] = true
                    } else {
                        j[i] = g > 0;
                        g--
                    }
                }
            }
            var k = (c.options.compact ? c.options.compactLabels : c.options.labels);
            var l = c.options.whichLabels || this._normalLabels;
            var m = function (a) {
                var b = c.options['compactLabels' + l(c._periods[a])];
                return (h[a] ? d._translateDigits(c, c._periods[a]) + (b ? b[a] : k[a]) + ' ' : '')
            };
            var n = (c.options.padZeroes ? 2 : 1);
            var o = function (a) {
                var b = c.options['labels' + l(c._periods[a])];
                return ((!c.options.significant && h[a]) || (c.options.significant && j[a]) ? '<span class="' + d._sectionClass + '">' + '<span class="' + d._amountClass + '">' + d._minDigits(c, c._periods[a], n) + '</span>' + '<span class="' + d._periodClass + '">' + (b ? b[a] : k[a]) + '</span></span>' : '')
            };
            return (c.options.layout ? this._buildLayout(c, h, c.options.layout, c.options.compact, c.options.significant, j) : ((c.options.compact ? '<span class="' + this._rowClass + ' ' + this._amountClass + (c._hold ? ' ' + this._holdingClass : '') + '">' + m(Y) + m(O) + m(W) + m(D) + (h[H] ? this._minDigits(c, c._periods[H], 2) : '') + (h[M] ? (h[H] ? c.options.timeSeparator : '') + this._minDigits(c, c._periods[M], 2) : '') + (h[S] ? (h[H] || h[M] ? c.options.timeSeparator : '') + this._minDigits(c, c._periods[S], 2) : '') : '<span class="' + this._rowClass + ' ' + this._showClass + (c.options.significant || f) + (c._hold ? ' ' + this._holdingClass : '') + '">' + o(Y) + o(O) + o(W) + o(D) + o(H) + o(M) + o(S)) + '</span>' + (c.options.description ? '<span class="' + this._rowClass + ' ' + this._descrClass + '">' + c.options.description + '</span>' : '')))
        },
        _buildLayout: function (c, d, e, f, g, h) {
            var j = c.options[f ? 'compactLabels' : 'labels'];
            var k = c.options.whichLabels || this._normalLabels;
            var l = function (a) {
                return (c.options[(f ? 'compactLabels' : 'labels') + k(c._periods[a])] || j)[a]
            };
            var m = function (a, b) {
                return c.options.digits[Math.floor(a / b) % 10]
            };
            var o = {
                desc: c.options.description,
                sep: c.options.timeSeparator,
                yl: l(Y),
                yn: this._minDigits(c, c._periods[Y], 1),
                ynn: this._minDigits(c, c._periods[Y], 2),
                ynnn: this._minDigits(c, c._periods[Y], 3),
                y1: m(c._periods[Y], 1),
                y10: m(c._periods[Y], 10),
                y100: m(c._periods[Y], 100),
                y1000: m(c._periods[Y], 1000),
                ol: l(O),
                on: this._minDigits(c, c._periods[O], 1),
                onn: this._minDigits(c, c._periods[O], 2),
                onnn: this._minDigits(c, c._periods[O], 3),
                o1: m(c._periods[O], 1),
                o10: m(c._periods[O], 10),
                o100: m(c._periods[O], 100),
                o1000: m(c._periods[O], 1000),
                wl: l(W),
                wn: this._minDigits(c, c._periods[W], 1),
                wnn: this._minDigits(c, c._periods[W], 2),
                wnnn: this._minDigits(c, c._periods[W], 3),
                w1: m(c._periods[W], 1),
                w10: m(c._periods[W], 10),
                w100: m(c._periods[W], 100),
                w1000: m(c._periods[W], 1000),
                dl: l(D),
                dn: this._minDigits(c, c._periods[D], 1),
                dnn: this._minDigits(c, c._periods[D], 2),
                dnnn: this._minDigits(c, c._periods[D], 3),
                d1: m(c._periods[D], 1),
                d10: m(c._periods[D], 10),
                d100: m(c._periods[D], 100),
                d1000: m(c._periods[D], 1000),
                hl: l(H),
                hn: this._minDigits(c, c._periods[H], 1),
                hnn: this._minDigits(c, c._periods[H], 2),
                hnnn: this._minDigits(c, c._periods[H], 3),
                h1: m(c._periods[H], 1),
                h10: m(c._periods[H], 10),
                h100: m(c._periods[H], 100),
                h1000: m(c._periods[H], 1000),
                ml: l(M),
                mn: this._minDigits(c, c._periods[M], 1),
                mnn: this._minDigits(c, c._periods[M], 2),
                mnnn: this._minDigits(c, c._periods[M], 3),
                m1: m(c._periods[M], 1),
                m10: m(c._periods[M], 10),
                m100: m(c._periods[M], 100),
                m1000: m(c._periods[M], 1000),
                sl: l(S),
                sn: this._minDigits(c, c._periods[S], 1),
                snn: this._minDigits(c, c._periods[S], 2),
                snnn: this._minDigits(c, c._periods[S], 3),
                s1: m(c._periods[S], 1),
                s10: m(c._periods[S], 10),
                s100: m(c._periods[S], 100),
                s1000: m(c._periods[S], 1000)
            };
            var p = e;
            for (var i = Y; i <= S; i++) {
                var q = 'yowdhms'.charAt(i);
                var r = new RegExp('\\{' + q + '<\\}([\\s\\S]*)\\{' + q + '>\\}', 'g');
                p = p.replace(r, ((!g && d[i]) || (g && h[i]) ? '$1' : ''))
            }
            $.each(o, function (n, v) {
                var a = new RegExp('\\{' + n + '\\}', 'g');
                p = p.replace(a, v)
            });
            return p
        },
        _minDigits: function (a, b, c) {
            b = '' + b;
            if (b.length >= c) {
                return this._translateDigits(a, b)
            }
            b = '0000000000' + b;
            return this._translateDigits(a, b.substr(b.length - c))
        },
        _translateDigits: function (b, c) {
            return ('' + c).replace(/[0-9]/g, function (a) {
                return b.options.digits[a]
            })
        },
        _determineShow: function (a) {
            var b = a.options.format;
            var c = [];
            c[Y] = (b.match('y') ? '?' : (b.match('Y') ? '!' : null));
            c[O] = (b.match('o') ? '?' : (b.match('O') ? '!' : null));
            c[W] = (b.match('w') ? '?' : (b.match('W') ? '!' : null));
            c[D] = (b.match('d') ? '?' : (b.match('D') ? '!' : null));
            c[H] = (b.match('h') ? '?' : (b.match('H') ? '!' : null));
            c[M] = (b.match('m') ? '?' : (b.match('M') ? '!' : null));
            c[S] = (b.match('s') ? '?' : (b.match('S') ? '!' : null));
            return c
        },
        _calculatePeriods: function (c, d, e, f) {
            c._now = f;
            c._now.setMilliseconds(0);
            var g = new Date(c._now.getTime());
            if (c._since) {
                if (f.getTime() < c._since.getTime()) {
                    c._now = f = g
                } else {
                    f = c._since
                }
            } else {
                g.setTime(c._until.getTime());
                if (f.getTime() > c._until.getTime()) {
                    c._now = f = g
                }
            }
            var h = [0, 0, 0, 0, 0, 0, 0];
            if (d[Y] || d[O]) {
                var i = this._getDaysInMonth(f.getFullYear(), f.getMonth());
                var j = this._getDaysInMonth(g.getFullYear(), g.getMonth());
                var k = (g.getDate() == f.getDate() || (g.getDate() >= Math.min(i, j) && f.getDate() >= Math.min(i, j)));
                var l = function (a) {
                    return (a.getHours() * 60 + a.getMinutes()) * 60 + a.getSeconds()
                };
                var m = Math.max(0, (g.getFullYear() - f.getFullYear()) * 12 + g.getMonth() - f.getMonth() + ((g.getDate() < f.getDate() && !k) || (k && l(g) < l(f)) ? -1 : 0));
                h[Y] = (d[Y] ? Math.floor(m / 12) : 0);
                h[O] = (d[O] ? m - h[Y] * 12 : 0);
                f = new Date(f.getTime());
                var n = (f.getDate() == i);
                var o = this._getDaysInMonth(f.getFullYear() + h[Y], f.getMonth() + h[O]);
                if (f.getDate() > o) {
                    f.setDate(o)
                }
                f.setFullYear(f.getFullYear() + h[Y]);
                f.setMonth(f.getMonth() + h[O]);
                if (n) {
                    f.setDate(o)
                }
            }
            var p = Math.floor((g.getTime() - f.getTime()) / 1000);
            var q = function (a, b) {
                h[a] = (d[a] ? Math.floor(p / b) : 0);
                p -= h[a] * b
            };
            q(W, 604800);
            q(D, 86400);
            q(H, 3600);
            q(M, 60);
            q(S, 1);
            if (p > 0 && !c._since) {
                var r = [1, 12, 4.3482, 7, 24, 60, 60];
                var s = S;
                var t = 1;
                for (var u = S; u >= Y; u--) {
                    if (d[u]) {
                        if (h[s] >= t) {
                            h[s] = 0;
                            p = 1
                        }
                        if (p > 0) {
                            h[u]++;
                            p = 0;
                            s = u;
                            t = 1
                        }
                    }
                    t *= r[u]
                }
            }
            if (e) {
                for (var u = Y; u <= S; u++) {
                    if (e && h[u]) {
                        e--
                    } else if (!e) {
                        h[u] = 0
                    }
                }
            }
            return h
        }
    })
})(jQuery);
var switchedToPlayer = false;
var server_time;
var live_streaming = window.live_streaming;
var need_countdown = window.need_countdown;
var setCountDownDuringLiveEvent;
var end_service_hours = "<?php echo $page->end_service_hours;?>";
var end_service_minutes = "<?php echo $page->end_service_minutes;?>";
var end_service_day = "<?php echo $page->end_service_day;?>";

function grabServerTime() {
    var time = null;
    $.ajax({
        url: '/server-time/',
        async: false,
        dataType: 'text',
        success: function (text) {
            time = new Date(text);
        },
        error: function (http, message, exc) {
            time = new Date();
        }
    });
    return time;
}
$(document).ready(function () {
    $('.share-series-twitter').sharrre({
        share: {
            twitter: true
        },
        buttons: {},
        enableHover: true,
        enableTracking: true,
        click: function (api, options) {
            api.simulateClick();
            api.openPopup('twitter');
        }
    });
    $('.share-series-facebook').sharrre({
        share: {
            facebook: true
        },
        enableHover: true,
        enableTracking: true,
        click: function (api, options) {
            api.simulateClick();
            api.openPopup('facebook');
        }
    });
    CKEDITOR.plugins.addExternal('print', '/site/templates/css/ckeditor/print/', 'plugin.js');
    CKEDITOR.plugins.addExternal('email', '/site/templates/css/ckeditor/email/', 'plugin.js');
    CKEDITOR.replace('editor1', {
        customConfig: '/site/templates/css/ckeditor/config.js'
    });
    var player = "";
    var playerOrigin = "";
    var outroVideoPlaying = false;
    var introSecondsPlayed = 0;

    function onMessageReceived(event) {
        if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
            return false;
        }
        if (playerOrigin === '*') {
            playerOrigin = event.origin;
        }
        var data = JSON.parse(event.data);
        switch (data.event) {
            case 'ready':
                onReady();
                break;
            case 'playProgress':
                onPlayProgress(data.data);
                break;
            case 'pause':
                onPause();
                break;
            case 'finish':
                onFinish();
                break;
        }
    }

    function post(action, value) {
        var data = {
            method: action
        };
        if (value) {
            data.value = value;
        }
        var message = JSON.stringify(data);
        player[0].contentWindow.postMessage(message, playerOrigin);
    }

    function onReady() {
        post('addEventListener', 'pause');
        post('addEventListener', 'finish');
        post('addEventListener', 'playProgress');
    }

    function onPause() {}

    function onFinish() {
        if (outroVideoPlaying == false) {
            $('#video-holder').html('<iframe id="ls_embed_1458644761" src="https://youtube.com/embed/<?php echo $page->youtube_id; ?>" width="960" height="540" frameborder="0" scrolling="no"></iframe>');
            $("body").fitVids({
                customSelector: "iframe[src^='https://youtube.com']"
            });
        }
    }

    function onPlayProgress(data) {
        introSecondsPlayed = data.seconds;
    }

    function runIntro() {
        player = $('iframe');
        playerOrigin = '*';
        if ($("#skipIntro").length) {
            if (window.addEventListener) {
                window.addEventListener('message', onMessageReceived, false);
            } else {
                window.attachEvent('onmessage', onMessageReceived, false);
            }
            $("#skipIntro").on('click', function (event) {
                onFinish();
                ga('send', 'event', 'button', 'click', 'Skip Live Welcome Video', introSecondsPlayed);
            });
        }
    }
    if (live_streaming == true && $("#skipIntro").length) {
        runIntro();
    }

    function displayAlertMessage(str) {
        var trimmed = str.substring(1);
        $.magnificPopup.open({
            items: {
                src: '<div class="alert-white-popup">' + trimmed + '</div>',
                type: 'inline'
            }
        });
    }

    function renderCountdown() {
        server_time = grabServerTime();
        if (live_streaming == true && need_countdown == false) {
            $('#countdown-block').hide();
        }
        $.getJSON('/api/1746/?time=' + new Date().getTime(), function (json) {
            $('#next-service').html("Next service:<br/>" + json['nextTime'] + ", <br/>" + json['nextDay']);
            if (!live_streaming || need_countdown == true) {
                $('#countdown-block').show();
            }
            end_service_day = parseInt(json['end_day']);
            end_service_minutes = parseInt(json['end_minute']);
            end_service_hours = parseInt(json['end_hour']);
            if (live_streaming == true && need_countdown == false) {
                $('#countdown-block').hide();
                setCountDownDuringLiveEvent = setInterval(function () {
                    halfHourBefore(null);
                }, 1000);
            }
            $('#defaultCountdown').countdown({
                until: new Date(json['year'], json['month'] - 1, json['day'], json["start_hour"], json["start_minute"], '0'),
                serverSync: grabServerTime,
                padZeroes: true,
                format: 'DHMS',
                labels: ['years', 'months', 'weeks', 'days', 'hours', 'mins', 'secs'],
                labels1: ['years', 'month', 'week', 'day', 'hour', 'min', 'sec'],
                onTick: halfHourBefore,
                onExpiry: function () {
                    $('#countdown-block').hide();
                }
            });
        });
    }

    function halfHourBefore(periods) {
        if (!server_time) {}
        server_time.setTime(server_time.getTime() + 1000);
        if (server_time.getDay() == end_service_day && server_time.getHours() == (end_service_hours + 2) && server_time.getMinutes() == end_service_minutes && server_time.getSeconds() == 0) {
            clearInterval(setCountDownDuringLiveEvent);
            $.ajax({
                url: '/api/1796/?time=' + new Date().getTime(),
                dataType: 'json',
                success: function (response) {
                    live_streaming = false;
                    $('#takeaway-block').hide();
                    $('#video-holder').html(response.video);
                    $('#live-message-details').html(response.msg_details);
                    $('#live-message-body').html(response.msg_body);
                    $('#review-content').html(response.review_questions);
                    if ($('#review-content').html() != '') {
                        $('#review-questions-click').show();
                    }
                    $("body").fitVids({
                        customSelector: "iframe[src^='https://youtube.com']"
                    });
                    renderCountdown();
                },
                error: function (response) {}
            });
        }
        if (periods != null) {
            if (periods[4] == '0' && periods[5] <= '15') {
                if (live_streaming == false) {
                    live_streaming = true;
                    $.ajax({
                        url: '/api/1748/?intro=true&time=' + new Date().getTime(),
                        dataType: 'json',
                        success: function (response) {
                            var d = CKEDITOR.instances.editor1.getData;
                            CKEDITOR.instances.editor1.setData(d + response.ckeditor_details);
                            $('#video-holder').html(response.video);
                            $('#live-message-details').html(response.msg_details);
                            $('#live-message-body').html(response.msg_body);
                            $('#review-content').html(response.review_questions);
                            if ($('#review-content').html() == '' || response.no_review == 'true') {
                                $('#review-questions-click').hide();
                            }
                            if (response.mgs_takeaway != '') {
                                $('#takeaway-block').html(response.mgs_takeaway);
                            } else {
                                $('#takeaway-block').html("");
                            }
                            runIntro();
                            $("body").fitVids({
                                customSelector: "iframe[src^='https://youtube.com']"
                            });

                        },
                        error: function (response) {}
                    });
                }
            }
        }
    }
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var str = String(e.target);
        if (str.indexOf("bible") > -1) {
            if ($('#bible-tab').find("iframe").length == 0) {
                $('#bible-tab').append('<iframe frameborder="0" allowtransparency="true" src="https://www.bible.com/bible/111/matthew.1.niv" class="bible-iframe"  style="padding:0px;margin:0px;width:100%;min-height: 645px;max-height: 700px;height: 100%;" ></iframe>');
            }
        }
    })
    

    $("#welcome-form").validate({
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json'
            }).done(function (response) {
                if (response.success == 'success') {
                    $("#welcome-form").hide();
                    $("#welcome-desc").hide();
                    $("#welcome-response").html("Thank you!");
                    $("#welcome-response").css("height", "630");
                } else {}
            });
            return false;
        }
    });
    $("#response-form").validate({
        submitHandler: function (form) {
            $.ajax({
                type: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                dataType: 'json'
            }).done(function (response) {
                if (response.success == 'success') {
                    $("#response-form").hide();
                    $("#response-desc").hide();
                    $("#response-response").html("Thank you!");
                    $("#response-response").css("height", "630");
                } else {}
            });
            return false;
        }
    });
    $("#send_prayer_email").on('click', function (event) {
        var email = $.trim($("#prayer_email").val());
        var phone = $.trim($("#prayer_phone").val());
        if (email != '') {
            if (!validateEmail(email)) {
                $("#prayer_email_status").html(" Please enter a valid email address.");
                return false;
            }
        }
        $("#prayer_email_status").html(" Sending....");
        var honeypot = $('#send_prayer_website').val();
        if (honeypot == '' || honeypot == null) {
            ga('send', 'event', 'button', 'click', 'Prayer Request Email (Live Page)');
            $.post("/api/1373/", {
                name: $("#prayer_name").val(),
                phone: $("#prayer_phone").val(),
                email: $("#prayer_email").val(),
                p_request: $("#p_request").val()
            }, function () {
                $("#prayer_email_status").html(" Your prayer request was sent.");
                $("#p_request").val('');
            });
        }
    });
    $("#send_tech_support_email").on('click', function (event) {
        var email = $.trim($("#tech_email").val());
        var issues = $.trim($("#tech_issues").val());
        if (issues == "") {
            $("#tech_email_status").html(" Please enter your issue.");
            return false;
        }
        if (email == "") {
            $("#tech_email_status").html(" Please enter a valid email address.");
            return false;
        }
        if (!validateEmail(email)) {
            $("#tech_email_status").html(" Please enter a valid email address.");
            return false;
        }
        $("#tech_email_status").html(" Sending....");
        $.post("/api/live-support/", {
            email: $("#tech_email").val(),
            name: $("#tech_name").val(),
            issues: $("#tech_issues").val()
        }, function () {
            $("#tech_email_status").html(" Thanks for letting us know your issue.");
            $("#tech_email").val('');
        });
    });
    $("#send_note_email").on('click', function (event) {
        var email = $.trim($("#send_email").val());
        if (email == "") {
            $("#email_status").html(" Please enter a valid email address.");
            return false;
        }
        if (!validateEmail(email)) {
            $("#email_status").html(" Please enter a valid email address.");
            return false;
        }
        var editor_data = CKEDITOR.instances.editor1.getData();
        var sermon_title = $('#live-message-details h2').html();
        var current = $("#message-date-notes").html();
        $("#email_status").html(" Sending....");
        ga('send', 'event', 'button', 'click', 'Email Live Message Notes');
        $.post("/api/email-notes/", {
            email: $("#send_email").val(),
            source_page: 'web',
            message_id: $("#message-id").html(),
            subject: 'Sermon Notes - ' + sermon_title + ' - ' + current,
            contents: editor_data
        }, function () {
            $("#email_status").html(" Your message was sent");
            $("#send_email").val('');
        });
    });
    $("#send_note_email_friend").on('click', function (event) {
        var email = $.trim($("#send_email_friend").val());
        var email_friend = $.trim($("#send_email_friend_friendname").val());
        if (email == "") {
            $("#email_friend_status").html(" Please enter a valid email address.");
            return false;
        }
        if (!validateEmail(email)) {
            $("#email_friend_status").html(" Please enter a valid email address.");
            return false;
        }
        if (email_friend == "") {
            $("#email_friend_status").html(" Please enter your friend's email address.");
            return false;
        }
        if (!validateEmail(email_friend)) {
            $("#email_friend_status").html(" Please enter your friend's email address.");
            return false;
        }
        $("#email_status").html(" Sending....");
        var honeypot = $('#send_website').val();
        if (honeypot == '' || honeypot == null) {
            ga('send', 'event', 'button', 'click', 'Share Live Email with Friend');
            $.post("/api/email-friend/", {
                email: $("#send_email_friend").val(),
                friend_email: $("#send_email_friend_friendname").val(),
                message: $("#send_email_friend_message").val(),
                page_id: '1369'
            }, function () {
                $("#email_friend_status").html(" Your message was sent");
                $("#send_email_friend_friendname").val('');
            });
        }
    });
    $(".share-series-email .box a").on('click', function (event) {
        event.preventDefault();
        $.magnificPopup.open({
            items: {
                src: '#share-email-popup'
            },
            type: 'inline'
        }, 0);
    });
    var reviewOff = true;
    $("#review-questions-click").on('click', function (event) {
        ga('send', 'event', 'button', 'click', 'Review Questions');
        $('#review-content').toggleClass("hide");
        $("#review-questions-click-holder").toggleClass('mg-b-lg');
        $("#review-questions-click-holder").toggleClass('mg-b-md');
        if (reviewOff) {
            reviewOff = false;
            $("#review-questions-click").html("<i class='icon-document-1'></i> Hide Review Questions &amp; Daily Readings");
        } else {
            reviewOff = true;
            $("#review-questions-click").html("<i class='icon-document-1'></i> View Review Questions &amp; Daily Readings");
        }
    });
    $("#expand").on('click', function (event) {
        ga('send', 'event', 'button', 'click', 'Expand Video');
        $("#section-video").removeClass("col-lg-7");
        $("#section-video").addClass("col-lg-12");
        $("#section-sidebar").removeClass("col-lg-5");
        $("#section-sidebar").addClass("col-lg-12");
        $("#contract").removeClass('size-control-disabled');
        $("#contract").addClass('size-control-enabled');
        $("#expand").removeClass('size-control-enabled');
        $("#expand").addClass('size-control-disabled');
    });
    $("#contract").on('click', function (event) {
        ga('send', 'event', 'button', 'click', 'Contract Video');
        $("#section-video").removeClass("col-lg-12");
        $("#section-video").addClass("col-lg-7");
        $("#section-sidebar").removeClass("col-lg-12");
        $("#section-sidebar").addClass("col-lg-5");
        $("#expand").removeClass('size-control-disabled');
        $("#expand").addClass('size-control-enabled');
        $("#contract").removeClass('size-control-enabled');
        $("#contract").addClass('size-control-disabled');
    });
    renderCountdown();
});

</script>
    <?php if(isset($additionalJS)) echo '<script>'. $additionalJS .'</script>'; ?>
    <script src='/site/templates/css/ckeditor/ckeditor.js'></script>
    <script src='/site/templates/css/ckeditor/samples/js/sample.js'></script>

    <!-- begin bootstrap modals -->
    <?php include("modals.php");?>

    <!-- End bootstrap modals -->
<script>
  initSample();
</script>
  </body>

</html>