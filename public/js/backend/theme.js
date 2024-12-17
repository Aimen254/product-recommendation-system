var NioApp=function(n,c){"use strict";var t=c(window),i=c("body"),a="nio-theme";function r(t,a){return Object.keys(a).forEach(function(e){t[e]=a[e]}),t}return c.fn.exists=function(){return 0<this.length},c.fn.csskey=function(e,t){for(var a=t?t+"-":"",o=e?e.split(" "):"",i=0;i<o.length;i++)o[i]=a+o[i];return o.toString().replace(","," ")},n.BS={},n.TGL={},n.Ani={},n.Addons={},n.Slider={},n.Picker={},n.Win={height:t.height(),width:t.outerWidth()},n.Break={mb:420,sm:576,md:768,lg:992,xl:1200,xxl:1540,any:1/0},n.Host={name:window.location.hostname,locat:a.slice(-5)+a.slice(0,3)},n.isDark=!(!i.hasClass("dark-mode")&&"dark"!==i.data("theme")),n.State={isRTL:!(!i.hasClass("has-rtl")&&"rtl"!==i.attr("dir")),isTouch:"ontouchstart"in document.documentElement,isMobile:!!navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|/i),asMobile:n.Win.width<n.Break.md,asServe:n.Host.name.split(".").indexOf(n.Host.locat)},n.hexRGB=function(e,t){t=t||1;if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(e))return 3===(e=e.substring(1).split("")).length&&(e=[e[0],e[0],e[1],e[1],e[2],e[2]]),e=[(e="0x"+e.join(""))>>16&255,e>>8&255,255&e].join(","),1<=t?"rgba("+e+")":"rgba("+e+","+t+")";throw new Error("bad hex")},n.StateUpdate=function(){n.Win={height:t.height(),width:t.outerWidth()},n.State.asMobile=n.Win.width<n.Break.md},n.ClassInit=function(){function e(){!0===n.State.asMobile?i.addClass("as-mobile"):i.removeClass("as-mobile")}!0===n.State.isTouch?i.addClass("has-touch"):i.addClass("no-touch"),e(),!0===n.State.isRTL&&i.addClass("has-rtl"),i.addClass("nk-"+a),t.on("resize",e)},n.ColorBG=function(){function e(e,t){var a=c(e),e=t||"bg",t=a.data(e);""!==t&&("bg-color"===e?a.css("background-color",t):"bg-image"===e?a.css("background-image",'url("'+t+'")'):a.css("background",t))}c("[data-bg]").each(function(){e(this,"bg")}),c("[data-bg-color]").each(function(){e(this,"bg-color")}),c("[data-bg-image]").each(function(){e(this,"bg-image")})},n.ColorTXT=function(){c("[data-color]").each(function(){var e,t;t="color",e=c(e=this),t=t||"color",""!==(t=e.data(t))&&e.css("color",t)})},n.BreakClass=function(e,t,a){var o=e||".header-menu",i=t||n.Break.md,t={timeOut:1e3,classAdd:"mobile-menu"},s=a?r(t,a):t,t=s.ignore||!1;if(t&&c(o).hasClass(t))return!1;n.Win.width<i?setTimeout(function(){n.Win.width<i&&c(o).addClass(s.classAdd)},s.timeOut):c(o).removeClass(s.classAdd)},n.Passcode=function(e,t){var a={showClass:"is-shown",hideClass:"is-hidden"},o=t?r(a,t):a;c(e).exists()&&c(e).on("click",function(e){var t=c(this),a=t.data("target"),a=c("#"+a);e.preventDefault(),a.hasClass(o.showClass)?(t.add(a).addClass(o.hideClass).removeClass(o.showClass),a.attr("type","password")):(t.add(a).addClass(o.showClass).removeClass(o.hideClass),a.attr("type","text"))})},n.LinkOff=function(e){c(e).on("click",function(e){e.preventDefault()})},n.SetHW=function(e,t){t="height"==t||"h"==t?"height":"width",e=e||"[data-"+t+"]";c(e).exists()&&c(e).each(function(){c(this).css(t,c(this).data(t))})},n.AddInBody=function(e,t){var a={prefix:"nk-",class:"",has:"has"},t=t?r(a,t):a,a=e.replace(".","").replace(t.prefix,""),e=a;t.prefix=!1!==t.prefix?t.prefix:"",t.has=""!==t.has?t.has+"-":"",e=""!==t.class?t.class:t.has+e,c("."+t.prefix+a).exists()&&!i.hasClass(e)&&i.addClass(e)},n.Toggle={trigger:function(e,t){var a={self:e,active:"active",content:"expanded",data:"content",olay:"toggle-overlay",speed:400},o=t?r(a,t):a,t=c("[data-target="+e+"]"),a=c("[data-"+o.data+"="+e+"]"),e=a.data("toggle-body");a.data("toggle-overlay")&&(o.overlay=o.olay),e&&(o.body="toggle-shown"),a.hasClass(o.content)?(t.removeClass(o.active),(1==o.toggle?a.slideUp(o.speed):a).removeClass(o.content)):(t.addClass(o.active),(1==o.toggle?a.slideDown(o.speed):a).addClass(o.content)),o.body&&i.toggleClass(o.body),o.overlay&&this.overlay(a,o.overlay,o)},removed:function(e,t){var a={self:e,active:"active",content:"expanded",body:"",data:"content",olay:"toggle-overlay"},o=t?r(a,t):a,t=c("[data-target="+e+"]"),a=c("[data-"+o.data+"="+e+"]"),e=a.data("toggle-body");a.data("toggle-overlay")&&(o.overlay=o.olay),e&&(o.body="toggle-shown"),(t.hasClass(o.active)||a.hasClass(o.content))&&(t.removeClass(o.active),a.removeClass(o.content),!0===o.toggle&&a.slideUp(o.speed)),o.body&&i.hasClass(o.body)&&i.removeClass(o.body),o.close&&(!0===o.close.profile&&this.closeProfile(a),!0===o.close.menu&&this.closeMenu(a)),o.overlay&&this.overlayRemove(o.overlay)},overlay:function(e,t,a){var o;!0===a.break&&(o=c(e).data("toggle-screen"),a.break=n.Break[o]),c(e).hasClass(a.content)&&n.Win.width<a.break?c(e).after('<div class="'+t+'" data-target="'+a.self+'"></div>'):this.overlayRemove(t)},overlayRemove:function(e){c("."+e).fadeOut(300).remove()},dropMenu:function(e,t){var a={active:"active",self:"link-toggle",child:"menu-sub",speed:400},t=t?r(a,t):a,a=c(e).parent(),e=a.children("."+t.child);t.speed=5<e.children().length?t.speed+20*e.children().length:t.speed,e.slideToggle(t.speed).find("."+t.child).slideUp(t.speed),a.toggleClass(t.active).siblings().removeClass(t.active).find("."+t.child).slideUp(t.speed)},closeProfile:function(e){var t=c(e).find(".nk-profile-toggle.active"),e=c(e).find(".nk-profile-content.expanded");t.exists()&&(t.removeClass("active"),e.slideUp().removeClass("expanded"))},closeMenu:function(e){e=c(e).find(".nk-menu-item.active");e.exists()&&e.removeClass("active").find(".nk-menu-sub").slideUp()}},n.BS.tooltip=function(e,t){var a={boundary:"window",trigger:"hover"},a=t?r(a,t):a;c(e).exists()&&"function"==typeof c.fn.tooltip&&c(e).tooltip(a)},n.BS.menutip=function(e){n.BS.tooltip(e,{boundary:"window",placement:"right"})},n.BS.popover=function(e){c(e).exists()&&"function"==typeof c.fn.popover&&c(e).popover()},n.BS.progress=function(e){c(e).exists()&&c(e).each(function(){c(this).css("width",c(this).data("progress")+"%")})},n.BS.modalfix=function(e){e=e||".modal";c(e).exists()&&"function"==typeof c.fn.modal&&c(e).on("shown.bs.modal",function(){i.hasClass("modal-open")||i.addClass("modal-open")})},n.BS.fileinput=function(e){c(e).exists()&&c(e).each(function(){var t=c(this).next().text(),a=[];c(this).on("change",function(){for(var e=0;e<this.files.length;e++)a[e]=this.files[e].name;t=a?a.join(", "):t,c(this).next().html(t)})})},n.Picker.date=function(e,t){c(e).exists()&&"function"==typeof c.fn.datepicker&&c(e).each(function(){var e=c(this).data("date-format"),e={format:""!==e?e:"mm/dd/yyyy",maxViewMode:2,clearBtn:!0,autoclose:!0,todayHighlight:!0,rtl:n.State.isRTL},e=t?r(e,t):e;c(this).datepicker(e).on("changeDate",function(e){0!==e.dates.length?c(this).parent().addClass("focused"):c(this).parent().removeClass("focused")})})},n.Picker.dob=function(e,t){var a={startView:2,todayHighlight:!1},a=t?r(a,t):a;n.Picker.date(e,a)},n.Picker.time=function(e,a){c(e).exists()&&"function"==typeof c.fn.timepicker&&c(e).each(function(){c(this).parent().addClass("has-timepicker");var e=c(this).data("time-format"),t=c(this).data("time-interval"),t={timeFormat:""!==e?e:"HH:mm",interval:""!==t?t:15,change:function(e){!1!==e?c(this).parent().addClass("focused"):c(this).parent().removeClass("focused")}},t=a?r(t,a):t;c(this).timepicker(t)})},n.Slick=function(e,t){c(e).exists()&&"function"==typeof c.fn.slick&&c(e).each(function(){var e={prevArrow:'<div class="slick-arrow-prev"><a href="javascript:void(0);" class="slick-prev"><em class="icon ni ni-chevron-left"></em></a></div>',nextArrow:'<div class="slick-arrow-next"><a href="javascript:void(0);" class="slick-next"><em class="icon ni ni-chevron-right"></em></a></div>',rtl:n.State.isRTL},e=t?r(e,t):e;c(this).slick(e)})},n.Knob=function(e,t){var a,o;c(e).exists()&&"function"==typeof c.fn.knob&&(a={min:0},o=t?r(a,t):a,c(e).each(function(){c(this).knob(o)}))},n.Range=function(e,a){c(e).exists()&&"undefined"!=typeof noUiSlider&&c(e).each(function(){var e=c(this).attr("id"),t=document.getElementById(e),e={start:[25],connect:"lower",direction:n.State.isRTL?"rtl":"ltr",range:{min:0,max:100}},e=a?r(e,a):e;noUiSlider.create(t,e)})},n.Select2=function(e,a){c(e).exists()&&"function"==typeof c.fn.select2&&c(e).each(function(){var e=c(this),t={placeholder:e.data("placeholder"),clear:e.data("clear"),search:e.data("search"),width:e.data("width"),theme:e.data("theme"),ui:e.data("ui")};t.ui=t.ui?" "+e.csskey(t.ui,"select2"):"";t={theme:t.theme?t.theme+" "+t.ui:"default"+t.ui,allowClear:t.clear||!1,placeholder:t.placeholder||"",dropdownAutoWidth:!(!t.width||"auto"!==t.width),minimumResultsForSearch:t.search&&"on"===t.search?1:-1,dir:n.State.isRTL?"rtl":"ltr"},t=a?r(t,a):t;c(this).select2(t)})},n.coreInit=function(){n.coms.onResize.push(n.StateUpdate),n.coms.docReady.push(n.ClassInit)},n.coreInit(),n}(NioApp=function(e,t,a){"use strict";var o={AppInfo:{name:"NioApp",version:"1.0.7",author:"Softnio"},Package:{name:"DashLite",version:"2.2"}},i={docReady:[],docReadyDefer:[],winLoad:[],winLoadDefer:[],onResize:[],onResizeDefer:[]};function s(t){t=void 0===t?e:t,i.docReady.concat(i.docReadyDefer).forEach(function(e){null!=e&&e(t)})}function n(t){t="object"==typeof t?e:t,i.winLoad.concat(i.winLoadDefer).forEach(function(e){null!=e&&e(t)})}function c(t){t="object"==typeof t?e:t,i.onResize.concat(i.onResizeDefer).forEach(function(e){null!=e&&e(t)})}return e(a).ready(s),e(t).on("load",n),e(t).on("resize",c),o.coms=i,o.docReady=s,o.winLoad=n,o.onResize=c,o}(jQuery,window,document),jQuery);
!(function (NioApp, $) {
    "use strict";
    NioApp.Package.name = "DashLite";
    NioApp.Package.version = "2.2";

    var $win = $(window), $body = $('body'), $doc = $(document), 

    //class names
    _body_theme  = 'nio-theme',
    _menu        = 'nk-menu',
    _mobile_nav  = 'mobile-menu',
    _header      = 'nk-header', 
    _header_menu = 'nk-header-menu', 
    //breakpoints
    _break       = NioApp.Break;

    function extend(obj, ext) {
        Object.keys(ext).forEach(function(key) { obj[key] = ext[key]; });
        return obj;
    }

    // ClassInit @v1.0
    NioApp.ClassNavMenu = function() {
        NioApp.BreakClass('.'+_header_menu, _break.lg, { timeOut: 0 } );
        $win.on('resize', function() {
            NioApp.BreakClass('.'+_header_menu, _break.lg);
        });
    };

    // Code Prettify @v1.0
    NioApp.Prettify = function(){
        window.prettyPrint && prettyPrint();
    };

    // Copied @v1.0
    NioApp.Copied = function() {
        var clip   = '.clipboard-init', target = '.clipboard-text', 
            sclass = 'clipboard-success', eclass = 'clipboard-error';

        // Feedback
        function feedback (el, state) {
            var $elm = $(el), $elp = $elm.parent(), copy = {text: 'Copy link', done: 'Copied', fail: 'Failed'},
                data = {text: $elm.data('clip-text'), done: $elm.data('clip-success'), fail: $elm.data('clip-error')};

                copy.text = (data.text) ? data.text : copy.text;
                copy.done = (data.done) ? data.done : copy.done;
                copy.fail = (data.fail) ? data.fail : copy.fail;

            var copytext = (state==='success') ? copy.done : copy.fail, 
                addclass = (state==='success') ? sclass : eclass;
            
            $elp.addClass(addclass).find(target).html(copytext);

            setTimeout(function(){
                $elp.removeClass(sclass + ' ' + eclass).find(target).html(copy.text).blur();
                $elp.find('input').blur();
            }, 2000);
        }

        // Init ClipboardJS
        if(ClipboardJS.isSupported()){
            var clipboard = new ClipboardJS(clip);
            clipboard.on('success', function(e) {
                feedback(e.trigger, 'success'); 
                e.clearSelection();
            }).on('error', function(e) {
                feedback(e.trigger, 'error');
            });
        } else {
            $(clip).css('display','none');
        };
    };

    // CurrentLink Detect @v1.0
    NioApp.CurrentLink = function(){
        var _link = '.nk-menu-link, .menu-link, .nav-link',
            _currentURL = window.location.href,
            fileName = _currentURL.substring(0, (_currentURL.indexOf("#") == -1) ? _currentURL.length : _currentURL.indexOf("#")), 
            fileName = fileName.substring(0, (fileName.indexOf("?") == -1) ? fileName.length : fileName.indexOf("?"));

        $(_link).each(function() {
            var self = $(this), _self_link = self.attr('href');
            if (fileName.match(_self_link)) {
                self.closest("li").addClass('active current-page').parents().closest("li").addClass("active current-page");
                self.closest("li").children('.nk-menu-sub').css('display','block');
                self.parents().closest("li").children('.nk-menu-sub').css('display','block');
            } else {
                self.closest("li").removeClass('active current-page').parents().closest("li:not(.current-page)").removeClass("active");
            }
        });
    };

    // PasswordSwitch @v1.0
    NioApp.PassSwitch = function(){
        NioApp.Passcode('.passcode-switch');
    };

    // Toastr Message @v1.0 
    NioApp.Toast = function (msg, ttype, opt) {
        var ttype   = (ttype) ? ttype : 'info', msi = '',
            ticon   = (ttype==='info') ? 'ni ni-info-fill' : ((ttype==='success') ? 'ni ni-check-circle-fill' : ((ttype==='error') ? 'ni ni-cross-circle-fill' : ((ttype==='warning') ? 'ni ni-alert-fill' : '') ) ), 
            def     = {position:'bottom-right', ui: '', icon: 'auto', clear: false}, attr = (opt) ? extend(def, opt) : def;

            attr.position = (attr.position) ? 'toast-'+attr.position : 'toast-bottom-right';
            attr.icon = (attr.icon==='auto') ? ticon : ((attr.icon) ? attr.icon : '' ); 
            attr.ui = (attr.ui) ? ' '+ attr.ui : '';

            msi  = (attr.icon!=='') ? '<span class="toastr-icon"><em class="icon '+ attr.icon +'"></em></span>' : '',
            msg = (msg!=='') ? msi + '<div class="toastr-text">'+ msg + '</div>' : '';

        if(msg!=="") {
            if(attr.clear===true) { toastr.clear(); }
            var option = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": attr.position + attr.ui,
                    "closeHtml": '<span class="btn-trigger">Close</span>',
                    "preventDuplicates": true,
                    "showDuration": "1500",
                    "hideDuration": "1500",
                    "timeOut": "2000",
                    "toastClass": "toastr",
                    "extendedTimeOut": "3000"
                };
            toastr.options = extend(option, attr);
            toastr[ttype](msg);
        }
    };

    // Toggle Screen @v1.0
    NioApp.TGL.screen = function (elm){
        if($(elm).exists()) {        
            $(elm).each(function(){
                var ssize = $(this).data('toggle-screen');
                if(ssize){ $(this).addClass('toggle-screen-' + ssize ); }
            });
        }
    };

    // Toggle Content @v1.0
    NioApp.TGL.content = function (elm, opt){
        var toggle = (elm) ? elm : '.toggle', $toggle = $(toggle), $contentD = $('[data-content]'), 
            toggleBreak = true, toggleCurrent = false, def = { active: 'active', content: 'content-active', break: toggleBreak}, attr = (opt) ? extend(def, opt) : def;

        NioApp.TGL.screen($contentD);

        $toggle.on('click', function(e){
            toggleCurrent = this;
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });

        $doc.on('mouseup', function(e){
            if (toggleCurrent) {
                var $toggleCurrent = $(toggleCurrent);
                if (!$toggleCurrent.is(e.target) && $toggleCurrent.has(e.target).length===0 && !$contentD.is(e.target) && $contentD.has(e.target).length===0) {
                    NioApp.Toggle.removed($toggleCurrent.data('target'), attr);
                    toggleCurrent = false;
                }
            }
        });

        $win.on('resize', function(){
            $contentD.each(function(){
                var content = $(this).data('content'), ssize = $(this).data('toggle-screen'), toggleBreak = _break[ssize];
                if(NioApp.Win.width > toggleBreak){ 
                    NioApp.Toggle.removed(content, attr);
                } 
            });
        });
    };

    // ToggleExpand @v1.0
    NioApp.TGL.expand = function(elm, opt){
        var toggle = (elm) ? elm : '.expand', def = {toggle: true}, attr = (opt) ? extend(def, opt) : def;

        $(toggle).on('click', function(e){
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });
    };

    // Dropdown Menu @v1.0
    NioApp.TGL.ddmenu = function(elm, opt){
        var imenu = (elm) ? elm : '.nk-menu-toggle',
            def = { active: 'active', self: 'nk-menu-toggle', child: 'nk-menu-sub'},
            attr = (opt) ? extend(def, opt) : def;

        $(imenu).on('click', function(e){
            if (NioApp.Win.width < _break.lg) {
                NioApp.Toggle.dropMenu($(this), attr);
            }
            e.preventDefault();
        });
    };

    // Show Menu @v1.0
    NioApp.TGL.showmenu = function(elm, opt){
        var toggle = (elm) ? elm : '.nk-nav-toggle', $toggle = $(toggle), $contentD = $('[data-content]'),
            toggleBreak = ($contentD.hasClass(_header_menu)) ? _break.lg : _break.xl,
            toggleOlay = _header + '-overlay', toggleClose = {profile: true, menu: false}, 
            def = { active: 'toggle-active', content: _header + '-active', body: 'nav-shown', overlay: toggleOlay, break: toggleBreak, close: toggleClose }, 
            attr = (opt) ? extend(def, opt) : def;

        $toggle.on('click', function(e){
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });

        $doc.on('mouseup', function(e){
            if (!$toggle.is(e.target) && $toggle.has(e.target).length===0 && !$contentD.is(e.target) && $contentD.has(e.target).length===0 && NioApp.Win.width < toggleBreak) {
                NioApp.Toggle.removed($toggle.data('target'), attr);
            }
        });

        $win.on('resize', function(){
            if(NioApp.Win.width < _break.xl || NioApp.Win.width < toggleBreak ){ 
                NioApp.Toggle.removed($toggle.data('target'), attr);
            } 
        });
    };

    // Animate FormSearch @v1.0
    NioApp.Ani.formSearch= function(elm, opt){
        var def = {active: 'active', timeout: 400, target: '[data-search]'}, attr = (opt) ? extend(def, opt) : def;
        var $elem = $(elm), $target = $(attr.target);

        if($elem.exists()) {
            $elem.on('click', function(e){
                e.preventDefault();
                var $self = $(this), the_target = $self.data('target'),
                    $self_st = $('[data-search=' + the_target + ']'),
                    $self_tg = $('[data-target=' + the_target + ']');

                if(!$self_st.hasClass(attr.active)){
                    $self_tg.add($self_st).addClass(attr.active);
                    $self_st.find('input').focus();
                } else{
                    $self_tg.add($self_st).removeClass(attr.active);
                    setTimeout(function(){
                        $self_st.find('input').val('');
                    }, attr.timeout);
                }
            });

            $doc.on({
                keyup: function(e) {
                    if (e.key === "Escape") {
                        $elem.add($target).removeClass(attr.active);
                    }
                },
                mouseup: function(e){
                    if (!$target.find('input').val() && !$target.is(e.target) && $target.has(e.target).length===0 && !$elem.is(e.target) && $elem.has(e.target).length===0) {
                        $elem.add($target).removeClass(attr.active);
                    }
                }
            });
        }
    };

    // Animate FormElement @v1.0
    NioApp.Ani.formElm = function(elm, opt){
        var def = {focus: 'focused'}, attr = (opt) ? extend(def, opt) : def;

        if($(elm).exists()) {
            $(elm).each(function(){
                var $self = $(this);

                if($self.val()){ 
                    $self.parent().addClass(attr.focus); 
                }
                $self.on({
                    focus: function(){
                        $self.parent().addClass(attr.focus);
                    },
                    blur: function(){
                        if(!$self.val()){ $self.parent().removeClass(attr.focus); }
                    }
                });
            });
        }
    };

    // Form Validate @v1.0
    NioApp.Validate = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var def = {errorElement: "span"}, attr = (opt) ? extend(def, opt) : def;
                $(this).validate(attr);
            });
        }
    };

    NioApp.Validate.init = function() {
        NioApp.Validate('.form-validate', 
        {
            errorElement: "span",
            errorClass: "invalid",
            errorPlacement: function(error, element) {
                error.appendTo( element.parent() );
              }
        });
    }

    // Dropzone @v1.0
    NioApp.Dropzone = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var def = {autoDiscover: false}, 
                    attr = (opt) ? extend(def, opt) : def;
                $(this).addClass('dropzone').dropzone(attr);
            });
        }
    };

    // Wizard @v1.0
    // NioApp.Wizard = function(){

    //     var $wizard = $(".nk-wizard").show();
    //     $wizard.steps({
    //         headerTag: ".nk-wizard-head",
    //         bodyTag: ".nk-wizard-content",
    //         labels: {
    //             finish: "Submit",
    //             next: "Next",
    //             previous: "Prev",
    //             loading: "Loading ..."
    //         },
    //         onStepChanging: function (event, currentIndex, newIndex)
    //         {
    //             // Allways allow previous action even if the current form is not valid!
    //             if (currentIndex > newIndex)
    //             {
    //                 return true;
    //             }
    //             // Needed in some cases if the user went back (clean up)
    //             if (currentIndex < newIndex)
    //             {
    //                 // To remove error styles
    //                 $wizard.find(".body:eq(" + newIndex + ") label.error").remove();
    //                 $wizard.find(".body:eq(" + newIndex + ") .error").removeClass("error");
    //             }
    //             $wizard.validate().settings.ignore = ":disabled,:hidden";
    //             return $wizard.valid();
    //         },
    //         onFinishing: function (event, currentIndex)
    //         {
    //             $wizard.validate().settings.ignore = ":disabled";
    //             return $wizard.valid();
    //         },
    //         onFinished: function (event, currentIndex){window.location.href = "#";}
            
    //     }).validate({
    //         errorElement: "span",
    //         errorClass: "invalid",
    //         errorPlacement: function(error, element) {
    //             error.appendTo( element.parent() );
    //         }
    //     });
        
    // }


    // DataTable @1.1
    NioApp.DataTable = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var auto_responsive = $(this).data('auto-responsive');
                var dom_normal = '<"row justify-between g-2"<"col-7 col-sm-6 text-left"f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'; 
                var dom_separate = '<"row justify-between g-2"<"col-7 col-sm-6 text-left"f><"col-5 col-sm-6 text-right"<"datatable-filter"l>>><"my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'; 
                var dom = $(this).hasClass('is-separate') ? dom_separate : dom_normal;
                var def = {
                        responsive: true,
                        autoWidth: false,
                        dom: dom,
                        language: {
                            search : "",
                            searchPlaceholder: "Type in to Search",
                            lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                            info: "_START_ -_END_ of _TOTAL_",
                            infoEmpty: "No records found",
                            infoFiltered: "( Total _MAX_  )",
                            paginate: {
                                "first":      "First",
                                "last":       "Last",
                                "next":       "Next",
                                "previous":   "Prev"
                            },
                        }
                    }, 
                    attr = (opt) ? extend(def, opt) : def;
                    attr =(auto_responsive === false) ?  extend(attr, {responsive: false}) : attr;

                $(this).DataTable(attr);
            });
        }
    };


    // BootStrap Extended
    NioApp.BS.ddfix = function(elm, exc) {
        var dd = (elm) ? elm : '.dropdown-menu',
            ex = (exc) ? exc : 'a:not(.clickable), button:not(.clickable), a:not(.clickable) *, button:not(.clickable) *';

        $(dd).on('click', function (e) {
            if(!$(e.target).is(ex)){ 
                e.stopPropagation();
                return;
            }
        });
        if(NioApp.State.isRTL){
            var $dMenu = $('.dropdown-menu');
            $dMenu.each(function(){
                var $self = $(this);
                if($self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')){
                    $self.prev('[data-toggle="dropdown"]').dropdown({
                        popperConfig: {
                            placement: 'bottom-start'
                        }
                    });
                }else if(!$self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')){
                    $self.prev('[data-toggle="dropdown"]').dropdown({
                        popperConfig: {
                            placement: 'bottom-end'
                        }
                    });
                }
            });
        }
    }

    // BootStrap Specific Tab Open
    NioApp.BS.tabfix = function(elm) {
        var tab = (elm) ? elm : '[data-toggle="modal"]';
        $(tab).on('click', function(){
            var _this = $(this), target = _this.data('target'), target_href = _this.attr('href'),
                tg_tab = _this.data('tab-target');

            var modal = (target) ? $body.find(target) : $body.find(target_href);
            if (tg_tab && tg_tab !=='#' && modal) {
                modal.find('[href="'+tg_tab+'"]').tab('show');
            } else if(modal) {
                var tabdef = modal.find('.nk-nav.nav-tabs');
                var link = $(tabdef[0]).find('[data-toggle="tab"]');
                $(link[0]).tab('show');
            }
        });
    }

    // Dark Mode Switch @since v2.0
    NioApp.ModeSwitch = function() {
        var toggle = $('.dark-switch');
        if($body.hasClass('dark-mode')){
            toggle.addClass('active');
        }else {
            toggle.removeClass('active');
        }
        toggle.on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('active');
            $body.toggleClass('dark-mode');
        })
    }

    // Knob @v1.0
    NioApp.Knob.init = function() {
        var knob = {
                default: {readOnly: true, lineCap: "round"}, 
                half: { angleOffset: -90, angleArc: 180, readOnly: true, lineCap: "round"} 
            };
        
        NioApp.Knob('.knob', knob.default);
        NioApp.Knob('.knob-half', knob.half);
    };

    // Range @v1.0
    NioApp.Range.init = function() {
        NioApp.Range('.form-range-slider');
    };

    NioApp.Select2.init = function() {
        // NioApp.Select2('.select');
        NioApp.Select2('.form-select');
    };

    // Slick Init @v1.0
    NioApp.Slider.init = function() {
        NioApp.Slick('.slider-init');
    };

    // Dropzone Init @v1.0
    NioApp.Dropzone.init = function() {
        NioApp.Dropzone('.upload-zone', {url: "/images"} );
    };

    // DataTable Init @v1.0
    NioApp.DataTable.init = function () {
        NioApp.DataTable('.datatable-init', {
            responsive: {
                details: true
            }
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
    }

    // Extra @v1.1
    NioApp.OtherInit = function() {
        NioApp.PassSwitch();
        NioApp.CurrentLink();
        NioApp.LinkOff('.is-disable');
        NioApp.ClassNavMenu();
        //v1.5
        NioApp.SetHW('[data-height]', 'height');
        NioApp.SetHW('[data-width]', 'width');
    };
    
    // Animate Init @v1.0
    NioApp.Ani.init = function() {
        NioApp.Ani.formElm('.form-control-outlined');
        NioApp.Ani.formSearch('.toggle-search');
    };

    // BootstrapExtend Init @v1.0
    NioApp.BS.init = function() {
        NioApp.BS.menutip('a.nk-menu-link');
        NioApp.BS.tooltip('.nk-tooltip');
        NioApp.BS.tooltip('.btn-tooltip', {placement: 'top'});
        NioApp.BS.tooltip('[data-toggle="tooltip"]');
        NioApp.BS.tooltip('.tipinfo,.nk-menu-tooltip', {placement: 'right'});
        NioApp.BS.popover('[data-toggle="popover"]');
        NioApp.BS.progress('[data-progress]');
        NioApp.BS.fileinput('.custom-file-input');
        NioApp.BS.modalfix();
        NioApp.BS.ddfix();
        NioApp.BS.tabfix();
    }

    // Picker Init @v1.0
    NioApp.Picker.init = function() {
        NioApp.Picker.date('.date-picker');
        NioApp.Picker.dob('.date-picker-alt'); 
        NioApp.Picker.time('.time-picker');
    };

    // Addons @v1
    NioApp.Addons.Init = function() {
        NioApp.Knob.init();
        NioApp.Range.init();
        NioApp.Select2.init();
        NioApp.Dropzone.init();
        NioApp.Slider.init();
        NioApp.DataTable.init();
    };

    // Toggler @v1
    NioApp.TGL.init = function() {
        NioApp.TGL.content('.toggle');
        NioApp.TGL.expand('.toggle-expand'); 
        NioApp.TGL.expand('.toggle-opt', {toggle: false}); 
        NioApp.TGL.showmenu('.nk-nav-toggle');
        NioApp.TGL.ddmenu('.'+ _menu + '-toggle', {self: _menu + '-toggle', child: _menu + '-sub' }); 
    };

    NioApp.BS.modalOnInit = function() {
        $('.modal').on('shown.bs.modal', function () {
            NioApp.Select2.init();
            NioApp.Validate.init();
        });

    };

    // Initial by default
    /////////////////////////////
    NioApp.init = function(){
        NioApp.coms.docReady.push(NioApp.OtherInit);
        NioApp.coms.docReady.push(NioApp.Prettify);
        NioApp.coms.docReady.push(NioApp.ColorBG);
        NioApp.coms.docReady.push(NioApp.ColorTXT);
        NioApp.coms.docReady.push(NioApp.Copied);
        NioApp.coms.docReady.push(NioApp.Ani.init);
        NioApp.coms.docReady.push(NioApp.TGL.init);
        NioApp.coms.docReady.push(NioApp.BS.init);
        NioApp.coms.docReady.push(NioApp.Validate.init);
        NioApp.coms.docReady.push(NioApp.Picker.init);
        NioApp.coms.docReady.push(NioApp.Addons.Init);
        NioApp.coms.docReady.push(NioApp.Wizard);
        NioApp.coms.winLoad.push(NioApp.ModeSwitch);
    }

    NioApp.init();

	return NioApp;
})(NioApp, jQuery);
// $(document).on('click', '.delete', function () {
//     let url = $(this).data('url');
//     let reload = $(this).data('reload');
//     let tableId = '#' + $(this).data('table');
//     let redirect = $(this).data('redirect');
//     let callback = $(this).data('callback');
//     let triggerred = $(this).data('triggerred');
//     deleteConfirmation(url, tableId, reload, redirect, callback, triggerred);
// });

