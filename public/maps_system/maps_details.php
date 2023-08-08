<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
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


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Point Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
    <div class="row">
                    <div class="col-sm-6">
                    <h3>Legend:</h3>
                        <p><i class="fa fa-square text-vacant"></i> Vacant</p>
                        <p><i class="fa fa-square text-occupied"></i> Occupied</p>
                        <p><i class="fa fa-square text-coffin"></i> Coffin Crypt</p>
                        <p><i class="fa fa-square text-mausoleum"></i> Mausoleum</p>
                        <p><i class="fa fa-square text-bone"></i> Bone Crypt</p>
                        <p><i class="fa fa-square text-no_slot"></i> No Slot</p>
                    </div>
                    <div class="col-sm-6">
                      <form class="generic_form" data-url="maps">
                        <input type="hidden" name="action" value="filter_lawn">
                        <input type="hidden" name="id" value="<?php echo($_GET["id"]); ?>">
                        <label>Filter</label>
                        <select class="form-control" name="filter">
                           <option value="<?php echo($_GET["filter"]); ?>"><?php echo($_GET["filter"]); ?></option>
                           <option value="ALL">ALL</option>
                           <option value="SUPER_PRIME_A">SUPER_PRIME_A</option>
                           <option value="SUPER_PRIME_B">SUPER_PRIME_B</option>
                           <option value="SUPER_PRIME_C">SUPER_PRIME_C</option>
                           <option value="PRIME_A">PRIME_A</option>
                           <option value="PRIME_B">PRIME_B</option>
                           <option value="PRIME_C">PRIME_C</option>
                           <option value="REGULAR">REGULAR</option>
                           <option value="CORNER">CORNER</option>
                           <option></option>
                        </select>
                        <button class="btn btn-primary" type="submit">Filter</button>
                      </form>
                    </div>
                </div>
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
  <script src="gravekeeper/webmap/data/road_2.js"></script>

  <script>
        $(window).on('load', function () {
            $('#loading').hide();
        }) 
    </script>


<?php






            if($_GET["filter"] == "ALL"){
              $result = query("select slot.*,client.client_name from crypt_slot slot
                                left join profile_list client
                                on client.slot_number = slot.slot_id
                                where crypt_slot_type = 'LAWN'");
            }
            else{
              $result = query("select slot.*,client.client_name from crypt_slot slot
              left join profile_list client
              on client.slot_number = slot.slot_id
              where crypt_slot_type = 'LAWN'
              and lawn_type = ?", $_GET["filter"]);
            }
        //    dump($result);
            
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
                            echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'lawn?action=slot_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"Name": "'.$row["client_name"].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            foreach($deceased as $d):
                                $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'lawn?action=slot_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Status": "OCCUPIED",';
                                echo '"slot_number": "'.$row['slot_id'].'",';
                                echo '"Name": "'.$d["deceased_name"].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                            endforeach;
                        else:
                            $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'lawn?action=slot_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
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
                                echo '"slot_number": "'.$row['crypt_id'].'",';
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        endif;
                    endforeach;
                    foreach($bone as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "BONE",';
                            echo '"Name": "'.$row["crypt_name"].'",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        endif;
                    endforeach;
                    foreach($coffin as $row):
                        if($row["coordinates"] != ""):
                        $trim = str_replace('""', '', $row['coordinates']);
                            echo '{ "type": "Feature", "properties": { ';
                            echo '"Status": "COFFIN",';
                            echo '"Name": "'.$row["crypt_name"].'",'; 
                            echo '"slot_number": "'.$row['crypt_id'].'",';
                            echo '"auxiliary_storage_labeling_offsetquad": "'.$row['crypt_id'].'" },'; 
                            echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
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
                ?>
            ]
            }
        </script>

        <script>
            var map = L.map('map', {
                zoomControl:true, maxZoom:21, minZoom:20
            }).fitBounds([[6.913597497117801,122.13930750978687],[6.914359146460475,122.14088332323063]]);
            var hash = new L.Hash(map);
            map.attributionControl.setPrefix('<a href="https://github.com/tomchadwin/qgis2web" target="_blank">qgis2web</a> &middot; <a href="https://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> &middot; <a href="https://qgis.org">QGIS</a>');
            var autolinker = new Autolinker({truncate: {length: 30, location: 'smart'}});
            L.control.locate({locateOptions: {maxZoom: 19}}).addTo(map);
            var bounds_group = new L.featureGroup([]);
            function setBounds() {
            }
            map.createPane('pane_GoogleSatellite_0');
            // Originally the zindex is 400, just reduced it to 100 so that searching is possible
            map.getPane('pane_GoogleSatellite_0').style.zIndex = 100;
            var layer_GoogleSatellite_0 = L.tileLayer('http://www.google.cn/maps/vt?lyrs=s@189&gl=cn&x={x}&y={y}&z={z}', {
                pane: 'pane_GoogleSatellite_0',
                opacity: 1.0,
                attribution: '',
                minZoom: 19,
                maxZoom: 21,
                minNativeZoom: 0,
                maxNativeZoom: 19
            });
            layer_GoogleSatellite_0;
            map.addLayer(layer_GoogleSatellite_0);
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
                    radius: 8.0,
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
                    radius: 8.0,
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
                        radius: 8.0,
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
                    case 'COFFIN':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 8.0,
                        opacity: 1,
                        color: '#00A7D0',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 2.0,
                        fill: true,
                        fillOpacity: 1,
                        // rgb(24, 22, 22)
                        fillColor: '#00A7D0',
                        interactive: true,
                    }
                    break;
                    case 'MAUSOLEUM':
                    return {
                        pane: 'pane_Marker_3',
                        radius: 8.0,
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
                        radius: 8.0,
                        opacity: 1,
                        color: '#D33724',
                        dashArray: '',
                        lineCap: 'butt',
                        lineJoin: 'miter',
                        weight: 2.0,
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
                    return L.circleMarker(latlng, style_Marker_3_0(feature));
                },
            });
            bounds_group.addLayer(layer_Marker_3);
            map.addLayer(layer_Marker_3);

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
                        // swal.close();
                        $('#myModal').modal('show');
                        // $(".select2").select2();//Show fetched data from database
                    }
                });

                }


                



                
                // Open the modal
                
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
                                    '<p>' + feature.properties.description + '</p>';

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
   
  })
</script>

