<?php
/**
 * Admin Filter Hooks.
 *
 * @package webify
 * @since 1.0
*/

/**
 * Allow xml file to upload
 *
 * @package webify
 * @since 1.0
 */
if(!function_exists('webify_upload_svg')) {
  function webify_upload_svg($mimes) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['ttf']  = 'font/ttf';
    $mimes['eot']  = 'font/eot';
    $mimes['svg']  = 'font/svg';
    $mimes['woff'] = 'font/woff';
    $mimes['otf']  = 'font/otf';
    $mimes['zip']  = 'application/zip';
    $mimes['gz']   = 'application/x-gzip';
    return $mimes;
  }
  add_filter('upload_mimes', 'webify_upload_svg');
}
