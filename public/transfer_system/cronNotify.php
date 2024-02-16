<?php


// require("includes/constants.php");
// require("includes/functions.php");



// $notification = query("SELECT *
// FROM (
//     SELECT
// 		n.notification_id,
//         n.profile_id,
//         SUM(CASE WHEN n.year_date <= CURDATE() AND (ns.year_notif_status = '' OR ns.year_notif_status IS NULL) THEN 1 ELSE 0 END) AS year_need_to_notify,
//         SUM(CASE WHEN n.6months_date <= CURDATE() AND (ns.6months_notif_status = '' OR ns.6months_notif_status IS NULL) THEN 1 ELSE 0 END) AS six_months_need_to_notify,
//         SUM(CASE WHEN n.3months_date <= CURDATE() AND (ns.3months_notif_status = '' OR ns.3months_notif_status IS NULL) THEN 1 ELSE 0 END) AS three_months_need_to_notify,
//         SUM(CASE WHEN n.month_date <= CURDATE() AND (ns.month_notif_status = '' OR ns.month_notif_status IS NULL) THEN 1 ELSE 0 END) AS month_need_to_notify,
//         SUM(CASE WHEN n.week_date <= CURDATE() AND (ns.week_notif_status = '' OR ns.week_notif_status IS NULL) THEN 1 ELSE 0 END) AS week_need_to_notify,
//         SUM(CASE WHEN n.day_before_date <= CURDATE() AND (ns.day_before_notif_status = '' OR ns.day_before_notif_status IS NULL) THEN 1 ELSE 0 END) AS day_before_need_to_notify,
//         SUM(CASE WHEN n.date_expired <= CURDATE() AND (ns.day_notif_status = '' OR ns.day_notif_status IS NULL) THEN 1 ELSE 0 END) AS date_expired_need_to_notify
//     FROM notification n
//     LEFT JOIN notification_status ns ON n.notification_id = ns.notification_id
//     LEFT JOIN profile_list p ON p.profile_id = n.profile_id
//     WHERE p.active_status IS NULL OR p.active_status != 'FORMER'
//     GROUP BY n.profile_id
// ) AS subquery
// ORDER BY
//     year_need_to_notify + six_months_need_to_notify + three_months_need_to_notify + month_need_to_notify + week_need_to_notify + day_before_need_to_notify DESC
//     "); 
// 	dump($notification);


	$notification = query("select n.*,ns.*, 
	p.client_firstname, p.client_middlename, p.client_lastname, p.email_address, p.client_contact, p.active_status,
	p.lease_date, p.date_expired

	from notification n left join notification_status ns on 
		ns.notification_id = n.notification_id
		left join profile_list p
		on n.profile_id = p.profile_id
		where p.active_status IS NULL
	");
	// dump($notification);

	$Crypt = [];
	$crypt_slot = query("select * from crypt_slot cs left join crypt_list c
						on c.crypt_id = cs.crypt_id
						where cs.crypt_slot_type = 'COFFIN'");
	foreach($crypt_slot as $row):
		$Crypt[$row["slot_id"]] = $row;
	endforeach;

	// dump($notification);


	$i=0;
	$toMessage = [];
	foreach($notification as $n):
		$data = strtotime($n["6months_date"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["6months_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "6months_date";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["6months_date"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				// echo("<br>");
				// echo($n["profile_id"] . " NAMESSAGEAN NA" . " 6months_date");
				// echo("<br>");
				//code to update notif_status
			endif;
		endif;

		$data = strtotime($n["3months_date"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["3months_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "3months_date";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["3months_date"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				//code to update notif_status
			endif;
		endif;

	

		$data = strtotime($n["month_date"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["month_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "month_date";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["month_date"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				//code to update notif_status
			endif;
		endif;

		$data = strtotime($n["week_date"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["week_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "week_date";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["week_date"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				//code to update notif_status
			endif;
		endif;

		$data = strtotime($n["day_before_date"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["day_before_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "day_before_date";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["day_before_date"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				//code to update notif_status
			endif;
		endif;

		$data = strtotime($n["date_expired"]);
		$current = strtotime(date("Y-m-d"));
		if($data <= $current):
			if($n["day_notif_status"] == ""):
				$toMessage[$i]["profile_id"] = $n["profile_id"];
				$toMessage[$i]["type"] = "date_expired";
				$toMessage[$i]["contact"] = $n["client_contact"];
				$toMessage[$i]["date"] = $n["date_expired"];
				$toMessage[$i]["notification_id"] = $n["notification_id"];
				$toMessage[$i]["slot_id"] = $n["slot_id"];
				$toMessage[$i]["date_expired"] = $n["date_expired"];
				$toMessage[$i]["name"] = $n["client_firstname"] . " " . $n["client_lastname"];
				$toMessage[$i]["status"] = $n["active_status"];
				$toMessage[$i]["lease_date"] = $n["lease_date"];
				$toMessage[$i]["email_address"] = $n["email_address"];
				$i++;
				//code to update notif_status
			endif;
		endif;
	endforeach;



	// dump($toMessage);
	// $ToMessage = [];
	// foreach($toMessage as $row):
	// 	$ToMessage[$row["profile_id"]][$row["type"]] = $row;
	// endforeach;
	// dump($toMessage);


	foreach($toMessage as $row):
		$message = "Good Day ".$row["name"]."! This is ";
		if($row["type"] == "6months_date"):
			$message.="6 month notification message.";
			query("update notification_status set 6months_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		elseif($row["type"] == "3months_date"):
			$message.="3 month notification message.";
			query("update notification_status set 3months_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		elseif($row["type"] == "month_date"):
			$message.="month notification message.";
			query("update notification_status set month_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		elseif($row["type"] == "week_date"):
			$message.="week notification message.";
			query("update notification_status set week_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		elseif($row["type"] == "day_before_date"):
			$message.="day before notification message.";
			query("update notification_status set day_before_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		elseif($row["type"] == "date_expired"):
			$message.="day expired notification message.";
			query("update notification_status set day_notif_status = 1 where notification_id = ?", $row["notification_id"]);
		endif;

		if($Crypt[$row["slot_id"]]["crypt_slot_type"] == "COFFIN"):
			$crypt = $Crypt[$row["slot_id"]];
			$message.=" Location: " . $crypt["crypt_name"] . " : Row:" . $crypt["row_number"] . " : Col:" . $crypt["column_number"];
		endif;
		$message.=". The expiry date of your slot is on: " . $row["date_expired"] . ". Please visit the Eternal Garden Cemetery for negotiation. [System Generated Message: Please dont reply!]";
		// dump($message);





			// dump($row);
			$lease_date = $row["lease_date"];
			$date_expired = $row["date_expired"];
			$current_date = date("Y-m-d");

			$lease_start = new DateTime($lease_date);
			$lease_end = new DateTime($date_expired);
			$duration = $lease_start->diff($lease_end)->days;
			$days_passed = $lease_start->diff(new DateTime($current_date))->days;
			$days_left = $duration - $days_passed;

			$timestamp = strtotime($row["date_expired"]);
    		$date_expired = date("F d, Y", $timestamp);

			$full_name = $row["name"];
			$the_message = "Dear Mr./Ms. " . $full_name . ",<br><br>";
			$the_message .= "We would like to inform you that your allocated crypt, situated at " . $crypt["crypt_name"] . " in Row " . $crypt["row_number"] . " and Column " . $crypt["column_number"] . ", requires your attention.<br><br>";
			$the_message .= "The crypt lease has its expiration date on " . $date_expired . ", only ".$days_left." days left to settle this concern.<br><br>";
			$the_message .= "In accordance with our policy, should the lease expire, the remains previously housed in the crypt will be respectfully relocated to our common area. We understand the importance of this matter and will handle the process with the utmost care and respect.<br><br>";
			$the_message .= "If you have any questions or concerns regarding this matter, please do not hesitate to contact our office.<br><br>";
			$the_message .= "Sincerely,<br><br>Eternal Garden Cemetery, Panabo City";
	

			// dump($message);

		

		$ch = curl_init();
		$parameters = array(
			'message' => $the_message, //Your API KEY
			'subject' => "EMAIL CEMETERY",
			'email_address' => $row["email_address"],
		);
		curl_setopt( $ch, CURLOPT_URL,'http://api.panabocity.gov.ph/register_final_data');
		curl_setopt( $ch, CURLOPT_POST, 1 );

		//Send the parameters set above with the request
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

		// Receive response from server
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		$output = curl_exec( $ch );
		curl_close ($ch);

		//Show the server response
		// echo $output;
		// dump($output);
		// dump($output);


	




	$ch = curl_init();
	$parameters = array(
		'apikey' => 'c7886ec1b7c43d0fdddf002e6bd7b1e3', //Your API KEY
		'number' => $row["contact"],
		'message' => $message,
		'sendername' => 'PANABOCMTRY'
	);
	curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
	curl_setopt( $ch, CURLOPT_POST, 1 );

	//Send the parameters set above with the request
	curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

	// Receive response from server
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	$output = curl_exec( $ch );
	curl_close ($ch);

	//Show the server response
	echo $output;
	endforeach;

?>
