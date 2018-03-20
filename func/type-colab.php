<?php

add_action('init', 'posttype_colaboradores', 1);  

function posttype_colaboradores(){
  $labels = array(
    'name' => _x('Lista de colaboradores', 'post type general name', 'rioaraguaia'),
    'singular_name' => _x('Colaborador', 'post type singular name', 'rioaraguaia'),
    'add_new' => _x('Adicionar novo', 'colaboradores', 'rioaraguaia'),
    'add_new_item' => __('Adicionar novo colaborador', 'rioaraguaia'),
    'edit_item' => __('Editar colaborador', 'rioaraguaia'),
    'new_item' => __('Nova colaborador', 'rioaraguaia'),
    'view_item' => __('Ver colaborador', 'rioaraguaia'),
    'search_items' => __('Buscar', 'rioaraguaia'),
    'not_found' =>  __('Nenhum colaborador encontrado', 'rioaraguaia'),
    'not_found_in_trash' => __('Nenhum colaborador encontrado na lixeira', 'rioaraguaia'),
    'parent_item_colon' => '',
    'menu_name' => 'Colaboradores'
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'has_archive' => 'colaboradores',
    'hierarchical' => false,
    'menu_position' => 5,
    'exclude_from_search' => false,
    'menu_icon' => 'dashicons-groups',
    'supports' => array('title','editor','thumbnail'),
    'rewrite' => array('slug' => 'colaboradores')
  );
  
  register_post_type('colaboradoresufg',$args);

}
