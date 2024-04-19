<?php

	// $client = query("select * from zzzbonecryptprofile");
	// foreach($client as $row):

	// 	$profile_id = create_uuid("PROF");
	// 	$transaction = create_uuid("TRANSACTION");



	// 	query("update zzzbonecryptprofile set clientid = ?, transaction_id = ?
	// 			where id = ?", $profile_id, $transaction,$row["id"]);
	// endforeach;

	// dump("Done");

	

	// $deceased = query("select * from zzzbonecryptdeceased");
	// foreach($deceased as $row):

	// 	$deceased_id = create_uuid("DEC");
	// 	// $transaction = create_uuid("TRANSACTION");
	// 	query("update zzzbonecryptdeceased set deceased_id = ?
	// 			where tblid = ?", $deceased_id,$row["tblid"]);
	// endforeach;

	// dump("Done");



    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "upload"):
			// dump($_FILES);


		$insertsClient = array();
        $queryFormatClient = "('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')";
        $insertsDeceased = array();
        $queryFormatDeceased = "('%s','%s','%s','%s','%s','%s','%s','%s','%s')";
	


		$fileName = $_FILES["uploadCSV"]["tmp_name"];
        if ($_FILES["uploadCSV"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $i = 0;
			fgetcsv($file);
			fgetcsv($file);
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
               
       

					$profile_id = create_uuid("PROF");
					$clientFirstName = $column[4];
					$clientMiddleName = $column[5];
					$clientLastName = $column[6];
					$clientSuffix = $column[7];
					$clientProvince = $column[8];
					$clientCity = $column[9];
					$clientBarangay = $column[10];
					$clientAddress = $column[11];
					$clientContact = $column[12];
					if($column[21] != ""):
						$formattedDate = date('Y-m-d', strtotime($column[21]));
						$t = strtotime($formattedDate);
						$lease_expired = date('Y-m-d', strtotime('+5 years', $t));
					else:
						$formattedDate = "";
						$lease_expired = "";
					endif;
					



					$deceased_id = create_uuid("DEC");
					
					$DeceasedFirstname = $column[23];
					$DeceasedMiddleName = $column[24];
					$DeceasedLastName = $column[25];
					$DeceasedSuffix = $column[26];
					$DeceasedGender = $column[29];
					$DeceasedName = $DeceasedFirstname . " " . $DeceasedLastName;

					$ORNumber = $column[3];



					





				
                    
                    
                    $insertsClient[] = sprintf( 
                         $queryFormatClient, $profile_id, $clientFirstName,
						 $clientMiddleName, $clientLastName, $clientSuffix, $clientContact, $clientProvince, $clientCity, $clientBarangay,
						 $clientAddress, $formattedDate, $lease_expired, "TEMP", $ORNumber);


					$insertsDeceased[] = sprintf( 
						$queryFormatDeceased, $deceased_id, $DeceasedName, $DeceasedFirstname,
						$DeceasedMiddleName, $DeceasedLastName,$DeceasedSuffix, $DeceasedGender, "TEMP", $profile_id);
              
            
            }
            	$query = implode( ",", $insertsClient );
                $query_string = "insert into profile_list
                (
					profile_id, client_firstname, client_middlename,client_lastname,client_suffix,client_contact,
					province,city_municipality,barangay,client_address,lease_date,date_expired,tempStatus,tempOR
				) 
                VALUES " . $query;
				// dump($query_string);
                query($query_string);

				$query = implode( ",", $insertsDeceased );
                $query_string = "insert into deceased_profile
                (
					deceased_id, deceased_name, deceased_firstname,deceased_middlename,
					deceased_lastname,deceased_suffix,gender,tempStatus,profile_id
				) 
                VALUES " . $query;
                query($query_string);




                $res_arr = [
                    "message" => "Successfully Uploaded and converted to RAW Attendance Data",
                    "status" => "success",
                    "link" => "refresh",
                    ];
                    echo json_encode($res_arr); exit();
                }
				else;
		elseif($_POST["action"] == "uploadCaptureTempProfile"):
			

			$slot = query("select * from crypt_slot where slot_id = ?", $_POST["crypt_slot"]);
			$slot = $slot[0];
			// dump($slot);
			
			$profile=query("select * from profile_list where profile_id = ?", $_POST["tempProfile"]);
			// dump($profile);
			$profile = $profile[0];

			if($slot["crypt_slot_type"] == "COFFIN"):
				$timestamp = strtotime($profile["lease_date"] . " 08:00:00");
			elseif($slot["crypt_slot_type"] == "BONE"):
				$profile["lease_date"] = $profile["tempDateTransaction"];
				$timestamp = strtotime($profile["tempDateTransaction"] . " 08:00:00");
			else:
				dump("not allowed");
			endif;

			$transaction_id = create_uuid("TRANSACTION");

			if (query("insert INTO transaction (transaction_id, date, time, profile_id, logs, timestamp,
													transaction_type, orNumber, slot_id)
                        VALUES(?,?,?,?,?,?,?,?,?)", 
                        $transaction_id, $profile["lease_date"], "08:00:00", $_POST["tempProfile"], "CAPTURED DATA", $timestamp , "CAPTURE", $profile["tempOR"],$_POST["crypt_slot"]) === false){
                            $res_arr = [
                                "result" => "failed",
                                "title" => "Failed",
                                "message" => "Failed",
                                // "link" => "appointment?action=list",
                                // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                                ];
                                echo json_encode($res_arr); exit();
							}




							if($slot["crypt_slot_type"] == "COFFIN"):
								$notification_id = create_uuid("NOTIF");
								$one_year_before = date('Y-m-d', strtotime('-1 year', strtotime($profile["date_expired"])));
								$six_months_before = date('Y-m-d', strtotime('-6 months', strtotime($profile["date_expired"])));
								$three_months_before = date('Y-m-d', strtotime('-3 months', strtotime($profile["date_expired"])));
								$one_month_before = date('Y-m-d', strtotime('-1 month', strtotime($profile["date_expired"])));
								$one_week_before = date('Y-m-d', strtotime('-1 week', strtotime($profile["date_expired"])));
								$one_day_before = date('Y-m-d', strtotime('-1 day', strtotime($profile["date_expired"])));
								if (query("insert into notification 
								(
									notification_id, profile_id, slot_id,
									year_date,6months_date,3months_date,month_date,
									week_date,day_before_date,date_expired
								) 
								VALUES(?,?,?,?,?,?,?,?,?,?)",
								$notification_id, $_POST["tempProfile"], $_POST["crypt_slot"],
								$one_year_before,$six_months_before,$three_months_before,$one_month_before,
								$one_week_before,$one_day_before,$profile["date_expired"]) === false)
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

							endif;

								query("update profile_list set slot_number = ?,
											tempStatus = NULL, paid_status = 'PAID',
											tempOR = null, transaction_id = ?
											where profile_id = ?", $_POST["crypt_slot"], $transaction_id, $_POST["tempProfile"]);

								query("update crypt_slot set active_status = 'OCCUPIED',
											occupied_by = ?
											where slot_id = ?", $_POST["tempProfile"], $_POST["crypt_slot"]);

								query("update deceased_profile set burial_date = ?, burial_time = '08:00 AM',
											slot_number = ?, burial_status = 'DONE', transaction_id = ?,
											tempStatus = NULL where profile_id = ?", $profile["lease_date"], $_POST["crypt_slot"],
											$transaction_id, $_POST["tempProfile"]);

											$res_arr = [
												"result" => "success",
												"title" => "Success",
												"message" => "Success Capture Data",
												"link" => "refresh",
												// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
												];
												echo json_encode($res_arr); exit();




			



		
		endif;
		
    }
	else {
		if(!isset($_GET["action"])):
			
			// $deceased = query("select * from deceased_profile");
			// $client = query("select * from profile_list");
			render("public/uploadCapture_system/uploadCaptureForm.php",
			[
				// "deceased" => $deceased,
				// "client" => $client,
				// "slot" => $slot,
			]);
		endif;

		
	}
?>
