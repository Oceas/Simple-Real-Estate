<?php

/**
 * Plugin Name: Simple Real Estate
 * Description: Easily organize and display Property Listings.
 * Version:     1.0
 * Author:      Scott Anderson
 * Author URI:  https://thriftydeveloper.com
 * License:     GPL2
 * Textdomain:  simple-real-estate
 *
 */


define('CS_DIRECTORY', __DIR__);

if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
	require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
	require_once dirname(__FILE__) . '/CMB2/init.php';
}

require CS_DIRECTORY . '/listings.php';
require CS_DIRECTORY . '/agents.php';

new Listings();
new Agents();
