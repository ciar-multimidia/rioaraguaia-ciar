<?php

add_action('print_media_templates', function(){
  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>
  <script type="text/html" id="tmpl-my-custom-gallery-setting">
    <label class="setting">
      <span><?php _e('Orientação das fotos'); ?></span>
      <select data-setting="orientacao">
        <option value="horizontal"> Paisagem </option>
        <option value="vertical"> Retrato </option>
        <option value="quadrada"> Quadrado </option>
      </select>
    </label>
  </script>

  <script>
    jQuery(document).ready(function(){
      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.galleryDefaults, {
        orientacao: 'horizontal'
      });
      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('my-custom-gallery-setting')(view);
        }
      });
    });
  </script>
  <?php
});


add_filter( 'post_gallery', 'galeria_imagens', 10, 2 );
function galeria_imagens( $output, $attr ) {
    $post = get_post();
    static $instance = 0;
    $instance++;
    // override default link settings
    if ( empty(  $attr['link'] ) ) {
        $attr['link'] = 'none'; // set your default value here
    }
    if ( !empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) )
            $attr['orderby'] = 'post__in';
        $attr['include'] = $attr['ids'];
    }
    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'orientacao' => 'horizontal',
        'size'       => 'thumbnail',
        'include'    => '',
        'post_type'  => 'attachment',
        'exclude'    => ''
    ), $attr, 'gallery'));
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';
    if ( !empty($include) ) {
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
    $columns = intval($columns);
    $selector = "postgaleria-{$instance}";
    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='galeria-imgs orientacao-{$orientacao} idgaleria-{$id} grid-{$columns}' data-colunas='{$columns}'>\n\n<div class='linha'>\n";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
    $i = 0;


    foreach ( $attachments as $id => $attachment ) {
        $imagemfull = wp_get_attachment_image_src($id, 'full', false, false);
        $imagemtlarge = wp_get_attachment_image_src($id, 'large', false, false);
        $imagemtmedium = wp_get_attachment_image_src($id, 'medium', false, false);
        $output .= "<div class='galeria-item'>\n";
            $output .= "<div class='galeria-imagem'>\n";
                $output .= "<a href='".$imagemfull[0]."' class='fancybox' title='".wptexturize($attachment->post_excerpt)."' style='background-image: url(".$imagemtmedium[0].")'>";
                    $output .= "<img src='".$imagemtmedium[0]."' alt='".wptexturize($attachment->post_excerpt)."'>";
                $output .= "</a>\n";
            $output .= "</div>";
        $output .= "\n</div>\n\n";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= "</div>\n\n<div class='linha'>\n";
    }
    $output .= "\n</div>";

    $output .= "\n</div>";
    return $output;
}