<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "reports-datatable"):
			// dump($_REQUEST);
			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$where = " where 1=1 ";

			if(isset($_REQUEST["burial_space"])):
                if($_REQUEST["burial_space"] != "")
					if($_REQUEST["burial_space"] == "COFFIN" || $_REQUEST["burial_space"] == "BONE" || $_REQUEST["burial_space"] == "MAUSOLEUM" || $_REQUEST["burial_space"] == "LAWN" || $_REQUEST["burial_space"] == "COMMON" || $_REQUEST["burial_space"] == "ANNEX")
                    	$where = $where . " and s.crypt_slot_type = '".$_REQUEST["burial_space"]."'";
					else
						$where = $where . " and s.crypt_id = '".$_REQUEST["burial_space"]."'";
            endif;


            if(isset($_REQUEST["burial_from"])):
                if($_REQUEST["burial_from"] != ""):
				
					$where = $where . " and d.burial_date >= '" . $_REQUEST["burial_from"] . "'";
					// $where = $where . " and d.burial_date <= '" . $toDate . "'";
				endif;
            endif;

			if(isset($_REQUEST["burial_to"])):
                if($_REQUEST["burial_to"] != ""):
				
					// $where = $where . " and d.burial_date >= '" . $_REQUEST["burial_from"] . "'";
					$where = $where . " and d.burial_date <= '" . $_REQUEST["burial_to"] . "'";
				endif;
            endif;


			if(isset($_REQUEST["client"])):
                if($_REQUEST["client"] != "")
                    $where = $where . " and s.profile_id = '" . $_REQUEST["client"] . "'";
            endif;


			if(isset($_REQUEST["deceased_id"])):
                if($_REQUEST["deceased_id"] != "")
                    $where = $where . " and (d.deceased_id = '" . $_REQUEST["deceased_id"] . "' or occupied_by = '".$_REQUEST["deceased_id"]."')";
            endif;

			$where = $where . " and s.active_status = 'OCCUPIED' ";

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


            // $data = query("select * from tblemployee_dtras");
            if($where != ""):
                $query_string = "select * from crypt_slot s
				left join profile_list p
				on s.occupied_by = p.profile_id
				left join deceased_profile d
				on d.profile_id = p.profile_id
				".$where."
				limit ".$limit." offset ".$offset." ";
                // dump($query_string);
                $data = query($query_string);
                $all_data = query("select * from crypt_slot s
										left join profile_list p
										on s.occupied_by = p.profile_id
										left join deceased_profile d
										on d.profile_id = p.profile_id
										".$where."
										");
                // $all_data = $data;
				// dump($query_string);
            else:
                $query_string = "select * from crypt_slot s
				left join profile_list p
				on s.occupied_by = p.profile_id
				left join deceased_profile d
				on d.profile_id = p.profile_id
				limit ".$limit." offset ".$offset." ";
                                // dump($query_string);
                $data = query($query_string);
                $all_data = query("select * from crypt_slot s
				left join profile_list p
				on s.occupied_by = p.profile_id
				left join deceased_profile d
				on d.profile_id = p.profile_id");
		
                // $all_data = $data;
            endif;
            $i=0;
			// dump($data);
            foreach($data as $row):
				// dump($row);

				$data[$i]["client"] = "";
				if(isset($Profile[$row["occupied_by"]])):
					$profile = $Profile[$row["occupied_by"]];
					$data[$i]["client"] = $profile["client_firstname"] . " " . $profile["client_lastname"];
				endif;

				$data[$i]["deceased"] = "";
				if(isset($Deceased[$row["deceased_id"]])):
					$deceased = $Deceased[$row["deceased_id"]];
					$data[$i]["deceased"] = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
				endif;

				if($row["crypt_slot_type"] == "COMMON"):
					$deceased = $Deceased[$row["occupied_by"]];
					$data[$i]["deceased"] = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
				endif;


				$location = $Crypt[$row["slot_id"]];
				if($location["crypt_type"] == "LAWN"):
					$data[$i]["location"] = "LAWN : TYPE : ".$location["lawn_type"];
				elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
					$data[$i]["location"] = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
				elseif($location["crypt_type"] == "COMMON"):
					$data[$i]["location"] = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
				elseif($location["crypt_type"] == "ANNEX"):
						$data[$i]["location"] = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
				endif;

				$data[$i]["date"] = $row["burial_date"];
				$data[$i]["time"] = $row["burial_time"];
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

		if($_POST["action"] == "printForm"):
				
				
$where = " where 1=1 ";

if(isset($_POST["burial_space"])):
	if($_POST["burial_space"] != "")
		if($_POST["burial_space"] == "COFFIN" || $_POST["burial_space"] == "BONE" || $_POST["burial_space"] == "MAUSOLEUM" || $_POST["burial_space"] == "LAWN")
			$where = $where . " and s.crypt_slot_type = '".$_POST["burial_space"]."'";
		else
			$where = $where . " and s.crypt_id = '".$_POST["burial_space"]."'";
endif;


if(isset($_POST["burial_from"])):
	if($_POST["burial_from"] != ""):
	
		$where = $where . " and d.burial_date >= '" . $_POST["burial_from"] . "'";
		// $where = $where . " and d.burial_date <= '" . $toDate . "'";
	endif;
endif;

if(isset($_POST["burial_to"])):
	if($_POST["burial_to"] != ""):
	
		// $where = $where . " and d.burial_date >= '" . $_REQUEST["burial_from"] . "'";
		$where = $where . " and d.burial_date <= '" . $_POST["burial_to"] . "'";
	endif;
endif;


	  if(isset($_POST["client_id"])):
	if($_POST["client_id"] != "")
		$where = $where . " and s.occupied_by = '" . $_POST["client_id"] . "'";
endif;


	  if(isset($_POST["deceased_id"])):
	if($_POST["deceased_id"] != "")
		$where = $where . " and (d.deceased_id = '" . $_POST["deceased_id"] . "' or occupied_by = '".$_POST["deceased_id"]."')";
endif;

$where = $where . " and s.active_status = 'OCCUPIED' ";

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


$query_string = "select * from crypt_slot s
	left join profile_list p
	on s.occupied_by = p.profile_id
	left join deceased_profile d
	on d.profile_id = p.profile_id
	".$where."";
				  // dump($query_string);
  $data = query($query_string);



//   dump($data);


  $mpdf = new \Mpdf\Mpdf([
		'mode' => 'utf-8', 'format' => 'FOLIO-L',
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
                                        <h4 style="text-align: center; padding: 0px; margin: 0px;">PROFILING REPORT</h4>
                                        
                                        <table class="tbl">
                                            <tr class="grey">
                                                <th>Deceased</th>
                                                <th>Birth</th>
                                                <th>Death</th>
                                                <th>Age Died</th>
                                                <th>Crypt Location</th>
                                                <th>Burial Date</th>
                                                <th>Burial Time</th>
                                                <th>Client</th>
                                            </tr>
                                        EOD;

										$i = 0;
                                        foreach ($data as $row) {
											$i++;
                                            // $record["sr_is_per_session"] === 1 ? $record["sr_salary_rate"] = $record["sr_rate_on_schedule"] : "";
                                            // $record["FromDate"] = datePDF($record["FromDate"]);
                                            // $record["ToDate"] = datePDF($record["ToDate"]);
                                            // $designation = $Designation[$record["DesigID"]]["DesigName"];
                                            // $status = $Stat[$record["StatID"]]["StatName"];
                                            // $assignment = $Assignment[$record["AssignID"]]["AssignName"];
                                            // $branch = $Branch[$record["BranchID"]]["BranchName"];
                                            // $salary = to_peso($record["MonthlySalary"]);

											$deceased_name = "";
											if(isset($Deceased[$row["deceased_id"]])):
												$deceased = $Deceased[$row["deceased_id"]];
												$deceased_name = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
											endif;

											if($row["crypt_slot_type"] == "COMMON"):
												$deceased = $Deceased[$row["occupied_by"]];
												$deceased_name = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
											endif;


											$location_name= "";
											$location = $Crypt[$row["slot_id"]];
											if($location["crypt_type"] == "LAWN"):
												$location_name = "LAWN : TYPE : ".$location["lawn_type"];
											elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
												$location_name = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
											elseif($location["crypt_type"] == "COMMON"):
												$location_name = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
											elseif($location["crypt_type"] == "ANNEX"):
												$location_name = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
											endif;


											$client_name = "";
											if(isset($Profile[$row["occupied_by"]])):
											  $profile = $Profile[$row["occupied_by"]];
											  $client_name = $profile["client_firstname"] . " " . $profile["client_lastname"];
											endif;
                                        
                                            $html .= <<< EOD
                                            <tr>
                                                <td>$deceased_name</td>
                                                <td>$row[birthdate]</td>
                                                <td>$row[date_of_death]</td>
                                                <td>$row[age_died]</td>
                                                <td>$location_name</td>
                                                <td>$row[burial_date]</td>
                                                <td>$row[burial_time]</td>
                                                <td>$client_name</td>
                                            </tr>
                                        EOD;

                                        if($i == 34):


                                            $html .= <<< EOD
                                            <tr>
                                                <td  colspan="8" class="center grey">************************************************* NEXT PAGE *************************************************</td>
                                            </tr>
                                        </table>

                                        <table width="100%" style="padding-top: 20px;">
<tr><td colspan="2" class="center"></td></tr>
<tr>
    <td></td>
    <td class="center nw" width="50%"><strong></strong></td>
</tr>
<tr>
    <td></td>
    <td class="center nw" width="50%"></td>
</tr>
<tr><td colspan="2" class="center">Issued in compliance with Executive Order No. 54, dated August 10, 1954 and in accordance with Circular No. 58, dated August 10, 1954 of the System.
</td></tr>
<tr><td colspan="2" class="center">Issued this $datenow at Panabo City, Davao del Norte, Philippines.
</td></tr>
</table>


<table width="100%" style="padding-top: 20px;">
<tr><td colspan="2" class="center">Certified Correct:</td></tr>
<tr><td colspan="2" class="center">&nbsp;</td></tr>
<tr><td colspan="2" class="center">&nbsp;</td></tr>
<tr><td colspan="2" class="center">&nbsp;</td></tr>
</table>

EOD;





$mpdf->WriteHTML($html);
$mpdf->AddPage();

$html = <<< EOD
<div style="position: fixed; left: 200px; top: 1px;">
<img src="./resources/hr_logo.png" width="60">
</div>
<div style="text-align:center; width: 100%;">
<p>Republic of the Philippines <br>
Province of Davao del Norte <br>
City of Panabo</p>
</div>
<h4 style="text-align: center; padding: 0px; margin: 0px;">SERVICE RECORD</h4>
<p style="text-indent: 5%; font-size: 12px;">This is to certify that the employee herein shows actually rendered service in this office as shown by the service record below, each line of which
is supported by appointment and other papers actually issued by this Office and approved by authorities concerned.</p>


<table class="tbl">
<tr class="grey">
    <th rowspan="2">#</th>
    <th colspan="2">SERVICE<br>(inclusive dates)</th>
    <th colspan="3">RECORD OF APPOINTMENT</th>
    <th colspan="2">OFFICE / ENTITY / DIVISION</th>
    <th rowspan="2" width="25%">REMARKS</th>
</tr>
<tr class="grey">
    <th>From</th>
    <th>To</th>
    <th>Designation</th>
    <th>Status</th>
    <th>Salary</th>
    <th>Station / Place of Assignment</th>
    <th>Branch</th>
</tr>
EOD;

// $mpdf->WriteHTML($html);

                                        endif;
// continue;
                                        // break;
                                        }
                                        $html .= <<< EOD
                                            <tr>
                                                <td  colspan="8" class="center grey">************************************************* nothing follows *************************************************</td>
                                            </tr>
                                        </table>
                                        <table width="100%" style="padding-top: 20px;">
<tr><td colspan="2" class="center"></td></tr>
<tr>
    <td></td>
    <td class="center nw" width="50%"><strong></strong></td>
</tr>
<tr>
    <td></td>
    <td class="center nw" width="50%"></td>
</tr>

</table>


<table width="100%" style="padding-top: 20px;">
<tr><td colspan="2" class="center">&nbsp;</td></tr>
<tr><td colspan="2" class="center">&nbsp;</td></tr>
<tr><td colspan="2" class="center">&nbsp;</td></tr>


<tr><td colspan="2">

</td></tr>

</table>

EOD;
                                        
                                            // dump($html);

                                        $mpdf->WriteHTML($html);

                                        $mpdf->Output("resources/reports/report.pdf", \Mpdf\Output\Destination::FILE);

        $res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success",
					"link" => "resources/reports/report.pdf",
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
			
			$deceased = query("select * from deceased_profile");
			$client = query("select * from profile_list");

			$burial_space = query("select * from crypt_list");
			render("public/reports_system/reports_form.php",
			[
				"deceased" => $deceased,
				"client" => $client,
				"burial_space" => $burial_space,
				// "slot" => $slot,
			]);
		endif;


		if($_GET["action"] == "printForm"):
			
			renderview("public/reports_system/printForm.php",[
				// "forms" => $forms,
			]);
		endif;

		
	}
?>
