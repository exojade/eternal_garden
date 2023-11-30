<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">

<link rel="stylesheet" href="gravekeeper/assets/fonts/simple-line-icons.min.css">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css"> -->
<link rel="stylesheet" href="gravekeeper/assets/css/smoothproducts.css">

<link rel="stylesheet" href="gravekeeper/webmap/css/leaflet.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/L.Control.Locate.min.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/qgis2web.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/fontawesome-all.min.css">
<link rel="stylesheet" href="gravekeeper/webmap/css/leaflet-search.css">
<link rel="stylesheet" href="gravekeeper/assets/css/home.css">

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




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">

        <h1>
        Map Details
     
    </h1>

       
   
      
    </section>
    <section class="content">




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
            <label for="exampleInputEmail1">Latitude</label>
            <input required name="latitude" type="text" class="form-control" id="latitudeInput" placeholder="---">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Longitude</label>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Lawn Information</h4>
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
      <form class="generic_form_trigger" data-url="maps">
      <input type="hidden" name="action" value="assign_crypt">
      <input type="hidden" name="slot_id" id="slot_id">
      <?php $crypts = query("select * from crypt_list where crypt_type != 'LAWN' and coordinates is null or coordinates = ''"); ?>

      <div class="form-group">
        <label>Select Crypt</label>
        <select style="width: 100%;" class="form-control select2" name="crypt">
            <?php foreach($crypts as $c): ?>
                <option value="<?php echo($c["crypt_id"]); ?>"><?php echo($c["crypt_name"] . " | " . $c["crypt_type"]); ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-flat">Submit</button>
        <!-- Point information will be displayed here -->
    </form>

    <hr>
    <form class="generic_form_trigger text-center" data-url="maps">
        <input type="hidden" name="action" value="remove_slot">
        <input type="hidden" name="slot_id" id="slot_id">
        <button type="submit" class="btn btn-danger btn-flat">Delete Slot</button>
    </form>

      </div>
    </div>
  </div>
