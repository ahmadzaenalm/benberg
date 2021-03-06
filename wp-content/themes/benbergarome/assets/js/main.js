;(function($, window, document, undefined) {
    "use strict";

    /*
     Template Name: Corpboot
     Template URI: http://www.templatespremium.net/corpboot/
     Description: Corporate HTML5 Template based on Twitter Bootstrap.
     Version: 2.1
     Author: Rafael Memmel
     Author URI: http://www.rafamemmel.com
     */
//===========================================================================================
//Get IE Version Function
//===========================================================================================
    function getInternetExplorerVersion() {
        var rv = -1;
        var ua = navigator.userAgent;
        var re = '';
        if (navigator.appName == 'Microsoft Internet Explorer') {
            re  = new RegExp('MSIE ([0-9]{1,}[\.0-9]{0,})');
            if (re.exec(ua) !== null) {
                rv = parseFloat(RegExp.$1);
            }
        } else if (navigator.appName == 'Netscape') {
            re = new RegExp('Trident/.*rv:([0-9]{1,}[\.0-9]{0,})');
            if (re.exec(ua) !== null) {
                rv = parseFloat(RegExp.$1);
            }
        }
        return rv;
    }

//Window and Document variables
    var $window = $(window);
    var $document = $(document);

//===========================================================================================
//Window Load Function
//===========================================================================================
    $window.on('load', function() {
        //---------------------------------------------------------------------------------------
        //Preloader
        //---------------------------------------------------------------------------------------
        var $preloader = $('#preloader');
        if ($preloader.length) {
            var ie = getInternetExplorerVersion();
            if (ie == '-1' || ie == '11') {
                //Good Browsers
                $preloader.fadeOut('slow', function() {
                    $(this).remove();
                });
                if(window.complete){
                    $window.trigger('load');
                }
            } else {
                //Older versions of Internet Explorer
                var myPreloader = document.querySelector('#preloader');
                myPreloader.style.display = 'none';
            }
        }
        $(".content-ready .container-fluid .row .col-md-12 h1").remove();
        $(".content-ready .container-fluid .row .col-md-12").append(
            "<p class='title-ready'>BénBérg Arôme</p><br><h1 class='title-white'>IF YOU HAVE QUESTIONS<br>FEEL FREE TO CONTACT US</h1><br><a href='/contact-us'><button class='btn-lg btn-ready btn-transparent'>Contact Us <span><li class='fa fa-chevron-right'></li></span></button></a>"
            
        );
    });

//===========================================================================================
//Document Ready Function
//===========================================================================================
    $document.on('ready', function() {
        //---------------------------------------------------------------------------------------
        //CSS Animations
        //---------------------------------------------------------------------------------------
        ie = getInternetExplorerVersion();
        if (ie == '-1' || ie == '11') {
            var wow = new WOW({
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       100,         // distance to the element when triggering the animation (default is 0)
                mobile: false             // trigger animations on mobile devices (true is default)
            });
            wow.init();
        }
        //---------------------------------------------------------------------------------------
        //Placeholder for IE old versions
        //---------------------------------------------------------------------------------------
        var ie = getInternetExplorerVersion();
        if (ie == '8' || ie == '9'  || ie == '10') {
            $('input, textarea').placeholder();
        }
        //---------------------------------------------------------------------------------------
        //Header Shrink
        //---------------------------------------------------------------------------------------


        if ($window.width() > 840) {
            $window.on('scroll', function() {
                if ($document.scrollTop() < 120) {
                    $('.navbar').removeClass('tiny');
                } else {
                    $('.navbar').addClass('tiny');
                }
            });
        }
        // media query event handler
        if (matchMedia) {
          const mq = window.matchMedia("(min-width: 370px)");
          mq.addListener(WidthChange);
          WidthChange(mq);
        }

        // media query change
        function WidthChange(mq) {
          if (mq.matches) {
            $window.on('scroll', function() {
                if ($document.scrollTop() < 120) {
                    $('.admin-bar .navbar').css('marginTop','33px');
                    $('.navbar2').css('display','block');
                    $('.navbar-fixed-top').css('top','3.66em');
                    $('.admin-bar .navbar-fixed-top').css('top','3.65em');

                    
                }if($document.scrollTop() >= 120){
                    $('.navbar2').css('marginTop','-50px');
                    $('.admin-bar .navbar').css('marginTop','-3px');
                    $('.navbar-fixed-top').css('top','0px');
                    $('.admin-bar .navbar-fixed-top').css('top','2.5em');
                    //$('.navbar2').css('display','none');

                }else {
                    $('.admin-bar .navbar').css('marginTop','32px');
                    $('.navbar2').css('marginTop','0px');
                    

                    
                    
                }
            });
          } 
          else {

            $('.navbar2').css('display','none');
            $('.navbar2').css('marginTop','-50px');
            $('.admin-bar .navbar').css('marginTop','4px');
            //$('.navbar-fixed-top').css('top','0px');
            $('.admin-bar .navbar-fixed-top').css('top','3.2em');
            
          }

        }
        if ($window.width() < 600) {
             $window.on('scroll', function() {
                if ($document.scrollTop() < 30) {
                   $('.navbar2').css('display','none');
                    $('.navbar2').css('marginTop','-50px');
                    $('.admin-bar .navbar').css('marginTop','4px');
                    $('.navbar-fixed-top').css('top','0px');
                    //$('.admin-bar .navbar-fixed-top').css('top','2.5em');
                }if($document.scrollTop() >= 30){
                    $('.navbar2').css('marginTop','-50px');
                    $('.admin-bar .navbar').css('marginTop','-3px');
                    $('.navbar-fixed-top').css('top','0em');
                    //$('.admin-bar .navbar-fixed-top').css('top','0em');
                    //$('.navbar2').css('display','none');

                }else{
                    $('.navbar-fixed-top').css('top','3em');
                }
            });

            
        }
        

        //---------------------------------------------------------------------------------------
        //Scroll to Top
        //---------------------------------------------------------------------------------------
        var $scrollToTop = $('#scrollToTop');
        if ($scrollToTop.length) {
            //Check to see if the window is top if not then display button
            $window.scroll(function(){
                if ($(this).scrollTop() > 800) {
                    $scrollToTop.fadeIn();
                } else {
                    $scrollToTop.fadeOut();
                }
            });
            //Click event to scroll to top
            $scrollToTop.on('click', function(){
                $('html, body').animate({scrollTop : 0},800);
                return false;
            });
        }
        //---------------------------------------------------------------------------------------
        //Parallax
        //---------------------------------------------------------------------------------------
        $window.stellar({
            horizontalScrolling: false,
            responsive: true/*,
             horizontalOffset: 0,
             verticalOffset: 0*/
        });
        //---------------------------------------------------------------------------------------
        //Flexslider
        //---------------------------------------------------------------------------------------
        var $bgSlider = $('#bg-slider');
        if ($bgSlider.length) {
            /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
            $bgSlider.flexslider({
                animation: "slide",
                slideshow: true,
                animationLoop: true,
                directionNav: false, //remove the default direction-nav
                controlNav: false, //remove the default control-nav
                slideshowSpeed: 6000
            });
        }
        var $mainSlider = $('#main-slider');
        if ($mainSlider.length) {
            /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
            $mainSlider.flexslider({
                animation: "fade",
                slideshow: true,
                animationLoop: true,
                directionNav: true, //remove the default direction-nav
                controlNav: true, //remove the default control-nav
                slideshowSpeed: 6000
            });
        }
        var $homeSlider = $('.home-promo');
        if ($homeSlider.length) {
            /* Ref: https://github.com/woothemes/FlexSlider/wiki/FlexSlider-Properties */
            $homeSlider.flexslider({
                animation: "slide",
                slideshow: true,
                animationLoop: true,
                directionNav: true, //remove the default direction-nav
                controlNav: true, //remove the default control-nav
                slideshowSpeed: 6000
            });
        }
        //---------------------------------------------------------------------------------------
        //Slick Carousel
        //---------------------------------------------------------------------------------------
        var $news = $('#news');
        if ($news.length) {
            $news.slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                dots: true,
                arrows: false,
                autoplaySpeed: 8000,
                pauseOnHover: true,
                responsive: [
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        var $clients = $('#clients');
        if ($clients.length) {
            $clients.each(function() {
                setCarousel($(this));
            });
        }
        function setCarousel(_this) {
            $($(_this)).slick({
                infinite: true,
                slidesToShow: $(_this).attr('data-slides'),
                slidesToScroll: 1,
                autoplay: Boolean($(_this).attr('data-autoplay')),
                autoplaySpeed: $(_this).attr('data-speed'),
                pauseOnHover: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }


        var $team = $('#team');
        if ($team.length) {
            $team.slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                dots: true,
                arrows: false,
                pauseOnHover: true
            });
        }

        //Slick Carousel for RTL layouts
        var $newsRtl = $('#news-rtl');
        if ($newsRtl.length) {
            $newsRtl.slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                dots: true,
                arrows: false,
                autoplaySpeed: 8000,
                pauseOnHover: true,
                rtl: true,
                responsive: [
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        var $clientsRtl = $('#clients-rtl');
        if ($clientsRtl.length) {
            $clientsRtl.slick({
                infinite: true,
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                pauseOnHover: true,
                rtl: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 4
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            arrows: false,
                            slidesToShow: 1
                        }
                    }
                ]
            });
        }
        var $teamRtl = $('#team-rtl');
        if ($teamRtl.length) {
            $teamRtl.slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 10000,
                dots: true,
                arrows: false,
                pauseOnHover: true,
                rtl: true
            });
        }
        //---------------------------------------------------------------------------------------
        //About Carousel
        //---------------------------------------------------------------------------------------
        var aboutCarouselClick = false;
        var $aboutCarousel = $('#aboutCarousel');
        var $navAboutCarouselA = $('#navAboutCarousel a');

        $aboutCarousel.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 10000,
            pauseOnHover: true,
            arrows: false,
            waitForAnimate: false,
            speed: 600,
            fade: true,
            centerPadding: 0
        }).on('beforeChange', function(e, slick, currentSlide, nextSlide){
            if(!aboutCarouselClick){
                $navAboutCarouselA.eq(nextSlide).trigger('click.bs');
            }
            else {
                aboutCarouselClick = false;
            }
        });

        $navAboutCarouselA.on('click.slick', function(e){
            aboutCarouselClick = true;
            var index = $(this).index('#navAboutCarousel a');
            $aboutCarousel.slick('slickGoTo', index);
            $(this).blur();
        });
        //---------------------------------------------------------------------------------------
        //Our history Carousel
        //---------------------------------------------------------------------------------------
        var historyCarouselClick = false;
        var $historyCarousel = $('#historyCarousel');
        var $navHistoryCarouselA = $('#navHistoryCarousel a');

        $historyCarousel.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            pauseOnHover: true,
            arrows: false,
            waitForAnimate: false,
            speed: 600,
            fade: true
        }).on('beforeChange', function(e, slick, currentSlide, nextSlide){
            if(!historyCarouselClick){
                $navHistoryCarouselA.eq(nextSlide).trigger('click.bs');
            }
            else {
                historyCarouselClick = false;
            }
        });
        $navHistoryCarouselA.on('click.slick', function(e){
            historyCarouselClick = true;
            var index = $(this).index('#navHistoryCarousel a');
            $historyCarousel.slick('slickGoTo', index);
            $(this).blur();
        });
        //---------------------------------------------------------------------------------------
        //About Carousel RTL
        //---------------------------------------------------------------------------------------
        var aboutCarouselClick = false;
        var $aboutCarouselRtl = $('#aboutCarousel-rtl');
        var $navAboutCarouselRtlA = $('#navAboutCarousel-rtl a');

        $aboutCarouselRtl.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 10000,
            pauseOnHover: true,
            arrows: false,
            waitForAnimate: false,
            speed: 600,
            fade: true,
            rtl: true,
            centerPadding: 0
        }).on('beforeChange', function(e, slick, currentSlide, nextSlide){
            if(!aboutCarouselClick){
                $navAboutCarouselRtlA.eq(nextSlide).trigger('click.bs');
            }
            else {
                aboutCarouselClick = false;
            }
        });

        $navAboutCarouselRtlA.on('click.slick', function(e){
            aboutCarouselClick = true;
            var index = $(this).index('#navAboutCarousel-rtl a');
            $aboutCarouselRtl.slick('slickGoTo', index);
            $(this).blur();
        });
        //---------------------------------------------------------------------------------------
        //Our history Carousel RTL
        //---------------------------------------------------------------------------------------
        var historyCarouselClick = false;
        var $historyCarouselRtl = $('#historyCarousel-rtl');
        var $navHistoryCarouselRtlA = $('#navHistoryCarousel-rtl a');

        $historyCarouselRtl.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            pauseOnHover: true,
            arrows: false,
            waitForAnimate: false,
            speed: 600,
            fade: true,
            rtl: true
        }).on('beforeChange', function(e, slick, currentSlide, nextSlide){
            if(!historyCarouselClick){
                $navHistoryCarouselRtlA.eq(nextSlide).trigger('click.bs');
            }
            else {
                historyCarouselClick = false;
            }
        });
        $navHistoryCarouselRtlA.on('click.slick', function(e){
            historyCarouselClick = true;
            var index = $(this).index('#navHistoryCarousel-rtl a');
            $historyCarouselRtl.slick('slickGoTo', index);
            $(this).blur();
        });
        //---------------------------------------------------------------------------------------
        //Vanillabox
        //---------------------------------------------------------------------------------------
        /* Ref: http://cocopon.me/app/vanillabox/demo.html */
        // Array of Vanillabox instances

        var boxes = [];
        var $gallery = $('.gallery');
        var $lightbox = $('.lightbox');
        var $webpage = $('.webpage');

        if (($gallery.length)) {
            boxes.push($gallery.vanillabox({
                closeButton: true,
                keyboard: true
            }));
        }

        if (($lightbox.length)) {
            boxes.push($lightbox.vanillabox({
                closeButton: true,
                keyboard: true
            }));
        }

        if (($webpage.length)) {
            boxes.push($webpage.vanillabox({
                type: 'iframe',
                closeButton: true,
                keyboard: true
            }));
        }

        $window.on('scroll', function(){
            var $vnbxFrame = $('.vnbx-frame');
            if (($vnbxFrame.length)) {
                $vnbxFrame.css('top', ( $window.height() - $vnbxFrame.height() ) / 3.2+$window.scrollTop() + 'px');
            }
        });

        $document.on('click', '.vnbx-mask', function() {
            boxes.forEach(function(box) {
                box.hide();
            });
        });
        //---------------------------------------------------------------------------------------
        //Video
        //---------------------------------------------------------------------------------------
        var $iframe = $('iframe');
        if ($iframe.length) {
            $iframe.each(function(){
                var ifr_source = $(this).attr('src');
                var wmode = '?wmode=transparent';
                $(this).attr('src',ifr_source+wmode);
            });
        }

        //---------------------------------------------------------------------------------------
        //Counter Up
        //---------------------------------------------------------------------------------------
        var $count = $('.count');
        if ($count.length) {
            var countFlag = false;
            $window.scroll(function(){
                var counterOffset = $('.counterUp').offset().top - 500;
                if ($(this).scrollTop() > counterOffset) {
                    if(!countFlag) {
                        countFlag = true;
                        $count.each(function () {
                            $(this).prop('Counter',0).animate({
                                Counter: $(this).text()
                            }, {
                                duration: 3000,
                                easing: 'swing',
                                step: function (now) {
                                    $(this).text(Math.ceil(now));
                                }
                            });
                        });
                    }
                }
            });
        }
        //---------------------------------------------------------------------------------------
        //Portfolio
        //---------------------------------------------------------------------------------------
        var $grid = $('#grid');
        if ($grid.length) {
            $grid.mixitup();
        }
        //---------------------------------------------------------------------------------------
        //Select
        //---------------------------------------------------------------------------------------
        var $selectpicker = $('.selectpicker');
        if ($selectpicker.length) {
            $selectpicker.selectpicker({
                style: 'selectcorp'
            });
        }
        //---------------------------------------------------------------------------------------
        //Contact Form
        //---------------------------------------------------------------------------------------
        $('#contactform').on('submit', function() {
            if (!$(this).validate($('#alertform'))) {
                return false;
            }
        });

        $(".post_content").fitVids();

        //---------------------------------------------------------------------------------------
        //Bootstrap Tooltip
        //---------------------------------------------------------------------------------------
        $('[data-toggle="tooltip"]').tooltip();

        //---------------------------------------------------------------------------------------
        //Background image
        //---------------------------------------------------------------------------------------
        function bgImage() {
            var sBackSwitch = $('.s-back-switch');

            for (var i = 0; i < sBackSwitch.length; i++ ) {

                var $img = $(sBackSwitch[i]).find('.s-img-switch');
                var $imgSrc =  $img.attr('src');
                var $imgDataHidden =  $img.data('s-hidden');
                $(sBackSwitch[i]).css('background-image' , 'url(' + $imgSrc + ')');
                if($imgDataHidden){
                    $img.css('visibility', 'hidden');
                }
                else{
                    $img.hide();
                }
            }
        }

        bgImage();
    });

})(jQuery, window, document);
