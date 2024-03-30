<?php
    require("includes/config.php");
    require("includes/uuid.php");
    require("includes/checkhit.php");
	require("PHPMailer/PHPMailerAutoload.php");
	
	ini_set('max_execution_time', '300');
		
		$request = $_SERVER['REQUEST_URI'];
		$constants = get_defined_constants();
		$request = explode('/eternal_garden',$request);
		$request = $request[1];
		$request = explode('?',$request);
		$request = $request[0];
		$request = explode('/',$request);
		$request = $request[1];
		
		$countering = array("login", "register", "print", "maps", "profile", "reports", "sales");
		
		if (!in_array($request, $countering)){
			if(empty($_SESSION["eternal_garden"]["userid"]) && empty($_SESSION["eternal_garden"]["application"])){
				require 'public/login_system/login.php';
			}
			else{
				if($request == 'index' || $request == '/')
					require 'public/dashboard_system/main.php';
				else if ($request == 'users')
					require 'public/users_system/users.php';
				else if ($request == 'profile')
					require 'public/profile_system/profile.php';
				else if ($request == 'pending_burial')
					require 'public/pending_system/pending.php';
				else if ($request == 'maps')
					require 'public/maps_system/maps.php';
				else if ($request == 'burial_space')
					require 'public/burial_space_system/burial_space.php';
				else if ($request == 'coffin_crypt')
					require 'public/coffin_crypt/coffin_crypt.php';
				else if ($request == 'common_area')
					require 'public/common_area/common_area.php';
				else if ($request == 'annex')
					require 'public/annex_area/annex.php';

				else if ($request == 'reports')
					require 'public/reports_system/reports.php';

				else if ($request == 'bone_crypt')
					require 'public/bone_crypt/bone_crypt.php';
				else if ($request == 'mausoleum')
					require 'public/mausoleum/mausoleum.php';

				else if ($request == 'schedule')
					require 'public/schedule_system/schedule.php';

				else if ($request == 'lawn')
					require 'public/lawn_lots/lawn.php';

				else if ($request == 'transfer')
					require 'public/transfer_system/transfer.php';

				else if ($request == 'transaction')
					require 'public/transaction_system/transaction.php';

				else if ($request == 'sales')
					require 'public/sales_system/sales.php';
				else if ($request == 'logout')
					require 'logout.php';


		


			
				
				else
					require 'public/404_system/404.php';
			}
		}
		else{
			
			if ($request == 'login')
				require 'public/login_system/login.php';
			
			else if ($request == 'register')
				require 'public/register_system/register.php';

			else if ($request == 'print')
					require 'public/print_system/print.php';

			else if ($request == 'maps')
					require 'public/maps_system/maps.php';

			else if ($request == 'profile')
					require 'public/profile_system/profile.php';
			else if ($request == 'reports')
					require 'public/reports_system/reports.php';

				else if ($request == 'sales')
					require 'public/sales_system/sales.php';
		}
		
		
			
		
?>