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

$where = " where total_fee != ''  ";


if(isset($options["profile"])):
  if($options["profile"] != "")
      $where = $where . " and profile_id = '" . $options["profile"] . "'";
endif;


if(isset($options["from"])):
  if($options["from"] != "")
      $where = $where . " and date >= '" . $options["from"] . "'";
endif;

if(isset($options["to"])):
  if($options["to"] != "")
      $where = $where . " and date <= '" . $options["to"] . "'";
endif;


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

			$Deceased_Transaction = [];
			$deceased_transaction = query("select * from deceased_transaction");
			foreach($deceased_transaction as $row):
				$Deceased_Transaction[$row["transaction_id"]][$row["deceased_id"]] = $row;
			endforeach;


        if($where != ""):
          $query_string = "SELECT * FROM TRANSACTION t  ".$where."
          ORDER BY t.timestamp DESC";
          $data = query($query_string);
        else:
            $query_string = "SELECT * FROM TRANSACTION t ".$where."
            ORDER BY t.timestamp DESC";
            $data = query($query_string);
        endif;

      
?>

    <img  class="img-responsive center-block"  style="width: 10%; height: auto; " src="resources/logo.png">
    <p class="text-center" style="font-size:200%; margin-bottom:0px; color:#254C0B;font-weight:900; ">City Government of Panabo</p>
    <p class="text-center" style="font-size:200%; margin-bottom:0px; color:#254C0B;font-weight:900; ">PANABO ETERNAL GARDEN</p>
    <p class="text-center" style="font-size:200%; margin-bottom:0px; color:#254C0B;font-weight:900; ">CEEMDO</p>
<br>

<table class="table table-bordered">
  <thead>
    <th>Client</th>
    <th>Location</th>
    <th>Type</th>
    <th>Date</th>
    <th>Time</th>
    <th>Fee</th>
  </thead>

  <tbody>
    <?php $total = 0; foreach($data as $row): 
      $total = $total + $row["total_fee"];
      ?>
      <tr>
      <td><?php
        $client = "";
				if(isset($Profile[$row["profile_id"]])):
					$profile = $Profile[$row["profile_id"]];
					$client = $profile["client_firstname"] . " " . $profile["client_lastname"];
				endif;
        ?><?php echo(strtoupper($client)); ?></td>

        <td><?php
        $location = $Crypt[$row["slot_id"]];
				
				if($location["crypt_type"] == "LAWN"):
					$the_location = "LAWN : TYPE : ".$location["lawn_type"];
				elseif($location["crypt_type"] == "COFFIN" || $location["crypt_type"] == "BONE"):
					$the_location = $location["crypt_type"] ." : NAME : ".$location["crypt_name"] . " : ROW : " . $location["row_number"] . " : COLUMN : " . $location["column_number"];
				elseif($location["crypt_type"] == "COMMON"):
					$the_location = $location["crypt_type"] ." : NAME : ".$location["crypt_name"];
				endif;
        
        
        echo($the_location); ?></td>
        <td><?php echo($row["transaction_type"]); ?></td>
        <td><?php echo($row["date"]); ?></td>
        <td><?php echo($row["time"]); ?></td>
        <td><span class="pull-right text-right"><?php echo(to_peso($row["total_fee"])); ?></span></td>
      </tr>
    <?php endforeach; ?>
    <tr>
    <th colspan="5">TOTAL</th>
    <th><span class="pull-right text-right"><?php echo(to_peso($total)); ?></span></th>
  </tr>
  </tbody>


</table>



      <!-- <div style="position:absolute; bottom:0; margin-bottom:10px; width: 100%">
      <div class="row">
        <div class="col-xs-12 text-center">
        <p>Generated by Cemetery Information System</p>
        </div>
      </div>
			
			</div> -->


<script>
$(".select2").select2();
</script>
