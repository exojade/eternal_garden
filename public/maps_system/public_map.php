<?php $public = "public"; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cemetery Information System</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="AdminLTE/plugins/sweetalert/sweetalert2.min.css">
  <link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="AdminLTE/plugins/iCheck/square/blue.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">


<link rel="stylesheet" href="gravekeeper/webmap/css/leaflet.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/L.Control.Locate.min.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/qgis2web.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/fontawesome-all.min.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/leaflet-search.css">
<link rel="stylesheet" href="gravekeeper/assets/css/home.css">

<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.text-bone {
    color: #D33724!important;
}.text-coffin {
    color: #00A7D0!important;
}
.text-vacant {
    color: #1cc88a!important;
}
.text-no_slot {
    color: #000!important;
}
.text-occupied {
    color: #C57B57!important;
}
.text-mausoleum {
    color: #F7DBA7!important;
}

.custom-label {
    position: absolute;
    background-color: white;
    border: 1px solid #ccc;
    padding: 5px;
    font-size: 14px;
    color: #333;
    z-index: 1000; /* Ensure it's above other map elements */
}



    #loading {
    position: static;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0.7;
    background-color: transparent;
}
</style>

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}

.table .btn{
  font-size:12px !important;
}

.table td{
  border:0px !important;
}
</style>

