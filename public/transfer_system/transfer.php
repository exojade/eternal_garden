<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "notify_mail"):
			// dump($_POST);
			$site_options = query("select * from site_options");
			$profile = query("select * from profile_list where profile_id = ?", $_POST["profile_id"]);
			$profile = $profile[0];
			$crypt = query("select * from crypt_slot s left join crypt_list c
							on c.crypt_id = s.crypt_id
							where s.slot_id = ?", $profile["slot_number"]);
			$crypt = $crypt[0];

			$notification = query("select * from notification where profile_id = ? and slot_id = ?", $_POST["profile_id"], $profile["slot_number"]);
			$notification = $notification[0];
			// dump($notification);
			$google_user = $site_options[0]["google_user"];
			$google_password = $site_options[0]["google_password"];
			$mail = new PHPMailer();


			$lease_date = $profile["lease_date"];
			$date_expired = $profile["date_expired"];
			$current_date = date("Y-m-d");

			$lease_start = new DateTime($lease_date);
			$lease_end = new DateTime($date_expired);
			$duration = $lease_start->diff($lease_end)->days;
			$days_passed = $lease_start->diff(new DateTime($current_date))->days;
			$progress_percentage = ($days_passed / $duration) * 100;
			$days_left = $duration - $days_passed;

			$timestamp = strtotime($profile["date_expired"]);
    		$date_expired = date("F d, Y", $timestamp);

			$full_name = $profile["client_firstname"] . " " . $profile["client_lastname"];
			$the_message = "Dear Mr./Ms. " . $full_name . ",<br><br>";
			$the_message .= "We would like to inform you that your allocated crypt, situated at " . $crypt["crypt_name"] . " in Row " . $crypt["row_number"] . " and Column " . $crypt["column_number"] . ", requires your attention.<br><br>";
			$the_message .= "The crypt lease has its expiration date on " . $date_expired . ", only ".$days_left." days left to settle this concern.<br><br>";
			$the_message .= "In accordance with our policy, should the lease expire, the remains previously housed in the crypt will be respectfully relocated to our common area. We understand the importance of this matter and will handle the process with the utmost care and respect.<br><br>";
			$the_message .= "If you have any questions or concerns regarding this matter, please do not hesitate to contact our office.<br><br>";
			$the_message .= "Sincerely,<br><br>Eternal Garden Cemetery, Panabo City";
			$message = "<html>
				<body>
					".$the_message."
				</body>
			</html>";
			// dump($message);

			try {
				$mail->isSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "ssl";
				$mail->Host = "smtp.gmail.com";
				$mail->Port = "465";
				$mail->isHTML();
				$mail->Username = $google_user;
				$mail->Password = $google_password;
				$mail->SetFrom("no-reply@cemetery_system.com");
				$mail->Subject = "Cemetery Online Notification: " . $_POST["notif_type"];
				$mail->Body = $message;
				$mail->AddAddress($profile["email_address"]);
				$mail->Send();

				if($_POST["notif_type"] == "year_notification")
					query("update notification_status set year_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "6months_notification")
					query("update notification_status set 6months_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "3months_notification")
					query("update notification_status set 3months_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "month_notification")
					query("update notification_status set month_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "week_notification")
					query("update notification_status set week_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "day_before_notification")
					query("update notification_status set day_before_notif_status = 1 where notification_id = ?", $notification["notification_id"]);
				else if($_POST["notif_type"] == "date_expired")
					query("update notification_status set day_notif_status = 1 where notification_id = ?", $notification["notification_id"]);

				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success mailing the concern",
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();	
			  } catch (phpmailerException $e) {
				
				$res_arr = [
					"result" => "failed",
					"title" => "Failed Mail",
					"message" => $e->errorMessage(),
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();	
				
			  } catch (Exception $e) {
				$res_arr = [
					"result" => "failed",
					"title" => "Failed Mail",
					"message" => $e->getMessage(),
					"link" => "refresh",
					];
					echo json_encode($res_arr); exit();	
			  }
		endif;
		
		
    }
	else {

		if($_GET["action"] == "list"){
			render("public/transfer_system/transfer_list.php",[]);
		}

		if($_GET["action"] == "details"){
			render("public/transfer_system/transfer_details.php",[]);
		}

		
	}
?>
