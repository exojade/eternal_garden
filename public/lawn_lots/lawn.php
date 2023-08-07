<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "filter_lawn"){
			// dump($_POST);
			$link = "lawn?action=details&id=".$_POST["id"]."&filter=".$_POST["filter"]."";
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
	
		

		
		
		
    }
	else {
		$lawn = query("select * from crypt_list where crypt_type = 'LAWN'");
		if($_GET["action"] == "list"){
			render("public/lawn_lots/lawn_list.php",
			[
				"lawn" => $lawn,
			]);
		}

		else if($_GET["action"] == "details"){
			$lawn = query("select * from crypt_list where crypt_id = ?", $_GET["id"]);
			$lawn = $lawn[0];
			$lawn_lots = query("select * from crypt_slot where crypt_id = ?", $_GET["id"]);
			// dump($crypt_slots);
			render("public/lawn_lots/lawn_details.php",
			[
				"lawn" => $lawn,
				"lawn_lots" => $lawn_lots,
			]);
		}

		else if($_GET["action"] == "slot_details"){
			$client = query("select * from profile_list where slot_number = ?", $_GET["slot"]);
			if(!empty($client)):
			$deceased = query("select * from deceased_profile where profile_id = ?", $client[0]["profile_id"]);
			else:
			$deceased = "";
			endif;

			$slot = query("select * from crypt_slot as slot
							left join crypt_list as crypt
							on slot.slot_id = crypt.crypt_id
							where slot.slot_id = ?", $_GET["slot"]);

			$slot = $slot[0];


			// $lawn_lots = query("select * from crypt_slot where crypt_id = ?", $_GET["slot"]);
			// dump($crypt_slots);
			render("public/lawn_lots/slot_details.php",
			[
				// "lawn" => $lawn,
				// "lawn_lots" => $lawn_lots,
				"client" => $client,
				"deceased" => $deceased,
				"slot" => $slot,
			]);
		}

		else if($_GET["action"] == "new"){
			// dump($_GET);
			$coffin = query("select * from pricing where type='coffin_crypt'");
		
			// dump($slot);
			$requirements = query("select * from requirements where pricing_id = ?", $coffin[0]["pricing_id"]);
			$services = query("select * from services");

			// dump($crypt_slots);
			render("public/lawn_lots/new_lawn.php",
			[
				"coffin" => $coffin,
				"requirements" => $requirements,
				"services" => $services,
			]);
		}
	}
?>
