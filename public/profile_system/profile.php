<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "add_client"):
			// dump($_FILES);
			$_POST["client_name"] = $_POST["first_name"] . " " . $_POST["last_name"];
			if($_POST["crypt_slot_type"] == "LAWN"):
			// dump($_POST);
			$profile_id = create_uuid("PROF");
			$_POST["lease_date"] = "";
			// $t = strtotime($_POST["lease_date"]);
			// $lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			$lease_expired = "";
			$requirements = "";
			
			if (query("insert into profile_list 
				(
					profile_id,
					client_firstname,client_middlename,client_lastname,client_suffix,
					client_contact,email_address,gender,
					province,city_municipality,barangay,client_address,
					id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number,lease_status,residency
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,
				$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["suffix"],
				$_POST["client_contact"],$_POST["email_address"],$_POST["gender"],
				$_POST["province"],$_POST["city_mun"],$_POST["barangay"],$_POST["client_address"],
				$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"],$_POST["lease_status"],$_POST["residency"]
				
				) === false):
					apologize("Sorry, that username has already been taken!");
				endif;

			elseif($_POST["crypt_slot_type"] == "COFFIN"):

			$profile_id = create_uuid("PROF");
			$t = strtotime($_POST["lease_date"]);
			$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			// dump($lease_expired);
			if (query("insert into profile_list 
				(
					profile_id,
					client_firstname,client_middlename,client_lastname,client_suffix,
					client_contact,email_address,gender,
					province,city_municipality,barangay,client_address,
					id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number,occupant_type
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,
				$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["suffix"],
				$_POST["client_contact"],$_POST["email_address"],$_POST["gender"],
				$_POST["province"],$_POST["city_mun"],$_POST["barangay"],$_POST["client_address"],
				$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"],$_POST["occupant_type"]
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				else;
				$notification_id = create_uuid("NOTIF");
				$one_year_before = date('Y-m-d', strtotime('-1 year', strtotime($lease_expired)));
				$six_months_before = date('Y-m-d', strtotime('-6 months', strtotime($lease_expired)));
				$three_months_before = date('Y-m-d', strtotime('-3 months', strtotime($lease_expired)));
				$one_month_before = date('Y-m-d', strtotime('-1 month', strtotime($lease_expired)));
				$one_week_before = date('Y-m-d', strtotime('-1 week', strtotime($lease_expired)));
				$one_day_before = date('Y-m-d', strtotime('-1 day', strtotime($lease_expired)));
				if (query("insert into notification 
				(
					notification_id, profile_id, slot_id,
					year_date,6months_date,3months_date,month_date,
					week_date,day_before_date,date_expired
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?)",
				$notification_id, $profile_id, $_POST["slot_number"],
				$one_year_before,$six_months_before,$three_months_before,$one_month_before,
				$one_week_before,$one_day_before,$lease_expired) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				else;



				if (query("insert into notification_status 
				(
					notification_id
				) 
				VALUES(?)",
				$notification_id) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				else;

				







		
				
			elseif($_POST["crypt_slot_type"] == "BONE"):

			$profile_id = create_uuid("PROF");

			if(isset($_POST["lease_date"])):
				$t = strtotime($_POST["lease_date"]);
				$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			else:
				$_POST["lease_date"] = "";
				$lease_expired = "";
			endif;
			
			

		
			if (query("insert into profile_list 
				(
					profile_id,
					client_firstname,client_middlename,client_lastname,client_suffix,
					client_contact,email_address,gender,
					province,city_municipality,barangay,client_address,
					id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,
				$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["suffix"],
				$_POST["client_contact"],$_POST["email_address"],$_POST["gender"],
				$_POST["province"],$_POST["city_mun"],$_POST["barangay"],$_POST["client_address"],
				$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"]
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
			else;

			elseif($_POST["crypt_slot_type"] == "MAUSOLEUM"):

				$profile_id = create_uuid("PROF");
			// $t = strtotime($_POST["lease_date"]);
			// $lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			$_POST["lease_date"] = "NO EXPIRY";
			$lease_expired = "NO EXPIRY";


			$requirements = "";
			if(isset($_POST["requirements"]))
			$requirements = serialize($_POST["requirements"]);
			if (query("insert into profile_list 
				(
					profile_id,
					client_firstname,client_middlename,client_lastname,client_suffix,
					client_contact,email_address,gender,
					province,city_municipality,barangay,client_address,
					id_presented,id_number,place_issued,slot_number,
					requirements
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,
				$_POST["first_name"],$_POST["middle_name"],$_POST["last_name"],$_POST["suffix"],
				$_POST["client_contact"],$_POST["email_address"],$_POST["gender"],
				$_POST["province"],$_POST["city_mun"],$_POST["barangay"],$_POST["client_address"],
				$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],$_POST["slot_number"],
				$requirements
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
			endif;

			$fullname = strtoupper($_POST["last_name"] . "_" . $_POST["first_name"] . "_" . $_POST["middle_name"] . "_" . $_POST["suffix"]);
			$fullname = str_replace(' ', '_', $fullname);
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
					"link" => "profile?action=client_details&slot=".$_POST["slot_number"],
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		elseif($_POST["action"] == "add_deceased"):

		


			$datetime1 = new DateTime($_POST["birthdate"]);
			$datetime2 = new DateTime($_POST["date_of_death"]);
			$interval = $datetime1->diff($datetime2);
			$age = $interval->format('%y');
	

			
			if(!isset($_POST["interment_type"]))
				$_POST["interment_type"] = "";
			if(!isset($_POST["deceased_type"]))
				$_POST["deceased_type"] = "REMAINS";
			// dump($_post);


			$deceased_id = create_uuid("DEC");
			$_POST["deceased_name"] = $_POST["firstname"] . " " . $_POST["middlename"]. " " . $_POST["lastname"] . $_POST["suffix"];
			if (query("INSERT INTO deceased_profile 
            (deceased_id, deceased_name, deceased_firstname, deceased_middlename, deceased_lastname, deceased_suffix, birthdate, date_of_death, age_died, religion, gender, burial_date, slot_number, burial_status, profile_id, interment_type, deceased_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            $deceased_id, $_POST["deceased_name"], $_POST["firstname"], $_POST["middlename"], $_POST["lastname"],
            $_POST["suffix"], $_POST["birthdate"], $_POST["date_of_death"],
            $age, $_POST["religion"], $_POST["gender"], "???", // Make sure you provide the correct value here
            $_POST["slot_number"], "NO BURIAL DATE", $_POST["client_id"], $_POST["interment_type"], $_POST["deceased_type"]
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

		elseif($_POST["action"] == "modal_profile"):
			// dump($_POST);
			$crypt_slot = query("select slot.*, concat(client_firstname, ' ', client_middlename,
			' ', client_lastname, ' ', client_suffix) as client_name,client.profile_id,client.client_address, 
			client.lease_date, client.date_expired,lease_status
			 from crypt_slot slot
								left join profile_list client
								on client.profile_id = slot.occupied_by
								where slot.slot_id = ?", $_POST["slot_number"]);
			$crypt_slot = $crypt_slot[0];
			$deceased = query("select * from deceased_profile where profile_id = ?", $crypt_slot["profile_id"]);
			// dump($deceased);

			if($crypt_slot["active_status"]=="OCCUPIED"):
			$message = "";
			$message = $message .'
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleInputEmail1">Client Name: '.$crypt_slot["client_name"].'</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label for="exampleInputEmail1">Address: '.$crypt_slot["client_address"].'</label>
					</div>
				</div>
			
				
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleInputEmail1">Lawn Type: '.$crypt_slot["lawn_type"].' | '.$crypt_slot["lease_status"].'</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleInputEmail1">Lease Date: '.$crypt_slot["lease_date"].'</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="exampleInputEmail1">Lease Expired: '.$crypt_slot["date_expired"].'</label>
					</div>
				</div>
			</div>
			<hr>
				<div class="form-group">
					<label for="exampleInputEmail1">List of Deceased Buried on this Niche</label>
				</div>
			<table class="table table-bordered table-striped">
				<thead>
					<th>Deceased Name</th>
					<th>Birthday</th>
					<th>Date of Death</th>
					<th>Age of Death</th>
					<th>Gender</th>
					<th>Religion</th>
				</thead>
				';
				foreach($deceased as $d):
					$message = $message . '<tr>';
						$message = $message . '<td>'.$d["deceased_name"].'</td>';
						$message = $message . '<td>'.$d["birthdate"].'</td>';
						$message = $message . '<td>'.$d["date_of_death"].'</td>';
						$message = $message . '<td>'.$d["age_died"].'</td>';
						$message = $message . '<td>'.$d["gender"].'</td>';
						$message = $message . '<td>'.$d["religion"].'</td>';
					$message = $message . '</tr>';
				endforeach;
			if(!isset($_POST["public"])):
				$message=$message.'
				</table>
				<a target="_blank" href="profile?action=client_details&slot='.$_POST["slot_number"].'" class="btn btn-primary btn-flat">Open Information</a>
				';
			endif;
			echo($message);
			else:

				$crypt_slot = query("select * from crypt_slot
								where slot_id = ?", $_POST["slot_number"]);
				$message = '
				<h3 class="text-center">THIS LAWN IS STILL VACANT</h3>
				<h4 class="text-center">'.$crypt_slot[0]["lawn_type"].'</h4>
				<h4 class="text-center">Niche | Lawn Number: '.$crypt_slot[0]["slot_number"].'</h4>
				';

				if(!isset($_POST["public"])):
					$message = $message . '
					<form class="generic_form_trigger" data-url="profile">
						<input type="hidden" name="action" value="convert_no_slot">
						<input type="hidden" name="slot_number" value="'.$crypt_slot[0]["slot_id"].'">';
						if($crypt_slot[0]["lawn_type"] != ""):
							$message = $message . '<a target="_blank" href="profile?action=client_details&slot='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a>';
						endif;
						$message = $message . '
						<button class="btn btn-danger btn-flat" type="submit">Make a No Slot</button>
					</form>
					<hr>
					<h4>Update Lawn Lot (only applicable if dont have client yet)</h4>
					<form class="generic_form_trigger" data-url="profile" class="text-center">
					<input type="hidden" name="action" value="update_lawn">
					<input type="hidden" name="crypt_slot_id" value="'.$crypt_slot[0]["slot_id"].'">
					<div class="form-group">
						<label>Lawn Type</label>
						<select name="lawn_type" class="form-control select2" style="width: 100%;">
						<option selected value="'.$crypt_slot[0]["lawn_type"].'" disabled>'.$crypt_slot[0]["lawn_type"].'</option>
						';
						$lawn_types = query("select * from pricing_lawn");
						foreach($lawn_types as $row):
							$message = $message . '<option value="'.$row["name"].'">'.$row["name"]. ' | PreNeed: '. $row["pre_need"] .' | ATNEED: ' . $row["at_need"] . '</option>';
						endforeach;
						$message = $message . '
						</select>
					</div>

					<button type="submit">Submit</button>
					</div>
					';
				endif;
				echo($message);
			endif;
			elseif($_POST["action"] == "convert_no_slot"):
				// dump($_POST);
				query("update crypt_slot set crypt_slot_type = 'NO_SLOT', lawn_type=''
						where slot_id = ?", $_POST["slot_number"]);
						$res_arr = [
							"result" => "success",
							"title" => "Success",
							"message" => "Success on adding Data",
							"link" => "refresh",
							];
							echo json_encode($res_arr); exit();
			elseif($_POST["action"] == "forward_cemetery"):
				// dump($_POST);
				$status = "";
				$burial_date = "";
				$burial_time = "";
				$services = "";
				if(isset($_POST["services"]))
				$services = serialize($_POST["services"]);
				$client = query("select * from crypt_slot where slot_id = ?", $_POST["slot_number"]);
				$client=$client[0];
				$crypt = query("select * from crypt_list where crypt_id = ?",$client["crypt_id"]);
				$crypt = $crypt[0];
				$deceased = query("select * from deceased_profile where slot_number = ? and burial_status = 'NO BURIAL DATE'", $_POST["slot_number"]);
			
				$crypt_fee= [];
				$transaction_id = create_uuid("TRANSACTION");
				$total_fee = 0;
				if($crypt["crypt_type"] == "BONE"):
					$price = query("select * from pricing_bonecrypt where type = ?", $_POST["bone_option"]);
					$price = $price[0];
					$total_fee = $price["amount"] + $price["certification"];
					$crypt_fee[0]["name"] = "Certification Fee";
					$crypt_fee[0]["cost"] = $price["certification"];
					$crypt_fee[1]["name"] = "Crypt Fee";
					$crypt_fee[1]["cost"] = $price["amount"];
					$crypt_fee = serialize($crypt_fee);
					if(isset($_POST["lapida_amount"]))
						$total_fee = $total_fee + $price["lapida_amount"];
				endif;
				if($crypt["crypt_type"] == "COFFIN"):
					$price = query("select * from pricing_coffincrypt where tbl_id = ?", $_POST["price_id"]);
					$price = $price[0];
					// dump($price);
					$total_fee = $price["amount"] + $price["certification_amount"];
					$crypt_fee[0]["name"] = "Certification Fee";
					$crypt_fee[0]["cost"] = $price["certification_amount"];
					$crypt_fee[1]["name"] = "Crypt Fee";
					$crypt_fee[1]["cost"] = $price["amount"];
					$crypt_fee = serialize($crypt_fee);
					if(isset($_POST["lapida_amount"]))
						$total_fee = $total_fee + $price["lapida_amount"];
				endif;

				$service = [];
				if(isset($_POST["service"])):
					$in_service = "'" . implode("','", $_POST["service"]) . "'";
					$service = query("select service_name, cost from services where service_name in (".$in_service.")");
					foreach($service as $row):
						$total_fee = $total_fee + $row["cost"];
					endforeach;
					// dump(count($service));
					if(isset($_POST["lapida_amount"])):
						$count = count($service);
						$service[$count]["service_name"] = "Lapida";
						$service[$count]["cost"] = $price["lapida_amount"];
					endif;
					$service = serialize($service);
				else:
					if(isset($_POST["lapida_amount"])):
						$count = count($service);
						$service[$count]["service_name"] = "Lapida";
						$service[$count]["cost"] = $price["lapida_amount"];
					endif;
					$service = serialize($service);
				endif;	

				$logs = "PAID Transaction and Forward to scheduler!";

				if(empty($crypt_fee))
				$crypt_fee = "";

				if (query("insert into transaction 
					(transaction_id,date,total_fee,services,time,crypt_fee,profile_id,logs,timestamp,slot_id,transaction_type) 
					VALUES(?,?,?,?,?,?,?,?,?,?,?)", 
					$transaction_id,date("Y-m-d"),$total_fee,$service,date("H:i:s"),$crypt_fee,$client["occupied_by"],$logs,time(),$_POST["slot_number"], "BURIAL"
					) === false)
					{
						apologize("Sorry, that username has already been taken!");
					}

				foreach($deceased as $row):
					if (query("insert into deceased_transaction 
					(transaction_id,deceased_id) 
					VALUES(?,?)", 
					$transaction_id,$row["deceased_id"]) === false)
					{
						apologize("Sorry, that username has already been taken!");
					}
				endforeach;
				
				



				if($_POST["deceased_burial_date"] == ""):
					$status = "FOR SCHEDULING";
					$update_query = "update deceased_profile set burial_status = 'FOR SCHEDULING', transaction_id = '".$transaction_id."' where 
					slot_number = '".$_POST["slot_number"]."' and burial_status = 'NO BURIAL DATE'";
				else:
					if($_POST["deceased_burial_time"] == ""):
						$res_arr = [
							"result" => "failed",
							"title" => "Failed",
							"message" => "Burial Time is required if Burial Date is not blank!",
							];
							echo json_encode($res_arr); exit();
					else:
						$status = "PENDING";
						$burial_date = $_POST["deceased_burial_date"];
						$burial_time = $_POST["deceased_burial_time"];
						$update_query = "update deceased_profile set burial_status = 'PENDING', transaction_id = '".$transaction_id."' where 
						slot_number = '".$_POST["slot_number"]."' and burial_status = 'NO BURIAL DATE'";
					endif;
				endif;

				$schedule_id = create_uuid("SCHED");
				if (query("insert into burial_schedule 
				(profile_id,slot_number,remarks,schedule_id,timestamp,date,time,burial_date,burial_time,transaction_id) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$client["occupied_by"],$_POST["slot_number"],$status,$schedule_id
				,time(),date("Y-m-d"),date("h:i:s a"),$burial_date,$burial_time,$transaction_id
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}


				query($update_query);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "update_lawn"):
			query("update crypt_slot set lawn_type = ? where slot_id = ?", $_POST["lawn_type"] , $_POST["crypt_slot_id"]);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => "refresh",
				];
				echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "lawn_bill"):
			// dump($_POST);
			$client = query("select * from profile_list where profile_id = ?", $_POST["client"]);
			$client = $client[0];
			$slot = query("select * from crypt_slot c left join pricing_lawn p
						on p.name = c.lawn_type
						where c.slot_id = ?", $client["slot_number"]);
			$slot = $slot[0];
			$price = ($client["lease_status"] == "PRE NEED") ? $slot["pre_need"] : $slot["at_need"]; 
			$price = ($client["residency"] == "PANABO") ? $price : $price * 2; 
			$transaction_id = create_uuid("TRANSACTION");
			$message = $client["client_firstname"] . " " . $client["client_lastname"] . " paid " . to_peso($price) . ". Lot Type: " . $slot["name"] . ". Lease Type: " . $client["lease_status"] . ". Residency: " . $client["residency"];
			if($client["residency"] != "PANABO")
			$message = $message . "<br>Note: If Residency is outside PANABO, price is twice the original price: PRENEED " . to_peso($slot["pre_need"]) . " | AtNEED: " . to_peso($slot["at_need"]);
			// dump($message);

			if (query("insert into transaction 
				(transaction_id,date,total_fee,time,profile_id,logs,timestamp,slot_id,transaction_type) 
				VALUES(?,?,?,?,?,?,?,?,?)", 
				$transaction_id,date("Y-m-d"),$price,date("H:i:s"),$client["profile_id"], $message, time(), $client["slot_number"], "LAWN PURCHASE"
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}

				query("update profile_list set paid_status = 'PAID', transaction_id = ? where profile_id = ?", $transaction_id, $client["profile_id"]);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Payment",
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "vacate"):
			$deceased = query("select count(*) as count from deceased_profile where slot_number = ?", $_POST["slot_id"]);
			$count = $deceased[0]["count"];
			if($count != 0):
				$res_arr = [
					"result" => "failed",
					"title" => "Failed",
					"message" => "There are deceased profiles occupying this slot. Please Transfer it first in order to vacate this slot.",
					// "link" => "refresh",
					];
					echo json_encode($res_arr); exit();
			endif;
			$slot = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);
			$profile_id = $slot[0]["occupied_by"];
			query("update profile_list set active_status = 'FORMER' where profile_id = ?", $profile_id);
			query("update crypt_slot set occupied_by = null, active_status = 'VACANT' where slot_id = ?", $_POST["slot_id"]);


			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on Vacating the Slot",
				"link" => "refresh",
				];
				echo json_encode($res_arr); exit();

			elseif($_POST["action"] == "continue"):
				// dump($_POST);
				query("update burial_schedule set remarks = 'FOR SCHEDULING' where
						profile_id = ?		
				", $_POST["profile_id"]);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Transferring Data",
					"link" => "refresh",
				];
				echo json_encode($res_arr); exit();

			elseif($_POST["action"] == "cancellation"):
				// dump($_POST);


				query("update burial_schedule set remarks = 'CANCELLED' where profile_id = ?", $_POST["profile_id"]);
				$transaction_id = create_uuid("TRANSACTION");
				$message = "BURIAL SCHEDULE IS CANCELLED";
				$service = [];
				$service[0]["service_name"] = "Cancellation";
				$service[0]["cost"] = "500";
				$service = serialize($service);
				
				if (query("insert into transaction 
				(transaction_id,date,total_fee,services,time,profile_id,logs,timestamp,slot_id,transaction_type) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$transaction_id,date("Y-m-d"),"500",$service,date("H:i:s"),
				$_POST["profile_id"],$message,time(),$_POST["slot_id"],"CANCELLATION"
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				else;
				$deceased = query("select * from deceased_profile where profile_id = ?
									and burial_status = 'FOR SCHEDULING'", $_POST["profile_id"]);
				foreach($deceased as $row):
					if (query("insert into deceased_transaction 
					(transaction_id,deceased_id) 
					VALUES(?,?)", 
					$transaction_id,$row["deceased_id"]
					) === false)
					{
						apologize("Sorry, that username has already been taken!");
					}
				endforeach;

				query("update profile_list set active_status = 'FORMER' where profile_id = ?", $_POST["profile_id"]);
				query("update deceased_profile set active_status = 'CANCELLED' where profile_id = ?
						and burial_status in ('PENDING', 'POSTPONED', 'FOR SCHEDULING')",$_POST["profile_id"]);
				query("update crypt_slot set active_status = 'VACANT', occupied_by = '' where slot_id = ?", $_POST["slot_id"]);

				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Cancellation of Burial",
					"link" => "refresh",
				];
				echo json_encode($res_arr); exit();

			
			elseif($_POST["action"] == "postponement"):
				// dump($_POST);
				query("update burial_schedule set remarks = 'POSTPONED' where profile_id = ?", $_POST["profile_id"]);
				$transaction_id = create_uuid("TRANSACTION");
				$message = "BURIAL SCHEDULE IS POSTPONED";
				$service = [];
				$service[0]["service_name"] = "Postponement";
				$service[0]["cost"] = "500";
				$service = serialize($service);
				
				if (query("insert into transaction 
				(transaction_id,date,total_fee,services,time,profile_id,logs,timestamp,slot_id,transaction_type) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$transaction_id,date("Y-m-d"),"500",$service,date("H:i:s"),
				$_POST["profile_id"],$message,time(),$_POST["slot_id"],"POSTPONEMENT"
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				else;
				$deceased = query("select * from deceased_profile where profile_id = ?
									and burial_status = 'FOR SCHEDULING'", $_POST["profile_id"]);
				foreach($deceased as $row):
					if (query("insert into deceased_transaction 
					(transaction_id,deceased_id) 
					VALUES(?,?)", 
					$transaction_id,$row["deceased_id"]
					) === false)
					{
						apologize("Sorry, that username has already been taken!");
					}
				endforeach;
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Transferring Data",
					"link" => "refresh",
				];
				echo json_encode($res_arr); exit();



		
			elseif($_POST["action"] == "transfer"):
				// dump($_POST);

				if($_POST["crypt_type"] != "COMMON"):
				$slot = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);
				query("update deceased_profile set slot_number = ?,
						transaction_id = null, burial_status = 'NO BURIAL DATE',
						burial_date = null, burial_time = null, profile_id = ?
						where deceased_id = ?", $_POST["slot_id"], $slot[0]["occupied_by"], $_POST["deceased_id"]);
				// $slot = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);
				// $profile_id = $slot[0]["occupied_by"];
				// query("update profile_list set active_status = 'FORMER' where profile_id = ?", $profile_id);
				// query("update crypt_slot set occupied_by = null, active_status = 'VACANT' where slot_id = ?", $_POST["slot_id"]);
				elseif($_POST["crypt_type"] == "COMMON"):
					
					$deceased = query("select * from deceased_profile where deceased_id = ?", $_POST["deceased_id"]);
					// dump($deceased);
					$crypt_slot_id = create_uuid("CRYPT_SLOT");
					if (query("insert into crypt_slot 
					(slot_id,crypt_id,active_status,occupied_by,crypt_slot_type,last_profile_id) 
					VALUES(?,?,?,?,?,?)", 
					$crypt_slot_id,$_POST["crypt_id"],"OCCUPIED",$_POST["deceased_id"],"COMMON", $deceased[0]["profile_id"]
					) === false)
					{
						apologize("Sorry, that username has already been taken!");
					}

					query("update deceased_profile set slot_number = ?, profile_id = null
							where deceased_id = ?", $crypt_slot_id, $_POST["deceased_id"]);

				endif;
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on Transferring Data",
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();
			elseif($_POST["action"] == "modal_details"):
				// dump($_POST);
				$transaction = query("select * from transaction where transaction_id = ?", $_POST["transaction_id"]);
				$transaction = $transaction[0];
				// dump($transaction);
				$message = "";
				
				if($transaction["crypt_fee"]!=""):
					$message=$message . "<h4><b>Crypt Fee</b></h4>";
					$message = $message . "<table class='table table-bordered'><thead><th>Name</th><th>Cost</th></thead>";
					foreach(unserialize($transaction["crypt_fee"]) as $crypt):
						$message = $message . "<tr>";
							$message = $message . "<td>" . $crypt["name"] . "</td>";
							$message = $message . "<td>" . to_peso($crypt["cost"]) . "</td>";
						$message = $message . "</tr>";
					endforeach;
					$message=$message."</table>";
				endif;
				if($transaction["services"]!=""):
					$message=$message . "<h4><b>Services</b></h4>";
					$message = $message . "<table class='table table-bordered'><thead><th>Name</th><th>Cost</th></thead>";
					foreach(unserialize($transaction["services"]) as $row):
						$message = $message . "<tr>";
							$message = $message . "<td>" . $row["service_name"] . "</td>";
							$message = $message . "<td>" . to_peso($row["cost"]) . "</td>";
						$message = $message . "</tr>";
					endforeach;
					$message=$message."</table>";
				endif;

				$deceased = query("select * from deceased_transaction t
									left join deceased_profile d
									on d.deceased_id = t.deceased_id 
									where t.transaction_id = ?", $_POST["transaction_id"]);
				if(!empty($deceased)):
					$message=$message . "<h4><b>DECEASED</b></h4>";
					$message = $message . "<table class='table table-bordered'>
											<thead>
												<th>Name</th>
												<th>Death</th>
												<th>Age Died</th>
												<th>Gender</th>
											</thead>";
					foreach($deceased as $row):
						$message = $message . "<tr>";
							$message = $message . "<td>" . $row["deceased_name"] . "</td>";
							$message = $message . "<td>" . $row["date_of_death"] . "</td>";
							$message = $message . "<td>" . $row["age_died"] . "</td>";
							$message = $message . "<td>" . $row["gender"] . "</td>";
						$message = $message . "</tr>";
					endforeach;
					$message=$message."</table>";

				endif;

				$message = $message . "<p><b>Total Fee: </b>".to_peso($transaction["total_fee"])."</p>";
				$message = $message . "<p><b>Logs: </b>".$transaction["logs"]."</p>";

				// dump($deceased);





				echo $message;

				




			


			endif;
	

		
    }
	else {
		
		$profile = query("select p.*, s.slot_id, c.crypt_name, s.slot_number, s.row_number, s.column_number from profile_list p
		left join crypt_slot s
		on s.slot_id = p.slot_number
		left join crypt_list c
		on c.crypt_id = s.crypt_id");
		// dump($profile);
		if($_GET["action"] == "client_list"){

			$profile = query("select p.*, 
			concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name,
			s.slot_id, c.crypt_name, s.slot_number, s.row_number, s.column_number from profile_list p
			left join crypt_slot s
			on s.slot_id = p.slot_number
			left join crypt_list c
			on c.crypt_id = s.crypt_id");
			// dump($_GET);
			render("public/profile_system/profile_list.php",
			[
				"profile" => $profile,
			]);
		}

		if($_GET["action"] == "deceased_list"){

			$deceased_profile = query("
			select *,d.gender as gender from deceased_profile d
			left join profile_list p
			on d.profile_id = p.profile_id
			left join crypt_slot cs
			on cs.slot_id = d.slot_number
			left join crypt_list as c
			on c.crypt_id = cs.crypt_id
			
			WHERE d.active_status IS NULL OR d.active_status != 'FOR TRANSFER'
			order by d.burial_date desc, d.burial_time desc
			");


			render("public/profile_system/deceased_list.php",
			[
				"deceased_profile" => $deceased_profile,
			]);
		}


		if($_GET["action"] == "pending_transfer"){

			$deceased_profile = query("
			select *,d.gender as gender from deceased_profile d
			left join profile_list p
			on d.profile_id = p.profile_id
			left join crypt_slot cs
			on cs.slot_id = d.slot_number
			left join crypt_list as c
			on c.crypt_id = cs.crypt_id
			WHERE d.active_status != 'FOR TRANSFER'
			order by d.burial_date desc, d.burial_time desc
			");


			render("public/profile_system/pending_transfer_list.php",
			[
				"deceased_profile" => $deceased_profile,
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
			render("public/profile_system/client_details.php",
			[
				"client" => $client,
				"deceased" => $deceased,
				"slot" => $slot,
			]);
		}


	
	}
?>
