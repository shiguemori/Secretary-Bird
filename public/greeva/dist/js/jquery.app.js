!function(i){"use strict";var t=function(){this.$body=i("body"),this.$window=i(window)};t.prototype.initMenu=function(){var e=this;i(".button-menu-mobile").on("click",function(t){t.preventDefault(),e.$body.toggleClass("enlarged"),i(".slimscroll-menu").slimscroll({height:"auto",position:"right",size:"8px",color:"#9ea5ab",wheelStep:5})}),i(".navbar-toggle").on("click",function(t){i(this).toggleClass("open"),i("#navigation").slideToggle(400)}),i(".navigation-menu>li").slice(-2).addClass("last-elements"),i('.navigation-menu li.has-submenu a[href="#"]').on("click",function(t){i(window).width()<992&&(t.preventDefault(),i(this).parent("li").toggleClass("open").find(".submenu:first").toggleClass("open"))}),i(".slimscroll-menu").slimscroll({height:"auto",position:"right",size:"8px",color:"#9ea5ab",wheelStep:5}),i(".right-bar-toggle").on("click",function(t){i("body").toggleClass("right-bar-enabled")}),i(document).on("click","body",function(t){0<i(t.target).closest(".right-bar-toggle, .right-bar").length||i("body").removeClass("right-bar-enabled")}),i(".navigation-menu a").each(function(){var t=window.location.href.split(/[?#]/)[0];this.href==t&&(i(this).addClass("active"),i(this).parent().addClass("active"),i(this).parent().parent().addClass("in"),i(this).parent().parent().prev().addClass("active"),i(this).parent().parent().parent().addClass("active"),i(this).parent().parent().parent().parent().addClass("in"),i(this).parent().parent().parent().parent().parent().addClass("active"))})},t.prototype.initLayout=function(){this.$window.width()<1025?this.$body.addClass("enlarged"):1!=this.$body.data("keep-enlarged")&&this.$body.removeClass("enlarged")},t.prototype.init=function(){this.initLayout(),this.initMenu()},i.App=new t,i.App.Constructor=t}(window.jQuery),function(t){"use strict";window.jQuery.App.init()}();