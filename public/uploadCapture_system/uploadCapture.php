<?php
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
				dump($query_string);
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