// function deleteConfirmation(url, tableId, reload = false, redirect = false, callback = false, triggerred=false) {
//     window.swal.fire({
//         title: 'Are you sure?',
//         text: "You want to delete this record",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: "Yes, delete it!"
//     }).then((result) => {
//         if (result.value) {
//             window.swal.fire({
//                 title: "",
//                 text: "Please wait...",
//                 showConfirmButton: false,
//                 backdrop: true
//             });

//             window.axios.delete(url).then(response => {
//                 if (response.status === 200) {
//                     window.swal.close();
//                     // Show toast message
//                     Toast.fire({
//                         icon: 'success',
//                         title: response.data.message
//                     });
//                     if(triggerred){
//                         $(document).trigger(triggerred);
//                     }
//                     if (reload == true) {
//                         window.location.reload();
//                     }

//                     if (redirect) {
//                         window.location.href = redirect;
//                     }

//                     if(callback){
//                         window[callback]();
//                     }

//                     $(tableId).DataTable().ajax.reload();


//                 }
//             }).catch(error => {
//                 window.swal.close();
//                 // Show toast message
//                 Toast.fire({
//                     icon: 'error',
//                     title: error.response.data.message
//                 });
//             });
//         }
//     });
// }

function toastMessage(message = '', status = '') {
    status = status == '' ? 'error' : status;

    if (message == '')
        message = status == 'error' ? 'Something went wrong' : 'Success';

    Toast.fire({
        title: message,
        icon: status,
    });
}