</div>
    <div class="row">
                    <div class="col-sm-6">
                        <div style="margin-top:7px;">
                        <span><i class="fa fa-square text-vacant"></i> Vacant</span>
                        <span><i class="fa fa-square text-occupied"></i> Occupied</span>
                        <span><i class="fa fa-square text-coffin"></i> Coffin Crypt</span>
                        <span><i class="fa fa-square text-mausoleum"></i> Mausoleum</span>
                        <span><i class="fa fa-square text-bone"></i> Bone Crypt</span>
                        <span><i class="fa fa-square text-no_slot"></i> No Slot</span>
                    </div>
                    </div>
                    <div class="col-md-6">

                    <?php if(isset($_GET["type"]) && $_GET["type"] == "LAWN"): ?>
                    <form class="generic_form" data-url="maps" >
                        <input type="hidden" name="action" value="filter_map_editor">
                        <?php if(isset($_GET["type"])): ?>
                        <input type="hidden" name="type" value="<?php echo($_GET["type"]); ?>">
                        <?php endif; ?>
                        <!-- <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>"> -->
                        <div class="row">
                            <div class="col-md-8">
                                <?php  ?>
                        <select class="form-control" name="filter">
                            <?php if(isset($_GET["filter"])): ?>
                                <option value="<?php echo($_GET["filter"]); ?>"><?php echo($_GET["filter"]); ?></option>
                            <?php endif; ?>
                           <option value="ALL">ALL</option>
                           <option value="SUPER PRIME A">SUPER PRIME A</option>
                           <option value="SUPER PRIME B">SUPER PRIME B</option>
                           <option value="SUPER PRIME C">SUPER PRIME C</option>
                           <option value="PRIME A">PRIME A</option>
                           <option value="PRIME B">PRIME B</option>
                           <option value="PRIME C">PRIME C</option>
                           <option value="REGULAR LOT">REGULAR LOT</option>
                           <option value="CORNER LOT">CORNER LOT</option>
                           <option></option>
                        </select>
                            </div>
                            <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Filter</button>
                                
                            </div>
                        </div>
                      </form>
                    
                      <?php elseif(!isset($_GET["type"])): ?>

                        <form class="generic_form" data-url="maps" >
                        <input type="hidden" name="action" value="filter_map_editor">
                        <?php if(isset($_GET["type"])): ?>
                        <input type="hidden" name="type" value="<?php echo($_GET["type"]); ?>">
                        <?php endif; ?>
                        <!-- <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>"> -->
                        <div class="row">
                            <div class="col-md-8">
                                <?php  ?>
                        <select class="form-control" name="filter">
                            <?php if(isset($_GET["filter"])): ?>
                                <option value="<?php echo($_GET["filter"]); ?>"><?php echo($_GET["filter"]); ?></option>
                            <?php endif; ?>
                           <option value="ALL">ALL</option>
                           <option value="SUPER PRIME A">SUPER PRIME A</option>
                           <option value="SUPER PRIME B">SUPER PRIME B</option>
                           <option value="SUPER PRIME C">SUPER PRIME C</option>
                           <option value="PRIME A">PRIME A</option>
                           <option value="PRIME B">PRIME B</option>
                           <option value="PRIME C">PRIME C</option>
                           <option value="REGULAR LOT">REGULAR LOT</option>
                           <option value="CORNER LOT">CORNER LOT</option>
                           <option></option>
                        </select>
                            </div>
                            <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Filter</button>
                                
                            </div>
                        </div>
                      </form>
                      <?php endif; ?>
                    </div>


                    
                </div>
                <br>
    <div id="map" style="border: 1px solid black; width: 99%; height: 600px;">
                                <div id="loading">
                                    <img id="loading-image" class="mx-auto" src="gravekeeper/Preloader_3.gif" alt="Loading..." />
                                </div>
                            </div>
    </section>
  </div>
  <?php 
    require("layouts/footer.php");
  ?>
  
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script> -->
  <script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>


  <!-- <script src="gravekeeper/assets/js/jquery.min.js"></script> -->
  <!-- <script src="gravekeeper/assets/bootstrap/js/bootstrap.min.js"></script> -->
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
  <script src="gravekeeper/webmap/data/CemeteryCoffinCryptCircumference.js"></script>
  <script src="gravekeeper/webmap/data/CemeteryBoneCryptCircumference.js"></script>
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
");
// dump($deceased_profile);
$Deceased = [];
$Deceased2 = [];
foreach($deceased_profile as $d):
    $Deceased[$d["slot_number"]][$d["deceased_id"]] = $d;
    $Deceased2[$d["crypt_id"]][$d["deceased_id"]] = $d;
