<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "add_schedule"):
			// dump($_POST);


			$selectedDate = $_POST["deceased_burial_date"];
    		$selectedTime = $_POST["deceased_burial_time"];
			$dateTime = new DateTime($selectedDate . ' ' . $selectedTime);

			$minTime = new DateTime('08:00:00');
    		$maxTime = new DateTime('16:00:00');

			if ($dateTime < $minTime || $dateTime > $maxTime) {
				$res_arr = [
					"result" => "failed",
					"title" => "Failed",
					"message" => "Time should be between 8:00 AM and 4:00 PM",
					// "link" => "pending_burial?action=list",
					];
					echo json_encode($res_arr); exit();
				// Handle the error as needed
			}

			// dump("payts");



			$for_schedule = query("select * from burial_schedule where schedule_id = ?",$_POST["schedule_id"]);
			$for_schedule = $for_schedule[0];
			$deceased = query("select * from deceased_profile where slot_number = ? and burial_status = 'FOR SCHEDULING'", $for_schedule["slot_number"]);
			query("update deceased_profile set burial_status = 'PENDING',
					burial_date = ?, burial_time = ? where slot_number = ? and burial_status = 'FOR SCHEDULING'", 
					$_POST["deceased_burial_date"], $_POST["deceased_burial_time"],$for_schedule["slot_number"]);
			query("update burial_schedule set remarks = 'PENDING', 
			burial_date=?, burial_time=? where schedule_id = ?", 
			$_POST["deceased_burial_date"], $_POST["deceased_burial_time"],$_POST["schedule_id"]);
			// dump($deceased);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => "pending_burial?action=list",
				];
				echo json_encode($res_arr); exit();
			
		endif;
    }
	else {
		$for_schedule = query("select *,concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name,
		bs.services_availed as services_availed from burial_schedule bs
								left join profile_list profile
								on bs.profile_id = profile.profile_id
								where remarks = 'FOR SCHEDULING' order by date asc, time asc");
								// dump($for_schedule);
		if($_GET["action"] == "list"){
			render("public/pending_system/pending_list.php",
			[
				"for_schedule" => $for_schedule,
			]);
		}
	}
?>
