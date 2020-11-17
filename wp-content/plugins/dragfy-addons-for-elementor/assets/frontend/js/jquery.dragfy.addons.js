// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
;
(function($, window, document, undefined) {
  'use strict';

  var DRAFGY = window.DRAFGY || {};

  DRAFGY.exists = function(selector) {
    return ($(selector).length > 0);
  };

  DRAFGY.isotope = function() {
    if (DRAFGY.exists('.df-isotop')) {
      $('.df-isotop').isotope({
        itemSelector: '.df-isotop-item',
        transitionDuration: '0.60s',
        percentPosition: true,
        masonry: {
          columnWidth: '.df-grid-sizer'
        }
      });
      $('.df-isotop-filter ul li').on('click', function(event) {
        $(this).siblings('.active').removeClass('active');
        $(this).addClass('active');
        event.preventDefault();
      });
      $('.df-isotop-filter ul').on('click', 'a', function() {
        var filterElement = $(this).attr('data-filter');
        $(this).parents('.df-isotop-filter').next().isotope({
          filter: filterElement
        });
      });
    }
  };

  DRAFGY.youtubePlaylist = function() {
    if (DRAFGY.exists('.df-ytv-wrap')) {
      $('.df-ytv-wrap').each(function() {
        var thisPlayer = $(this).find('.yt-playlist');
        var channelId = thisPlayer.data('channel-id');
        $(thisPlayer).ytv({
          channelId: channelId,
          playerTheme: 'dark',
          responsive: true
        });
      });
    }
  };


  DRAFGY.slickSlider = function() {
    $('.df-slider').each(function() {

      // Slick Variable
      var $ts = $(this).find('.slick-container');
      var $slickActive = $(this).find('.slick-wrapper');
      var $sliderNumber = $(this).siblings('.slider-number');

      // Auto Play
      var autoPlayVar = parseInt($ts.attr('data-autoplay'), 10);
      // Auto Play Time Out
      var autoplaySpdVar = 3000;
      if (autoPlayVar > 1) {
        autoplaySpdVar = autoPlayVar;
        autoPlayVar = 1;
      }
      // Slide Change Speed
      var speedVar = parseInt($ts.attr('data-speed'), 10);
      // Slider Loop
      var loopVar = Boolean(parseInt($ts.attr('data-loop'), 10));
      // Slider Center
      var centerVar = Boolean(parseInt($ts.attr('data-center'), 10));
      // Pagination
      var paginaiton = $(this).children().hasClass('pagination');
      // Slide Per View
      var slidesPerView = $ts.attr('data-slides-per-view');
      if (slidesPerView == 1) {
        slidesPerView = 1;
      }
      if (slidesPerView == 'responsive') {
        var slidesPerView = parseInt($ts.attr('data-add-slides'), 10);
        var lgPoint = parseInt($ts.attr('data-lg-slides'), 10);
        var mdPoint = parseInt($ts.attr('data-md-slides'), 10);
        var smPoint = parseInt($ts.attr('data-sm-slides'), 10);
        var xsPoing = parseInt($ts.attr('data-xs-slides'), 10);
      }

      // Fade Slider
      var fadeVar = parseInt($($ts).attr('data-fade-slide'));
      (fadeVar === 1) ? (fadeVar = true) : (fadeVar = false);


      // Slick Active Code
      $slickActive.slick({
        infinite: true,
        autoplay: autoPlayVar,
        dots: paginaiton,
        centerPadding: '0',
        speed: speedVar,
        infinite: loopVar,
        autoplaySpeed: autoplaySpdVar,
        centerMode: centerVar,
        prevArrow: $(this).find('.slick-arrow-left'),
        nextArrow: $(this).find('.slick-arrow-right'),
        appendDots: $(this).find('.pagination'),
        fade: fadeVar,
        slidesToShow: slidesPerView,
        responsive: [{
            breakpoint: 1600,
            settings: {
              slidesToShow: lgPoint
            }
          },
          {
            breakpoint: 1200,
            settings: {
              slidesToShow: mdPoint
            }
          },
          {
            breakpoint: 992,
            settings: {
              slidesToShow: smPoint
            }
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: xsPoing
            }
          }
        ]
      });
    })
  };


  DRAFGY.accordion = function() {
    var $this = $(this);
    $('.df-accordian').children('.df-accordian-body').hide();
    $('.df-accordian.active').children('.df-accordian-body').show();
    $('.df-accordian-title').on('click', function() {
      $(this).parent('.df-accordian').siblings().children('.df-accordian-body').slideUp(250);
      $(this).siblings().slideDown(250);
      $(this).parents('.df-accordian').addClass('active');
      $(this).parent('.df-accordian').siblings().removeClass('active');
    });
    // Gallery Accordian
    $('.df-gallery-accordian').each(function() {
      $(this).find('.df-gallery-accordian-in').hover(
        function() { $(this).addClass('active').siblings().removeClass('active') }
      )
      var activeWidth = $(this).children('.df-gallery-accordian-in.active').width() + 'px';
      var activeHeight = $(this).children('.df-gallery-accordian-in.active').height() + 'px';
      $(this).find('.df-gallery-accordian-img').css({
        'width': activeWidth,
        'height': activeHeight
      })
    });


  };

  DRAFGY.toggle = function() {
    $('.df-accordian-title').on('click', function() {
      $(this).parents('.df-accordian').toggleClass('df-active');
      $(this).siblings('.df-accordian-title-body').slideToggle();
    })
  }


  DRAFGY.videoPopup = function() {
    $(document).on('click', '.df-video-open', function(e) {
      e.preventDefault();
      var video = $(this).attr('href');
      $('.df-video-popup-container iframe').attr('src', video);
      $('.df-video-popup').addClass('active');
    });
    $('.df-video-popup-close, .df-video-popup-layer').on('click', function(e) {
      $('.df-video-popup').removeClass('active');
      $('html').removeClass('overflow-hidden');
      $('.df-video-popup-container iframe').attr('src', 'about:blank')
      e.preventDefault();
    });
  };

  DRAFGY.videoGallery = function() {
    $(document).on('click', '.df-ydf-open', function(e) {
      e.preventDefault();
      var video = $(this).attr('href');
      $(this).html('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="" allowfullscreen="1"  allow="autoplay;encrypted-media;"></div>')
      $(this).find('iframe').attr('src', video);
      $(this).addClass('active');
    });
  };

  DRAFGY.tabs = function() {
    $('.df-tabs.df-standard-tabs .df-tab-links a').on('click', function(e) {
      var currentAttrValue = $(this).attr('href');
      $('.df-tabs ' + currentAttrValue).show().siblings().hide();
      $(this).parent('li').addClass('active').siblings().removeClass('active');
      e.preventDefault();
    });
    $('.df-tabs.df-fade-tabs .df-tab-links a').on('click', function(e) {
      var currentAttrValue = $(this).attr('href');
      $('.df-tabs ' + currentAttrValue).fadeIn(400).siblings().hide();
      $(this).parents('li').addClass('active').siblings().removeClass('active');
      e.preventDefault();
    });
  };

  DRAFGY.modal = function() {

  };

  DRAFGY.lightBox = function() {
    $('.df-lightgallery').each(function() {
      $(this).lightGallery({
        selector: '.df-lightbox-item'
      });
    });
  };

  DRAFGY.lineChart = function() {

    $('.df-line-chart').each(function() {
      var eachLineChart = $(this).find('#df-chart2')
      if (DRAFGY.exists(eachLineChart)) {

        var selector = $(this),
          el = selector.data('values'),
          labels = $.parseJSON(el.view_labels),
          data = $.parseJSON(el.view_data),
          y_axis_label = selector.data('y-label'),
          bg_color = selector.data('bg-color'),
          border_width = selector.data('border-width'),
          x_axis_color = selector.data('x-axis-color'),
          x_axis_grid_color = selector.data('x-axis-grid-color'),
          y_axis_color = selector.data('y-axis-color'),
          y_axis_grid_color = selector.data('y-axis-grid-color'),
          border_color = selector.data('border-color');

        var ctx = selector.find(eachLineChart);

        var myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
              label: y_axis_label,
              data: data,
              backgroundColor: bg_color,
              borderColor: border_color,
              borderWidth: border_width,
              lineTension: 0,
              pointBackgroundColor: '#fff'
            }]

          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
              position: 'bottom',
              display: false
            },
            tooltips: {
              displayColors: false,
              mode: 'nearest',
              intersect: false,
              position: 'nearest',
              xPadding: 8,
              yPadding: 8,
              caretPadding: 8,
              backgroundColor: '#666666',
              cornerRadius: 2,
              titleFontSize: 13,
              titleFontStyle: 'normal',
              titleFontFamily: 'Open Sans',
              bodyFontSize: 13,
              footerFontFamily: 'Open Sans'
            },
            scales: {
              yAxes: [{
                ticks: {
                  fontSize: 14,
                  fontColor: y_axis_color,
                  fontFamily: 'Open Sans',
                  padding: 15,
                  beginAtZero: true,
                  autoSkip: false,
                  maxTicksLimit: 4
                },
                gridLines: {
                  color: y_axis_grid_color,
                  borderDash: [1, 3],
                  zeroLineWidth: 1,
                  zeroLineColor: '#eaeaea',
                  drawBorder: false
                }
              }],
              xAxes: [{
                ticks: {
                  fontSize: 14,
                  fontColor: x_axis_color,
                  fontFamily: 'Open Sans',
                  padding: 5,
                  beginAtZero: true,
                  autoSkip: false,
                  maxTicksLimit: 4
                },
                gridLines: {
                  color: x_axis_grid_color,
                  borderDash: [1, 3],
                  zeroLineColor: '#b5b5b5',
                }
              }],
            },
            elements: {
              point: {
                radius: 3,
                hoverRadius: 3
              }
            }
          }
        });
      }
    });
  };

  DRAFGY.roundChart = function() {
    if (DRAFGY.exists('.df-round-chart')) {

      $('.df-round-chart').each(function() {
        var ctx = $(this).find('#df-chart1'),
          el = $(this),
          options = el.data('options'),
          labels = {},
          values = [],
          stroke_colors = [];

        $.each(options, function(key, value) {
          labels[key] = value['label'];
          values[key] = parseInt(value['value']);
          stroke_colors[key] = value['stroke_color'];
          el.find('.df-circle-stroke .df-circle-label').eq(key).html(value['label']).siblings().css('background-color', value['stroke_color']);
        });

        var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: labels,
            datasets: [{
              backgroundColor: stroke_colors,
              data: values,
              borderWidth: 0
            }]
          },
          options: {
            cutoutPercentage: 80,
            legend: {
              position: 'right',
              display: false
            },
            tooltips: {
              displayColors: false,
              mode: 'nearest',
              intersect: false,
              position: 'nearest',
              xPadding: 8,
              yPadding: 8,
              caretPadding: 8,
              backgroundColor: '#666666',
              cornerRadius: 2,
              titleFontSize: 13,
              titleFontStyle: 'normal',
              titleFontFamily: 'Open Sans',
              bodyFontSize: 13,
              footerFontFamily: 'Open Sans'
            },
          }
        });

      });
    }
  };

  DRAFGY.countDown = function() {
    if (DRAFGY.exists('#df-if-expired')) {

      $('.df-countdown').each(function() {
        var el = $(this);
        var date = el.data('countdate');
        var expire_text = el.data('expire-text');
        var countDownDate = new Date(date).getTime();
        var x = setInterval(function() {
          var now = new Date().getTime();
          var distance = countDownDate - now;
          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);

          if (DRAFGY.exists(el.find('#df-count-days'))) {
            el.find('#df-count-days').html(days);
          }
          if (DRAFGY.exists(el.find('#df-count-hours'))) {
            el.find('#df-count-hours').html(hours);
          }
          if (DRAFGY.exists(el.find('#df-count-minutes'))) {
            el.find('#df-count-minutes').html(minutes);
          }
          if (DRAFGY.exists(el.find('#df-count-seconds'))) {
            el.find('#df-count-seconds').html(seconds);
          }
          if (distance < 0) {
            clearInterval(x);
            el.html(expire_text);
          }
        }, 1000);
      });

    }
  };

  DRAFGY.progressBar = function() {
    $('.df-single-bar').each(function() {
      var progressPercentage = $(this).data('progress-percentage') + "%";
      $(this).find('.df-single-bar-in').css('width', progressPercentage);
    });
    $('.df-single-bar').each(function() {
      var windowScroll = $(document).scrollTop(),
        windowHeight = $(window).height(),
        barOffset = $(this).offset().top,
        barHeight = $(this).height(),
        barScrollUp = barOffset <= (windowScroll + windowHeight),
        barSctollDown = barOffset + barHeight >= windowScroll;

      if (barSctollDown && barScrollUp) {
        $(this).addClass('df-active');
      }

    });
  };

  DRAFGY.horizontalPrallax = function() {
    $('.df-horizontal-parallax').each(function() {
      var windowScroll = $(document).scrollTop(),
        windowHeight = $(window).height(),
        barOffset = $(this).offset().top,
        barHeight = $(this).height(),
        barScrollAtZero = windowScroll - barOffset + windowHeight,
        barHeightWindowHeight = windowScroll + windowHeight,
        barScrollUp = barOffset <= (windowScroll + windowHeight),
        barSctollDown = barOffset + barHeight >= windowScroll;

      if (barSctollDown && barScrollUp) {
        var calculadedHeight = barHeightWindowHeight - barOffset;
        var calcWindowScroll = ((calculadedHeight / 15)) + 'px';
        var calcWindowScroll2 = ((calculadedHeight / 5)) + 'px';
        $(this).find('.df-card-img-in').css('bottom', calcWindowScroll2);
        $(this).find('.df-card-feature').css('right', calcWindowScroll2);
        $(this).find('.df-layer-img.df-style2').css('right', calcWindowScroll);
        $(this).find('.df-layer-img.df-style3').css('left', calcWindowScroll);
        $(this).find('.df-timeline-bar-in').css('height', barScrollAtZero);
        $(this).find('.df-image-animation').css('margin-left', calcWindowScroll);
        $(this).find('.df-hero-mockup-img.df-style12').css('margin-left', calcWindowScroll);
        $(this).find('.df-hero-mockup-img.df-style9').css('margin-left', calcWindowScroll);
        $(this).find('.df-hero-mockup-img.df-style2').css({'margin-left': calcWindowScroll, 'margin-top': ("-" + calcWindowScroll)});
        $(this).find('.df-hero-mockup-img.df-style5').css('margin-left', ("-" + calcWindowScroll));
        $(this).find('.df-hero-mockup-img.df-style8').css({'margin-top': ("-" + calcWindowScroll), 'margin-left': calcWindowScroll});
      }
    });
  }

  DRAFGY.beforeAfterSlider = function() {
    if ($('.df-image-comparison').length > 0) {
      $(".df-image-comparison[data-orientation='horizontal']").twentytwenty({
        default_offset_pct: 0.5
      });
      $(".df-image-comparison[data-orientation='vertical']").twentytwenty({
        default_offset_pct: 0.5,
        orientation: 'vertical'
      });
    }
  };

  DRAFGY.googleMap = function() {
    if ($('#map').length > 0) {
      var el = $('.df-map-wrap'),
        lat = el.data('lat'),
        lng = el.data('lng'),
        zoom = el.data('zoom'),
        marker = el.data('marker'),
        marker_url = (!marker || marker.length === 0) ? get.siteurl + '/assets/img/map-marker.png' : marker;
      el.each(function() {
        var contactmap = {
          lat: lat,
          lng: lng
        };
        el.find('#map').gmap3({
            zoom: zoom,
            center: contactmap,
            scrollwheel: false,
          })
          .marker({
            position: contactmap,
            icon: marker_url
          })
      });
    }
  };

  DRAFGY.hobbleEffect = function() {
    $(document).on('mousemove', '.df-hover-layer', function(event) {
      var halfW = (this.clientWidth / 2);
      var halfH = (this.clientHeight / 2);
      var coorX = (halfW - (event.pageX - $(this).offset().left));
      var coorY = (halfH - (event.pageY - $(this).offset().top));
      var degX = ((coorY / halfH) * 6) + 'deg';
      var degY = ((coorX / halfW) * -6) + 'deg';
      var degX1 = ((coorY / halfH) * -50) + 'px';
      var degY1 = ((coorX / halfW) * 50) + 'px';
      var degX2 = ((coorY / halfH) * -25) + 'px';
      var degY2 = ((coorX / halfW) * 25) + 'px';
      var degX3 = ((coorY / halfH) * 15) + 'deg';
      var degY3 = ((coorX / halfW) * -15) + 'deg';

      $(this).find('.hover-container').css('transform', function() {
        return 'perspective( 800px ) translate3d( 0, -2px, 0 ) rotateX(' + degX + ') rotateY(' + degY + ')';
      });
      $(this).find('.df-hover-layer1').css('transform', function() {
        return 'perspective( 800px ) translate3d( 0, 0, 0 ) rotateX(' + degX + ') rotateY(' + degY + ')';
      });
      $(this).find('.df-hover-layer4').css('transform', function() {
        return 'perspective( 800px ) translate3d( 0, 0, 0 ) rotateX(' + degX3 + ') rotateY(' + degY3 + ')';
      });
      $(this).find('.df-hover-layer2').css('transform', function() {
        return 'perspective( 800px ) translateX(' + degX1 + ') translateY(' + degY1 + ')';
      });
      $(this).find('.df-hover-layer3').css('transform', function() {
        return 'perspective( 800px ) translateX(' + degX2 + ') translateY(' + degY2 + ')';
      });
    }).on('mouseout', '.df-hover-layer', function() {
      $(this).find('.hover-container').removeAttr('style');
      $(this).find('.df-hover-layer1').removeAttr('style');
      $(this).find('.df-hover-layer2').removeAttr('style');
      $(this).find('.df-hover-layer3').removeAttr('style');
      $(this).find('.df-hover-layer4').removeAttr('style');
    });

  };

  DRAFGY.ajaxPagination = function() {
    $('.df-ajax-load-more').each(function() {

      var $this = $(this),
        $container = $this.parent().find('.df-post-outerwrapper'),
        token = $this.data('token'),
        settings = window['webify_load_more_' + token],
        is_isotope = parseInt(settings.isotope),
        paging = 1,
        flood = false,
        ajax_data;

      $this.bind('click', function() {

        if (flood === false) {
          paging++;
          flood = true;

          ajax_data = $.extend({}, { action: 'ajax-pagination', paged: paging }, settings);

          $.ajax({
            type: 'POST',
            url: get.ajaxurl,
            data: ajax_data,
            dataType: 'html',
            beforeSend: function() {
              $this.addClass('more-loading');
              $this.html('Loading...');
            },
            success: function(html) {

              var content = $(html).css('opacity', 0);

              if (is_isotope) {
                content.imagesLoaded(function() {
                  $container.append(content).isotope('appended', content);
                  $container.isotope('layout');
                });
              } else {
                $(content).insertBefore($this.parent());
              }
              content.animate({ 'opacity': 1 }, 250);

              $this.removeClass('more-loading');
              $this.html('Load More');
              if (parseInt(settings.max_pages) == paging) { $this.hide(); }

              flood = false;
            }

          });

        }

        return false;
      });

    });
  };

  DRAFGY.particleEffects = function() {
    if (DRAFGY.exists('#df-ball-wrap')) {
      var colors = ['#3CC157', '#2AA7FF', '#FCBC0F', '#F85F36'];
      var numBalls = 20;
      var balls = [];

      for (var i = 0; i < numBalls; i++) {
        var ball = document.createElement('div');
        ball.classList.add('df-ball');
        ball.style.background = colors[Math.floor(Math.random() * colors.length)];
        ball.style.left = (Math.floor(Math.random() * 100)) + "vw";
        ball.style.top = (Math.floor(Math.random() * 100)) + "vh";
        ball.style.transform = "scale(" + (Math.random()) + ")";
        ball.style.width = (Math.random()) + "em";
        ball.style.height = ball.style.width;

        balls.push(ball);
        document.getElementById('df-ball-wrap').append(ball);
      }

      // Keyframes
      balls.forEach(function (el, i, ra) {
        var to = {
          x: Math.random() * (i % 2 === 0 ? -11 : 11),
          y: Math.random() * 12
        };

        var anim = el.animate(
          [
            { transform: 'translate(0, 0)' },
            { transform: ("translate(" + (to.x) + "rem, " + (to.y) + "rem)") }
          ], {
            duration: (Math.random() + 1) * 2000, // random duration
            direction: 'alternate',
            fill: 'both',
            iterations: Infinity,
            easing: 'ease-in-out'
          }
        );
      });
    }
  };

  DRAFGY.hotspot = function() {
    if (DRAFGY.exists('.df-hotspot-btn')) {
      $('.df-hotspot-btn').on('click', function() {
        $(this).parents('.df-hotspot-wrap').toggleClass('active');
      });
    }
  };

  DRAFGY.timeline = function() {
    if (DRAFGY.exists('.df-timeline-wrap')) {
      $('.df-timeline-wrap').each(function() {
        var firstChildPosition = $(this).children('.df-timeline-post').first().find('.df-timeline-icon').position();
        var topPosition = firstChildPosition.top + 'px';
        var lastChildPosition = $(this).children('.df-timeline-post').last().find('.df-timeline-icon').position();
        var lastChildHeight = $(this).children('.df-timeline-post').last().height();
        var bottomPosition = (lastChildHeight - lastChildPosition.top) + 'px';
        $(this).find('.df-timeline-bar').css({
          top: topPosition,
          bottom: bottomPosition
        })
      });
    }
  };

  DRAFGY.counter = function() {
    if (DRAFGY.exists('.counter')) {
      $('.counter').each(function() {
        var windowScroll = $(document).scrollTop(),
          windowHeight = $(window).height(),
          barOffset = $(this).offset().top,
          barHeight = $(this).height(),
          barScrollAtZero = windowScroll - barOffset + windowHeight,
          barHeightWindowHeight = windowScroll + windowHeight,
          barScrollUp = barOffset <= (windowScroll + windowHeight),
          barSctollDown = barOffset + barHeight >= windowScroll;

        if (barSctollDown && barScrollUp) {
          $(this).html($(this).data('count-to'));
        }
      });

    }
  }


  $(document).ready(function() {
    DRAFGY.isotope();
    DRAFGY.slickSlider();
    DRAFGY.accordion();
    DRAFGY.videoPopup();
    DRAFGY.videoGallery();
    DRAFGY.tabs();
    DRAFGY.modal();
    DRAFGY.lightBox();
    DRAFGY.lineChart();
    DRAFGY.roundChart();
    DRAFGY.countDown();
    DRAFGY.progressBar();
    DRAFGY.beforeAfterSlider();
    DRAFGY.googleMap();
    DRAFGY.hobbleEffect();
    DRAFGY.ajaxPagination();
    DRAFGY.particleEffects();
    DRAFGY.horizontalPrallax();
    DRAFGY.hotspot();
    DRAFGY.timeline();
    DRAFGY.counter();
  });

  $(window).resize(function() {
    DRAFGY.isotope();
    DRAFGY.slickSlider();
    DRAFGY.timeline();
  });

  $(window).scroll(function() {
    DRAFGY.progressBar();
    DRAFGY.horizontalPrallax();
    DRAFGY.counter();
  });

  $(window).load(function() {
    DRAFGY.isotope();
    DRAFGY.youtubePlaylist();
  });

  $(window).on('elementor/frontend/init', function() {

    var triggerSlick = [
      'logo-carousel',
      'interactive-slider',
      'road-map',
      'icon-box-slider',
      'testimonial-slider',
      'post-slider',
      'team-member-slider',
      'team-slider',
      'image-box-slider',
      'image-slider'
    ];

    $.each(triggerSlick, function(index, item) {
      elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-' + item + '.default', function($scope, $) {
        DRAFGY.slickSlider();
      });
    });

    var triggerIsotope = [
      'image-gallery',
      'filterable-gallery',
      'filterable-video-gallery',
      'post',
    ];

    $.each(triggerIsotope, function(index, item) {
      elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-' + item + '.default', function($scope, $) {
        var selector = $scope.find('dragfy-addons-' + item);
        selector.imagesLoaded(function() {
          DRAFGY.isotope();
        });
      });
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-accordion.default', function($scope, $) {
      DRAFGY.accordion();
      DRAFGY.toggle();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-image-comparison.default', function($scope, $) {
      DRAFGY.beforeAfterSlider();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-filterable-video-gallery.default', function($scope, $) {
      DRAFGY.videoGallery();
      DRAFGY.videoPopup();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-count-down.default', function($scope, $) {
      DRAFGY.countDown();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-interactive-banner.default', function($scope, $) {
      DRAFGY.particleEffects();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-progress-bar.default', function($scope, $) {
      DRAFGY.progressBar();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-youtube-video-playlist.default', function($scope, $) {
      DRAFGY.youtubePlaylist();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-line-chart.default', function($scope, $) {
      DRAFGY.lineChart();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-round-chart.default', function($scope, $) {
      DRAFGY.roundChart();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-tabs.default', function($scope, $) {
      DRAFGY.tabs();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-content-toggle.default', function($scope, $) {
      DRAFGY.tabs();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-counter.default', function($scope, $) {
      DRAFGY.counter();
    });

    elementorFrontend.hooks.addAction('frontend/element_ready/dragfy-addons-timeline.default', function($scope, $) {
      DRAFGY.horizontalPrallax();
    });

  });


})(jQuery, window, document);