endforeach;
// dump($Deceased);

                $result=[];
                $result = $lawn;

                $list = query("select * from crypt_list where coordinates is not null");
                $Cryptss = [];
                foreach($list as $row):
                    $Cryptss[$row["coordinates"]] = $row;
                endforeach;

                    
         
                
                if(isset($_GET["filter"])):
                    if($_GET["filter"] != "ALL"):
                        $result = query("select slot.*,concat(client_firstname, ' ', client_middlename, ' ', client_lastname, ' ', client_suffix) as client_name, lease_date, date_expired from crypt_slot slot
                        left join profile_list client
                        on client.slot_number = slot.slot_id
                        where crypt_slot_type = 'LAWN' and lawn_type = ?", $_GET["filter"]);
                    endif;
                endif;

    //    dump($result);
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
              
        ?>
        <script>
            var json_Marker_3 = {
            "type": "FeatureCollection",
            "name": "Marker_3",
            "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features": [
                <?php
                    foreach($result as $row){
                        if(!isset($Cryptss[$row["coordinates"]])):
                        if(isset($Deceased[$row["slot_id"]])):
                            $deceased = $Deceased[$row["slot_id"]];
                            $trim = str_replace('""', '', $row['coordinates']);
                            $location = $row["lawn_type"];
                            echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"description": "<b>Lawn:</b> '.$row["lawn_type"].'",';
                                echo '"Name": "'.$row["client_name"].' [CLIENT]",';
                                echo '"link_url": "profile?action=client_details&slot='.$row["slot_id"].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                
                            foreach($deceased as $d):
                                $location = $row["lawn_type"];
                                $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"description": "<b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b><br>Location: '.$location.'",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"link_url": "profile?action=client_details&slot='.$row["slot_id"].'",';
                                echo '"Name": "'.$d["deceased_name"].' [DECEASED]",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            endforeach;
                        else:
                        // if($row["crypt_id"] == "CRYPT-796caa375ef68-230525"):

                            $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'profile?action=client_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                if($row["active_status"] == "OCCUPIED"):
                                    echo '"Status": "OCCUPIED",';
                                    echo '"Name": "'.$row["client_name"].' [CLIENT]",'; 
                                else:
                                    echo '"Status": "VACANT",';
                                    echo '"Name": "'."Empty".'",'; 
                                endif;
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        endif;
                        endif;
                        // endif;
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
                                // dump($deceased);
                                foreach($deceased as $d):
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "MAUSOLEUM",';
                                    echo '"Name": "'.$d["deceased_name"].' [DECEASED]",';
                                    echo '"description": "<b>'.$d["birthdate"] . ' - ' . $d["date_of_death"] .'</b><br>Mausoleum: '.$row["crypt_name"].'",';
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
                                    echo '"Status": "MAUSOLEUM",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].' [CLIENT]",';
                                    echo '"description": "<br>Mausoleum: '.$row["crypt_name"].'",';
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
                                    echo '"Name": "'.$d["deceased_name"].' [DECEASED]",'; 
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
                                    echo '"Status": "BONE",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].' [CLIENT]",';
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
                                    echo '"Name": "'.$d["deceased_name"].' [DECEASED]",'; 
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
                                    // dump($Clients[$cs["occupied_by"]]["client_firstname"]);
                                    $trim = str_replace('""', '', $row['coordinates']);
                                    echo '{ "type": "Feature", "properties": { ';
                                    echo '"Status": "COFFIN",';
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].' [CLIENT]",';
                                    echo '"description": "[CLIENT]<br>Crypt: '.$row["crypt_name"].'<br>Row: '.$cs["row_number"].' | Column: '.$cs["column_number"].'<br>Crypt Number: '.$cs["slot_number"].'",';
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
                                    echo '"link_url": "common_area?action=details&id='.$row["crypt_id"].'",';
                                    echo '"slot_number": "'.$row['crypt_id'].'",';
                                    echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                    echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                                endforeach;
                            endif;
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
                                    echo '"Name": "'.$d["deceased_name"].' [DECEASED]",'; 
                                    echo '"description": "<b>'.convertDateFormat($d["birthdate"]) . ' - ' . convertDateFormat($d["date_of_death"]) .'</b>",';
                                    echo '"link_url": "annex?action=client_details&slot='.$d["slot_number"].'",';
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
                                    echo '"Name": "'.$Clients[$cs["occupied_by"]]["client_firstname"] . " " . $Clients[$cs["occupied_by"]]["client_lastname"].' [CLIENT]",';
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
            //}).fitBounds([[6.913597497117801,122.13930750978687],[6.914359146460475,122.14088332323063]]);
         }).fitBounds([[7.31848,125.66304],[7.31848,125.66304]]);
            var hash = new L.Hash(map);
            map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
            var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
            L.control.locate({locateOptions: {maxZoom: 21}}).addTo(map);
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
                maxZoom: 21,
                minNativeZoom: 0,
                maxNativeZoom: 21
            });
            layer_GoogleSatellite_0;
            map.addLayer(layer_GoogleSatellite_0);


            

            map.on('click', function (e) {
    // Check if the clicked element is not a marker
    // if (e.originalEvent.target.classList.contains('leaflet-interactive')) {
    //     return; // Clicked on a marker, do nothing
    // }
    if (e.originalEvent.target.classList.contains('leaflet-interactive')) {
        var targetElement = e.originalEvent.target;
        var fillColor = targetElement.getAttribute('fill');
        if(fillColor == '#858796'){
            var latlng = e.latlng; // Get the clicked latitude and longitude

document.getElementById('latitudeInput').value = latlng.lat;
document.getElementById('longitudeInput').value = latlng.lng;

// Open the modal
$('#modal-add_lot').modal('show');
        }
        else{
         return;
        }
        


         // Clicked on a marker, do nothing
    }
    var latlng = e.latlng; // Get the clicked latitude and longitude

    document.getElementById('latitudeInput').value = latlng.lat;
    document.getElementById('longitudeInput').value = latlng.lng;

    // Open the modal
    $('#modal-add_lot').modal('show');


    // var popup = L.popup()
    //     .setLatLng(latlng)
    //     .setContent("Latitude: " + latlng.lat + "<br>Longitude: " + latlng.lng)
    //     .openOn(map);
});

