<?php


// $list = query("select * from crypt_list");

// foreach($list as $row):
// 	$crypt_slot = query("select * from crypt_slot where crypt_id = ?", $row["crypt_id"]);
// 	$crypt_slot_id = [];
// 	foreach($crypt_slot as $row2):
// 		$crypt_slot_id[] = $row2["slot_id"];
// 	endforeach;
// 	$crypt_slot_id = "'" . implode("','", $crypt_slot_id) . "'";
// 	// dump($crypt_slot_id);
// 	query("update crypt_slot set crypt_slot_type = ? where slot_id in (".$crypt_slot_id.")", $row["crypt_type"]);
// endforeach;


// $crypt_list = query("select * from crypt_list where crypt_type not in ('LAWN', 'MAUSOLEUM')");
// foreach($crypt_list as $list):
// 	$crypt_slot = query("select * from crypt_slot where crypt_id = ?", $list["crypt_id"]);
// 	foreach($crypt_slot as $slot):
// 		query("update crypt_slot set crypt_slot_type = ? where slot_id = ?", $list["crypt_type"], $slot["slot_id"]);
// 	endforeach;
// endforeach;
// dump("finished");

// $grave = query("select * from gravekeeper.grave_data");
// $crypt_id = 'CRYPT-796caa375ef68-230525';
// // dump($grave);
// // $lawn = query("select * from crypt_list where crypt_id = 'CRYPT-796caa375ef68-230525'");
// // // dump($lawn);
// $inserts = array();
// $queryFormat = "('%s','%s','%s','%s','%s','%s')";
// // $rows = 10;
// // $columns = 15;

// foreach($grave as $g):
// 	$crypt_slot_id = create_uuid("CRYPT_SLOT");
// 		$inserts[] = sprintf(
// 			$queryFormat, $crypt_slot_id, $crypt_id, "VACANT","",$g["grave_no"], $g["coordinates"]);
// endforeach;

// $query = implode( ",", $inserts );
//                 $query_string = "insert into crypt_slot
//                 (slot_id, crypt_id, active_status,occupied_by,slot_number,coordinates) 
//                 VALUES " . $query;
//                 // dump($query_string);
// 			query($query_string);



// $slot_number = 1;
// for($i = 1; $i <= $rows; $i++):
// 	for($j = 1; $j<=$columns; $j++){
// 		$crypt_slot_id = create_uuid("CRYPT_SLOT");
// 		$inserts[] = sprintf(
// 			$queryFormat, $crypt_slot_id, $crypt_id, "VACANT","",$slot_number);
// 			$slot_number++;
// 	}	
// endfor;

// $query = implode( ",", $inserts );
//                 $query_string = "insert into crypt_slot
//                 (slot_id, crypt_id, active_status,occupied_by,slot_number) 
//                 VALUES " . $query;
//                 // dump($query_string);
// 			query($query_string);
// for($i=)


// for($i=1;$i<=3004;$i++){
// 	$input = array("SUPER_PRIME_A","SUPER_PRIME_B",
// 					"SUPER_PRIME_C","PRIME_A","PRIME_B", "PRIME_C",
// 					"REGULAR", "CORNER");
// 	$rand_keys=array_rand($input,1);
// 	// dump($rand_keys);
// 	$lawn_type = $input[$rand_keys];
// 	// dump($lawn_type);
// 	query("update crypt_slot set lawn_type = ? where crypt_id = 'CRYPT-796caa375ef68-230525'
// 			and slot_number = ?", $lawn_type, $i);
// }
// rand(1,3004);





    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "track_deceased"){
		// dump($_POST);
		// $search = $q;
        $limit = 10;
        $where = "where 1=1";
        if($_POST["q"] != ""){
            $where = $where . "
            and (
            deceased_name like '%".$_POST["q"]."%'
           )
                ";
        }
		else{
			
		}
    
		$query_string = "

		select * from profile_list p
		left join crypt_slot s
		on s.slot_id = p.slot_number
		left join crypt_list c
		on c.crypt_id = s.crypt_id
        ".$where."
        limit ".$limit."";
		$transactions = query($query_string);
		$i = 0;
		foreach($transactions as $row):
			$transactions[$i]["action"] = "";
			if($row["crypt_type"] != "LAWN" || $row["crypt_type"] != "MAUSOLEUM") {
				$transactions[$i]["location"] = 
				$row["crypt_type"] . ": " . $row["crypt_name"] . ", Row: " . $row["row_number"] . ", Column: " . $row["column_number"];
			}
			$i++;
		endforeach;
    
    
        
		// dump($transactions);
        echo(json_encode($transactions));
		}
		
    }
	else {

		render("public/dashboard_system/indexform.php",[]);
	}
?>
