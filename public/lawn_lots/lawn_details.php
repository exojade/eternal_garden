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
.text-occupied2 {
    color: rgb(128, 45, 45)!important;
}.text-occupied3 {
    color: rgb(24, 22, 22)!important;
}
.text-vacant {
    color: #1cc88a!important;
}
.text-occupied1 {
    color: #858796!important;
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
        Lawn Lots
      </h1>
    </section>
    <section class="content">

    <div class="row">
                    
                    <div class="col-sm-6">
                    <h3>Legend:</h3>
                        <p><i class="fa fa-square text-vacant"></i> Vacant</p>
                        <p><i class="fa fa-square text-occupied1"></i> Occupied by 1 person</p>
                        <p><i class="fa fa-square text-occupied2"></i> Occupied by 2 person</p>
                        <p><i class="fa fa-square text-occupied3"></i> Occupied by 3 person</p>
                    </div>
                    <div class="col-sm-6">
                      <form class="generic_form" data-url="lawn">
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
    <!-- /.content -->
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
  <script src="gravekeeper/assets/bootstrap/js/bootstrap.min.js"></script>
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

$deceased_profile = query("select * from deceased_profile");
$Deceased = [];
foreach($deceased_profile as $d):
    $Deceased[$d["slot_number"]][$d["deceased_id"]] = $d;
endforeach;


            if($_GET["filter"] == "ALL"){
              $result = query("select * from crypt_slot where crypt_id = ?", $_GET["id"]);
            }
            else{
              $result = query("select * from crypt_slot where crypt_id = ?
              and lawn_type = ?", $_GET["id"], $_GET["filter"]);
            }
            
        ?>
        <script>
            var json_Marker_3 = {
            "type": "FeatureCollection",
            "name": "Marker_3",
            "crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
            "features": [
                <?php
                    //  function format_interval(DateInterval $interval) {
                    //      $result = "";
                    //      if ($interval->y) { $result .= $interval->format("%y years"); }
                    //      if ($interval->m) { $result .= $interval->format("%m months"); }
                    //      if ($interval->d) { $result .= $interval->format("%d days"); }

                    //      return $result;
                    //  }
                    foreach($result as $row){

                        // if(isset($Deceased[$row["slot_number"]])):
                        //     $deceased = $Deceased[$row["slot_number"]];
                        //     foreach($deceased)
                        // else:

                        // endif;


                                $trim = str_replace('""', '', $row['coordinates']);
                                echo '{ "type": "Feature", "properties": { ';
                                echo '"button": "<a target=\'_blank\' href=\'lawn?action=slot_details&slot='.$row["slot_id"].'\' style=\'color:#fff;\' class=\'btn btn-primary btn-flat btn-block\'>Add Profile</a>",';
                                echo '"Grave No.": "'.$row['slot_number'].'",';
                                echo '"Birth": "'."Empty".'",'; 
                                echo '"Death": "'."Empty".'",'; 
                                echo '"Visibility": "-",'; 
                                if($row["active_status"] == "OCCUPIED"):
                                    echo '"Status": "OCCUPIED",';
                                    echo '"Name": "'."Empty".'",'; 
                                else:
                                    echo '"Status": "VACANT",';
                                    echo '"Name": "'."Empty".'",'; 
                                endif;
                                
                                echo '"Photos": "'."Empty".'",';  
                                echo '"auxiliary_storage_labeling_offsetquad": "'.$row['slot_number'].'" },'; 
                                echo '"geometry": { "type": "Point", "coordinates": ['.$trim.'] } },';
                        
                    }
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
                        <tr>\
                            <th scope="row">Grave No.</th>\
                            <td>' + (feature.properties['Grave No.'] !== null ? autolinker.link(feature.properties['Grave No.'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Name</th>\
                            <td>' + (feature.properties['Name'] !== null ? autolinker.link(feature.properties['Name'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Birth</th>\
                            <td>' + (feature.properties['Birth'] !== null ? autolinker.link(feature.properties['Birth'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Death</th>\
                            <td>' + (feature.properties['Death'] !== null ? autolinker.link(feature.properties['Death'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Visibility</th>\
                            <td>' + (feature.properties['Visibility'] !== null ? autolinker.link(feature.properties['Visibility'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Status</th>\
                            <td>' + (feature.properties['Status'] !== null ? autolinker.link(feature.properties['Status'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <th scope="row">Photos</th>\
                            <td>' + (feature.properties['Photos'] !== null ? autolinker.link(feature.properties['Photos'].toLocaleString()) : '') + '</td>\
                        </tr>\
                        <tr>\
                            <td colspan="2">' + (feature.properties['auxiliary_storage_labeling_offsetquad'] !== null ? autolinker.link(feature.properties['auxiliary_storage_labeling_offsetquad'].toLocaleString()) : '') + '</td>\
                        </tr>\
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
                    color: 'rgba(0,0,0,1.0)',
                    dashArray: '',
                    lineCap: 'butt',
                    lineJoin: 'miter',
                    weight: 2.0,
                    fill: true,
                    fillOpacity: 1,
                    // fillColor: 'rgba(251,124,92,1.0)',
                    // fillColor: '#3695E7',
                    // fillColor: '#4e73df',
                    fillColor: '#E73F32',
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
                    case 'occupied2':
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
                        // rgb(24, 22, 22)
                        fillColor: 'rgb(128, 45, 45)',
                        interactive: true,
                    }
                    break;
                    case 'occupied3':
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
                        // rgb(24, 22, 22)
                        fillColor: 'rgb(24, 22, 22)',
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
                onEachFeature: pop_Marker_3,
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
            setBounds();
            map.addControl(new L.Control.Search({
                layer: layer_Marker_3,
                initial: false,
                hideMarkerOnCollapse: true,
                propertyName: 'Name'}));
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


  <?php require("public/bone_crypt/bone_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
   
  })
</script>