// var gridLayer = L.tileLayer('grid/{z}/{x}/{y}.png', {
//     tms: true,
//     noWrap: true,
//     minZoom: 0,
//     maxZoom: 18
// });

// gridLayer.addTo(map);

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



            function style_CemeteryCoffinCryptCircumference() {
                return {
                    pane: 'pane_CemeteryCoffinCryptCircumference',
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
            map.createPane('pane_CemeteryCoffinCryptCircumference');
            map.getPane('pane_CemeteryCoffinCryptCircumference').style.zIndex = 401;
            map.getPane('pane_CemeteryCoffinCryptCircumference').style['mix-blend-mode'] = 'normal';
            var layer_CemeteryCoffinCryptCircumference = new L.geoJson(json_CemeteryCoffinCryptCircumference, {
                attribution: '',
                interactive: true,
                dataVar: 'json_CemeteryCoffinCryptCircumference',
                layerName: 'layer_CemeteryCoffinCryptCircumference',
                pane: 'pane_CemeteryCoffinCryptCircumference',
                // onEachFeature: pop_CemeteryCoffinCryptCircumference,
                style: style_CemeteryCoffinCryptCircumference,
            });
            bounds_group.addLayer(layer_CemeteryCoffinCryptCircumference);
            map.addLayer(layer_CemeteryCoffinCryptCircumference);



            function style_CemeteryBoneCryptCircumference() {
                return {
                    pane: 'pane_CemeteryBoneCryptCircumference',
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
            map.createPane('pane_CemeteryBoneCryptCircumference');
            map.getPane('pane_CemeteryBoneCryptCircumference').style.zIndex = 401;
            map.getPane('pane_CemeteryBoneCryptCircumference').style['mix-blend-mode'] = 'normal';
            var layer_CemeteryBoneCryptCircumference = new L.geoJson(json_CemeteryBoneCryptCircumference, {
                attribution: '',
                interactive: true,
                dataVar: 'json_CemeteryBoneCryptCircumference',
                layerName: 'layer_CemeteryBoneCryptCircumference',
                pane: 'pane_CemeteryBoneCryptCircumference',
                // onEachFeature: pop_CemeteryCoffinCryptCircumference,
                style: style_CemeteryBoneCryptCircumference,
            });
            bounds_group.addLayer(layer_CemeteryBoneCryptCircumference);
            map.addLayer(layer_CemeteryBoneCryptCircumference);
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
                    color: '#9E6246',
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
                    case 'COMMON':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 10.0,
                        opacity: 1,
                        color: '#000',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 3.0,
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
                        radius: 20.0,
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

            layer_Marker_3.on('click', function(e) {
                var properties = e.layer.feature.properties;
                // alert(properties.Status );
                if(properties.Status == 'NO_SLOT'){
                    $('#assignCrypt_modal #slot_id').val(properties.slot_number);
                    $('#assignCrypt_modal').modal('show');
                }
                else if(properties.Status != 'VACANT' && properties.Status != 'OCCUPIED'){
                
                    $.ajax({
                    type : 'post',
                    url : 'maps',
                    data: {
                        slot_number: properties.slot_number, action: "modal_crypt_profile"
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
                        slot_number: properties.slot_number, action: "modal_profile"
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
                if(feature.properties.link_url != "none")
                popupContent = popupContent + '<div class="text-center\"><a href="'+feature.properties.link_url+'" class="btn btn-primary btn-flat">Open Information</div>';

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





        </script>



  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
    $('.select2').select2()
   
  })
</script>

