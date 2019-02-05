<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.codexwp.com/about/
 * @since      1.0.0
 *
 * @package    Cwp_Auctions
 * @subpackage Cwp_Auctions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cwp_Auctions
 * @subpackage Cwp_Auctions/admin
 * @author     Codex WP <info@codexwp.com>
 */
class Cwp_Auctions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->admin_hook_actions();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cwp_Auctions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cwp_Auctions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', array(), $this->version, 'all' );
        wp_enqueue_style('jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', array(), $this->version, 'all' );
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cwp-auctions-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cwp_Auctions_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cwp_Auctions_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array(), $this->version, 'false' );
        wp_enqueue_script('xlsx.core', 'https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.7/xlsx.core.min.js', array(), $this->version, 'false' );
        wp_enqueue_script('xls.core', 'https://cdnjs.cloudflare.com/ajax/libs/xls/0.7.4-a/xls.core.min.js', array(), $this->version, 'false' );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cwp-auctions-admin.js', array( 'jquery' ), $this->version, 'all' );

	}

	public function admin_hook_actions(){
        add_action( 'init', array($this,'create_auction_post_type'), 0 );
        add_action( 'admin_init', array($this, 'create_auction_post_meta_box') );
        add_action( 'save_post', array($this, 'save_auction_meta_fields' ));
    }

    public function create_auction_post_meta_box(){
        add_meta_box("auctions_meta", "Auctions Informations", array($this, 'auction_post_meta_box_html'), "auctions", "normal", "low");
    }

    public function create_auction_post_type(){
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

    public function auction_post_meta_box_html(){
        require plugin_dir_path( __FILE__ ) . 'partials/cwp-auctions-admin-meta-box-html.php';
    }

    public function save_auction_meta_fields()
    {
        if(count($_POST)==0)
            return;
        global $post;
        if($post->post_type != "auctions")
            return;
        if(isset($_POST['start_date']))
        {$start_date = $_POST['start_date'];}
        else
        {$start_date = '';}
        if(isset($_POST['end_date']))
        {$end_date = $_POST['end_date'];}
        else
        {$end_date = '';}
        if(isset($_POST['lot_td1']))
        {$lot_td1  = $_POST['lot_td1'];$lot_td2  = $_POST['lot_td2'];$lot_td3  = $_POST['lot_td3'];}
        else
        {$lot_td1 = array();$lot_td2 = array();$lot_td3 = array();}
        if(isset($_POST['images']))
        {$images = $_POST['images'];}
        else
        {$images = array();}
        $data = array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'images' => $images,
            'lot_td1' =>$lot_td1,
            'lot_td2' =>$lot_td2,
            'lot_td3' =>$lot_td3
        );
        $d = new DateTime($start_date);
        $start_ts = $d->getTimestamp();
        $d = new DateTime($end_date);
        $end_ts = $d->getTimestamp();
        update_post_meta($_POST['post_ID'],'auction_start_ts',$start_ts);
        update_post_meta($_POST['post_ID'],'auction_end_ts',$end_ts);
        update_post_meta($_POST['post_ID'],'auction_title',$_POST['post_title']);
        $json = base64_encode(wp_json_encode($data,true));
        update_post_meta($_POST['post_ID'],'lot_settings',$json);
    }
}
