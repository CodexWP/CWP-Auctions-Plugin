<?php
add_action( 'init', 'create_auction_post_type', 0 );
add_action( 'admin_init', 'add_auctions_meta_boxes' );

function create_auction_post_type() {
    $labels = array(
        'name'                => _x( 'Auctions', 'Post Type General Name', 'auctions-helper' ),
        'singular_name'       => _x( 'Auction', 'Post Type Singular Name', 'auctions-helper' ),
        'menu_name'           => __( 'Auctions', 'auctions-helper' ),
        'parent_item_colon'   => __( 'Parent Auctions', 'auctions-helper' ),
        'all_items'           => __( 'All Auctions', 'auctions-helper' ),
        'view_item'           => __( 'View Auctions', 'auctions-helper' ),
        'add_new_item'        => __( 'Add New Auctions', 'auctions-helper' ),
        'add_new'             => __( 'Add New', 'auctions-helper' ),
    );
    $args = array(
        'label'               => __( 'auctions', 'auctions-helper' ),
        'description'         => __( 'Auctions news and informations', 'auctions-helper' ),
        'labels'              => $labels,
        'supports'            => array(  'title', 'editor','thumbnail'),
        'taxonomies'          => array( 'genres' ),
        'hierarchical'        => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'auctions', $args );
    flush_rewrite_rules();
}

function add_auctions_meta_boxes() {
    add_meta_box("auctions_meta", "Auctions Informations", "auctions_meta_box_html", "auctions", "normal", "low");
}





?>