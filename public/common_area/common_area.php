<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);
		if($_POST["action"] == "add_common_area"){
			// dump($_POST);
			$crypt_id = create_uuid("CRYPT");
			if (query("insert INTO crypt_list (crypt_id, crypt_name, crypt_type)
                        VALUES(?,?,?)", 
                        $crypt_id, $_POST["crypt_name"], "COMMON") === false){
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
					"link" => "refresh",
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
		$common_list = query("select * from crypt_list where crypt_type = 'COMMON'");
		if($_GET["action"] == "list"){
			render("public/common_area/common_area_list.php",
			[
				"common_list" => $common_list,
			]);
		}

		else if($_GET["action"] == "details"){
			$common_area = query("select * from crypt_list where crypt_id = ?", $_GET["id"]);
			$common_area = $common_area[0];

			$crypt_slot = query("select * from crypt_slot s 
                                        left join crypt_list c on c.crypt_id = s.crypt_id");
			$Crypt_slot = [];
			foreach($crypt_slot as $row):
				$Crypt_slot[$row["slot_id"]] = $row;
			endforeach;
			$Profile = [];
			$profile = query("select * from profile_list");
			foreach($profile as $row):
				$Profile[$row["profile_id"]] = $row;
			endforeach;

			$deceased_profile = query("select s.*, d.*, t.slot_id from crypt_slot s left join deceased_profile d
										on s.occupied_by = d.deceased_id
										left join transaction t on t.transaction_id = d.transaction_id
										where crypt_id = ?", $_GET["id"]);
			render("public/common_area/common_area_details.php",
			[
				"common_area" => $common_area,
				"deceased_profile" => $deceased_profile,
				"Profile" => $Profile,
				"Crypt_slot" => $Crypt_slot,
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
