<?php
	session_start();
	
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
		// Optional: Lösche auch das Session-Cookie
		setcookie(session_name(), '', time() - 7200, '/');
	
		$isUsernameSet = '';
		session_destroy();
		$_SESSION['username'] = '';
		$isUsernameSet = '';
		
		echo "success";
		exit;
	} else {
		echo "error";
		exit;
	}
?>
