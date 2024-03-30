<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		
		
		
    }
	else {
		if(!isset($_GET["action"])):
			
			// $deceased = query("select * from deceased_profile");
			// $client = query("select * from profile_list");
			render("public/notification_system/notification_list.php",
			[
				// "deceased" => $deceased,
				// "client" => $client,
				// "slot" => $slot,
			]);
		endif;

		
	}
?>
