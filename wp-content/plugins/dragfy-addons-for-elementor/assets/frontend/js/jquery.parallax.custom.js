// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
(function($) {


  function parallaxJS(selector) {
    $(selector).each(function() {
      var windowScroll        = $(document).scrollTop(),
        windowHeight          = $(window).height(),
        barOffset             = $(this).offset().top,
        barHeight             = $(this).height(),
        barScrollAtZero       = windowScroll - barOffset + windowHeight,
        barHeightWindowHeight = windowScroll + windowHeight,
        barScrollUp           = barOffset <= (windowScroll + windowHeight),
        barSctollDown         = barOffset + barHeight >= windowScroll;

      if (barSctollDown && barScrollUp) {
        var calculadedHeight = barHeightWindowHeight - barOffset;
        var xxxx              = calculadedHeight / 5;
        var yyyy              = -(calculadedHeight / 5);
        var zzzz              = calculadedHeight / 15;
        $(this).find('.df-parallax-rotate').css({'margin-top': "".concat(yyyy, "px"), 'transform': "rotate(".concat(zzzz, "deg)")});
        $(this).find('.df-parallax-bottom-top').css('margin-top', "".concat(yyyy, "px"));
        $(this).find('.df-parallax-right-left').css({'margin-left': "".concat(yyyy, "px"), 'margin-top': "".concat(yyyy, "px")});
      }

    });
  }

  if ($('.df-parallax-yes').length) {
    Object.keys(window.scope_array).forEach(function(i) {
      $scope = window.scope_array[i];
      elemJS($scope);
    });
  }

  function elemJS($scope) {
    id           = $scope.data('id');
    element_type = $scope.data('element_type');
    attributes   = $scope.data('df-parallax');

    $content = [];


    $.each(attributes, function(index, item) {
      $html = '<div class="df-parallax-shape df-parallax-' + item.style + '" id="df-parallax-' + index + '" style="left:' + item.horizontal_position.size  + '%; top:' + item.vertical_position.size + '%;">';
      $html += '<img src="' + item.image.url + '" alt="image-' + index + '">';
      $html += '</div>';

      $content.push($html);

    });

    if (element_type == 'column') {
      if ($scope.find('.elementor-background-overlay').length == 0) {
        $column = $scope.find('.elementor-column-wrap');
      } else {
        $column = $scope.find('.elementor-background-overlay');
      }
      $column.after($content);
    } else {
      if ($scope.find('.elementor-background-overlay ~ .elementor-container').length == 0) {
        $scope.prepend($content);
      } else {
        $scope.find('.elementor-background-overlay').after($content);
      }
    }

    parallaxJS('.df-parallax-wrapper');
    
    $(document).scroll(function() {
      parallaxJS('.df-parallax-wrapper');        
    });
  };




})(jQuery);