$('body').on('click', '[data-act=ajax-modal]', function () {
    const _self = $(this);

    const content = $("#ajax_model_content");
    const spinner = $("#ajax_model_spinner");

    content.hide();
    spinner.show();

    $("#ajax_model").modal({ backdrop: "static" });
    $("#ajax_model_title").html(_self.attr('data-title'));
    var metaData = {};
    $(this).each(function () {
        $.each(this.attributes, function () {
            if (this.specified && this.name.match("^data-post-")) {
                var dataName = this.name.replace("data-post-", "");
                metaData[dataName] = this.value;
            }
        });
    });

    axios({
        method: _self.attr('data-method'),
        url: _self.attr('data-action-url'),
        data: metaData
    })
        .then(response => {
            spinner.hide();
            if (response.status === 200) {
                content.html(response.data).show();
                $('#ajax_model select').css('width', '100%');
                $('.form-select-modal').select2({
                    width: '100%',

                });
                $('.datepicker').datepicker({
                    format: "yyyy-mm-dd",

                });
                initMap('map-popup', 'searchInputPopup', 'latitude-popup', 'longitude-popup', false, '', 0, 0)
            }
            else toastMessage();
            $('input.open-time-picker').timepicker({
                timeFormat: 'HH:mm:ss',
            });
            $('input.close-time-picker').timepicker({
                timeFormat: 'HH:mm:ss',
            });
            $('textarea:not(.without-summernote)').summernote({
                height: 200
            });




        }).catch(error => {
            spinner.hide();
            // toastMessage(error.response.data.message);
        });
});

