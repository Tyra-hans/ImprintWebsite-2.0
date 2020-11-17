// the semi-colon before the function invocation is a safety
// net against concatenated scripts and/or other plugins
// that are not closed properly.
;
(function($, window, document, undefined) {
  'use strict';

  var ADMIN = window.ADMIN || {};

  ADMIN.exists = function(selector) {
    return ($(selector).length > 0);
  };

  ADMIN.saveSettings = function() {
    $('form#df-settings').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: settings.ajaxurl,
        type: 'post',
        data: {
          action: 'save_admin_addons_settings',
          fields: $('form#df-settings').serialize(),
        },
        success: function(response, data) {
          console.log(data);
          swal(
            'Settings Saved !',
            'Click OK to continue',
            'success'
          );
        },
        error: function() {
          console.log('error');
          swal(
            'Oops...',
            'Something Wrong!',
          );
        }
      });
    });
  };

  ADMIN.upgradePro = function() {
    $('.upgrade-pro').on('click', function() {
      swal({
        title: '<span>Go Premium<span>',
        html: 'Updgrade our Premium Version to unlock these compontents.',
        type: 'warning',
        showCloseButton: true,
        showCancelButton: true,
        cancelButtonText: 'More Info',
        focusConfirm: true
      });
    });
  };

  
  $(document).ready(function() {
    ADMIN.saveSettings();
    ADMIN.upgradePro();
  });

  $(window).resize(function() {
    
  });

  $(window).scroll(function() {

  });

  $(window).load(function() {

  });

})(jQuery, window, document);
