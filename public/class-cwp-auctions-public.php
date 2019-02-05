<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.codexwp.com/about/
 * @since      1.0.0
 *
 * @package    Cwp_Auctions
 * @subpackage Cwp_Auctions/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cwp_Auctions
 * @subpackage Cwp_Auctions/public
 * @author     Codex WP <info@codexwp.com>
 */
class Cwp_Auctions_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->singe_post_type();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cwp-auctions-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cwp-auctions-public.js', array( 'jquery' ), $this->version, 'all' );

	}

	public function singe_post_type(){
        add_filter('single_template', array($this,'load_single_auctions_template'));
    }

    public function load_single_auctions_template($template) {
        global $post;
        if ($post->post_type == "auctions" && $template !== locate_template(array("single-auctions.php"))){
            require plugin_dir_path( __FILE__ ).'partials/single-auctions.php';
        }
        return $template;
    }

}
