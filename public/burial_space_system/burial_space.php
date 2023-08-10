<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		

	

		
		
		
    }
	else {
		
		if($_GET["action"] == "list"){
			// $bone_crypt = query("select * from crypt_list where crypt_type = 'BONE'");
			render("public/burial_space_system/burial_space_form.php",
			[
				// "bone_crypt" => $bone_crypt,
			]);
		}
	}
?>
