<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "filter_lawn"){
			// dump($_POST);
			$link = "maps?filter=".$_POST["filter"]."";
			// dump($link);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => $link,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "assign_crypt"):
			// dump($_POST);
			$coordinates = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);
			query("update crypt_list set coordinates = ? where crypt_id = ?", $coordinates[0]["coordinates"],$_POST["crypt"]);
			query("update crypt_slot set crypt_slot_type = 'TAKEN' where slot_id = ?",$_POST["slot_id"]);
			$link = "maps?filter=ALL";
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => $link,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		endif;


		if($_POST["action"] == "modal_crypt_profile"):
			// dump($_POST);
			$crypt = query("select * from crypt_list
								where crypt_id = ?", $_POST["slot_number"]);
			$crypt = $crypt[0];
			if($crypt["crypt_type"] == "COFFIN"):
				$message = '
				<h3 class="text-center">'.$crypt["crypt_name"].'</h3>
				<div class="text-center"><a target="_blank" href="coffin_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);

			elseif($crypt["crypt_type"] == "BONE"):
				$message = '
				<h3 class="text-center">'.$crypt["crypt_name"].'</h3>
				<div class="text-center"><a target="_blank" href="bone_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);

			elseif($crypt["crypt_type"] == "MAUSOLEUM"):
				$message = '
				<h3 class="text-center">'.$crypt["crypt_name"].'</h3>
				<div class="text-center"><a target="_blank" href="mausoleum?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);
			endif;

			
				
				
		endif;


		
		
		
    }
	else {
	
			$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
			$coffin = query("select * from crypt_list where crypt_type = 'COFFIN'");
			$bone = query("select * from crypt_list where crypt_type = 'BONE'");
			$lawn = query("select * from crypt_slot where crypt_slot_type = 'LAWN'");

			$no_slot = query("select * from crypt_slot where crypt_slot_type = 'NO_SLOT'");


			render("public/maps_system/maps_details.php",
			[
				"lawn" => $lawn,
				"coffin" => $coffin,
				"mausoleum" => $mausoleum,
				"bone" => $bone,
				"no_slot" => $no_slot,
			]);
	
	}
?>
