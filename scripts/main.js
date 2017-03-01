(function ($) {

    //activeFilters = jQuery.deparam.querystring();


    // DOM Ready

    $(document).ready(function () {

        // Filter Helpers

        // var addFilter, addCheckboxes, parseFilter, sendpJaxRequest, getUnique;

        // getUnique = function (arr) {
        //     var u = {},
        //   a = [];

        //     for (var i = 0, l = arr.length; i < l; ++i) {
        //         if (u.hasOwnProperty(arr[i])) {
        //             continue;
        //         }
        //         a.push(arr[i]);
        //         u[arr[i]] = 1;
        //     }

        //     return a;
        // };

        // addFilter = function (element) {
        //     var filter = element.attr('data-filter');
        //     activeFilters[filter] = [];

        //     $.map($("[data-filter=" + filter + "][data-active=true]"), function (e, i) {
        //         activeFilters[filter].push($(e).attr('data-value'));
        //     });

        //     activeFilters[filter] = getUnique(activeFilters[filter]);
        // };

        // parseFilters = function (element) {
        //     var filter = element.attr('data-filter');

        //     if (element.attr('data-active') === 'true') {
        //         element.attr('data-active', false);
        //     } else {
        //         $("[data-filter=" + filter + "][data-active=true]").attr('data-active', false);
        //         element.attr('data-active', true);
        //     }

        //     addFilter(element);
        // };

        // buildpJaxRequest = function (href) {
        //     var hash = href.split('#')[1] || '';
        //     hash = hash.length > 0 ? '#' + hash : '';
        //     var filters = $.param(activeFilters);
        //     url = href.split('?')[0];
        //     return url + "?" + filters + hash;
        // };

        // sendpJaxRequest = function (href, container, resetFilters) {
        //     if (resetFilters) {
        //         var params = (href.split('?')[1] || '').split('#')[0];
        //         activeFilters = $.deparam(params);
        //     }

        //     if ($.support.pjax) {
        //         $.pjax({
        //             url: buildpJaxRequest(href),
        //             container: container
        //         });
        //     } else {
        //         window.location.href = buildpJaxRequest(href);
        //     }
        // };


        // PJax Events

        // if ($.support.pjax) {
        //     $.pjax.defaults.scrollTo = false;

        //     $(document).on('pjax:end', function () {
        //         $window.trigger('resize');

        //         setTimeout(function () {
        //             $window.trigger('resize');
        //         }, 500);
        //     });

        //     $(document).on('pjax:complete', function () {
        //         activeFilters = jQuery.deparam.querystring();
        //     });
        // }


        // // Pjax Search

        // $(document).on('click', '[data-pjax-search]', function (event) {
        //     event.preventDefault();
        //     activeFilters['q'] = $('.pjaxSearch').val();
        //     parseFilters($(this));
        //     sendpJaxRequest(window.location.href, '[data-pjax-container]', false);
        // });


        // // Filter System Events

        // $(document).on('click', '[data-filter]', function (event) {
        //     event.preventDefault();

        //     if (!$(this).hasClass('checkbox')) {
        //         parseFilters($(this));
        //     }
        // });

        // $(document).on('click', '[data-trigger-pjax]', function (event) {
        //     event.preventDefault();
        //     sendpJaxRequest(window.location.href, '[data-pjax-container]', false);
        // });

        // $(document).on('click', '[data-url][data-pjax]', function (event) {
        //     var container = $(this).attr('data-pjax');
        //     event.preventDefault();
        //     sendpJaxRequest($(this).attr('data-url'), '[data-pjax-container=' + container + ']', true);
        // });

        // $(document).on('click', 'a[data-pjax]', function (event) {
        //     event.preventDefault();
        //     sendpJaxRequest($(this).attr('href'), '[data-pjax-container=""]', true);
        // });


        // Mobile Nav

        $('#phone-nav-open').on('click', function () {
            $('#phone-search-close').trigger('click');
            $('#phone-nav-open').hide();
            $('#phone-nav-close').show();
            $('nav').fadeIn(500);
        });

        $('#phone-nav-close').on('click', function () {
            $('#phone-nav-close').hide();
            $('#phone-nav-open').show();
            $('nav').fadeOut(500);
        });


        // Mobile Search

        $('#phone-search-open').on('click', function () {
            $('#phone-nav-close').trigger('click');
            $('#phone-search-open').hide();
            $('#phone-search-close').show();
            $('#mobile-search-form').fadeIn(500);
        });

        $('#phone-search-close').on('click', function () {
            $('#phone-search-close').hide();
            $('#phone-search-open').show();
            $('#mobile-search-form').fadeOut(500);
        });


        // Parallax Resizing

        var $window = $(window);
        var windowWidth, windowHeight;
        var navFixed = false;

        function resizeParallax() {
            navFixed = $('#fixed-navbar-padding').is(':visible');
            windowWidth = $window.width();
            windowHeight = $window.height();

            var parallax1Height = windowHeight - 120;
            var parallax23Height = navFixed ? windowHeight - 120 : windowHeight;

            $('#parallax-1').height(parallax1Height);
            $('#parallax-2, #parallax-3').height(parallax23Height);

            $('.parallax-bg').each(function () {
                var $this = $(this);
                var aspect = $this.width() / $this.height();
                var parallaxHeight = $this.parent().height();

                if ((windowWidth / parallaxHeight) <= aspect) {
                    $this.css('top', 0).removeClass('aspect-width').addClass('aspect-height');
                    $this.css('left', (windowWidth - $this.width()) / 2);
                } else {
                    $this.css('left', 0).removeClass('aspect-height').addClass('aspect-width');
                }
            });

            $('#horizontal-parallax').css('left', -currentSlide * windowWidth);
            $('.hp-slide').width(windowWidth);

            // $('#parallax-people').css('display', windowHeight > 669 ? 'block' : 'none');
        }


        if ($('#parallax-1').length) {
            resizeParallax();
            window.setTimeout(resizeParallax, 500);
            $window.on('resize', resizeParallax);

            var mySkrollr = skrollr.init({
                forceHeight: false
            });

            skrollr.menu.init(mySkrollr, {
                animate: true,
                duration: 1000,
                easing: 'swing',
                relative: function () {
                    return $('#fixed-navbar-padding').is(':visible') ? -120 : 0;
                }
            });
        }


        /* Horizontal Parallax */

        var currentSlide = 0;
        var nextButton = $('#hp-next');
        var prevButton = $('#hp-prev');

        $('#hp-next').on('click', function () {
            var prevSlide = currentSlide;
            currentSlide = currentSlide + 1;

            if (currentSlide == 3) {
                nextButton.hide();
            } else {
                prevButton.show();
            }

            $('#horizontal-parallax').iAnimate('left', -currentSlide * windowWidth, 1500);
            $('#hp-sky').iAnimate('left', '-=150', 1500);
            $('#hp-' + prevSlide + '-bg, #hp-' + currentSlide + '-bg').iAnimate('left', '-=200', 1500);
            $('#hp-' + prevSlide + '-fg, #hp-' + currentSlide + '-fg').iAnimate('left', '-=750', 1500);
        });


        $('#hp-prev').on('click', function () {
            var prevSlide = currentSlide;
            currentSlide = currentSlide - 1;

            if (currentSlide === 0) {
                prevButton.hide();
            } else {
                nextButton.show();
            }

            $('#horizontal-parallax').iAnimate('left', -currentSlide * windowWidth, 1500);
            $('#hp-sky').iAnimate('left', '+=150', 1500);
            $('#hp-' + prevSlide + '-bg, #hp-' + currentSlide + '-bg').iAnimate('left', '+=200', 1500);
            $('#hp-' + prevSlide + '-fg, #hp-' + currentSlide + '-fg').iAnimate('left', '+=750', 1500);
        });


        /* Home Page Button Slides */

        $('#home-buttons .home-button').on('click', function () {
            var $this = $(this);
            var slide = $this.data('slide');

            $('.text-slide.active').removeClass('active').fadeOut(250, function () {
                $(slide).fadeIn(250).addClass('active');
            });

            $('#home-buttons .home-button').not($this).removeClass('active');
            $this.addClass('active');
        });


        $('#home-buttons-mobile .home-button').on('click', function () {
            var $this = $(this);
            var slide = $this.data('slide');

            $('.mobile-slide.active').removeClass('active').fadeOut(250, function () {
                $(slide).fadeIn(250).addClass('active');
            });

            $('#home-buttons-mobile .home-button').not($this).removeClass('active');
            $this.addClass('active');
        });


        /* Handle Box Nav Border Hiding */

        $('.box-nav-item.active').prev().find('.box-border-wrap').addClass('no-bg');

        $(document).on('mouseenter', '.box-nav-item', function () {
            $(this).not('.active').prev().find('.box-border-wrap').addClass('no-bg');
        }).on('mouseleave', '.box-nav-item', function () {
            $(this).not('.active').prev().find('.box-border-wrap').removeClass('no-bg');
        });


        /* Mobile Nav Toggle */

        $(document).on('click', '.mobile-box-nav-item', function () {
            var $this = $(this);
            var id = $this.data('nav');

            if ($this.hasClass('active')) {
                $this.removeClass('active');
                $(id).fadeOut(500);
            } else {
                $this.addClass('active');
                $('.mobile-box-nav-item').not(this).removeClass('active');
                $(id).fadeIn(500);
                $('.mobile-box-nav-options').not(id).fadeOut(500);
            }
        });


        $(document).on('click', '.mobile-box-nav-option, .mobile-box-nav-options .done-button', function () {
            $(this).parent().hide();
        });


        /* Filter Nav Toggle */

        $(document).on('mouseenter', '.filter-menu', function () {
            $(this).children('.filter-options').show();
        }).on('mouseleave', '.filter-menu', function () {
            $(this).children('.filter-options').hide();
        });

        $(document).on('click', '.filter-menu .filter-option', function () {
            $(this).parent().hide();
        });

        $(document).on('click', '.filter-menu .done-button', function () {
            $(this).parent().parent().hide();
        });


        /* Bio Toggle */

        $('.bio-copy').each(function (i, e) {
            var bioLength;
            var $copy = $(e);
            if ($copy.find('.bio-container').length > 0) {
                bioLength = $($copy.find('.bio-container')[0]).height();
            }
            var $toggle = $copy.siblings('.bio-toggle');

            if (bioLength > 260) {
                $copy.height(260);
                $toggle.show();
            } else {
                $toggle.hide();
            }

            $toggle.on('click', function () {
                $toggle.toggleClass('active');

                if ($copy.height() == 260) {
                    var oldHeight = $copy.height();
                    var bioHeight = $copy.height('auto').height();

                    $copy.height(oldHeight);
                    $copy.animate({
                        height: bioHeight
                    }, 700);
                } else {
                    $copy.animate({
                        height: 260
                    }, 700);
                }
            });

        });


        /* Portfolio Checkboxes */

        $(document).on('click', '.checkbox-options .checkbox', function () {
            var id = $(this).data('value');
            var $this = $('.checkbox-' + id);
            var filters = [];

            if (id == 'all' && !$this.hasClass('active')) {
                $('.checkbox').not($this).addClass('active');
            }

            if (id == 'all' && $this.hasClass('active')) {
                $('.checkbox').not($this).removeClass('active');
                $('.checkbox-current, .checkbox-public, .checkbox-private').addClass('active');
            }
            
            if (id != 'all' && $('.checkbox-all').hasClass('active')) {
                $('.checkbox-all').removeClass('active');
            }

            if (id == 'current' && $this.hasClass('active')) {
                $('.checkbox-public, .checkbox-private').removeClass('active');
            } else if (id == 'current') {
                $('.checkbox-public, .checkbox-private').addClass('active');
                $('.checkbox-prior').removeClass('active');
            }

            if (id == 'prior' && !$this.hasClass('active')) {
                $('.checkbox').not($this).removeClass('active');
            }

            $this.toggleClass('active');

            $.map($('.checkbox'), function (e, i) {
                var el = $(e);
                el.attr('data-active', el.hasClass('active'));
            });

            $.map($('.checkbox[data-active=true]'), function (e, i) {
                filters.push($(e).attr('data-value'));
            });

            filters = getUnique(filters);
            activeFilters[$($this[0]).attr('data-filter')] = filters;
        });


        $(document).on('click', '.mobile-box-nav-options .done-button', function () {
            $('.mobile-box-nav-item.active').trigger('click');
        });


        /* Press Page */

        if ($('.infiniteScroll').length > 0) {
            $('.infinite-scroll').jscroll({
                loadingHtml: 'Loading...',
                padding: 20,
                nextSelector: 'a.jscroll-next:last'
            });
        }


        /* Press Detail Body Mobile Toggle */

        var $copy = $('.press-body');
        var $toggle = $('.press-toggle');

        var bodyLength = $copy.text().length;

        if (bodyLength > 400) {
            $copy.height(260);
            $toggle.show();
        } else {
            $toggle.hide();
        }

        $toggle.on('click', function () {
            $toggle.toggleClass('active');

            if ($copy.height() == 260) {
                var oldHeight = $copy.height();
                var bodyHeight = $copy.height('auto').height();

                $copy.height(oldHeight);
                $copy.animate({
                    height: bodyHeight
                }, 700);
            } else {
                $copy.animate({
                    height: 260
                }, 700);
            }
        });


        /* Office Map */

        if ($('#google-map').length) {

            var markers = [];
            var element = $('#google-map')[0];
            var center = new google.maps.LatLng(Number(29), Number(-8));

            var mapStyles = [
				{
				    featureType: "poi", //points of interest
				    stylers: [
                        { "background": "003366" },
						{ "hue": "003366" },
						{ "color": "003366" },
						{ "visibility": "off" },
						{ "overflow": "hidden" }
                    ]
				}
            ];

            var mapOptions = {
                center: center,
                zoom: 2,
                size: 50,
                //center: new google.maps.LatLng(52.709675, 4.892575),
                panControl: false,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false,
                scrollwheel: false,
                styles: mapStyles,
                mapTypeId: google.maps.MapTypeId.TERRAIN
            };

            var map = new google.maps.Map(element, mapOptions);

            var infowindow = new InfoBubble({
                hideCloseButton: true,

                tabClassName: 'infobubble_tab'
            });

            $.each(locations, function (i, e) {
                markers[i] = new google.maps.Marker({
                    position: new google.maps.LatLng(e.lat, e.lon),
                    map: map,
                    icon: '/assets/img/location_marker.png',
                    visible: e.zoomLevel == 'low' ? true : false
                });

                google.maps.event.addListener(markers[i], 'mouseout', function () {
                    $('#map-popup').hide();
                });

                google.maps.event.addListener(markers[i], 'mouseover', function () {
                    $('#map-popup').html(locations[i].label).show();
                });

                google.maps.event.addListener(markers[i], 'click', function () {
                    /*$('#map-popup').html(locations[i].label).show();
                    });
                    */
                    //google.maps.event.addListener(markers[i], 'click', function() {
                    if (infowindow.b.length > 0) {
                        for (var a = infowindow.b.length; a >= 0; a--) {
                            infowindow.removeTab(a);
                        }
                    }

                    var loc = locations[i];
                    var zoomLocCount = 0;

                    if (loc.url == 'zoom') {
                        for (var x = 0; x < locations.length; x++) {
                            var html;

                            if (locations[x].zoomLevel == "high" && loc.label.indexOf(locations[x].label) > -1) {
                                if (html != undefined) {
                                    html += '<hr>';
                                } else {
                                    html = '';
                                }

                                html += '<div id="map-POI"><span style="font-size:14px; text-transform:uppercase;">' + locations[x].label + '</span><br/>' + locations[x].address;
                                if (locations[x].phone != '') html += '<br/>t: ' + locations[x].phone;
                                if (locations[x].fax != '') html += '<br/>f: ' + locations[x].fax;
                                //location link
                                html += '<br/><img src="/assets/img/location_google2.png"/> <a target="_blank" href="http://maps.google.com/maps?f=d&hl=en&geocode=&daddr=' + locations[x].address.replace(/(<([^>]+)>)/ig, "") + '&ie=UTF8"> Get Directions</a>';
                                //directions link
                                html += '<br/><a href="/people/?l%5B%5D=' + locations[x].id + '"><strong>Meet the ' + locations[x].label + ' Team ></strong></a>';
                                html += '</div>';

                                //infowindow.setContent(html);
                                //infowindow.addTab('<span style="color:#ffffff;">' + locations[x].label + '</span>', html);
                            }
                        }

                        //infowindow.open(map, markers[i]);
                        //infowindow.setBorderRadius('0');
                        //infowindow.setBackgroundColor('#003366');
                        //infowindow.setPadding('15');

                        html += '<img src="/assets/img/close-info.png" id="close-info"/>';
                        $('#map-box #map-info').html(html);
                        $('#map-box #map-info').addClass('show');

                        //old code to zoom in
                        /*var center = new google.maps.LatLng(Number(loc.lat), Number(loc.lon));
                        map.setCenter(center);
                        map.setZoom(8);*/
                    } else {
                        var html = '<div id="map-POI"><span style="text-transform:uppercase;">' + loc.label + '</span><br/>' + loc.address;

                        if (loc.phone != '') html += '<br/>t: ' + loc.phone;

                        if (loc.fax != '') html += '<br/>f: ' + loc.fax;
                        //location link
                        html += '<br/><img src="/assets/img/location_google2.png"/><a target="_blank" href="http://maps.google.com/maps?f=d&hl=en&geocode=&daddr=' + loc.address.replace(/(<([^>]+)>)/ig, "") + '&ie=UTF8"> Get Directions</a>';
                        //directions link
                        html += '<br/><a href="/people/?l[]=' + loc.id + '"><strong>Meet the ' + loc.label + ' Team ></strong></a>';
                        html += '</div>';

                        html += '<img src="/assets/img/close-info.png" id="close-info"/>';
                        $('#map-box #map-info').html(html);
                        $('#map-box #map-info').addClass('show');

                        //infowindow.setContent(html);
                        //infowindow.open(map, markers[i]);

                        //infowindow.setBorderRadius('0');
                        //infowindow.setBackgroundColor('#003366');
                        //infowindow.setPadding('15');				
                    }

                    $('#map-box #map-info #close-info').on('click', function () {
                        $('#map-box #map-info').removeClass('show');
                    });
                });
            });

            google.maps.event.addListener(map, 'zoom_changed', function () {
                var currentZoom = map.getZoom();

                $.each(locations, function (i, e) {

                    if (e.url == 'zoom') {
                        if (currentZoom > 6) {
                            markers[i].setVisible(false);
                        } else {
                            markers[i].setVisible(true);
                        }
                    }

                    if (e.zoomLevel == 'high') {
                        if (currentZoom > 6) {
                            markers[i].setVisible(true);
                        } else {
                            markers[i].setVisible(false);
                        }
                    }

                });

            });


            $('#google-map').on('mousemove', function (e) {
                var parentOffset = $(this).offset();
                var mouseLeft = e.pageX - parentOffset.left + 30;
                var mouseTop = e.pageY - parentOffset.top - 10;

                $('#map-popup').css({
                    left: mouseLeft,
                    top: mouseTop
                });
            });


            $('#google-map').append('<div id="map-popup"></div>');


            $window.on('resize', function () {
                if (map.getZoom() < 3) {
                    var zoom = $window.width() < 980 ? 1 : 2;
                    map.setZoom(zoom);
                    map.setCenter(center);
                }
            }).trigger('resize');

            //map.disableDragging(); 
            //map.disableDoubleClickZoom(); 
            //map.disableScrollWheelZoom(); 

        }

        $('#offices-mobile .accordion-toggle').bind('touchstart mousedown', function () {

            var $img = $(this).parents('.accordion-group').find('.google-map-img');
            $img.attr('src', $img.attr('data-src'));
        })


        /* Form Defaults */

        $('input.placeholder').on('focus', function () {
            if ($(this).val() == $(this).data('placeholder')) {
                $(this).val('');
            }
        }).on('blur', function () {
            if ($(this).val() === '') {
                $(this).val($(this).data('placeholder'));
            }
        });

        $('input.placeholder').each(function (i, e) {
            if ($(this).val() === '') {
                $(this).val($(this).data('placeholder'));
            }
        });


        /* Print Bio */

        $('#print').on('click', function () {
            window.print();
        });


        /* PDF Footer Link */

        $('.pdf-downloads').on('click', function () {
            $(this).toggleClass('active');
            $('.pdf-links').slideToggle();
        });


        /*	TEMP - FIX TODO - INSERTING LEGAL PDF LINK */
        /*	$('#footer-phone .span12').append('&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a class="underline" href="/media/110082/GA-AD.pdf">Careers</a>');*/

        /*	$('#footer-links .privacy-legal').append('&nbsp;&nbsp;<a class="underline" href="/media/110082/GA-AD.pdf">Careers</a>');	  */

    });


    /* On Load Event */

    $(window).on('load', function () {

        var $window = $(this);


        /* Scroll iPhone to hide Chrome */

        if (Modernizr.touch) {
            setTimeout(function () { window.scrollTo(0, 1) }, 10);
        }


        /* Match Column Heights after Images are Loaded */

        $('.match-height').matchHeight();
        $('.match-height-2').matchHeight();

        if (!categorizr.isMobile && !categorizr.isTablet) {

            $window.on('resize', function () {

                $('.match-height').height('auto');
                $('.match-height').matchHeight();
                $('.match-height-2').height('auto');
                $('.match-height-2').matchHeight();
            });

        }


        /* Home Page Delayed Parallax Image Loading */

        var loaded = false;

        function loadImages() {
            if (!loaded) {

                if ($('#parallax-3').is(':visible')) {
                    loaded = true;

                    $('[data-src]').each(function (i, e) {
                        var $this = $(e);
                        $this.attr('src', $this.data('src'));
                    });
                }

            }
        }

        $window.on('resize', function () {
            loadImages();
        });

        loadImages();

    });


    /* Abstract CSS Animations */

    $.fn.iAnimate = function (property, amount, time) {

        if (Modernizr.csstransitions) {
            $(this).css(property, amount);
        } else {
            var options = {};
            options[property] = amount;
            $(this).animate(options, time, 'easeOutCirc');
        }

    };


    /* Make Columns Same Height */

    $.fn.matchHeight = function () {

        var max = 0;

        $(this).each(function (i, e) {
            if ($(window).width() > 767 || !$(this).hasClass('no-phone-match-height')) {
                var height = $(e).height();
                max = height > max ? height : max;
            } else {
                max = 'auto';
            }
        });

        $(this).height(max);

    };

	/*$(document).ready(function () {
		$( "p.privacy-legal" ).append( "&nbsp;&nbsp;<a class='underline' href='/market-soundings/'>Market Soundings</a>" );
	});*/

} (jQuery));
