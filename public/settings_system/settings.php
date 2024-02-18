<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "updateLawn"):
			// dump($_POST);
			query("update pricing_lawn set
					name = ?,
					pre_need = ?,
					at_need = ?
					where tbl_id = ?
			",
			$_POST["name"],
			$_POST["pre_need"],
			$_POST["at_need"],
			$_POST["tbl_id"]
		);
			
			$link = "schedule";
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on Updating Data",
				"link" => "settings",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		elseif($_POST["action"] == "updateService"):
// dump($_POST);
			query("update services set
			service_name = ?,
			cost = ?
			where service_id = ?
				",
				$_POST["service_name"],
				$_POST["cost"],
				$_POST["service_id"]
			);
				
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Updating Data",
					"link" => "settings",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "updateCoffinSettings"):
			// dump($_POST);

			query("update pricing_coffincrypt set
			type = ?,
			amount = ?,
			certification_amount = ?,
			lapida_amount = ?
			where tbl_id = ?
				",
				$_POST["type"],
				$_POST["amount"],
				$_POST["certification_amount"],
				$_POST["lapida_amount"],
				$_POST["tbl_id"],
			);
				
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Updating Data",
					"link" => "settings",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

					elseif($_POST["action"] == "updateBoneSettings"):
						// dump($_POST);
			
						query("update pricing_bonecrypt set
						type = ?,
						amount = ?,
						certification = ?,
						lapida_amount = ?
						where tbl_id = ?
							",
							$_POST["type"],
							$_POST["amount"],
							$_POST["certification"],
							$_POST["lapida_amount"],
							$_POST["tbl_id"],
						);
							
							$res_arr = [
								"result" => "success",
								"title" => "Success",
								"message" => "Success on Updating Data",
								"link" => "settings",
								// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
								];
								echo json_encode($res_arr); exit();


		
		
		endif;
		
    }
	else {
		if(!isset($_GET["action"])):
			
			// $deceased = query("select * from deceased_profile");
			// $client = query("select * from profile_list");
			render("public/settings_system/settings_form.php",
			[
				// "deceased" => $deceased,
				// "client" => $client,
				// "slot" => $slot,
			]);
		endif;

		
	}
?>
