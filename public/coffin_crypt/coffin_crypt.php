<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);
		if($_POST["action"] == "add_coffin_crypt"){
			// dump($_POST);
			$crypt_id = create_uuid("CRYPT");
			$inserts = array();
        	$queryFormat = "('%s','%s','%s','%s','%s','%s','%s','%s','%s')";
			if (query("insert INTO crypt_list (crypt_id, crypt_name, crypt_type, crypt_rows, crypt_columns)
                        VALUES(?,?,?,?,?)", 
                        $crypt_id, $_POST["crypt_name"], "COFFIN", $_POST["crypt_rows"], $_POST["crypt_columns"]) === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
                        }
			$slot_number = 1;

			


			for($i = 1; $i <= $_POST["crypt_rows"]; $i++):
				for($j = 1; $j<=$_POST["crypt_columns"]; $j++){
					$crypt_slot_id = create_uuid("CRYPT_SLOT");
					$inserts[] = sprintf(
						$queryFormat, $crypt_slot_id, $crypt_id, "VACANT","",$slot_number, $i, $j, "FRONT", "COFFIN");
						$slot_number++;
				}	
			endfor;

			for($i = 1; $i <= $_POST["crypt_rows"]; $i++):
				for($j = 1; $j<=$_POST["crypt_columns"]; $j++){
					$crypt_slot_id = create_uuid("CRYPT_SLOT");
					$inserts[] = sprintf(
						$queryFormat, $crypt_slot_id, $crypt_id, "VACANT","",$slot_number, $i, $j, "BACK", "COFFIN");
						$slot_number++;
				}	
			endfor;


			$query = implode( ",", $inserts );
                $query_string = "insert into crypt_slot
                (slot_id, crypt_id, active_status,occupied_by,slot_number, row_number, column_number, face, crypt_slot_type) 
                VALUES " . $query;
                // dump($query_string);
			query($query_string);

				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "coffin_crypt?action=list",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "new_coffin_crypt"){
			// dump($_POST);
			$Requirements = [];
			$requirements = query("select * from requirements");

			$price = query("select * from pricing where pricing_id = ?", $_POST["pricing"]);
			$price = $price[0];

			//main
			$pricing_availed = [];
			$i=0;
			if(isset($_POST["crypt_cost"])){
				$pricing_availed[$i]["cost_name"] = "crypt_cost";
				if($_POST["profile_type"] == "indigent")
					$pricing_availed[$i]["cost"] = $price["indigent_cost"];
				else
					$pricing_availed[$i]["cost"] = $price["original_cost"];
				$i++;
			}

			if(isset($_POST["lapida_cost"])){
				$pricing_availed[$i]["cost_name"] = "lapida_cost";
				$pricing_availed[$i]["cost"] = $price["lapida_cost"];
				$i++;
			}

			if(isset($_POST["certification_cost"])){
				$pricing_availed[$i]["cost_name"] = "certification_cost";
				$pricing_availed[$i]["cost"] = $price["certification_cost"];
				$i++;
			}
			$pricing_availed = serialize($pricing_availed);
			

			//endmain
			$i=0;
			foreach($requirements as $r):
				if(isset($_POST[$r["requirements_id"]])){
					$Requirements[$i]["requirement"] = $r["requirement"];
				}
				$i++;
			endforeach;

			$Requirements = serialize($Requirements);
			

			$Services = [];
			$services = query("select * from services");
			$i=0;
			foreach($services as $s):
				if(isset($_POST[$s["service_id"]])){
					$Services[$i]["service"] = $s["service_name"];
					$Services[$i]["cost"] = $s["cost"];
				}
				$i++;
			endforeach;
			$Services = serialize($Services);
			// dump($Services);
			// dump($_POST);
			$t = strtotime($_POST["deceased_burial_date"]);
			$date_expired = date('Y-m-d', strtotime('+5 years', $t));
			// dump($_POST);

			$profile_id = create_uuid("PROF");
			if (query("insert INTO profile_list (profile_id, client_name,deceased_name, deceased_dob, deceased_date_death,
													deceased_burial_date, slot_number, client_contact,
													client_address,active_status, pricing_availed, requirements, services_availed,
													date_expired,total_fee
													)
                        VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
                        $profile_id, $_POST["client_name"], $_POST["deceased_name"], $_POST["deceased_dob"], $_POST["deceased_date_death"],
						$_POST["deceased_burial_date"], $_POST["slot_id"], $_POST["client_contact"],
						$_POST["client_address"], "PAID", $pricing_availed, $Requirements, $Services,$date_expired,$_POST["total_fee"]
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
			
			$sched_id = create_uuid("SCHED");
			$_POST["deceased_burial_time"] = date("H:i", strtotime($_POST["deceased_burial_time"]));
			if (query("insert INTO burial_schedule (profile_id, burial_date,burial_time, remarks, schedule_id)
						VALUES(?,?,?,?,?)", 
						$profile_id, $_POST["deceased_burial_date"], $_POST["deceased_burial_time"], $_POST["remarks"],$sched_id
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

			$transaction_id = create_uuid("TR");
			if (query("insert INTO transaction (transaction_id, date,time, total_fee, pricing_availed,requirements,services)
						VALUES(?,?,?,?,?,?,?)", 
						$transaction_id, date("Y-m-d"), date("H:i:s"), $_POST["total_fee"],  $pricing_availed,
						$Requirements, $Services
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

			query("update profile_list set current_transaction_id = ?
						where profile_id = ?", $transaction_id, $profile_id);


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
		$coffin_crypt = query("select * from crypt_list where crypt_type = 'coffin'");
		if($_GET["action"] == "list"){
			render("public/coffin_crypt/coffin_crypt_list.php",
			[
				"coffin_crypt" => $coffin_crypt,
			]);
		}

		else if($_GET["action"] == "details"){
			$coffin_crypt = query("select * from crypt_list where crypt_id = ?", $_GET["id"]);
			$coffin_crypt = $coffin_crypt[0];
			$crypt_slots = query("select * from crypt_slot where crypt_id = ?", $_GET["id"]);
			render("public/coffin_crypt/coffin_crypt_details.php",
			[
				"coffin_crypt" => $coffin_crypt,
				"crypt_slots" => $crypt_slots,
			]);
		}

		else if($_GET["action"] == "new"){
			// dump($_GET);
			$coffin = query("select * from pricing where type='coffin_crypt'");
			$slot = query("select * from crypt_slot s
							left join crypt_list l
							on l.crypt_id = s.crypt_id
							 where s.slot_id = ?", $_GET["slot_id"]);
			$slot = $slot[0];
			// dump($slot);
			$requirements = query("select * from requirements where pricing_id = ?", $coffin[0]["pricing_id"]);
			$services = query("select * from services");

			// dump($crypt_slots);
			render("public/coffin_crypt/new_coffin_crypt.php",
			[
				"coffin" => $coffin,
				"requirements" => $requirements,
				"services" => $services,
				"slot" => $slot,
			]);
		}
	}
?>
