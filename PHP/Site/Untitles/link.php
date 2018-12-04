<?php  
	function addtoLink($text){
		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
		$url = '<a href="'.$escaped_url.$text.'">'.$escaped_url.'</a>'; 
		return $url;	
	}

	function getLink(){
		$url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
		$url = $escaped_url; 
		return $url;
	}
?>