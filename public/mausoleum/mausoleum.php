<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);
		if($_POST["action"] == "add_mausoleum"){
			// dump($_POST);
			$crypt_id = create_uuid("CRYPT");



			if (query("insert INTO crypt_list (crypt_id, crypt_name, crypt_type)
                        VALUES(?,?,?)", 
                        $crypt_id, $_POST["crypt_name"], "MAUSOLEUM") === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
                        }
		
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "mausoleum?action=list",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "new_mausoleum_profile"){
			// dump($_POST);
			$crypt_slot_id = create_uuid("CRYPT_SLOT");
			if (query("insert INTO crypt_slot (slot_id, crypt_id, active_status, crypt_type)
                        VALUES(?,?,?,?)", 
                        $crypt_slot_id, $_POST["crypt_id"], "OCCUPIED" , "MAUSOLEUM") === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
                        }


			$profile_id = create_uuid("PROF");
			if (query("insert INTO profile_list (profile_id, client_name,deceased_name, deceased_dob, deceased_date_death,
													deceased_burial_date, slot_number, client_contact,
													client_address,active_status
													)
                        VALUES(?,?,?,?,?,?,?,?,?,?)", 
                        $profile_id, $_POST["client_name"], $_POST["deceased_name"], $_POST["deceased_dob"], $_POST["deceased_date_death"],
						$_POST["deceased_burial_date"], $crypt_slot_id, $_POST["client_contact"],
						$_POST["client_address"], "PAID") === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
							}
				
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "mausoleum?action=details&id=".$_POST["crypt_id"],
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "new_bone_crypt"){
			
			// dump($Services);

			
			$price = query("select * from pricing where type = 'bone_crypt'");
			$price = $price[0];
			$Deceased = [];

			$i=0;
			foreach($_POST["deceased_name"] as $deceased):
				if($_POST["deceased_name"] != ""){
					$Deceased[$i]["deceased_name"] = $_POST["deceased_name"][$i];
					$Deceased[$i]["deceased_dob"] = $_POST["deceased_dob"][$i];
					$Deceased[$i]["deceased_date_death"] = $_POST["deceased_date_death"][$i];
					$Deceased[$i]["deceased_burial_date"] = $_POST["deceased_burial_date"][$i];
				}
				$i++;
			endforeach;


			$pricing_availed = [];
			$i=0;
			if(isset($_POST["lapida_cost"])){
				$pricing_availed[$i]["cost_name"] = "lapida_cost";
				$pricing_availed[$i]["cost"] = $price["lapida_cost"];
				$i++;
			}

			if(isset($_POST["certficiation_cost"])){
				$pricing_availed[$i]["cost_name"] = "certification_cost";
				$pricing_availed[$i]["cost"] = $price["certification_cost"];
				$i++;
			}
			// dump($_POST);
			if($_POST["bone_options"] == "one_bone"){
				$pricing_availed[$i]["cost_name"] = "crypt_cost_one_bone";
				$pricing_availed[$i]["cost"] = $price["original_cost"] + $price["one_bone"];
			}
			else if($_POST["bone_options"] == "two_bone"){
				$pricing_availed[$i]["cost_name"] = "crypt_cost_two_bone";
				$pricing_availed[$i]["cost"] = $price["original_cost"] + $price["two_bone"];
			}
			else{
				$pricing_availed[$i]["cost_name"] = "crypt_cost_three_bone";
				$pricing_availed[$i]["cost"] = $price["original_cost"] + $price["three_bone"];
			}
			// dump($_POST);
			$pricing_availed = serialize($pricing_availed);

			$transaction_id = create_uuid("TR");
			if (query("insert INTO transaction (transaction_id, date,time, total_fee, pricing_availed)
                        VALUES(?,?,?,?,?)", 
                        $transaction_id, date("Y-m-d"), date("H:i:s"), $_POST["total"],  $pricing_availed
						) === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
							}

			foreach($Deceased as $d):

			$profile_id = create_uuid("PROF");
			if (query("insert INTO profile_list (profile_id, client_name,deceased_name, deceased_dob, deceased_date_death,
													deceased_burial_date, slot_number, client_contact,
													client_address,active_status, pricing_availed, total_fee,
													current_transaction_id
													)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 
                        $profile_id, $_POST["client_name"], $d["deceased_name"], $d["deceased_dob"], $d["deceased_date_death"],
						$d["deceased_burial_date"], $_POST["slot_id"], $_POST["client_contact"],
						$_POST["client_address"], "PAID", $pricing_availed, $_POST["total"], $transaction_id
						) === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
							}
			endforeach;

						query("update crypt_slot set active_status = 'OCCUPIED' where slot_id = ?", $_POST["slot_id"]);
							$res_arr = [
								"result" => "success",
								"title" => "Success",
								"message" => "Success on adding Data",
								"link" => "coffin_crypt?action=list",
								// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
								];
								echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "add_profile"){
			// dump($_POST);
			$profile_id = create_uuid("PROF");
			if (query("insert INTO profile_list (profile_id, client_name,deceased_name, deceased_dob, deceased_date_death,
													deceased_burial_date, slot_number, client_contact,
													client_address,active_status,
													crypt_fee,lapida,certification_fee
													)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 
                        $profile_id, $_POST["purchaser_name"], $_POST["deceased_name"], $_POST["deceased_dob"], $_POST["deceased_dod"],
						$_POST["burial_date"], $_POST["slot_id"], $_POST["purchaser_contact"],
						$_POST["purchaser_address"], "PAID",
						$_POST["crypt_fee"], $_POST["lapida_installation"], $_POST["certification_fee"]
						) === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
							}
						query("update crypt_slot set occupied_by = ?, active_status = 'OCCUPIED' where slot_id = ?",
								$profile_id, $_POST["slot_id"]);
							$res_arr = [
								"result" => "success",
								"title" => "Success",
								"message" => "Success on adding Data",
								"link" => "coffin_crypt?action=list",
								// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
								];
								echo json_encode($res_arr); exit();



		}

		
		
		
    }
	else {
		
		if($_GET["action"] == "list"){
			$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
			render("public/mausoleum/mausoleum_list.php",
			[
				"mausoleum" => $mausoleum,
			]);
		}

		else if($_GET["action"] == "details"){
			$crypt_name = query("select * from crypt_list where crypt_id = ?", $_GET["id"]);
			$crypt_name = $crypt_name[0];
			$occupants = query("select * from crypt_slot c
				left join profile_list p
				on p.slot_number = c.slot_id					
				where crypt_id = ?", $_GET["id"]);
			// dump($occupants);
			render("public/mausoleum/mausoleum_details.php",
			[
				"crypt_name" => $crypt_name,
				"occupants" => $occupants,
			]);
		}

	}
?>
