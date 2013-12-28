<?php
/*
 * Add a new link via ajax
 */
require_once("links_class.php");

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //requested with Javascript
	while(true) {
		if (empty($_POST['title'])) {
			$return['error'] = true;
	    	$return['msg'] = 'You didn\'t enter a title.';
	    	$return['eh'] = 'title';
	    	break;
		}
		if (empty($_POST['url'])) {
			$return['error'] = true;
	    	$return['msg'] = 'You didn\'t enter a URL.';
	    	$return['eh'] = 'url';
	    	break;
		}
		break;
	}
	if (!$return['error']) {
		$Link->Add_new_link($_POST['title'],$_POST['url'],$_POST['ip'],$_POST['wid']);
		$return['msg'] = 'Your link has been added successfully.';
	}
	echo json_encode($return);


} else {
  header("Location: ". $Link->home_page() );
 die('direct access is forbidden');
}
?>