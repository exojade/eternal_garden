<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "filter_lawn"){
			// dump($_POST);
			$link = "maps?action=map_details&crypt_type=LAWN&filter=".$_POST["filter"]."";
			// dump($link);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => $link,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		}

		if($_POST["action"] == "assign_crypt"):
			
			$coordinates = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);


			$crypt = query("select * from crypt_list where crypt_id = ?", $_POST["crypt"]);

			// dump($crypt);
			// dump($coordinates);
			query("update crypt_list set coordinates = ? where crypt_id = ?", $coordinates[0]["coordinates"],$_POST["crypt"]);
			query("update crypt_slot set crypt_slot_type = ? where slot_id = ?",$crypt[0]["crypt_type"],$_POST["slot_id"]);
			$link = "maps?filter=ALL";
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		endif;

		if($_POST["action"] == "upload_lots"):
        $inserts = array();
        $queryFormat = "('%s','%s','%s','%s','%s','%s','%s','%s')";
        $fileName = $_FILES["logzips"]["tmp_name"];
        if ($_FILES["logzips"]["size"] > 0) {
            $file = fopen($fileName, "r");
            $i = 0;
            while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
                // dump($column[0]);
				

					$crypt_id = "CRYPT-796caa375ef68-230525";
                    $slot_id = create_uuid("CRYPT_SLOT");
					$coordinates = $column[1] . ", " . $column[0];
                    
                    $inserts[] = sprintf( 
                        $queryFormat, $slot_id, $crypt_id, "VACANT", "", $i, $coordinates, "", "LAWN");
            $i++;
            }
            $query = implode( ",", $inserts );
                $query_string = "insert into crypt_slot
                (slot_id, crypt_id, active_status,occupied_by,slot_number,coordinates,lawn_type, crypt_slot_type) 
                VALUES " . $query;
                // dump($query_string);
                query($query_string);
                $res_arr = [
                    "message" => "Successfully Uploaded and converted to RAW Attendance Data",
                    "status" => "success",
                    "link" => "refresh",
                    ];
                    echo json_encode($res_arr); exit();
                }




			endif;


		if($_POST["action"] == "modal_crypt_profile"):
			// dump($_POST);
			$crypt = query("select * from crypt_list
								where crypt_id = ?", $_POST["slot_number"]);
			$crypt = $crypt[0];
			$details = query("SELECT SUM(CASE WHEN active_status = 'OCCUPIED' THEN 1 ELSE 0 END) occupied,
				SUM(CASE WHEN active_status = 'VACANT' THEN 1 ELSE 0 END) vacant,
				COUNT(*) total, crypt_name, s.crypt_id
				FROM  crypt_slot s
				LEFT JOIN crypt_list l
				ON s.crypt_id = l.crypt_id
				WHERE l.crypt_id = ?
				", $_POST["slot_number"]);
				$details = $details[0];
			if($crypt["crypt_type"] == "COFFIN"):
			
			$message = '
				<div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">'.$crypt["crypt_name"].'</h3>
              <h5 class="widget-user-desc">Coffin Crypt Building</h5>
            </div>
            <div class="widget-user-image">
              <img  src="resources/crypt_building.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">'.$details["total"].'</h5>
                    <span class="description-text">SLOTS</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
				  <h5 class="description-header">'.$details["vacant"].'</h5>
                    <span class="description-text">VACANT</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
				  <h5 class="description-header">'.$details["occupied"].'</h5>
                    <span class="description-text">OCCUPIED</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
				';

				if(!isset($_POST["public"])):
				$message = $message . '
				<div class="text-center"><a target="_blank" href="coffin_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				endif;
				echo($message);

			elseif($crypt["crypt_type"] == "BONE"):
				// dump("awit");
				$message = "";
				$message = $message . '
			<div class="box box-widget widget-user">
            <div class="widget-user-header bg-red-active">
              <h3 class="widget-user-username">'.$crypt["crypt_name"].'</h3>
              <h5 class="widget-user-desc">Bone Crypt</h5>
            </div>
            <div class="widget-user-image">
              <img  src="resources/crypt_building.png" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
				  <h5 class="description-header">'.$details["total"].'</h5>
                    <span class="description-text">SLOTS</span>
                  </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
				  <h5 class="description-header">'.$details["vacant"].'</h5>
                    <span class="description-text">VACANT</span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
				  <h5 class="description-header">'.$details["occupied"].'</h5>
                    <span class="description-text">OCCUPIED</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
				';

				if(!isset($_POST["public"])):
					$message = $message . '
					<div class="text-center"><a target="_blank" href="bone_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
					';
					endif;
					echo($message);


		elseif($crypt["crypt_type"] == "COMMON"):
			$count = query("select count(*) as count from crypt_slot where crypt_id = ?", $crypt["crypt_id"]);
			// echo();

					$message = "";
					$message = $message . '
				<div class="box box-widget widget-user">
				<div class="widget-user-header bg-black-active">
				  <h3 class="widget-user-username">'.$crypt["crypt_name"].'</h3>
				  <h5 class="widget-user-desc">COMMON</h5>
				</div>
				<div class="widget-user-image">
				  <img  src="resources/crypt_building.png" alt="User Avatar">
				</div>
				<div class="box-footer">
				  <div class="row">
					<div class="col-sm-12 border-right">
					  <div class="description-block">
					  <h5 class="description-header">'.$count[0]["count"].'</h5>
						<span class="description-text">DECEASED LISTED HERE</span>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
					';

				if(!isset($_POST["public"])):
				$message = $message . '
				<div class="text-center"><a target="_blank" href="bone_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				endif;
				echo($message);

			elseif($crypt["crypt_type"] == "MAUSOLEUM"):
				// dump($_POST);
				$crypt_slot = query("select * from crypt_slot where crypt_id = ?", $_POST["slot_number"]);
				
				$message = "";
				$message = $message . '
				<div class="box box-widget widget-user">
				<div class="widget-user-header bg-yellow-active">
				  <h3 class="widget-user-username">'.$crypt["crypt_name"].'</h3>
				  <h5 class="widget-user-desc">Mausoleum</h5>
				</div>
				<div class="widget-user-image">
				  <img  src="resources/crypt_building.png" alt="User Avatar">
				</div>
				<div class="box-footer">
				  <div class="row">
					<div class="col-sm-12 border-right">
					  <div class="description-block">
					  <h5 class="description-header">'.$details["occupied"].'</h5>
						<span class="description-text">OCCUPIED</span>
					  </div>
					</div>
				   
				  </div>
				</div>
			  </div>
				';
				
				if(!isset($_POST["public"])):
				$message = $message.'
				<div class="text-center"><a target="_blank" href="profile?action=client_details&slot='.$crypt_slot[0]["slot_id"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				endif;
				echo($message);
			endif;
		endif;

		if($_POST["action"] == "add_lot"):
			$crypt_id = "CRYPT-796caa375ef68-230525";
			$slot_id = create_uuid("CRYPT_SLOT");
			$coordinates = $_POST["longitude"] . ", " . $_POST["latitude"];
			if (query("insert INTO crypt_slot 
				(slot_id,crypt_id,active_status,coordinates,lawn_type,crypt_slot_type) 
				VALUES(?,?,?,?,?,?)", 
				$slot_id,$crypt_id,"VACANT",$coordinates, $_POST["lawn_type"], "LAWN") === false)
				{
					
				}
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on adding Data",
					"link" => "refresh",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
		endif;

		if($_POST["action"] == "remove_slot"):
			// dump($_POST);

			query("delete from crypt_slot where slot_id = ?", $_POST["slot_id"]);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		endif;

    }
	else {
			if($_GET["action"] == "map_details"):
				$mausoleum = [];
				$coffin = [];
				$bone = [];
				$lawn = [];
				$no_slot = [];
				$Clients = [];
				$Crypt_slot = [];
				
				$clients = query("select concat(
									client_firstname, ' ', 
									client_middlename, ' ',
									client_lastname, ' ',
									client_suffix, ' '
									) as client_name, profile_id from profile_list");
				foreach($clients as $c):
					$Clients[$c["profile_id"]] = $c;
				endforeach;

				if($_GET["crypt_type"] == "COFFIN"):
					$coffin = query("
						select * from crypt_list where crypt_type = 'COFFIN'
					");
					$crypt_slot = query("select * from crypt_slot where crypt_slot_type = ?", $_GET["crypt_type"]);
					foreach($crypt_slot as $c):
						if($c["occupied_by"] != "")
							$Crypt_slot[$c["crypt_id"]][$c["occupied_by"]] = $c;
					endforeach;
				elseif($_GET["crypt_type"] == "BONE"):
					$bone = query("select * from crypt_list where crypt_type = 'BONE'");
					$crypt_slot = query("select * from crypt_slot where crypt_slot_type = ?", $_GET["crypt_type"]);
					foreach($crypt_slot as $c):
						if($c["occupied_by"] != "")
							$Crypt_slot[$c["crypt_id"]][$c["occupied_by"]] = $c;
					endforeach;
				elseif($_GET["crypt_type"] == "LAWN"):
					$lawn = query("select * from crypt_slot where crypt_slot_type = 'LAWN'");
					$no_slot = query("select * from crypt_slot where crypt_slot_type = 'NO_SLOT'");
				elseif($_GET["crypt_type"] == "MAUSOLEUM"):
					$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
					$crypt_slot = query("select * from crypt_slot where crypt_slot_type = ?", $_GET["crypt_type"]);
					foreach($crypt_slot as $c):
						if($c["occupied_by"] != "")
							$Crypt_slot[$c["crypt_id"]][$c["occupied_by"]] = $c;
					endforeach;
				endif;

				// dump($Clients);
			render("public/maps_system/maps_details.php",
			[
				"lawn" => $lawn,
				"coffin" => $coffin,
				"mausoleum" => $mausoleum,
				"bone" => $bone,
				"no_slot" => $no_slot,
				"Clients" => $Clients,
				"Crypt_slot" => $Crypt_slot,
			]);
			elseif($_GET["action"] == "public_map"):
			$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
			$coffin = query("select * from crypt_list where crypt_type = 'COFFIN'");
			$bone = query("select * from crypt_list where crypt_type = 'BONE'");
			$lawn = query("select * from crypt_slot where crypt_slot_type = 'LAWN'");
			$common = query("select * from crypt_list where crypt_type = 'COMMON'");
			$no_slot = query("select * from crypt_slot where crypt_slot_type = 'NO_SLOT'");
			renderview("public/maps_system/public_map.php",
			[
				"lawn" => $lawn,
				"coffin" => $coffin,
				"mausoleum" => $mausoleum,
				"bone" => $bone,
				"common" => $common,
				"no_slot" => $no_slot,
			]);



			elseif($_GET["action"] == "map_editor"):
				$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
				$coffin = query("select * from crypt_list where crypt_type = 'COFFIN'");
				$bone = query("select * from crypt_list where crypt_type = 'BONE'");
				$lawn = query("select * from crypt_slot where crypt_slot_type = 'LAWN'");
				$common = query("select * from crypt_list where crypt_type = 'COMMON'");
				$no_slot = query("select * from crypt_slot where crypt_slot_type = 'NO_SLOT'");
				render("public/maps_system/map_editor.php",
				[
					"lawn" => $lawn,
					"coffin" => $coffin,
					"mausoleum" => $mausoleum,
					"bone" => $bone,
					"common" => $common,
					"no_slot" => $no_slot,
				]);

			endif;

			
	}
?>
