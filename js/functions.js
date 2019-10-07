var parallaxInit = false;
//document.getElementById("video-lunch").width=document.body.offsetWidth;
(function ($, window, document, undefined) {
    
    

    // #### PORTFOLIO ####

    var gridContainer = $('#grid-container'),
        filtersContainer = $('#filters-container');

    // init cubeportfolio
    gridContainer.cubeportfolio({
        defaultFilter: '*',
        animationType: 'rotateSides',
        gapHorizontal: 25,
        gapVertical: 25,
        gridAdjustment: 'responsive',
        caption: 'overlayBottomReveal',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxShowCounter: true,

        // singlePage popup
        singlePageDelegate: '.cbp-singlePage',
        singlePageDeeplinking: true,
        singlePageStickyNavigation: true,
        singlePageShowCounter: true,
        singlePageCallback: function (url, element) {

            // to update singlePage content use the following method: this.updateSinglePage(yourContent)
            var t = this;

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                timeout: 5000
            })
            .done(function(result) {
                t.updateSinglePage(result);
            })
            .fail(function() {
                t.updateSinglePage("Error! Please refresh the page!");
            });

        },

        // single page inline
        singlePageInlineDelegate: '.cbp-singlePageInline',
        singlePageInlinePosition: 'above',
        singlePageInlineShowCounter: false,
        singlePageInlineInFocus: true,
        singlePageInlineCallback: function(url, element) {
            // to update singlePage Inline content use the following method: this.updateSinglePageInline(yourContent)
        }
    });

    // add listener for filters click
    filtersContainer.on('click', '.cbp-filter-item', function (e) {

        var me = $(this), wrap;

        // get cubeportfolio data and check if is still animating (reposition) the items.
        if ( !$.data(gridContainer[0], 'cubeportfolio').isAnimating ) {

            if ( filtersContainer.hasClass('cbp-l-filters-dropdown') ) {
                wrap = $('.cbp-l-filters-dropdownWrap');

                wrap.find('.cbp-filter-item').removeClass('cbp-filter-item-active');

                wrap.find('.cbp-l-filters-dropdownHeader').text(me.text());

                me.addClass('cbp-filter-item-active');
            } else {
                me.addClass('cbp-filter-item-active').siblings().removeClass('cbp-filter-item-active');
            }

        }

        // filter the items
        gridContainer.cubeportfolio('filter', me.data('filter'), function () {});

    });

    // activate counters
    gridContainer.cubeportfolio('showCounter', filtersContainer.find('.cbp-filter-item'));


    // add listener for load more click
    $('.load-more-link').on('click', function(e) {

        e.preventDefault();

        var clicks, me = $(this), oMsg;

        if (me.hasClass('cbp-l-loadMore-button-stop')) return;

        // get the number of times the loadMore link has been clicked
        clicks = $.data(this, 'numberOfClicks');
        clicks = (clicks)? ++clicks : 1;
        $.data(this, 'numberOfClicks', clicks);

        // set loading status
        oMsg = me.text();
        me.text('Loading...');

        // perform ajax request
        $.ajax({
            url: me.attr('href'),
            type: 'GET',
            dataType: 'HTML'
        })
            .done( function (result) {
                var items, itemsNext;

                // find current container
                items = $(result).filter( function () {
                    return $(this).is('div' + '.loadMore-block' + clicks);
                });

                gridContainer.cubeportfolio('appendItems', items.html(),
                    function () {
                        // put the original message back
                        me.text(oMsg);

                        // check if we have more works
                        itemsNext = $(result).filter( function () {
                            return $(this).is('div' + '.loadMore-block' + (clicks + 1));
                        });

                        if (itemsNext.length === 0) {
                            me.text('NO MORE WORKS');
                            me.addClass('cbp-l-loadMore-button-stop');
                        }

                    });

            })
            .fail(function() {
                // error
            });

    });



})(jQuery, window, document);

