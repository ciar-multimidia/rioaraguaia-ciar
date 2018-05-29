<?php

// ========================================//
// SETUP THEME
// ========================================// 

add_action( 'after_setup_theme', 'setup_theme' );
function setup_theme() {

    // admin menus
    if( function_exists('acf_add_options_page') ) {
      
      acf_add_options_page(array(
        'page_title'  => 'Página principal',
        'menu_title'  => 'Opções do site',
        'menu_slug'   => 'opcoes-site',
        'capability'  => 'edit_posts',
        'position'    => 3,
        'redirect'    => false
      ));

      acf_add_options_sub_page(array(
        'page_title'  => 'Página: Sobre o curso',
        'menu_title'  => 'Sobre o curso',
        'parent_slug' => 'opcoes-site'
      ));

      acf_add_options_sub_page(array(
        'page_title'  => 'Página: Ficha técnica',
        'menu_title'  => 'Ficha técnica',
        'parent_slug' => 'opcoes-site'
      ));
      
    }


    // thumbnails
    add_theme_support( 'post-thumbnails' );

    // suporte
    add_theme_support( 'html5' );

    // menus
    register_nav_menus( array(
      'menu-topo' => __( 'Menu global' )
    ));

    // scripts
    add_action( 'wp_enqueue_scripts', 'estilos_scripts', 1 );
   

    // configs do layout
    if ( ! isset( $content_width ) ) { $content_width = 800; }
    add_filter( 'embed_oembed_html', 'envolve_embed', 99, 4);
    add_filter( 'excerpt_more', 'reticencias' );
    add_filter( 'excerpt_length', 'num_palavras_resumo' );
    add_filter( 'body_class', 'classes_body' );

    // seguranca
    add_filter( 'the_generator', 'remove_versao_wp' );
    add_filter( 'style_loader_src', 'remove_versao_wp_arquivos', 9999 );
    add_filter( 'script_loader_src', 'remove_versao_wp_arquivos', 9999 );
    add_filter( 'style_loader_src', 'remove_query_string_scriptscss', 10, 2 );
    add_filter( 'script_loader_src', 'remove_query_string_scriptscss', 10, 2 );

    add_action( 'wp_ajax_loadmore', 'load_ajax_handler'); // wp_ajax_{action}
    add_action( 'wp_ajax_nopriv_loadmore', 'load_ajax_handler'); // wp_ajax_nopriv_{action}

}

require_once(get_template_directory().'/func/galeria.php' );
require_once(get_template_directory().'/func/type-colab.php' );

// ========================================//
// CUSTOM DASHBOARD ITENS
// ========================================// 
function custom_menus(){
  global $menu;
  global $submenu;

  $menu[2][0] = 'Início';
  $menu[5][0] = 'Exposição Virtual';
  $menu[10][0] = 'Biblioteca mídia';


  if (! current_user_can('administrator')) {
    unset($submenu['themes.php'][6]); // remove customize
    unset($submenu['themes.php'][8]); // remove editor

    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');
    remove_submenu_page('themes.php','theme-editor.php');

    remove_menu_page( 'edit.php?post_type=page' );
    remove_menu_page( 'edit.php?post_type=acf-field-group' );
  }
}
add_action( 'admin_menu', 'custom_menus', 999 );


function remover_personalizar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('customize');
}
add_action( 'wp_before_admin_bar_render', 'remover_personalizar' );



// ========================================//
// ESTILOS E SCRIPTS
// ========================================// 
function estilos_scripts() {  
  wp_enqueue_style('googlefonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i|Nunito:600,800', array(), '' , 'screen', false);
  wp_enqueue_style('fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '' , 'screen', false);
  wp_enqueue_style('layout', get_template_directory_uri() . '/css/layout.css', array(), '', 'all', null);
  
  wp_enqueue_script( 'popup', get_template_directory_uri() . '/js/magnific-popup.js', array('jquery'), '', true);
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '', true);

  // ajax load more
  // creditos: https://rudrastyh.com/wordpress/load-more-posts-ajax.html
  global $wp_query;
  wp_register_script( 'vermais', get_stylesheet_directory_uri() . '/js/ajax.js', array('jquery') );
  wp_localize_script( 'vermais', 'button_loadmore_params', array(
    'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
    'posts' => json_encode( $wp_query->query_vars ), // everything about your loop is here
    'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
    'max_page' => $wp_query->max_num_pages
  ) );
  wp_enqueue_script( 'vermais' );  
} 



