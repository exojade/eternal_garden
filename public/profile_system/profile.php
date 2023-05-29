<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);
	

		


		
		
		
    }
	else {
		
		$profile = query("select p.*, s.slot_id, c.crypt_name, s.slot_number, s.row_number, s.column_number from profile_list p
							left join crypt_slot s
							on s.slot_id = p.slot_number
							left join crypt_list c
							on c.crypt_id = s.crypt_id");
		// dump($profile);
		if($_GET["action"] == "list"){
			render("public/profile_system/profile_list.php",
			[
				"profile" => $profile,
			]);
		}

		if($_GET["action"] == "details"){
			// dump($_GET);
			$type = query("select * from crypt_slot s
							left join crypt_list c
							on s.crypt_id = c.crypt_id
							where s.slot_id = ?
								", $_GET["id"]);
			$crypt_id = $type[0]["crypt_id"];
			$type = $type[0]["crypt_type"];

			if($type == "BONE"){

				$crypt_name = query("select * from crypt_slot s
									left join crypt_list c
									on s.crypt_id = c.crypt_id
									where s.slot_id = ?					
				", $_GET["id"]);
				$crypt_name = $crypt_name[0];

				$profiles = query("select * from profile_list p
								left join crypt_slot s
								on s.slot_id = p.slot_number
								left join crypt_list c
								on c.crypt_id = s.crypt_id
								left join transaction t
								on t.transaction_id = p.current_transaction_id
								where p.slot_number = ?", $_GET["id"]);
								// dump(count($profiles));
				// dump($profiles);
				render("public/profile_system/profile_details_bones.php",
				[
					"profiles" => $profiles,
					"crypt_name" => $crypt_name,
				]);

			}

			else if($type == "MAUSOLEUM"){
				redirect("mausoleum?action=details&id=".$crypt_id);
			}

			else{

				$profiles = query("select * from profile_list p
								left join crypt_slot s
								on s.slot_id = p.slot_number
								left join crypt_list c
								on c.crypt_id = s.crypt_id
								left join transaction t
								on t.transaction_id = p.current_transaction_id
								where p.slot_number = ?", $_GET["id"]);
								// dump($profiles);
			
			render("public/profile_system/profile_details.php",
			[
				"profiles" => $profiles,
			]);

			}


			
			
			
		}
	}
?>
