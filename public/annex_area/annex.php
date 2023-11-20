<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_POST);


		if($_POST["action"] == "addClient"):
			// dump($_POST);

			$crypt_slot_id = create_uuid("CRYPT_SLOT");
			$profile_id = create_uuid("PROF");
			if (query("insert into profile_list 
				(
					profile_id,
					client_firstname,client_middlename,client_lastname,client_suffix,
					client_contact,email_address,gender,
					province,city_municipality,barangay,client_address,
					id_presented,id_number,place_issued,slot_number
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,
				$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["suffix"],
				$_POST["client_contact"],$_POST["email_address"],$_POST["gender"],
				$_POST["province"],$_POST["city_mun"],$_POST["barangay"],$_POST["client_address"],
				$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],$crypt_slot_id
				) === false):
					apologize("Sorry, that username has already been taken!");
				endif;
			$target_pdf = "uploads/" . $profile_id."/";
			if (!file_exists($target_pdf )) {
				mkdir($target_pdf , 0777, true);
			}
			if($_FILES["certificate_indigency"]["size"] != 0):
				$path_parts = pathinfo($_FILES["certificate_indigency"]["name"]);
				$extension = $path_parts['extension'];
				$target = $target_pdf . "INDIGENCY" . "." . $extension;
                    if(!move_uploaded_file($_FILES['certificate_indigency']['tmp_name'], $target)){
                        echo("FAMILY Do not have upload files");
                        exit();
                    }
			query("update profile_list set certificate_indigency = '".$target."'
					where profile_id = '".$profile_id."'");
			endif;
			if($_FILES["valid_id"]["size"] != 0):
				$path_parts = pathinfo($_FILES["valid_id"]["name"]);
				$extension = $path_parts['extension'];
				$target = $target_pdf . "ID" . "." . $extension;
                    if(!move_uploaded_file($_FILES['valid_id']['tmp_name'], $target)){
                        echo("FAMILY Do not have upload files");
                        exit();
                    }
			query("update profile_list set valid_id = '".$target."'
					where profile_id = '".$profile_id."'");
			endif;

			if($_FILES["picture"]["size"] != 0):
				$path_parts = pathinfo($_FILES["picture"]["name"]);
				$extension = $path_parts['extension'];
				$target = $target_pdf . "PICTURE" . "." . $extension;
                    if(!move_uploaded_file($_FILES['picture']['tmp_name'], $target)){
                        echo("FAMILY Do not have upload files");
                        exit();
                    }
			query("update profile_list set picture = '".$target."'
					where profile_id = '".$profile_id."'");
			endif;


			if (query("insert into crypt_slot 
				(
					slot_id,crypt_id,active_status,occupied_by,crypt_slot_type
				) 
				VALUES(?,?,?,?,?)", 
				$crypt_slot_id,$_POST["crypt_id"],"OCCUPIED",$profile_id,"ANNEX"
				
				) === false):
					apologize("Sorry, that username has already been taken!");
				endif;
			
			
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "profile?action=client_details&slot=".$crypt_slot_id,
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

				endif;









		if($_POST["action"] == "add_annex"){
			// dump($_POST);
			$crypt_id = create_uuid("CRYPT");
			if (query("insert INTO crypt_list (crypt_id, crypt_name, crypt_type)
                        VALUES(?,?,?)", 
                        $crypt_id, $_POST["crypt_name"], "ANNEX") === false){
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


		if($_POST["action"] == "addDeceased"):


			$datetime1 = new DateTime($_POST["birthdate"]);
			$datetime2 = new DateTime($_POST["date_of_death"]);
			$interval = $datetime1->diff($datetime2);
			$age = $interval->format('%y');
	

			
			// dump($_POST);


			$deceased_id = create_uuid("DEC");
			$_POST["deceased_name"] = $_POST["firstname"] . " " . $_POST["middlename"]. " " . $_POST["lastname"] . $_POST["suffix"];
			if (query("INSERT INTO deceased_profile 
            (deceased_id, deceased_name, deceased_firstname, deceased_middlename, deceased_lastname, deceased_suffix, birthdate, date_of_death, age_died, religion, gender, burial_date, slot_number, burial_status, profile_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            $deceased_id, $_POST["deceased_name"], $_POST["firstname"], $_POST["middlename"], $_POST["lastname"],
            $_POST["suffix"], $_POST["birthdate"], $_POST["date_of_death"],
            $age, $_POST["religion"], $_POST["gender"], "", // Make sure you provide the correct value here
            $_POST["slot_number"], "DONE", $_POST["client_id"]
            ) === false) {
			dump("error");
			}
				$fullname = strtoupper($_POST["lastname"] . "_" . $_POST["firstname"] . "_" . $_POST["middlename"] . "_" . $_POST["suffix"]);
				$fullname = str_replace(' ', '_', $fullname);
				$target_pdf = "uploads/deceased/" . $deceased_id."/";
				if (!file_exists($target_pdf )) {
					mkdir($target_pdf , 0777, true);
				}
	

				if($_FILES["death_certificate"]["size"] != 0):
					$path_parts = pathinfo($_FILES["death_certificate"]["name"]);
					$extension = $path_parts['extension'];
					$target = $target_pdf . "DEATHCERTIFICATE" . "." . $extension;
						if(!move_uploaded_file($_FILES['death_certificate']['tmp_name'], $target)){
							echo("FAMILY Do not have upload files");
							exit();
						}
				query("update deceased_profile set death_certificate = '".$target."'
						where deceased_id = '".$deceased_id."'");
				endif;


			// $transaction_id = create_uuid("LOGS");
			// 	$message = $_POST["deceased_name"] . " was added to this slot";
			// 	if (query("insert into transaction_logs 
			// 	(transaction_id,slot_number,transaction_type,message,timestamp,transaction_date,transaction_time,services_availed) 
			// 	VALUES(?,?,?,?,?,?,?,?)", 
			// 	$transaction_id,$_POST["slot_number"],"DECEASED PROFILE",$message,
			// 	time(),date("Y-m-d"),date("h:i:s a"),""
			// 	) === false)
			// 	{
			// 		apologize("Sorry, that username has already been taken!");
			// 	}


				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "refresh",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		endif;

		
		
		
    }
	else {
		$annex_list = query("select * from crypt_list where crypt_type = 'ANNEX'");
		if($_GET["action"] == "list"){
			render("public/annex_area/annex_list.php",
			[
				"annex_list" => $annex_list,
			]);
		}

		else if($_GET["action"] == "details"){
			$annex = query("select * from crypt_list where crypt_id = ?", $_GET["id"]);
			$annex = $annex[0];

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
			render("public/annex_area/annex_details.php",
			[
				"annex" => $annex,
				"deceased_profile" => $deceased_profile,
				"Profile" => $Profile,
				"Crypt_slot" => $Crypt_slot,
			]);
		}

		if($_GET["action"] == "client_details"){
			$slot = query("select * from crypt_slot where slot_id = ?", $_GET["slot"]);
			$client = query("select * from profile_list where profile_id = ?", $slot[0]["occupied_by"]);
			if(!empty($client)):
				// dump($client);
			$deceased = query("select * from deceased_profile where profile_id = ?", $client[0]["profile_id"]);
			else:
			$deceased = "";
			endif;
			// dump($deceased);
			$slot = query("select  * from crypt_slot as slot
							left join crypt_list as crypt
							on slot.crypt_id = crypt.crypt_id
							where slot.slot_id = ?", $_GET["slot"]);
			$slot = $slot[0];
			// dump($client);
			render("public/annex_area/annex_profile_details.php",
			[
				"client" => $client,
				"deceased" => $deceased,
				"slot" => $slot,
			]);
		}
		
	}
?>
