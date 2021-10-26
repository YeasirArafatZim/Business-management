(function () {
    'use strict';
    var isMobile = {
        Android: function () {
            return navigator.userAgent.match(/Android/i);
        }
        , BlackBerry: function () {
            return navigator.userAgent.match(/BlackBerry/i);
        }
        , iOS: function () {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        }
        , Opera: function () {
            return navigator.userAgent.match(/Opera Mini/i);
        }
        , Windows: function () {
            return navigator.userAgent.match(/IEMobile/i);
        }
        , any: function () {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };
	jQuery('.widget-block #s').attr('placeholder','Search...'); 	
    // Full Height
    var fullHeight = function () {
        if (!isMobile.any()) {
            jQuery('.js-fullheight').css('height', jQuery(window).height());
            jQuery(window).resize(function () {
                jQuery('.js-fullheight').css('height', jQuery(window).height());
            });
        }
    };
    // Animations
    var contentWayPoint = function () {
        var i = 0;
        jQuery('.animate-box').waypoint(function (direction) {
            if (direction === 'down' && !jQuery(this.element).hasClass('animated')) {
                i++;
                jQuery(this.element).addClass('item-animate');
                setTimeout(function () {
                    jQuery('body .animate-box.item-animate').each(function (k) {
                        var el = jQuery(this);
                        setTimeout(function () {
                            var effect = el.data('animate-effect');
                            if (effect === 'fadeIn') {
                                el.addClass('fadeIn animated');
                            }
                            else if (effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft animated');
                            }
                            else if (effect === 'fadeInRight') {
                                el.addClass('fadeInRight animated');
                            }
                            else {
                                el.addClass('fadeInUp animated');
                            }
                            el.removeClass('item-animate');
                        }, k * 200, 'easeInOutExpo');
                    });
                }, 100);
            }
        }, {
            offset: '85%'
        });
    };
    // Burger Menu 
    var burgerMenu = function () {
        jQuery('.js-doro-nav-toggle').on('click', function (event) {
            event.preventDefault();
            var jQuerythis = jQuery(this);
            if (jQuery('body').hasClass('offcanvas')) {
                jQuerythis.removeClass('active');
                jQuery('body').removeClass('offcanvas');
            }
            else {
                jQuerythis.addClass('active');
                jQuery('body').addClass('offcanvas');
            }
        });
    };
    // Click outside of offcanvass
    var mobileMenuOutsideClick = function () {
        jQuery(document).click(function (e) {
            var container = jQuery("#doro-aside, .js-doro-nav-toggle");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                if (jQuery('body').hasClass('offcanvas')) {
                    jQuery('body').removeClass('offcanvas');
                    jQuery('.js-doro-nav-toggle').removeClass('active');
                }
            }
        });
        jQuery(window).scroll(function () {
            if (jQuery('body').hasClass('offcanvas')) {
                jQuery('body').removeClass('offcanvas');
                jQuery('.js-doro-nav-toggle').removeClass('active');
            }
        });
    };
    // Sub Menu 
    jQuery('#doro-main-menu li.menu-item-has-children>a').on('click', function () {
        jQuery(this).removeAttr('href');
        var element = jQuery(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        }
        else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
    jQuery('#doro-main-menu>ul>li.menu-item-has-children>a').append('<span class="holder"></span>');
    // Slider
    var sliderMain = function () {
        jQuery('#doro-hero .flexslider').flexslider({
            animation: "fade"
            , slideshowSpeed: jQuery("#doro-hero .flexslider").data("slider-speed")
			//, slideshow: false
			, slideshow: jQuery("#doro-hero .flexslider").data("slider-slideshow")
            , directionNav: true
            , start: function () {
                setTimeout(function () {
                    jQuery('.slider-text').removeClass('animated fadeInUp');
                    jQuery('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
                }, 500);
            }
            , before: function () {
                setTimeout(function () {
                    jQuery('.slider-text').removeClass('animated fadeInUp');
                    jQuery('.flex-active-slide').find('.slider-text').addClass('animated fadeInUp');
                }, 500);
            }
        });
    };
    // Sticky 
    var stickyFunction = function () {
        var h = jQuery('.image-content').outerHeight();
        if (jQuery(window).width() <= 992) {
            jQuery("#sticky_item").trigger("sticky_kit:detach");
        }
        else {
            jQuery('.sticky-parent').removeClass('stick-detach');
            jQuery("#sticky_item").trigger("sticky_kit:detach");
            jQuery("#sticky_item").trigger("sticky_kit:unstick");
        }
        jQuery(window).resize(function () {
            var h = jQuery('.image-content').outerHeight();
            jQuery('.sticky-parent').css('height', h);
            if (jQuery(window).width() <= 992) {
                jQuery("#sticky_item").trigger("sticky_kit:detach");
            }
            else {
                jQuery('.sticky-parent').removeClass('stick-detach');
                jQuery("#sticky_item").trigger("sticky_kit:detach");
                jQuery("#sticky_item").trigger("sticky_kit:unstick");
                jQuery("#sticky_item").stick_in_parent();
            }
        });
        jQuery('.sticky-parent').css('height', h);
        jQuery("#sticky_item").stick_in_parent();
    };
    // Document on load.
    jQuery(function () {
        fullHeight();
        contentWayPoint();
        burgerMenu();
        mobileMenuOutsideClick();
        sliderMain();
        stickyFunction();
    });
}());