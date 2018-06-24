<?php
/**
 * @package MP
 */
/*
Plugin Name: Cars
Plugin URI: www.google.com
Decription: Plugin for listing cars
Version: 1.0.0
Author: Milos Pejovic
Author URI: https://www.linkedin.com/in/milo%C5%A1-pejovi%C4%87-766a9526/
License: GPLv2 or later
*/

// Die if accessed directly
if (!defined('ABSPATH')) {
	die();
}

require_once 'CarClass.php';

// Plugin class
class CarsPlugin {
	public $car;
	
	// Constructor
	function __construct() {
		$car = Car::getInstance();
		add_action('init', array($car, 'custom_post_type'));
		add_action('init', array($car, 'car_taxonomies'));
	}
	
	// Activation
	function activate() {
		$car = Car::getInstance();
		$car->custom_post_type();
		flush_rewrite_rules();
	}
	
	// Deactivation
	function deactivate() {
		flush_rewrite_rules();
	}
	
}

$carsPlugin = new CarsPlugin();

register_activation_hook(__FILE__, array($carsPlugin, 'activate'));
register_deactivation_hook(__FILE__, array($carsPlugin, 'deactivate'));
