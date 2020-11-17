<?php
/**
 * Instagram override file
 *
 * @package webify
 * @since 1.0
 */
?>
<?php
echo '<li class="' . esc_attr( $liclass ) . ' instragram-feed"><a href="' . esc_url( $item['link'] ) . '" target="' . esc_attr( $target ) . '"  class="' . esc_attr( $aclass ) . '"><img src="' . esc_url( $item[$size] ) . '"  alt="' . esc_attr( $item['description'] ) . '" title="' . esc_attr( $item['description'] ) . '"  class="' . esc_attr( $imgclass ) . '"/><i class="fa fa-instagram"></i></a></li>';
?>
