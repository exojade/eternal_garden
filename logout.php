<?php


	if(!isset($_SESSION["eternal_garden"])) {
		redirect("login");
	}
	
	// log out current user, if any
	logout();
	
	// redirect user
	redirect("login");

?>