$(function(){
    // #### COUNTERS ####
    $('.counter').counterUp({
        delay: 10,
        time: 800
    });

    // #### Liquid Slider - quote slider ####
    $('#quotes-slider').liquidSlider({
        autoSlide: true,
        autoSlideDirection: 'right',
        autoSlideInterval:  5000,
        autoSlideControls:  true,
        forceAutoSlide: true,
        autoHeight: false,
        dynamicArrows: true,
        slideEaseFunction:'animate.css',
        slideEaseDuration:500,
        heightEaseDuration:500,
        animateIn:"flipInX",
        animateOut:"fadeOut",
        callback: function() {
            var self = this;
            $('.slider-6-panel').each(function() {
                $(this).removeClass('animated ' + self.options.animateIn);
            });
        }
    });

    $('#slider-home').liquidSlider({
        autoSlide: true,
        autoSlideInterval:  4500,
        autoSlideControls:  true,
        forceAutoSlide: true,
        dynamicTabs:false,
        dynamicArrows: false,
        slideEaseFunction:'animate.css',
        slideEaseDuration:900,
        heightEaseDuration:900,
        animateIn:"bounceIn",
        animateOut:"bounceOut",
        callback: function() {}
    })

    var slider_ver2 = '#slider-home-ver2';
    var slidesCount = $(slider_ver2).children().length;
    var pointsBlock = $('<div class="navigation"></div>');
    var points = $([]), point;
    for(var i = 0; i< slidesCount; i++){
        point = $('<span class="point" />');
        if(i == 0) point.addClass('active');
        points = points.add(point);
    }
    pointsBlock.append(points);
    $('.slider-home-block').append(pointsBlock);
    $(slider_ver2).liquidSlider({
        autoSlide: true,
        autoSlideInterval:  4500,
        pauseOnHover:true,
        autoSlideControls:  false,
        forceAutoSlide: false,
        dynamicArrows: true,
        dynamicTabs:false,
        slideEaseFunction:'animate.css',
        slideEaseDuration:900,
        heightEaseDuration:900,
        animateIn:"bounceIn",
        animateOut:"bounceOut",
        crosslinks:false,
        callback: function() {
            var i = $(slider_ver2).find('.panel').index('.currentPanel');
            points.removeClass('active');
            points.eq(i).addClass('active');
        }
    })
    points.each(function(){
        var i = points.index($(this));
        $(this).on('click', function(){
            var sliderApi = $.data( $(slider_ver2)[0], 'liquidSlider');
            sliderApi.setNextPanel(i);
            sliderApi.updateClass($(this));
        })

    })
    pointsBlock.hover(function(){
        var sliderApi = $.data( $(slider_ver2)[0], 'liquidSlider');
        sliderApi.stopAutoSlide();
    }, function(){
        var sliderApi = $.data( $(slider_ver2)[0], 'liquidSlider');
        sliderApi.startAutoSlide();
    })






    // #### Sticky Navbar ####
    $(".navbar").sticky({topSpacing:0});


    // #### Skill Bars ####
    $('.progressbars-block').waypoint(function() {
        $('.skillbar').each(function(){
            $(this).find('.skillbar-bar').animate({
                width:jQuery(this).attr('data-percent')
            },2000);
        });
    }, {
        offset: '80%'
    });

    $('.chart').each(function(){
        var cur = $(this);
        cur.waypoint(function() {
            if(!cur.hasClass('waypoint')){
                cur.addClass('waypoint');
                pieChart(cur);
            }
        }, {
            offset: '100%'
        })
    })



    // #### Smooth Scroll To Anchor ####
    $('#main-nav a, .move-link').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - $('#header').height()
        }, 1000);
        event.preventDefault();
    });

    var sections = $('section'),
        header = $('#header'),
        nav = $('#main-nav');

    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();
        //console.log(cur_pos);
        $('#video-lunch').css({ top: cur_pos + 'px' });
        sections.each(function() {
            var top = Math.floor($(this).offset().top) - header.height(),
                bottom = top + $(this).outerHeight();
            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('li').removeClass('active');
                sections.removeClass('current');

                $(this).addClass('current');
                nav.find('a[href="#'+$(this).attr('id')+'"]').closest('li').addClass('active');
            }
        });
    });



    // #### WOW plugin triggers animation.css on scroll ####
    var wow = new WOW(
        {
            boxClass:     'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset:       100,          // distance to the element when triggering the animation (default is 0)
            mobile:       false        // trigger animations on mobile devices (true is default)
        }
    );
    wow.init();

    // #### Parallax ####
    parallax();
    var windowW = $(window).width();
    $(window).on('resize', function(){
        if($(window).width() != windowW) parallax();
    })


    // #### roll up map ####
    var upBtnText = ['Roll up', 'Show map'];
    var status = 1;
    $('#up').text(upBtnText[status]);
    $('#up').on('click', function(e){
        e.preventDefault();
        status = !status ? 1 : 0;
        $(this).text(upBtnText[status]);
        $('.map-block').toggleClass('active');
    })

    // #### Grayscale images ####
    $('.logo-block .logo').each(function(){
        var cur = $(this);
        var img = cur.find('img');
        img.addClass('colored');
        var src = img.attr('src');
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var imgObj = new Image();
        imgObj.src = src;
        imgObj.onload = function(){
            canvas.width = imgObj.width;
            canvas.height = imgObj.height;
            ctx.drawImage(imgObj, 0, 0);
            var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
            for(var y = 0; y < imgPixels.height; y++){
                for(var x = 0; x < imgPixels.width; x++){
                    var i = (y * 4) * imgPixels.width + x * 4;
                    var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
                    imgPixels.data[i] = avg;
                    imgPixels.data[i + 1] = avg;
                    imgPixels.data[i + 2] = avg;
                }
            }
            ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
            var greyscaleImg = $('<img src="' + canvas.toDataURL() + '" class="img-responsive" alt="" />').addClass('greyscale');
            img.hide();
            img.after(greyscaleImg);
            $(canvas).remove();

            cur.on('mouseover', function(){
                img.show();
            }).on('mouseleave', function(){
                img.hide();
            })

        }



    })

    $(".word-rotate").each(function() {

        var $this = $(this),
            itemsWrapper = $(this).find(".word-rotate-items"),
            items = itemsWrapper.find("> span"),
            firstItem = items.eq(0),
            itemHeight = 0,
            currentItem = 1,
            currentTop = 0;

        itemHeight = 2 * firstItem.height();
        $this.css('margin', -itemHeight/4 + 'px 0');
        items.css({
            'height': itemHeight + 'px',
            'line-height': itemHeight + 'px'
        });
        var firstItemClone = firstItem.clone();
        itemsWrapper.append(firstItemClone);

        $this
            .height(itemHeight)
            .addClass("active");

        setInterval(function() {


            currentTop = (currentItem * itemHeight);

            itemsWrapper.animate({
                top: -(currentTop) + "px"
            }, 300, "easeOutQuad", function(){
                currentItem++;

                if(currentItem > items.length) {
                    itemsWrapper.css("top", 0);
                    currentItem = 1;

                }
            })

        }, 2000);

    });
})

