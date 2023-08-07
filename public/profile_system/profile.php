<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);
		if($_POST["action"] == "add_client"):
			// dump($_POST);
			$profile_id = create_uuid("PROF");
			$t = strtotime($_POST["lease_date"]);
			$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			if (query("insert into profile_list 
				(profile_id,client_name,client_address,client_contact,gender,id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number,lease_status
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,$_POST["client_name"],$_POST["client_address"],$_POST["client_contact"],
				$_POST["gender"],$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"],$_POST["lease_status"],
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}

				$transaction_id = create_uuid("LOGS");
				$message = $_POST["client_name"] . " availed LEASE from " . $_POST["lease_date"] . " to " . $lease_expired;
				if (query("insert into transaction_logs 
				(transaction_id,slot_number,transaction_type,message,timestamp,transaction_date,transaction_time,services_availed) 
				VALUES(?,?,?,?,?,?,?,?)", 
				$transaction_id,$_POST["slot_number"],"LEASE",$message,
				time(),date("Y-m-d"),date("h:i:s a"),""
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				query("update crypt_slot set occupied_by = ?, active_status = 'OCCUPIED' where slot_id = ?", $profile_id, $_POST["slot_number"]);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "lawn?action=slot_details&slot=".$_POST["slot_number"],
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		elseif($_POST["action"] == "add_deceased"):
			$datetime1 = new DateTime($_POST["birthdate"]);
			$datetime2 = new DateTime($_POST["date_of_death"]);
			$interval = $datetime1->diff($datetime2);
			$age = $interval->format('%y');

			$deceased_id = create_uuid("DEC");
			if (query("insert into deceased_profile 
				(deceased_id,deceased_name,birthdate,date_of_death,age_died,religion,gender,burial_date,
					slot_number,burial_status,profile_id,interment_type
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?)", 
				$deceased_id,$_POST["deceased_name"],$_POST["birthdate"],$_POST["date_of_death"],
				$age,$_POST["religion"],$_POST["gender"],"",
				$_POST["slot_number"],"NO BURIAL DATE",$_POST["client_id"],$_POST["interment_type"],
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}


			$transaction_id = create_uuid("LOGS");
				$message = $_POST["deceased_name"] . " was added to this slot";
				if (query("insert into transaction_logs 
				(transaction_id,slot_number,transaction_type,message,timestamp,transaction_date,transaction_time,services_availed) 
				VALUES(?,?,?,?,?,?,?,?)", 
				$transaction_id,$_POST["slot_number"],"DECEASED PROFILE",$message,
				time(),date("Y-m-d"),date("h:i:s a"),""
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}


				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "lawn?action=slot_details&slot=".$_POST["slot_number"],
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		endif;
	

		


		
		
		
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
