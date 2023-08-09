<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "add_client"):

			// dump($_POST);
			if($_POST["crypt_slot_type"] == "LAWN"):
			$profile_id = create_uuid("PROF");
			$t = strtotime($_POST["lease_date"]);
			$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			if (query("insert into profile_list 
				(profile_id,client_name,email_address,client_address,client_contact,gender,id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number,lease_status
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,$_POST["client_name"],$_POST["email_address"],$_POST["client_address"],$_POST["client_contact"],
				$_POST["gender"],$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"],$_POST["lease_status"],
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
			else;

			elseif($_POST["crypt_slot_type"] == "COFFIN"):

			$profile_id = create_uuid("PROF");
			$t = strtotime($_POST["lease_date"]);
			$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			if (query("insert into profile_list 
				(profile_id,client_name,email_address,client_address,client_contact,gender,id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number,occupant_type
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,$_POST["client_name"],$_POST["email_address"],$_POST["client_address"],$_POST["client_contact"],
				$_POST["gender"],$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
				$_POST["lease_date"],$lease_expired,$_POST["slot_number"],$_POST["occupant_type"],
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
			else;
				
			elseif($_POST["crypt_slot_type"] == "BONE"):

			$profile_id = create_uuid("PROF");
			$t = strtotime($_POST["lease_date"]);
			$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
			if (query("insert into profile_list 
				(profile_id,client_name,email_address,client_address,client_contact,gender,id_presented,id_number,place_issued,
					lease_date,date_expired,slot_number
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,$_POST["client_name"],$_POST["email_address"],$_POST["client_address"],$_POST["client_contact"],
				$_POST["gender"],$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],
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
			if (query("insert into profile_list 
				(profile_id,client_name,email_address,client_address,client_contact,gender,id_presented,id_number,place_issued,slot_number
				) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$profile_id,$_POST["client_name"],$_POST["email_address"],$_POST["client_address"],$_POST["client_contact"],
				$_POST["gender"],$_POST["id_presented"],$_POST["id_number"],$_POST["place_issued"],$_POST["slot_number"]
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
			
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
					"link" => "profile?action=client_details&slot=".$_POST["slot_number"],
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "modal_profile"):
			// dump($_POST);
			$crypt_slot = query("select slot.*,
			client.client_name,client.profile_id,client.client_address, 
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


			$message=$message.'
			</table>
			<a target="_blank" href="profile?action=client_details&slot='.$_POST["slot_number"].'" class="btn btn-primary btn-flat">Open Information</a>
			';
			echo($message);
			else:

				$crypt_slot = query("select * from crypt_slot
								where slot_id = ?", $_POST["slot_number"]);
				$message = '
				<h3 class="text-center">THIS LAWN IS STILL VACANT</h3>
				<h4 class="text-center">'.$crypt_slot[0]["slot_id"].'</h4>
				<h4 class="text-center">'.$crypt_slot[0]["lawn_type"].'</h4>
				<h4 class="text-center">Niche | Lawn Number: '.$crypt_slot[0]["slot_number"].'</h4>
				<div class="text-center"><a target="_blank" href="profile?action=client_details&slot='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);
			endif;

			elseif($_POST["action"] == "forward_cemetery"):
				$status = "";
				$burial_date = "";
				$burial_time = "";
				if(isset($_POST["services"]))
				$services = serialize($_POST["services"]);
				$client = query("select * from crypt_slot where slot_id = ?", $_POST["slot_number"]);
				$client=$client[0];
				$deceased = query("select * from deceased_profile where slot_number = ? and burial_status = 'NO BURIAL DATE'", $_POST["slot_number"]);
				
				if($_POST["deceased_burial_date"] == ""):
					$status = "FOR SCHEDULING";
					$update_query = "update deceased_profile set burial_status = 'FOR SCHEDULING' where 
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
						$update_query = "update deceased_profile set burial_status = 'PENDING' where 
						slot_number = '".$_POST["slot_number"]."' and burial_status = 'NO BURIAL DATE'";
					endif;
				endif;

				$services = "";
				$schedule_id = create_uuid("SCHED");
				if (query("insert into burial_schedule 
				(profile_id,slot_number,remarks,schedule_id,services_availed,timestamp,date,time,burial_date,burial_time) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$client["occupied_by"],$_POST["slot_number"],$status,$schedule_id,
				$services,time(),date("Y-m-d"),date("h:i:s a"),$burial_date,$burial_time
				) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
				query($update_query);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "profile?action=client_details&slot=".$_POST["slot_number"],
					];
					echo json_encode($res_arr); exit();
		endif;
	

		


		
		
		
    }
	else {
		
		
		// dump($profile);
		if($_GET["action"] == "client_list"){
			
			$profile = query("select p.*, s.slot_id, c.crypt_name, s.slot_number, s.row_number, s.column_number from profile_list p
							left join crypt_slot s
							on s.slot_id = p.slot_number
							left join crypt_list c
							on c.crypt_id = s.crypt_id");

			render("public/profile_system/profile_list.php",
			[
				"profile" => $profile,
			]);
		}

		if($_GET["action"] == "deceased_list"){
			render("public/profile_system/deceased_list.php",
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


		if($_GET["action"] == "client_details"){
			$client = query("select * from profile_list where slot_number = ?", $_GET["slot"]);
			if(!empty($client)):
			$deceased = query("select * from deceased_profile where profile_id = ?", $client[0]["profile_id"]);
			else:
			$deceased = "";
			endif;

			$slot = query("select * from crypt_slot as slot
							left join crypt_list as crypt
							on slot.crypt_id = crypt.crypt_id
							where slot.slot_id = ?", $_GET["slot"]);

			$slot = $slot[0];


			// $lawn_lots = query("select * from crypt_slot where crypt_id = ?", $_GET["slot"]);
			// dump($crypt_slots);
			render("public/profile_system/client_details.php",
			[
				// "lawn" => $lawn,
				// "lawn_lots" => $lawn_lots,
				"client" => $client,
				"deceased" => $deceased,
				"slot" => $slot,
			]);
		}
	}
?>
