<?php
namespace check_my_color;
/**
 Plugin Name:  check my color
 Plugin URI: https://color.toshidayurika.com
 Description: This plugin provides personal color check
 Version: 1.0
 Author: Yurika Toshoda
 Author URI: https://color.toshidayurika.com
 License: GPLv2 or later
 Text Domain: contraction

 */


require_once("ColorCheckerClass.php");


Class  Simple_color_class{

public function __construct() {
	add_filter( 'the_content', array($this, 'simple_check_my_color'));
	add_action( 'pre_get_posts', array($this, 'simple_check_displayRet'));
}

public function simple_check_displayRet( $query ) {

	if ( is_admin() ) return;

	if ( is_page('dia-result')) {
		$ColorChecker = new ColorCheckerClass();
		$check_sheet_csv = wp_upload_dir()['basedir']  . "/p_color_check_sheet.csv";

		$ColorChecker->SetCheckFile($check_sheet_csv);
		$ret = $ColorChecker->DisplayRet( $_POST['result'], $_GET['id']);

		$query->set( 'cat', get_cat_ID( $ret ));
		return;
	}
}


public function simple_check_my_color($content){


	if (is_page('diagnosis')){
		if (!isset($_GET['id']))  {
			return $content;  
		}

		$ColorChecker = new ColorCheckerClass();
		$content = $ColorChecker->Replace($content, $_POST['result'], $_POST['page_no'], $_GET['id']);
	}
	return $content;  
}
}


$dummy = new Simple_color_class();








?>
