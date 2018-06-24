<?php
class Car {
	private static $instance;
	
	// Private constructor prevents making a Car object using keyword 'new'
	private function __construct() {}
	
	// Singleton implementation
	public static function getInstance() {
		if (!self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	// Register custom post type
	function custom_post_type() {
		
		function mp_car_post_type() {
			$name_singular = 'Car';
			$name_plural = 'Cars';

			$labels = array(
				'name' => $name_singular,
				'singular_name' => $name_singular,
				'add_new' => 'Add ' . $name_singular,
				'all_items' => 'All ' . $name_plural,
				'add_new_item' => 'Add ' . $name_singular,
				'edit_item' => 'Edit ' . $name_singular,
				'new_item' => 'New ' . $name_singular,
				'view_item' => 'View ' . $name_singular,
				'search_item' => 'Search ' . $name_singular,
				'not_found' => 'No ' . $name_plural . ' found',
				'not_found_in_trash' => 'No ' . $name_plural . ' found in trash',
				'parent_item_colon' => 'Parent ' . $name_singular
			);
			$args = array(
				'labels' => $labels,
				'public' => true,
				'has_archive' => true,
				'publicly_queryable' => true,
				'query_var' => true,
				'rewrite' => true,
				'capability_type' => 'post',
				'hierarchical' => false,
				'supports' => array('title', 'editor', 'thumbnail'),
				'taxonomies' => array('location', 'color', 'price'),
				'menu_position' => 3,
				'exclude_from_search' => false,
			);
			register_post_type('car', $args);
		}
		mp_car_post_type();
	}
	
	// Create car taxonomies
	function car_taxonomies() {
		$this->createLocationTaxonomy();
		$this->createPriceTaxonomy();
		$this->createColorTaxonomy();
	}
	
	// Create Location Taxonomy
	function createLocationTaxonomy() {
		$labels = array(
			'name' => 'Locations',
			'singular_name' => 'Location',
			'search_items' => 'Search Locations',
			'all_items' => 'All Locations',
			'edit_item' => 'Edit Location',
			'update_item' => 'Update Location',
			'add_new_item' => 'Add New Location',
			'menu_name' => 'Locations'
		);
		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'location')
		);
		register_taxonomy('location', array('car'), $args);
	}
	
	// Create Price Taxonomy
	function createPriceTaxonomy() {
		$labels = array(
			'name' => 'Prices',
			'singular_name' => 'Price',
			'search_items' => 'Search Prices',
			'all_items' => 'All Prices',
			'edit_item' => 'Edit Price',
			'update_item' => 'Update Price',
			'add_new_item' => 'Add New Price',
			'menu_name' => 'Prices'
		);
		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'price')
		);
		register_taxonomy('price', array('car'), $args);
	}
	
	// Create Color Taxonomy
	function createColorTaxonomy() {
		$labels = array(
			'name' => 'Colors',
			'singular_name' => 'Color',
			'search_items' => 'Search Colors',
			'all_items' => 'All Colors',
			'edit_item' => 'Edit Color',
			'update_item' => 'Update Color',
			'add_new_item' => 'Add New Color',
			'menu_name' => 'Colors'
		);
		$args = array(
			'hierarchical' => false,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'color')
		);
		register_taxonomy('color', array('car'), $args);
	}
	
}