function parallax(){
    if(window.innerWidth < 768){
        if(parallaxInit){
            $(window).stellar('destroy');
        }
        parallaxInit = false;
    } else {
        if(parallaxInit){
            $(window).stellar('refresh');
        } else {
            $(window).stellar({
                horizontalScrolling: false,
                responsive:false,
                parallaxElements: false
            });
        }
        parallaxInit = true;
    }
}

map();
function map(){
    google.load('maps', '3', {
        other_params: 'sensor=false'
    });
    google.setOnLoadCallback(map_initialize);
}

function map_initialize() {
    //var myMarker = new google.maps.LatLng(32.83823,-96.775347);
    var myMarker = new google.maps.LatLng(33.976429,-84.478226);

    if($('#map').length) {

        /* may be changed */
        var mapStyle = [{"featureType":"water",
                        "stylers":[{"color":"#46bcec"},
                        {"visibility":"on"}]},
                        {"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},
                        {"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},
                        {"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},
                        {"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},
                        {"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},
                        {"featureType":"transit","stylers":[{"visibility":"off"}]},
                        {"featureType":"poi","stylers":[{"visibility":"off"}]}]

        map = new google.maps.Map( document.getElementById('map'), {
            zoom: 14,
            scrollwheel: false,
            disableDoubleClickZoom: true,
            center: myMarker,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: mapStyle
        });
        var marker1 = new google.maps.Marker({
            position: myMarker,
            map: map,
            icon:'http://anyvue.co/wp-content/themes/anyvue/images/map_marker.png'
        });
        google.maps.event.addDomListener(window, 'resize', function() {
            map.setCenter(myMarker);
        });
    }

}

$(window).on('load', function(){
    $('#load').addClass('hidden');
})

function pieChart(cur){
    cur.html('<span></span>');
    var style = cur.data('style');
    var size = cur.data('size');
    var color = cur.data('color');
    if(style == '1'){
        var props = {
            barColor: color,
            trackColor: '#cae9f1',
            lineCap: 'butt',
            lineWidth: 30,
            size: size,
            animate: 2000,
            scaleColor: false
        }
    } else {
        var props = {
            barColor: color,
            trackColor: '#f2f2f2',
            lineCap: 'butt',
            lineWidth: 58,
            size: size,
            animate: 2000,
            scaleColor: false
        }
    }
    cur.easyPieChart(props);
}