// ========================================//
// AJAX QUERY
// ========================================// 
function load_ajax_handler(){
 
  // prepare our arguments for the query
  $args = json_decode( stripslashes( $_POST['query'] ), true );
  $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
  $args['post_status'] = 'publish';
 
  // it is always better to use WP_Query but not here
  query_posts( $args );
 
  if( have_posts() ) :
    while( have_posts() ): the_post();
      get_template_part( 'content', 'grid');  
    endwhile;
 
  endif;
  die; // here we exit the script and even no wp_reset_query() required!
}


// ========================================//
// TITULO PAGINA
// ========================================// 
function titulo_pagina() {
    global $page, $paged; 
    $site_description = get_bloginfo( 'description', 'display' ); 
    wp_title( '|', true, 'right' ); bloginfo( 'name' ); 
    
    if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description"; 
    if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Página %s' ), max( $paged, $page ) );
}

function classes_body($classes) {
  global $post;
  if ( isset( $post ) ) {
    $classes[] = $post->post_type . '-' . $post->post_name;
  }
    return $classes;
}


// ========================================//
// RESUMO
// ========================================// 
function reticencias( $more ) { return '...'; }
function num_palavras_resumo( $length ) { return 52; }




// ========================================//
// TAXONOMIA
// ========================================// 
function mostra_taxonomia($tax,$sentido) {
    // creditos: https://code.tutsplus.com/tutorials/taxonomy-archives-list-posts-by-taxonomys-terms--cms-20045
    global $post;

    $terms = get_terms( $tax, array(
        'orderby'    => 'name',
        'order' => $sentido,
        'hide_empty' => 0
    ) );

    foreach( $terms as $term ) {
     
        $args = array(
            'post_type' => 'revistasufg',
            'orderby'    => 'name',
            'order' => $sentido,
            $tax => $term->slug
        );

        $query = new WP_Query($args);
                           
        echo'<h4 class="divisoria titulo-taxonomia">' . $term->name . '</h4>';
         
        while ( $query->have_posts() ) : $query->the_post(); 
          if( have_rows('revista_informacoes') ): while( have_rows('revista_informacoes') ): the_row();
            loop_revista(); 
          endwhile; endif;
        endwhile; wp_reset_postdata();
    }
}



// ========================================//
// SEGURANCA
// ========================================// 
// removendo versao do wordpress
function remove_versao_wp() { return ''; }


// remover versão do wp nos scripts 
function remove_versao_wp_arquivos( $src ) {
    if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// retirar query strings de scripts e css
function remove_query_string_scriptscss( $src ) {
   if( strpos( $src, '?ver=' ) )
   $src = remove_query_arg( 'ver', $src );
   return $src;
}



// ========================================//
// VIDEOS - credito: https://wordpress.stackexchange.com/a/195135
// ========================================// 
function envolve_embed($html, $url, $attr, $post_id) {
    return '<div class="video">' . $html . '</div>';
}

// converter youtube link para embed
function video_youtube($string, $id) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe id=\"". $id ."\" src=\"//www.youtube.com/embed/$2?enablejsapi=1&amp;rel=0&amp;controls=0&amp;showinfo=0\" frameborder=\"0\" allowfullscreen></iframe>",
        $string
    );
}


// ========================================//
// THUMB
// ========================================// 
function thumb_url($size) {
    global $post;
    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size); 
    $url = $thumb['0'];
    echo $url;
}




// ========================================//
// SHORTCODES
// ========================================// 
function shortcode_arruma_espacos($content) {  
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
add_filter('the_content', 'shortcode_arruma_espacos', 20);


////////////////////////////// botao
function shortcode_botao( $atts, $content = null ) {
    extract(shortcode_atts(array(
        "link" => '',
        "tamanho" => '',
    ), $atts));
    ob_start();

        echo "<a href=".$link."";
        echo " class='button";
        if ($tamanho) { echo " ".$tamanho."";}
        echo "' target='blank'>".$content."</a>";

    $output = ob_get_clean();
    return $output;
}
add_shortcode('botao','shortcode_botao');

////////////////////////////// lingua karaja nos posts
function shortcode_karaja( $atts, $content = null ) {
    return '<div class="lingua-kr">'.$content.'</div>';
}
add_shortcode('karaja','shortcode_karaja');

