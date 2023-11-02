<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "schedule-datatable"):
			// dump($_POST);
			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$where = " ";


            if(isset($_REQUEST["from"])):
                if($_REQUEST["from"] != "")
                    $where = $where . " and burial_date >= '" . $_REQUEST["from"] . "'";
            endif;

            if(isset($_REQUEST["to"])):
                if($_REQUEST["to"] != "")
                    $where = $where . " and burial_date <= '" . $_REQUEST["to"] . "'";
            endif;

			$crypt = query("select * from crypt_slot s
							left join crypt_list c
							on c.crypt_id = s.crypt_id");
            $Crypt = [];
			

            foreach($crypt as $row):
                $Crypt[$row["slot_id"]] = $row;
            endforeach;
            // $data = query("select * from tblemployee_dtras");
            if($where != ""):
                $query_string = "select p.client_firstname, p.client_lastname ,bs.* from burial_schedule bs
							 left join profile_list p
							 on bs.profile_id = p.profile_id
                             where remarks in ('POSTPONED', 'PENDING') ".$where."
                             order by burial_date asc, burial_time asc
                                limit ".$limit." offset ".$offset." ";
                // dump($query_string);
                $data = query($query_string);
                $all_data = query("select p.client_firstname, p.client_lastname ,bs.* from burial_schedule bs
				left join profile_list p
				on bs.profile_id = p.profile_id
                where remarks in ('POSTPONED', 'PENDING') ".$where."
                order by burial_date asc, burial_time asc");
                // $all_data = $data;
            else:
                $query_string = "select p.client_firstname, p.client_lastname ,bs.* from burial_schedule bs
				left join profile_list p
				on bs.profile_id = p.profile_id
				where remarks in ('POSTPONED', 'PENDING')
				order by burial_date asc, burial_time asc
                                limit ".$limit." offset ".$offset." ";
                                // dump($query_string);
                $data = query($query_string);
                $all_data = query("select * from select p.client_firstname, p.client_lastname ,bs.* from burial_schedule bs
				left join profile_list p
				where remarks in ('POSTPONED', 'PENDING')
				on bs.profile_id = p.profile_id");
                // $all_data = $data;
            endif;
            $i=0;
            foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = "<a data-id='".$row["schedule_id"]."' href='#' class='btn btn-xs btn-primary btn-block btn-flat open-schedule'>View</a>";
				$data[$i]["client"] = $row["client_firstname"] . " " . $row["client_lastname"];
				if($Crypt[$row["slot_number"]]["crypt_type"] == "LAWN"):
					$crypt = $Crypt[$row["slot_number"]];
					$data[$i]["location"] = $crypt["crypt_type"] . " : " . " TYPE:  " .$crypt["lawn_type"];
				elseif($Crypt[$row["slot_number"]]["crypt_type"] == "COFFIN" || $Crypt[$row["slot_number"]]["crypt_type"] == "BONE"):
					$crypt = $Crypt[$row["slot_number"]];
					$data[$i]["location"] = $crypt["crypt_type"] . " : " . " ROW :  " .$crypt["row_number"] . " : COLUMN : " . $crypt["column_number"];
				endif;


				// dump();	
                $i++;
            endforeach;
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_data),
                "iTotalDisplayRecords" => count($all_data),
                "aaData" => $data
            );
            echo json_encode($json_data);


		elseif($_POST["action"] == "modal_schedule"):
			// dump($_POST);

			$schedule=query("select * from burial_schedule bs 
									left join crypt_slot s on bs.slot_number = s.slot_id
									left join crypt_list c on c.crypt_id = s.crypt_id
								 where schedule_id = ?", $_POST["schedule_id"]);
			$sched = $schedule[0];
			$transaction = query("select * from transaction where transaction_id = ?", $sched["transaction_id"]);
			// dump($transaction);
			$client =query("select * from profile_list where profile_id = ?", $sched["profile_id"]);
			$deceased = query("select * from deceased_transaction t
								left join deceased_profile d
								on d.deceased_id = t.deceased_id where t.transaction_id = ?", $sched["transaction_id"]);
			$message = "";

			$message = $message . "<input type='hidden' name='schedule_id' value='".$_POST["schedule_id"]."'>";
			$message = $message . "<table class='table table-bordered table-striped'>";
			$message = $message . "<thead>";
			$message = $message . "<th>Client</th>";
			$message = $message . "<th>Location</th>";
			$message = $message . "<th>Burial Date</th>";
			$message = $message . "<th>Burial Time</th>";
			$message = $message . "</thead><tbody>";
			foreach($schedule as $row):
				$message = $message . "<tr>";
				$message = $message . "<td>" . $client[0]["client_firstname"] . " " . $client[0]["client_lastname"]  ."</td>";
				if($row["crypt_type"] == "LAWN"):
					$message = $message . "<td>" . $row["crypt_type"] . " : TYPE: " .  $row["lawn_type"] .  "</td>";
				elseif($row["crypt_type"] == "BONE" || $row["crypt_type"] == "COFFIN"):
					$message = $message . "<td>" . $row["crypt_type"] . " : ROW: " .  $row["row_number"]   . " : COLUMN : " .  $row["column_number"] ."</td>";
				endif;

				$message = $message . "<td>" . $row["burial_date"] . "</td>";
				
				$message = $message . "<td>" . $row["burial_time"] . "</td>";
				$message = $message . "</tr>";
			endforeach;



			$message = $message . "<table class='table table-bordered table-striped'>";
			$message = $message . "<thead>";
			$message = $message . "<th>Deceased</th>";
			$message = $message . "<th>Death Date</th>";
			$message = $message . "<th>Age Died</th>";
			$message = $message . "<th>Death Certificate</th>";
			$message = $message . "</thead><tbody>";
			foreach($deceased as $row):
				$message = $message . "<tr>";
				$message = $message . "<td>" . $row["deceased_firstname"] . " " . $row["deceased_lastname"] . "</td>";
				$message = $message . "<td>" . $row["date_of_death"] . "</td>";
				$message = $message . "<td>" . $row["age_died"] . "</td>";
				$message = $message . "<td><a href='".$row["death_certificate"]."' target='_blank' class='btn btn-xs btn-primary'>View</a></td>";
				$message = $message . "</tr>";
			endforeach;

			
			$message = $message ."</tbody></table>";

			$services = unserialize($transaction[0]["services"]);
			// dump($services);
			$message = $message . "<table class='table table-bordered table-striped'>";
			$message = $message . "<thead>";
			$message = $message . "<th>Service</th>";
			$message = $message . "<th>Cost</th>";
			$message = $message . "</thead><tbody>";
			foreach($services as $row):
				$message = $message . "<tr>";
				$message = $message . "<td>" . $row["service_name"] . "</td>";
				$message = $message . "<td>" . $row["cost"] . "</td>";
				$message = $message . "</tr>";
			endforeach;

			
			$message = $message ."</tbody></table>";


			echo($message);

		endif;










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
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		}
		if($_POST["action"] == "modalSchedule"){
		// dump($_POST);

			$schedule = query("select * from burial_schedule where schedule_id = ?", $_POST["schedule_id"]);
			

			$crypt_slot = query("select slot.*,
			concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name,client.profile_id,client.client_address, 
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

		$burial_schedule = query("select * from burial_schedule where 
							
		
		remarks = 'FOR SCHEDULING'");

		render("public/schedule_system/schedule_form.php",[]);
	}
?>