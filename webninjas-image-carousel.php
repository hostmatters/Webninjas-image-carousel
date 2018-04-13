<?php
/*
Plugin Name: Webninjas-image-carousel

Description: Rotate sidebar HTML
Version: 1.3
Author: Niels
Author URI: www.hostmatters.nl
License: 

*/

if(	!defined('ABSPATH')) 
{
	die('You are not allowed to call this page directly.');
}

class webninjas_image_carousel extends WP_Widget {
	
	function webninjas_image_carousel() {
		parent::__construct(false, $name = __('Webninjas: image carousel', 'webninjas_image_carousel') );
	}

	function widget($args, $instance) 
	{
		$dir = plugin_dir_path( __FILE__ );

				$handle = fopen($dir . "banners.txt", "r");
			if ($handle) {
			    while (($line = fgets($handle)) !== false) {
				    if (trim($line) != ''){
			        	$arr[] = trim($line); 
					}
			    }
			    $count = count($arr);
			    $total = $count -1;
			    
			    if ($count < 4){
				    die('Te weinig (unieke) links in tekstbestand'); 
			    }
			    
			    $x = 1;
			    $killswitch = 1;
			    $pastnumbers = array();
			    while($x <= 4) {
					   echo '<p></p>';			    

				    $number = rand(0, $total);
				    if (!in_array($number, $pastnumbers))
				    {

					   echo '<span class="span_1_of_2 nr-col col-2">';		    
					   echo $arr[$number]; 
					   echo '</span>';
					   $x++;
					   $pastnumbers[] = $number; 
				    }else{
					    // do nothing //
				    } 
				 	   
					$killswitch++;	
					if ($killswitch > 10){
						exit();
					}
				}	
			    fclose($handle);
			}
	}
}

add_action('widgets_init', create_function('', 'return register_widget("webninjas_image_carousel");'));


	/* Update from github if any */
	require 'plugin-update-checker/plugin-update-checker.php';
		$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
			'https://github.com/hostmatters/Webninjas-image-carousel/',
			__FILE__,
			'Webninjas-image-carousel'
		);

?>