$('body').on('submit', '[data-form=ajax-form]', function (e) {
    e.preventDefault();
    const form = this;
    const confirm = $(form).data('confirm');

    if (confirm == 'yes') {
        window.swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to submit this form?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, do it!"
        }).then((result) => {
            if (result.value) sendAjaxForm(form);
        });
    } else {
        sendAjaxForm(form);
    }
});

function sendAjaxForm(form) {
    const _self = $(form);
    const btn = _self.find('[data-button=submit]');
    const btnHtml = btn.html();
    const modal = _self.data('modal');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');
    const redirect = _self.data('redirect');
    const formReset = _self.data('form-reset');
    const callback = _self.data('callback');
    const editFormCallback = _self.data('editform');

    btn.attr('disabled', 'disabled');
    btn.html(btnHtml + '&nbsp;&nbsp;<span class="spinner-border spinner-border-sm"></span>');

    axios({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
    })
        .then(response => {
            if (response.status == 200) {
                if (modal !== '') $(modal).modal('hide');
                if (dt !== '') $(dt).DataTable().ajax.reload();


                toastMessage(response.data.message, 'success');

                if (formReset == true) _self.trigger('reset');

                if (reload == true) window.location.reload();

                if (redirect) {
                    window.location.href = redirect;
                }
                if(callback){
                    window[callback]();
                }
                if(editFormCallback){
                    window[editFormCallback](response.data.model.uuid, response.data.model.id);
                }

            }

            else toastMessage();
        })
        .catch(error => {
            console.log(error);
            toastMessage(error.response.data.message);

        })
        .finally(response => {
            btn.removeAttr('disabled');
            btn.html(btnHtml);
        });
}

