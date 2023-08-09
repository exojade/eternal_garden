<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "filter_lawn"){
			// dump($_POST);
			$link = "maps?filter=".$_POST["filter"]."";
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
			// dump($_POST);
			$coordinates = query("select * from crypt_slot where slot_id = ?", $_POST["slot_id"]);
			query("update crypt_list set coordinates = ? where crypt_id = ?", $coordinates[0]["coordinates"],$_POST["crypt"]);
			query("update crypt_slot set crypt_slot_type = 'TAKEN' where slot_id = ?",$_POST["slot_id"]);
			$link = "maps?filter=ALL";
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding Data",
				"link" => $link,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
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


				$message = $message . '
				<div class="text-center"><a target="_blank" href="coffin_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);

			elseif($crypt["crypt_type"] == "BONE"):

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


				$message = $message . '
				<div class="text-center"><a target="_blank" href="bone_crypt?action=details&id='.$_POST["slot_number"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
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
				
				
				$message = $message.'
				<div class="text-center"><a target="_blank" href="profile?action=client_details&slot='.$crypt_slot[0]["slot_id"].'" class="btn text-center btn-primary btn-flat">Open Information</a></div>
				';
				echo($message);
			endif;

			
				
				
		endif;


		
		
		
    }
	else {
	
			$mausoleum = query("select * from crypt_list where crypt_type = 'MAUSOLEUM'");
			$coffin = query("select * from crypt_list where crypt_type = 'COFFIN'");
			$bone = query("select * from crypt_list where crypt_type = 'BONE'");
			$lawn = query("select * from crypt_slot where crypt_slot_type = 'LAWN'");

			$no_slot = query("select * from crypt_slot where crypt_slot_type = 'NO_SLOT'");


			render("public/maps_system/maps_details.php",
			[
				"lawn" => $lawn,
				"coffin" => $coffin,
				"mausoleum" => $mausoleum,
				"bone" => $bone,
				"no_slot" => $no_slot,
			]);
	
	}
?>
