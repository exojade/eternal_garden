<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		
		
    }
	else {

		if($_GET["action"] == "list"){
			render("public/transfer_system/transfer_list.php",[]);
		}

		
	}
?>