<style>
.layer {
    background-color: rgba(5, 5, 5, 0.7);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

@font-face { 
	font-family: 'Pacifico';
	font-style: normal;
	font-weight: 400;
	font-display: swap;
	/* src: url('AdminLTE/dist/fonts/SpaceGrotesk-Regular.ttf');  */
}


#message
{
	font-family: 'Pacifico', sans-serif;
}
  </style>
  
</head>

<header class="main-header" style="background-color: #244D07;">
    <nav class="navbar navbar-static-top" style="margin-left: 0px;">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand">Cemetery Management and Tracking System
Panabo City Eternal Garden</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

       
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
  
 
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

<body class="hold-transition login-page" style="
background-image: url('resources/eternal_bg.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
">

<div class="layer">


<div class="modal fade" id="modal-add_lot" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBody">
      <form class="generic_form_trigger" data-url="maps">
        <input type="hidden" name="action" value="add_lot">
        <div class="form-group">
    <label for="latitudeInput">Latitude</label>
    <input required name="latitude" type="text" class="form-control" id="latitudeInput" placeholder="---">
</div>
<div class="form-group">
    <label for="longitudeInput">Longitude</label>
    <input required name="longitude" type="text" class="form-control" id="longitudeInput" placeholder="---">
</div>
        <?php 
        $lawn_type = query("select lawn_type from crypt_slot group by lawn_type");
        // dump($lawn_type);
        ?>

                <div class="form-group">
                  <label>Lawn Type</label>
                  <select class="form-control" name="lawn_type">
                    <option selected disabled value="">Please Select Lawn Type</option>
                   <?php foreach($lawn_type as $row): ?>
                        <option value="<?php echo($row["lawn_type"]); ?>"><?php echo($row["lawn_type"]); ?></option>
                   <?php endforeach; ?>
                  </select>
                </div>


        <button type="submit" class="btn btn-primary btn-flat">Submit</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="modalLabel">LOCATION INFORMATION</h5>
    
      </div>
      <div class="modal-body" id="modalBody">
        <!-- Point information will be displayed here -->
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="assignCrypt_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Assign Crypt</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBody">
      <form class="generic_form" data-url="maps">
      <input type="hidden" name="action" value="assign_crypt">
      <input type="hidden" name="slot_id" id="slot_id">
      <?php $crypts = query("select * from crypt_list where crypt_type != 'LAWN' and coordinates is null or coordinates = ''"); ?>

      <div class="form-group">
        <label>Select Crypt</label>
        <select class="form-control" name="crypt">
            <?php foreach($crypts as $c): ?>
                <option value="<?php echo($c["crypt_id"]); ?>"><?php echo($c["crypt_name"] . " | " . $c["crypt_type"]); ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <!-- Point information will be displayed here -->
    </form>
      </div>
    </div>
  </div>
</div>

<div class="login-box" style="width:80% !important; padding-bottom: 100px; max-height: 1300px;">

<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Public Map for View <a href="login" class="btn btn-primary pull-right">Login</a></h4>
              </div>
<div class="box">
    <div class="box-body">
    <div class="row">
                    <div class="col-sm-6">
                    <h3>Legend:</h3>
                        <span><i class="fa fa-square text-vacant"></i> Vacant</span>
                        <span><i class="fa fa-square text-occupied"></i> Occupied</span>
                        <span><i class="fa fa-square text-coffin"></i> Coffin Crypt</span>
                        <span><i class="fa fa-square text-mausoleum"></i> Mausoleum</span>
                        <span><i class="fa fa-square text-bone"></i> Bone Crypt</span>
                        <span><i class="fa fa-square text-no_slot"></i> No Slot</span>
                    </div>
                   
                </div>

                <div id="map" style="border: 1px solid black; width: 99%; height: 600px;">
                                <div id="loading">
                                    <img id="loading-image" class="mx-auto" src="gravekeeper/Preloader_3.gif" alt="Loading..." />
                                </div>
                            </div>
        
    </div>
    
</div>

   
</div>


    

</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="AdminLTE/plugins/iCheck/icheck.min.js"></script>
<!-- SweetAlert -->
<script src="AdminLTE/plugins/sweetalert/sweetalert2.min.js"></script>
<script src="public/login_system/login.js"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
  <script src="gravekeeper/assets/js/smoothproducts.min.js"></script>
  <script src="gravekeeper/assets/js/theme.js"></script>
  <script src="gravekeeper/webmap/js/qgis2web_expressions.js"></script>
  <script src="gravekeeper/webmap/js/leaflet.js"></script>
  <script src="gravekeeper/webmap/js/L.Control.Locate.min.js"></script>
  <script src="gravekeeper/webmap/js/leaflet.rotatedMarker.js"></script>
  <script src="gravekeeper/webmap/js/leaflet.pattern.js"></script>
  <script src="gravekeeper/webmap/js/leaflet-hash.js"></script>
  <script src="gravekeeper/webmap/js/Autolinker.min.js"></script>
  <script src="gravekeeper/webmap/js/rbush.min.js"></script>
  <script src="gravekeeper/webmap/js/labelgun.min.js"></script>
  <script src="gravekeeper/webmap/js/labels.js"></script>
  <script src="gravekeeper/webmap/js/leaflet-search.js"></script>
  <script src="gravekeeper/webmap/data/CemeteryCircumference_1.js"></script>
  <script src="gravekeeper/webmap/data/road_2.js"></script>
  <script>
        $(window).on('load', function () {
            $('#loading').hide();
        }) 
  </script>
<?php
$deceased_profile = query("select d.*, slot.crypt_id, slot.row_number, slot.column_number, slot.slot_number as crypt_number 
                            from deceased_profile d
                            left join crypt_slot slot
                            on slot.slot_id = d.slot_number
                            where  d.active_status IS NULL OR d.active_status != 'FOR TRANSFER';
");
// dump($deceased_profile);
$Deceased = [];
$Deceased2 = [];
foreach($deceased_profile as $d):
    $Deceased[$d["slot_number"]][$d["deceased_id"]] = $d;
    $Deceased2[$d["crypt_id"]][$d["deceased_id"]] = $d;
endforeach;
$client = query("select * from profile_list");
$Clients = [];
        foreach($client as $row):
            $Clients[$row["profile_id"]] = $row;
        endforeach;

        $crypt_slot = query("select * from crypt_slot");
					foreach($crypt_slot as $c):
						if($c["occupied_by"] != "")
							$Crypt_slot[$c["crypt_id"]][$c["occupied_by"]] = $c;
					endforeach;
// dump($Deceased);

            if($_GET["filter"] == "ALL"){
              $result = query("select slot.*,concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name, lease_date, date_expired from crypt_slot slot
                                left join profile_list client
                                on client.slot_number = slot.slot_id
                                where crypt_slot_type = 'LAWN'");
            }
            else{
              $result = query("select slot.*,concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name, lease_date, date_expired from crypt_slot slot
              left join profile_list client
              on client.slot_number = slot.slot_id
              where crypt_slot_type = 'LAWN'
              and lawn_type = ?", $_GET["filter"]);
            }
            // dump($result);
        ?>
        <script>
            var json_Marker_3 = {
            "type": "FeatureCollection",
            "name": "Marker_3",
            "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features": [
                <?php
                    foreach($result as $row){
                        if(isset($Deceased[$row["slot_id"]])):
                            $deceased = $Deceased[$row["slot_id"]];
                            $trim = str_replace('""', '', $row['coordinates']);
                            $location = $row["lawn_type"];
                            echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"description": "[CLIENT] <br><b>Location:</b> '.$location.'",';
                                echo '"Name": "'.$row["client_name"].'",';
                                echo '"link_url": "profile?action=client_details&slot='.$row["slot_id"].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            foreach($deceased as $d):
                                $location = $row["lawn_type"];
                                $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"description": "[DECEASED]<br> <b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b><br>Location: '.$location.'",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"link_url": "profile?action=client_details&slot='.$row["slot_id"].'",';
                                echo '"Name": "'.$d["deceased_name"].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            endforeach;
                        else:
                            $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                if($row["active_status"] == "OCCUPIED"):
                                    echo '"Status": "OCCUPIED",';
                                    echo '"Name": "'.$row["client_name"].'",'; 
                                else:
                                    echo '"Status": "VACANT",';
                                    echo '"Name": "'."Empty".'",'; 
                                endif;
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        endif;
                    }

                    foreach($mausoleum as $row):
                        if($row["coordinates"] != ""):
                            $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"Status": "MAUSOLEUM",';
                                echo '"Name": "'.$row["crypt_name"].'",';
                                echo '"link_url": "none",';
                                echo '"description": "",'; 
                                echo '"slot_number": "'.$row['crypt_id'].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            if(isset($Deceased2[$row["crypt_id"]])):
                                $deceased = $Deceased2[$row["crypt_id"]];
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "MAUSOLEUM",';
                                    echo '"Name": "'.$d["deceased_name"].'",';
                                    echo '"description": "<b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b><br>Mausoleum: '.$row["crypt_name"].'",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
                        endif;
                    endforeach;
                    foreach($bone as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "BONE",';
                            echo '"Name": "'.$row["crypt_name"].'",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"link_url": "none",';
                            echo '"description": "",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            if(isset($Deceased2[$row["crypt_id"]])):
                                $deceased = $Deceased2[$row["crypt_id"]];
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "BONE",';
                                    echo '"Name": "'.$d["deceased_name"].'",'; 
                                    echo '"description": "[DECEASED] <br> <b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b><br>Crypt: '.$row["crypt_name"].'<br>Row: '.$d["row_number"].' | Column: '.$d["column_number"].'<br>Crypt Number: '.$d["crypt_number"].'",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;


                            if(isset($Crypt_slot[$row["crypt_id"]])):
                                $crypt_slot = $Crypt_slot[$row["crypt_id"]];
                                foreach($crypt_slot as $cs):
                                    // dump($Clients[$cs["occupied_by"]]);
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "BONE",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].'",';
                                    echo '"description": "[CLIENT]<br>Crypt: '.$row["crypt_name"].'<br>Row: '.$cs["row_number"].' | Column: '.$cs["column_number"].'<br>Crypt Number: '.$cs["slot_number"].'",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
                        
                        endif;
                    endforeach;
                    foreach($coffin as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "COFFIN",';
                            echo '"Name": "'.$row["crypt_name"].'",';
                            echo '"link_url": "none",';
                            echo '"description": "",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            if(isset($Deceased2[$row["crypt_id"]])):
                                $deceased = $Deceased2[$row["crypt_id"]];
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "COFFIN",';
                                    echo '"Name": "'.$d["deceased_name"].'",'; 
                                    echo '"description": "<b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b><br>Crypt: '.$row["crypt_name"].'<br>Row: '.$d["row_number"].' | Column: '.$d["column_number"].'<br>Crypt Number: '.$d["crypt_number"].'",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;


                            if(isset($Crypt_slot[$row["crypt_id"]])):
                                $crypt_slot = $Crypt_slot[$row["crypt_id"]];
                                foreach($crypt_slot as $cs):
                                    // dump($Clients[$cs["occupied_by"]]);
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "COFFIN",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].'",';
                                    echo '"description": "[CLIENT]<br>Crypt: '.$row["crypt_name"].'<br>Row: '.$cs["row_number"].' | Column: '.$cs["column_number"].'<br>Crypt Number: '.$cs["slot_number"].'",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
                        endif;
                    endforeach;

                    foreach($common as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "COMMON",';
                            echo '"Name": "'.$row["crypt_name"].'",';
                            echo '"link_url": "none",';
                            echo '"description": "",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            if(isset($Deceased2[$row["crypt_id"]])):
                                $deceased = $Deceased2[$row["crypt_id"]];
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "COMMON",';
                                    echo '"Name": "'.$d["deceased_name"].'",'; 
                                    echo '"description": "<b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b>",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
                        endif;
                    endforeach;



                    foreach($no_slot as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "NO_SLOT",';
                            echo '"Name": "NO SLOT",'; 
                            echo '"slot_number": "'.$row['slot_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        endif;
                    endforeach;

                    foreach($annex as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "ANNEX",';
                            echo '"Name": "'.$row["crypt_name"].'",';
                            echo '"link_url": "none",';
                            echo '"description": "",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            if(isset($Deceased2[$row["crypt_id"]])):
                                $deceased = $Deceased2[$row["crypt_id"]];
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "ANNEX",';
                                    echo '"Name": "'.$d["deceased_name"].'",'; 
                                    echo '"description": "[DECEASED]<br><b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b>",';
                                    echo '"link_url": "profile?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;

                            if(isset($Crypt_slot[$row["crypt_id"]])):
                                $crypt_slot = $Crypt_slot[$row["crypt_id"]];
                                foreach($crypt_slot as $cs):
                                    // dump($Clients[$cs["occupied_by"]]["client_firstname"]);
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "ANNEX",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].'",';
                                    echo '"description": "[CLIENT]<br>Crypt: '.$row["crypt_name"].$cs["slot_number"].'",';
                                    echo '"link_url": "annex?action=client_details&slot='.$d["slot_number"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
                        endif;
                    endforeach;
                ?>
            ]
            }
        </script>

        <script>
             var map = L.map('map', {
                zoomControl:true, maxZoom:21, minZoom:18
            }).fitBounds([[7.318064, 125.662665]]);
        // }).fitBounds([[7.31848,125.66304],[7.31848,125.66304]]);
            var hash = new L.Hash(map);
            map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
            var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
            L.control.locate({locateOptions: {maxZoom: 22}}).addTo(map);
            var bounds_group = new L.featureGroup([]);
            map.setView([7.31848, 125.66304], 19);
            function setBounds() {
            }
            map.createPane('pane_GoogleSatellite_0');
            // Originally the zindex is 400, just reduced it to 100 so that searching is possible
            map.getPane('pane_GoogleSatellite_0').style.zIndex = 100;
            var layer_GoogleSatellite_0 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                pane: 'pane_GoogleSatellite_0',
                opacity: 1.0,
                attribution: '',
                minZoom: 10,
                maxZoom: 22,
                minNativeZoom: 0,
                maxNativeZoom: 22
            });
            layer_GoogleSatellite_0;
            map.addLayer(layer_GoogleSatellite_0);

//             map.on('click', function (e) {
//     // Check if the clicked element is not a marker
//     if (e.originalEvent.target.classList.contains('leaflet-interactive')) {
//         return; // Clicked on a marker, do nothing
//     }

//     var latlng = e.latlng; // Get the clicked latitude and longitude

//     // Set the latitude and longitude values in the modal input fields
//     document.getElementById('latitudeInput').value = latlng.lat;
//     document.getElementById('longitudeInput').value = latlng.lng;

//     // Open the modal
//     $('#modal-add_lot').modal('show');
// });

            // map.removeLayer(layer_GoogleSatellite_0);

            // var standardMapLayer = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94LWdsLWpzIiwiYSI6ImNram9ybGI1ajExYjQyeGxlemppb2pwYjIifQ.LGy5UGNIsXUZdYMvfYRiAQ', {
            //     maxZoom: 25,  // Adjust the maxZoom as needed
            //     attribution: '© Mapbox',
            // }).addTo(map);

            // // Set the view to the center and an appropriate zoom level
            // map.setView([7.3180037, 125.6630402], 18);


            function pop_CemeteryCircumference_1(feature, layer) {
                var popupContent = '<table>\
                        <tr>\
                            <td colspan="2">' + (feature.properties['Name'] !== null ? autolinker.link(feature.properties['Name'].toLocaleString()) : '') + '</td>\
                        </tr>\
                    </table>';
                // This is to remove the pop-ups in the circumference
                // layer.bindPopup(popupContent, {maxHeight: 400});
            }

            function style_CemeteryCircumference_1_0() {
                return {
                    pane: 'pane_CemeteryCircumference_1',
                    opacity: 1,
                    color: 'rgba(35,35,35,1.0)',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    weight: 1.0, 
                    fill: true,
                    fillOpacity: .6,
                    // fillColor: 'rgba(114,155,111,1.0)',
                    fillColor: '#858796',
                    // fillColor: '#53CC9D',
                    interactive: true,
                }
            }
            map.createPane('pane_CemeteryCircumference_1');
            map.getPane('pane_CemeteryCircumference_1').style.zIndex = 401;
            map.getPane('pane_CemeteryCircumference_1').style['mix-blend-mode'] = 'normal';
            var layer_CemeteryCircumference_1 = new L.geoJson(json_CemeteryCircumference_1, {
                attribution: '',
                interactive: true,
                dataVar: 'json_CemeteryCircumference_1',
                layerName: 'layer_CemeteryCircumference_1',
                pane: 'pane_CemeteryCircumference_1',
                onEachFeature: pop_CemeteryCircumference_1,
                style: style_CemeteryCircumference_1_0,
            });
            bounds_group.addLayer(layer_CemeteryCircumference_1);
            map.addLayer(layer_CemeteryCircumference_1);
            function pop_road_2(feature, layer) {
                var popupContent = '<table>\
                        <tr>\
                            <td colspan="2">' + (feature.properties['id'] !== null ? autolinker.link(feature.properties['id'].toLocaleString()) : '') + '</td>\
                        </tr>\
                    </table>';
                // This is to remove the pop-up on the road 
                // layer.bindPopup(popupContent, {maxHeight: 400});
            }

            function style_road_2_0() {
                return {
                    pane: 'pane_road_2',
                    opacity: 1,
                    color: 'rgba(239,229,192,1.0)',
                    // color: '#858796',
                    // color: '#008E76',
                    dashArray: '',
                    lineCap: 'square',
                    lineJoin: 'bevel',
                    weight: 12.0,
                    fillOpacity: 0,
                    interactive: true,
                }
            }
            map.createPane('pane_road_2');
            map.getPane('pane_road_2').style.zIndex = 402;
            map.getPane('pane_road_2').style['mix-blend-mode'] = 'normal';
            var layer_road_2 = new L.geoJson(json_road_2, {
                attribution: '',
                interactive: true,
                dataVar: 'json_road_2',
                layerName: 'layer_road_2',
                pane: 'pane_road_2',
                onEachFeature: pop_road_2,
                style: style_road_2_0,
            });
            bounds_group.addLayer(layer_road_2);
            map.addLayer(layer_road_2);
            function pop_Marker_3(feature, layer) {
                var popupContent = '<table>\
                        <tr>\
                            <th scope="row" colspan="2">' + (feature.properties['button'] !== null ? autolinker.link(feature.properties['button'].toLocaleString()) : '') + '</th>\
                            <td></td>\
                        </tr><br>\
                    </table>';
                layer.bindPopup(popupContent, {maxHeight: 400});
            }

       

            function style_Marker_3_0(feature) {
                switch(String(feature.properties['Status'])) {
                    case 'OCCUPIED':
                        return {
                    pane: 'pane_Marker_3',
                    radius: 5.0,
                    opacity: 1,
                    color: '#C57B57',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    weight: 2.0,
                    fill: true,
                    fillOpacity: 1,
                    // fillColor: 'rgba(251,124,92,1.0)',
                    // fillColor: '#3695E7',
                    // fillColor: '#4e73df',
                    fillColor: '#C57B57',
                    interactive: true,
                }
                        break;
                    case 'VACANT':
                        return {
                    pane: 'pane_Marker_3',
                    radius: 5.0,
                    opacity: 1,
                    color: 'rgba(61,128,53,1.0)',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    weight: 2.0,
                    fill: true,
                    fillOpacity: 1,
                    // fillColor: 'rgba(27,187,72,1.0)',
                    // fillColor: '#17B88F',
                    fillColor: '#1cc88a',
                    interactive: true,
                }
                break;
                    case 'NO_SLOT':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 5.0,
                        opacity: 1,
                        color: '#111D13',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 2.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#111D13',
                        interactive: true,
                    }
                    break;
                    case 'COMMON':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 10.0,
                        opacity: 1,
                        color: '#fff',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 2.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#fff',
                        interactive: true,
                    }
                    break;
                    case 'COFFIN':
                    return {
                        pane: 'pane_Marker_3',
                        pane: 'pane_Marker_3',
                        radius: 6.0,
                        opacity: 1,
                        color: '#00A7D0',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 16.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#00A7D0',
                        interactive: true,    // Adjust the height to match your requirements
                    }
                    break;
                    case 'ANNEX':
                    return {
                        pane: 'pane_Marker_3',
                        pane: 'pane_Marker_3',
                        radius: 20.0,
                        opacity: 1,
                        color: '#33B7B7',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 16.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#33B7B7',
                        interactive: true,  
                    }
                    break;
                    case 'MAUSOLEUM':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 5.0,
                        opacity: 1,
                        color: '#F7DBA7',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 2.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#F7DBA7',
                        interactive: true,
                    }
                    break;
                    case 'BONE':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 6.0,
                        opacity: 1,
                        color: '#D33724',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 16.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#D33724',
                        interactive: true,
                    }
                }
            }
            map.createPane('pane_Marker_3');
            map.getPane('pane_Marker_3').style.zIndex = 403;
            map.getPane('pane_Marker_3').style['mix-blend-mode'] = 'normal';
            var layer_Marker_3 = new L.geoJson(json_Marker_3, {
                attribution: '',
                interactive: true,
                dataVar: 'json_Marker_3',
                layerName: 'layer_Marker_3',
                pane: 'pane_Marker_3',
                // onEachFeature: pop_Marker_3,
                pointToLayer: function (feature, latlng) {
                    var context = {
                        feature: feature,
                        variables: {}
                    };

                    // console.log(feature.properties);
                    console.log(latlng);
                    
                    
                    if(feature.properties["Status"] == "COFFIN" || feature.properties["Status"] == "BONE"){

//                         var marker = L.marker([latlng.lat, latlng.lng]).addTo(map);

// // Define the label as an HTML element
// var label = L.divIcon({
//     className: 'custom-label',
//     html: 'Your Label Text',
// });

// // Add the label to the marker
// marker.setIcon(label);



        var top = [latlng.lat - 0.00009, latlng.lng]; // Top corner
        var bottom = [latlng.lat + 0.00009, latlng.lng]; // Bottom corner

        // Create a rectangle marker by connecting the top and bottom coordinates
        var rectangle = L.polygon([top, bottom, bottom, top], style_Marker_3_0(feature));

        return rectangle;

                    }

                    else if(feature.properties["Status"] == "ANNEX"){
                        var left = [latlng.lat , latlng.lng - 0.00009]; // Top corner
                        var right = [latlng.lat , latlng.lng + 0.00029]; // Bottom corner

                        // Create a rectangle marker by connecting the top and bottom coordinates
                        var rectangle = L.polygon([left, right, left, right], style_Marker_3_0(feature));
                        return rectangle;
                    }

                    else{
                        return L.circleMarker(latlng, style_Marker_3_0(feature));
                    }

                   


                    
                },
            });
            bounds_group.addLayer(layer_Marker_3);
            map.addLayer(layer_Marker_3);

            layer_Marker_3.on('click', function(e) {
                var properties = e.layer.feature.properties;
                if(properties.Status == 'NO_SLOT'){
                    $('#assignCrypt_modal #slot_id').val(properties.slot_number);
                    $('#assignCrypt_modal').modal('show');
                }
                else if(properties.Status != 'VACANT' && properties.Status != 'OCCUPIED'){
                    $.ajax({
                    type : 'post',
                    url : 'maps',
                    data: {
                        slot_number: properties.slot_number, action: "modal_crypt_profile",
                        public: "public"
                    },
                    success : function(data){
                        $('#myModal #modalBody').html(data);
                        // swal.close();
                        $('#myModal').modal('show');
                        // $(".select2").select2();//Show fetched data from database
                    }
                });


                }
                else{
                    $.ajax({
                    type : 'post',
                    url : 'profile',
                    data: {
                        slot_number: properties.slot_number, action: "modal_profile",
                        public: "public"
                    },
                    success : function(data){
                        $('#myModal #modalBody').html(data);
                        $('#myModal').modal('show');
                    }
                });
                }
            });
            setBounds();
             var searchControl = new L.Control.Search({
                layer: layer_Marker_3,
                initial: false,
                hideMarkerOnCollapse: false,
                propertyName: 'Name'});
                searchControl.on('search:locationfound', function(e) {
                    // pop_Marker_3;
                    // alert("awit");
                var feature = e.layer.feature;
                var popupContent = '<h3>' + feature.properties.Name + '</h3>' +
                                    '<p class="text-center">' + feature.properties.description + '</p>';
                // console.log(feature.properties.link_url);





































                
                
             
                
                

                // Display the pop-up content
                var popup = L.popup()
                    .setLatLng(e.latlng)
                    .setContent(popupContent)
                    .openOn(map);
                
                // Show the pop-up container
                document.getElementById('popup-content').style.display = 'block';
                document.getElementById('popup-content').innerHTML = popupContent;
});

// geojsonLayer.eachLayer(function(layer) {

// });


            map.addControl(searchControl);
            document.getElementsByClassName('search-button')[0].className +=
            ' fa fa-search';
            resetLabels([layer_Marker_3]);
            map.on("zoomend", function(){
                resetLabels([layer_Marker_3]);
            });
            map.on("layeradd", function(){
                resetLabels([layer_Marker_3]);
            });
            map.on("layerremove", function(){
                resetLabels([layer_Marker_3]);
            });

            $('.generic_form_trigger').submit(function(e) {


var form = $(this)[0];
var formData = new FormData(form);
  var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
  var prompttitle = 'Data submission';
  e.preventDefault();
  var url = $(this).data('url');
  
    swal({
        title: prompttitle,
        text: promptmessage,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.value) {
            swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
        $.ajax({
            type: 'post',
            url: url,
            processData: false,
            contentType: false,
            data: formData,
            success: function (results) {
            var o = jQuery.parseJSON(results);
            console.log(o);
            if(o.result === "success") {
                swal.close();
                swal({title: "Submit success",
                text: o.message,
                type:"success"})
                .then(function () {
                  if(o.link == "refresh")
                    window.location.reload();
                  else
                    window.location.replace(o.link);
                });
            }
            else {
                swal({
                title: "Error!",
                text: o.message,
                type:"error"
                });
                console.log(results);
            }
            },
            error: function(results) {
            console.log(results);
            swal("Error!", "Unexpected error occur!", "error");
            }
        });
        }
    });
});



        </script>






<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
