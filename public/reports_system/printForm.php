<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>



 hr{
  margin-bottom: 2px;
  margin-top: 2px;
 }

html *
{
	font-family: 'Barlow';
 
}
body{
  border: 4px solid black;
  padding:10px;
}
.tabular, .tabular th, .tabular td {
   border: 1px solid black !important;
}
.table td{
	font-size: 11.3px !important;
}

.table{
  margin-bottom:1px !important;
}

#fordtr{font-size:20px;}
#fordtr td{padding: 1px !important;}
#fordtr th{padding: 7px !important;}

p{
 
  font-size: 180%;
  
}

ul li{
  font-size: 180%;
}

hr{
  height:2px;border-width:6;color:#254C0B !important;background-color:#254C0B !important;
  border-top: 1px solid #254C0B;
}
	</style>

<style>

</style>
<?php
$options = unserialize($_GET["options"]);
// dump($options);

$where = " where 1=1 ";

			if(isset($options["burial_space"])):
                if($options["burial_space"] != "")
					if($options["burial_space"] == "COFFIN" || $options["burial_space"] == "BONE" || $options["burial_space"] == "MAUSOLEUM" || $options["burial_space"] == "LAWN")
                    	$where = $where . " and s.crypt_slot_type = '".$options["burial_space"]."'";
					else
						$where = $where . " and s.crypt_id = '".$options["burial_space"]."'";
            endif;


            if(isset($options["burial_date"])):
                if($options["burial_date"] != ""):
                  $dateArray = explode(' - ', $options["burial_date"]);
                  // Extract "from date" and "to date" from the array
                  $fromDate = $dateArray[0];
                  $toDate = $dateArray[1];
                  $where = $where . " and d.burial_date >= '" . $fromDate . "'";
                  $where = $where . " and d.burial_date <= '" . $toDate . "'";
                endif;
            endif;


			      if(isset($options["client"])):
                if($options["client"] != "")
                    $where = $where . " and t.profile_id = '" . $options["client"] . "'";
            endif;


			      if(isset($options["deceased_id"])):
                if($options["deceased_id"] != "")
                    $where = $where . " and (d.deceased_id = '" . $options["deceased_id"] . "' or occupied_by = '".$options["deceased_id"]."')";
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
?>

<div class="row">
  <div class="col-xs-5 text-right">
    <img  class="img-responsive  pull-right"  style="width: 30%; height: auto; " src="resources/logo.png">
  </div>
  <div class="col-xs-7">
    <p style="font-size:200%; color:#254C0B;font-weight:900; ">City Government of Panabo</p>
    <p style="font-size:200%; color:#254C0B;font-weight:900; ">PANABO ETERNAL GARDEN</p>
    <p style="font-size:200%; color:#254C0B;font-weight:900; ">CEEMDO</p>
  </div>
</div>
<br>

<table class="table table-bordered">
  <thead>
    <th>Deceased</th>
    <th>Birth</th>
    <th>Death</th>
    <th>Age Died</th>
    <th>Location</th>
    <th>Burial Date</th>
    <th>Burial Time</th>
    <th>Client</th>
  </thead>

  <tbody>
    <?php 
    // dump($all_data);
    foreach($data as $row): ?>
      <tr>
      <td><?php
        $deceased_name = "";
				if(isset($Deceased[$row["deceased_id"]])):
					$deceased = $Deceased[$row["deceased_id"]];
					$deceased_name = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
				endif;

				if($row["crypt_slot_type"] == "COMMON"):
					$deceased = $Deceased[$row["occupied_by"]];
					$deceased_name = $deceased["deceased_firstname"] . " " . $deceased["deceased_lastname"];
				endif;
        ?><?php echo($deceased_name); ?></td>

        <td><?php echo($row["birthdate"]); ?></td>
        <td><?php echo($row["date_of_death"]); ?></td>
        <td><?php echo($row["age_died"]); ?></td>
        <?php
          $location_name= "";
          $location = $Crypt[$row["slot_id"]];
          if($location["crypt_type"] == "LAWN"):
            $location_name = "LAWN : TYPE : ".$location["lawn_type"];
          elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
            $location_name = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
          elseif($location["crypt_type"] == "COMMON"):
            $location_name = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
          endif;
        ?>
        <td><?php echo($location_name); ?></td>
        <td><?php echo($row["burial_date"]); ?></td>
        <td><?php echo($row["burial_time"]); ?></td>
        <?php
          $client_name = "";
          if(isset($Profile[$row["profile_id"]])):
            $profile = $Profile[$row["profile_id"]];
            $client_name = $profile["client_firstname"] . " " . $profile["client_lastname"];
          endif;
        ?>
        <td><?php echo($client_name); ?></td>


      </tr>
    <?php endforeach; ?>
  </tbody>

</table>



      <div style="position:absolute; bottom:0; margin-bottom:10px; width: 100%">
      <div class="row">
        <div class="col-xs-12 text-center">
        <p>Generated by Cemetery Information System</p>
        </div>
      </div>
			
			</div>


<script>
$(".select2").select2();
</script>
