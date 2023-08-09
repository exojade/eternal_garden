<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "markDone"){
			// dump($_POST);
			query("update burial_schedule set remarks = 'DONE' where schedule_id = ?", $_POST["schedule_id"]);
			$schedule = query("select * from burial_schedule where schedule_id = ?", $_POST["schedule_id"]);
			
			query("update deceased_profile set burial_status = 'DONE', burial_date = ?, burial_time = ? where slot_number = ? and burial_status = 'PENDING'",
			$schedule[0]["burial_date"],$schedule[0]["burial_time"], $schedule[0]["slot_number"] );

			
			$link = "schedule";
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => $link,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		}
		if($_POST["action"] == "modalSchedule"){
		

			$schedule = query("select * from burial_schedule where schedule_id = ?", $_POST["schedule_id"]);
			

			$crypt_slot = query("select slot.*,
			client.client_name,client.profile_id,client.client_address, 
			client.lease_date, client.date_expired,lease_status
			 from crypt_slot slot
								left join profile_list client
								on client.profile_id = slot.occupied_by
								where slot.slot_id = ?", $schedule[0]["slot_number"]);
			$crypt_slot = $crypt_slot[0];
			$deceased = query("select * from deceased_profile where profile_id = ? and burial_status = 'PENDING'", $crypt_slot["profile_id"]);
			// dump($deceased);
			if($crypt_slot["crypt_slot_type"] != "LAWN"):
				$crypt = query("select * from crypt_list where crypt_id = ?", $crypt_slot["crypt_id"]);
				$crypt_slot["lawn_type"] = $crypt[0]["crypt_name"];
				$crypt_slot["lease_status"] = "";
			endif;

			if($crypt_slot["active_status"]=="OCCUPIED"):
			$message = "";
			$message = $message .'

			<input type="hidden" name="schedule_id" value="'.$_POST["schedule_id"].'">

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
						<label for="exampleInputEmail1">Crypt Type: '.$crypt_slot["lawn_type"].' | '.$crypt_slot["lease_status"].'</label>
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


		}
		
    }
	else {

		render("public/schedule_system/schedule_form.php",[]);
	}
?>
