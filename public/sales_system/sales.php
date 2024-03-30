<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "sales-datatable"):
			// dump($_REQUEST);
			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];
			$where = " where total_fee != ''  ";
            if(isset($_REQUEST["client"])):
                if($_REQUEST["client"] != "")
                    $where = $where . " and profile_id = '" . $_REQUEST["client"] . "'";
            endif;

			if(isset($_REQUEST["from"])):
                if($_REQUEST["from"] != "")
                    $where = $where . " and date >= '" . $_REQUEST["from"] . "'";
            endif;

            if(isset($_REQUEST["to"])):
                if($_REQUEST["to"] != "")
                    $where = $where . " and date <= '" . $_REQUEST["to"] . "'";
            endif;

			$crypt = query("select * from crypt_slot s
							left join crypt_list c
							on c.crypt_id = s.crypt_id");
            $Crypt = [];
            foreach($crypt as $row):
                $Crypt[$row["slot_id"]] = $row;
            endforeach;

			$Profile = [];
			$profile = query("select * from profile_list");
			foreach($profile as $row):
				$Profile[$row["profile_id"]] = $row;
			endforeach;

			$Deceased = [];
			$deceased = query("select * from deceased_profile");
			foreach($deceased as $row):
				$Deceased[$row["deceased_id"]] = $row;
			endforeach;

			$Deceased_Transaction = [];
			$deceased_transaction = query("select * from deceased_transaction");
			foreach($deceased_transaction as $row):
				$Deceased_Transaction[$row["transaction_id"]][$row["deceased_id"]] = $row;
			endforeach;


            // $data = query("select * from tblemployee_dtras");
            if($where != ""):
                $query_string = "SELECT * FROM transaction t  ".$where."
				ORDER BY t.timestamp DESC
				limit ".$limit." offset ".$offset." ";
                // dump($query_string);
                $data = query($query_string);
                $all_data = query("SELECT * FROM transaction t ".$where."
				ORDER BY t.timestamp DESC");
                // $all_data = $data;
            else:
                $query_string = "SELECT * FROM transaction t ".$where."
				ORDER BY t.timestamp DESC
				limit ".$limit." offset ".$offset." ";
                                // dump($query_string);
                $data = query($query_string);
                $all_data = query("SELECT * FROM transaction t ".$where."
				ORDER BY t.timestamp DESC");
                // $all_data = $data;
            endif;
            $i=0;
            foreach($data as $row):
				// dump($row);

				$data[$i]["action"] = '<a href="#" data-id="'.$row["transaction_id"].'"  class="btn btn-primary btn-xs btn-flat btn-block open_transaction_modal">View</a>';


				$data[$i]["client"] = "";
				if(isset($Profile[$row["profile_id"]])):
					$profile = $Profile[$row["profile_id"]];
					$data[$i]["client"] = $profile["client_firstname"] . " " . $profile["client_lastname"];
				endif;

					
				$location = $Crypt[$row["slot_id"]];
				
				if($location["crypt_type"] == "LAWN"):
					$data[$i]["location"] = "LAWN : TYPE : ".$location["lawn_type"];
				elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
					$data[$i]["location"] = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
				elseif($location["crypt_type"] == "COMMON"):
					$data[$i]["location"] = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
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


		if($_POST["action"] == "print_pdf"):
				// dump($_POST);


				
				
$where = " where total_fee != ''  ";


if(isset($_POST["profile"])):
  if($_POST["profile"] != "")
      $where = $where . " and profile_id = '" . $_POST["profile"] . "'";
endif;


if(isset($_POST["from"])):
  if($_POST["from"] != "")
      $where = $where . " and date >= '" . $_POST["from"] . "'";
endif;

if(isset($_POST["to"])):
  if($_POST["to"] != "")
      $where = $where . " and date <= '" . $_POST["to"] . "'";
endif;


$crypt = query("select * from crypt_slot s
							left join crypt_list c
							on c.crypt_id = s.crypt_id");
            $Crypt = [];
            foreach($crypt as $row):
                $Crypt[$row["slot_id"]] = $row;
            endforeach;

			$Profile = [];
			$profile = query("select * from profile_list");
			foreach($profile as $row):
				$Profile[$row["profile_id"]] = $row;
			endforeach;

			$Deceased = [];
			$deceased = query("select * from deceased_profile");
			foreach($deceased as $row):
				$Deceased[$row["deceased_id"]] = $row;
			endforeach;

			$Deceased_Transaction = [];
			$deceased_transaction = query("select * from deceased_transaction");
			foreach($deceased_transaction as $row):
				$Deceased_Transaction[$row["transaction_id"]][$row["deceased_id"]] = $row;
			endforeach;


        if($where != ""):
          $query_string = "SELECT * FROM transaction t  ".$where."
          ORDER BY t.timestamp DESC";
          $data = query($query_string);
        else:
            $query_string = "SELECT * FROM transaction t ".$where."
            ORDER BY t.timestamp DESC";
            $data = query($query_string);
        endif;


		

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8', 'format' => 'FOLIO-P',
			'margin_top' => 15,
			'margin_left' => 5,
			'margin_right' => 5,
			'margin_bottom' => 5,
			'margin_footer' => 1,
			'default_font' => 'helvetica'
		]);
	
	   $mpdf->showImageErrors = true;
	
	   $html = <<< EOD
											<style>
												.p-2 {
													padding: 3px;
												}
												.u {
													border-bottom: 1px solid black;
												}
												.nw {
													white-space:nowrap;
												}
												.w {
													width: 250;
												}
												th,td {
													font-size: 10px;
												}
												.tbl {
													width: 100%;
													border-collapse: collapse;
												}
												.tbl tr th {
													border: 1px inset grey;
												}
												.tbl tr td {
													border: 1px inset grey;
													padding: 3px;
												}
												.center {
													text-align: center;
												}
												.grey {
													background-color: lightgrey;
												}
											</style>
											
											<htmlpagefooter name="myFooter2">
												<table width="100%" style="border: none; font-size: 9px; font-weight: bold; font-style: italic;">
													<tr><td colspan="3" class="u"></td></tr>
													<tr>
														<td width="33%">Printed on {DATE F d, Y}</td>
														<td width="33%"></td>
														<td width="33%" style="text-align:right;">Page {PAGENO} of {nbpg}</td>
													</tr>
												</table>
											</htmlpagefooter>
											<sethtmlpagefooter name="myFooter2" value="on" force="1" />
											<div style="position: fixed; left: 175px; top: 1px;">
												<img src="./resources/logo.png" width="60">
											</div>
											<div style="text-align:center; width: 100%;">
												<p>City Economic Enterprise Management <br>
												and Development Office <br>
												CEEMDO - CEMETERY</p>
											</div>
											<h4 style="text-align: center; padding: 0px; margin: 0px;">SALES REPORT</h4>
											
											<table class="tbl">
												<tr class="grey">
													<th>Client</th>
													<th>Location</th>
													<th>Type</th>
													<th>Date</th>
													<th>Time</th>
													<th>Fee</th>
												</tr>
											EOD;
	
											$i = 0;
											$grand_total_fee = 0;
											foreach ($data as $row) {
												$i++;
												$grand_total_fee = $grand_total_fee + $row["total_fee"];

												$client = "";
												if(isset($Profile[$row["profile_id"]])):
													$profile = $Profile[$row["profile_id"]];
													$client = $profile["client_firstname"] . " " . $profile["client_lastname"];
												endif;
												$client = strtoupper($client);


												$location = $Crypt[$row["slot_id"]];
												if($location["crypt_type"] == "LAWN"):
													$the_location = "LAWN : TYPE : ".$location["lawn_type"];
												elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
													$the_location = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
												elseif($location["crypt_type"] == "COMMON"):
													$the_location = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
												endif;

												$total_fee = to_peso($row["total_fee"]);
											
												$html .= <<< EOD
												<tr>
													<td>$client</td>
													<td>$the_location</td>
													<td>$row[transaction_type]</td>
													<td>$row[date]</td>
													<td>$row[time]</td>
													<td style="text-align: right; float:right;">$total_fee</td>
												</tr>
											EOD;
	
											
	// continue;
											// break;
											}

											$grand_total_fee = to_peso($grand_total_fee);

											$html .= <<< EOD
												<tr>
													<td  colspan="6" class="center grey">************************************************* nothing follows *************************************************</td>
												</tr>
											</table>
									
	
	
	<table width="100%" style="padding-top: 5px;">
	<tr ><td><h3 style="text-align:right; float: right;">
	Total:₱  $grand_total_fee</h3>
	</td></tr>
	
	</table>
	
	EOD;
											
												// dump($html);
	
											$mpdf->WriteHTML($html);
	
											$mpdf->Output("resources/sales/sales.pdf", \Mpdf\Output\Destination::FILE);
	
			$res_arr = [
						"result" => "success",
						"title" => "Success",
						"message" => "Success",
						"link" => "resources/sales/sales.pdf",
						"newlink" => "newlink",
						];
						echo json_encode($res_arr); exit();










				// $base_url = the_base_url();
				// $options = urlencode(serialize($_POST));
                // $webpath = $base_url . "/eternal_garden/sales?action=print_pdf&options=".$options;
                // $filename = "SALES";
				// $path = "resources/sales/".$filename.".pdf";
				// $exec = '"C:/Program Files/wkhtmltopdf/bin/wkhtmltopdf.exe" -O portrait --image-dpi 300 "'.$webpath.'" '.$path.'';
				// // dump($webpath);
				// exec($exec);
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success",
					"link" => $path,
					"newlink" => "newlink",
					];
					echo json_encode($res_arr); exit();




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
		if($_GET["action"] == "list"):
			
			// $deceased = query("select * from deceased_profile");
			$client = query("select * from profile_list");


			render("public/sales_system/sales_list.php",
			[
				// "deceased" => $deceased,
				"client" => $client,
				// "slot" => $slot,
			]);
		endif;


		if($_GET["action"] == "print_pdf"):
			renderview("public/sales_system/salesPdf.php",[
				// "forms" => $forms,
			]);
		endif;

		
	}
?>