// setting up toast
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Logo Preview
$(document).on('click', '.modal-logo', function (e) {
    $(this).siblings('.logo').click();
});

$(document).on('change', '.logo', function (e) {


    var input = e.target;
    if (input.files && input.files[0]) {
        var file = input.files[0];

        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            $('.modalCompanyLgo').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click', '#modal-logo', function (e) {
    $(this).siblings('#avatar').click();
});

$(document).on('change', '#avatar', function (e) {


    var input = e.target;
    if (input.files && input.files[0]) {
        var file = input.files[0];

        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            $('#modalAvatar').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click', '#modal-logo', function (e) {
    $(this).siblings('#avatar-edit').click();
});

$(document).on('change', '#avatar-edit', function (e) {


    var input = e.target;
    if (input.files && input.files[0]) {
        var file = input.files[0];

        var reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = function (e) {
            $('#modalAvatarEdit').attr('src', reader.result).addClass('hasImage');
        }
    }
});


function changeStatus(url, tableId, formData, message, inputField) {
    // alert(formData.status);
    newStatus = formData.status ? 'activate' : 'deactivate';
    window.swal.fire({
        title: 'Are you sure?',
        text: "You want to " + newStatus + " this record",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes"
    }).then((result) => {
        let toggleStatus = inputField.is(':checked') ? false : true;
        // if alert is confirmed
        if (result.isConfirmed) {
            // axios put method request here
            window.axios.put(url, formData).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    $(tableId).DataTable().ajax.reload(null, false);

                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                }
            }).catch(error => {
                inputField.prop('checked', toggleStatus);

                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });
        }

        // if alert is dismissed
        if (result.isDismissed) {
            inputField.prop('checked', toggleStatus);
        }
    });
}

$(document).on('click', '.toggle-clicked', function (e) {
    _self = $(this);
    var data = {
        'status': _self.data('status')
        // 'reason': $('[name=rejected_reason]').val(),
    }
    let url = _self.data('url');
    let table = _self.data('table');
    const message = ""

    changeStatus(url, table, data, message, _self);
});

// $('.language-item').on('click', function (e) {
//     e.preventDefault();
//     var locale = $(this).attr('data-code');
//     $.ajax({
//         url: "/set-locale/" + locale,
//         method: "get",
//         success: function (response) {
//             if (response.status) {
//                 window.location.reload();
//             }
//         }
//     });
// });

$(document).on('click','.action-button', function(){
    var preview = $(this).data('preview');
    var inputfile = $(this).data('fileinput');
    $(inputfile).click();
    $(inputfile).on('change', function(e){
        var input = e.target;
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (e) {
                $(preview).attr('src', reader.result).addClass('hasImage');
            }
        }
    })
});
