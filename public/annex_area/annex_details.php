<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}
.table .btn{
  font-size:12px !important;
}

.color-red{
  color: red;
}
</style>
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
      <?php echo($annex["crypt_name"]); ?>
      <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modalAddClient">Register Client</a>
      </h1>
    </section>
    <section class="content">
    <div class="modal fade" id="modalAddClient">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Client's Profile</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="annex">
              <div class="modal-body">
                <input type="hidden" name="action" value="addClient">
                <input type="hidden" name="crypt_id" value="<?php echo($_GET["id"]) ?>">
                <input type="hidden" name="province" id="true_province" value="">
                <input type="hidden" name="city_mun" id="true_city_mun" value="">
                <input type="hidden" name="barangay" id="true_barangay" value="">
                <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="color-red">*</span></label>
                  <input required type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name</label>
                  <input type="text" name="middle_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="color-red">*</span></label>
                  <input required type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Suffix</label>
                  <input type="text" name="suffix" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
</div>
<hr>
<div class="row">
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Province <span class="color-red">*</span></label>
                  <select required class="form-control" id="province_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">City | Municipality <span class="color-red">*</span></label>
                  <select required class="form-control" id="city_mun_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Barangay <span class="color-red">*</span></label>
                  <select required class="form-control" id="barangay_select"></select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Home Address <span class="color-red">*</span></label>
                  <input required type="text" name="client_address" class="form-control" id="exampleInputEmail1" placeholder="Subdivision / Village / Purok (Complete Address)">
                </div>
              </div>
</div>
<hr>
<div class="row">
              <div class="col-md-4">
              <div class="form-group">
                <label>Client Contact Number <span class="color-red"><b>*</b></span></label>
                  <input name="client_contact" type="text" placeholder="(09xx)-xxx-xxxx" class="form-control" data-inputmask='"mask": "9999-999-9999"' data-mask>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Email <span class="color-red">*</span></label>
                    <input  type="email" name="email_address" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red">*</span></label>
                  <select required class="form-control" name="gender">
                  <option value="" selected disabled>Please select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
</div>
<hr>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Certificate of Indigency (optional)</label>
                      <input name="certificate_indigency" type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Valid ID <span class="color-red"><b>*</b></span></label>
                      <input name="valid_id" required type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">2 x 2 ID <span class="color-red"><b>*</b></span></label>
                      <input name="picture" required type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
                  </div>
                </div>
              </div>
            <hr>
            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
                <label>ID Presented <span class="color-red"><b>*</b></span></label>
                <select name="id_presented" required class="form-control" id="courseInput" style="width: 100%;" >
                  <option value="" selected></option>
                  <option value="GSIS ID">GSIS ID</option>
                  <option value="POSTAL ID">POSTAL ID</option>
                  <option value="VOTERS ID">VOTERS ID</option>
                  <option value="PHILIPPINE PASSPORT">PHILIPPINE PASSPORT</option>
                  <option value="PHILHEALTH ID">PHILHEALTH ID</option>
                  <option value="SSS ID">SSS ID</option>
                  <option value="PWD ID">PWD ID</option>
                  <option value="NATIONAL ID">NATIONAL ID</option>
                  <option value="PRC ID">PRC ID</option>
                  <option value="DRIVERS LICENSE">DRIVERS LICENSE</option>
                  <option value="UMID">UMID</option>
                  <!-- <option></option> -->
                </select>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Number <span class="color-red"><b>*</b></span></label>
                  <input required type="text" name="id_number" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Place Issued <span class="color-red"><b>*</b></span></label>
                  <input required type="text" name="place_issued" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>








        <div class="modal fade" id="updateClientModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Client</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="updateClient">
                <input type="hidden" name="profile_id" value="<?php echo($client["profile_id"]); ?>">
                <input type="hidden" name="slot_number" value="<?php echo($client["slot_number"]); ?>">
                <input type="hidden" value="<?php echo($client["province"]); ?>" name="province" id="update_true_province" value="">
                <input type="hidden" value="<?php echo($client["city_municipality"]) ?>" name="city_mun" id="update_true_city_mun" >
                <input type="hidden" value="<?php echo($client["barangay"]) ?>" name="barangay" id="update_true_barangay" value="">

              
              
                <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="color-red"><b>*</b></span></label>
                  <input required value="<?php echo($client["client_firstname"]); ?>" type="text" name="client_firstname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name (optional)</label>
                  <input type="text" value="<?php echo($client["client_middlename"]); ?>" name="client_middlename" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="color-red"><b>*</b></span></label>
                  <input required value="<?php echo($client["client_lastname"]); ?>" type="text" name="client_lastname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Suffix</label>
                  <input type="text" value="<?php echo($client["client_suffix"]); ?>" name="client_suffix" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
</div>
<hr>
<div class="row">
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Province <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="update_province_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">City | Municipality <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="update_city_mun_select">
                    <option selected value="<?php echo($client["city_municipality"]); ?>"><?php echo($client["city_municipality"]); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Barangay <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="update_barangay_select">
                   <option selected value="<?php echo($client["barangay"]); ?>"><?php echo($client["barangay"]); ?></option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Address Home <span class="color-red"><b>*</b></span></label>
                  <input required value="<?php echo($client["client_address"]); ?>" type="text" name="client_address" class="form-control" id="exampleInputEmail1" placeholder="Subdivision / Village / Purok (Complete Address)">
                </div>
              </div>
</div>
<hr>
<div class="row">
              <div class="col-md-4">


              <div class="form-group">
                <label>Client Contact Number <span class="color-red"><b>*</b></span></label>
                  <input value="<?php echo($client["client_contact"]); ?>" name="client_contact" type="text" placeholder="(09xx)-xxx-xxxx" class="form-control" data-inputmask='"mask": "9999-999-9999"' data-mask>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Email <span class="color-red"><b>*</b></span></label>
                    <input value="<?php echo($client["email_address"]); ?>" required type="email" name="email_address" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" name="gender">
                  <option value="<?php echo($client["gender"]); ?>" selected ><?php echo($client["gender"]); ?></option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
</div>
<hr>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Certificate of Indigency (optional)</label>
                      <br><a target="_blank" href="<?php echo($client["certificate_indigency"]); ?>">View Existing File</a>
                      <input name="certificate_indigency" type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload softcopy</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Valid ID <span class="color-red"><b>*</b></span></label>
                      <br><a target="_blank" href="<?php echo($client["valid_id"]); ?>">View Existing File</a>
                      <input name="valid_id"  type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Take a photo of the valid ID and upload it here. </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">2 x 2 ID <span class="color-red"><b>*</b></span></label>
                      <br><a target="_blank" href="<?php echo($client["picture"]); ?>">View Existing File</a>
                      <input name="picture"  type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload softcopy</p>
                  </div>
                </div>

              </div>
              
<hr>


<!-- <div class="form-group">
                <label>Requirements</label>
                <select name="requirements[]" class="form-control select2" multiple="multiple" data-placeholder="Select Requirements Submitted"
                        style="width: 100%;">
                  <option value="Certificate of Residency">Certificate of Residency</option>
                  <option value="Valid ID">Valid ID</option>
                  <option value="2x2 Picture">2x2 Picture</option>
                </select>
              </div> -->
<div class="row">
              <div class="col-md-4">

              <div class="form-group">
                <label>ID Presented <span class="color-red"><b>*</b></span></label>
                <select name="id_presented" required class="form-control" id="courseInput2" style="width: 100%;" >
                  <option value="<?php echo($client["id_presented"]); ?>" selected><?php echo($client["id_presented"]); ?></option>
                  <option value="GSIS ID">GSIS ID</option>
                  <option value="POSTAL ID">POSTAL ID</option>
                  <option value="VOTERS ID">VOTERS ID</option>
                  <option value="PHILIPPINE PASSPORT">PHILIPPINE PASSPORT</option>
                  <option value="PHILHEALTH ID">PHILHEALTH ID</option>
                  <option value="SSS ID">SSS ID</option>
                  <option value="PWD ID">PWD ID</option>
                  <option value="NATIONAL ID">NATIONAL ID</option>
                  <option value="PRC ID">PRC ID</option>
                  <option value="DRIVERS LICENSE">DRIVERS LICENSE</option>
                  <option value="UMID">UMID</option>
                  <!-- <option></option> -->
                </select>
              </div>
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">ID Presented </label>
                  <input required type="text" name="id_presented" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div> -->
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Number <span class="color-red"><b>*</b></span></label>
                  <input value="<?php echo($client["id_number"]); ?>" required type="text" name="id_number" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Place Issued <span class="color-red"><b>*</b></span></label>
                  <input value="<?php echo($client["place_issued"]); ?>" required type="text" name="place_issued" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
          
              <?php if($slot["crypt_type"] == "BONE"): ?>


              <?php elseif($slot["crypt_type"] == "COFFIN"): ?>

              <?php $transaction = query("select * from transaction where profile_id = ?", $client["profile_id"]); ?>
              <?php if(empty($transaction)): ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Lease Date</label>
                  <input required type="date" value="<?php echo($client["lease_date"]); ?>" name="lease_date" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Occupant Type</label>
                  <select required class="form-control" name="occupant_type">
                    <option value="<?php echo($client["occupant_type"]); ?>" selected ><?php echo($client["occupant_type"]); ?></option>
                    <option value="NON INDIGENT">NON INDIGENT</option>
                    <option value="INDIGENT">INDIGENT</option>
                  </select>
                </div>
              </div>
              <?php endif; ?>

             
                
              <?php elseif($slot["crypt_type"] == "MAUSOLEUM"): ?>

              <?php elseif($slot["crypt_type"] == "LAWN"): ?>

                <?php $transaction = query("select * from transaction where profile_id = ?", $client["profile_id"]); ?>
              <?php if(empty($transaction)): ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Residency</label>
                  <select required class="form-control" name="residency">
                    <option value="" selected disabled>Please select residency status</option>
                    <option value="PANABO">Resident of Panabo</option>
                    <option value="OUTSIDE">Residing outside Panabo</option>
                  </select>
                </div>
              </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Lease Status</label>
                  <select required class="form-control" name="lease_status">
                    <option value="" selected disabled>Please select lease status</option>
                    <option value="PRE NEED">PRE NEED</option>
                    <option value="AT NEED">AT NEED</option>
                  </select>
                </div>
              </div>
              <?php endif; ?>
              
       

              <?php endif; ?>

              



            </div>




              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </form>
            </div>
          </div>
        </div>











    <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                  <th>Action</th>
                  <th>Deceased</th>
                  <th>BirthDate</th>
                  <th>Date Died</th>
                  <th>Age Died</th>
                  <th>Death Certificate</th>
                  <th>Client</th>
                </thead>
                <tbody>
                  <?php foreach($deceased_profile as $row):?>
                    <tr>
                      <td><a href="annex?action=client_details&slot=<?php echo($row["slot_id"]); ?>" class="btn btn-primary btn-xs btn-block">Details</a></td>
                      <td><?php echo($row["deceased_firstname"] . " " . $row["deceased_lastname"]); ?></td>
                      <td><?php echo($row["birthdate"]); ?></td>
                      <td><?php echo($row["date_of_death"]); ?></td>
                      <td><?php echo($row["age_died"]); ?></td>
                      <td><a href="<?php echo($row["death_certificate"]); ?>" class="btn btn-primary btn-xs">View Certificate</a></td>
                      <td><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></td>
                    </tr>
                  <?php endforeach; ?>
         
                </tbody>
              </table>
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
  <script src="AdminLTE/plugins/select2/js/select2.full.min.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <script src="AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  <script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script type="text/javascript">



$('#courseInput').select2({
        tags: true,
        placeholder: "Select ID or enter a new one",
        allowClear: true
    });

    $('#courseInput').on('select2:open', function() {
        $('.select2-search__field').attr('placeholder', 'Search here. If not found, type the ID presented.');
    });

    $('#courseInput2').select2({
        tags: true,
        placeholder: "Select ID or enter a new one",
        allowClear: true
    });

    $('#courseInput2').on('select2:open', function() {
        $('.select2-search__field').attr('placeholder', 'Search here. If not found, type the ID presented.');
    });

$('[data-mask]').inputmask()
     console.log(Philippines.sort(Philippines.provinces,"A"));
     
     console.log(Philippines.getBarangayByMun("112315"));
      var all_province = Philippines.sort(Philippines.provinces,"A");
    html = "<option value='' disabled selected>Select Province</option>";
    
    for(var key in all_province) {
      // console.log(all_province[key].name);
        html += "<option value=" + all_province[key].prov_code  + ">" +all_province[key].name + "</option>"
    }
    document.getElementById("province_select").innerHTML = html;


  $('#province_select').change(function(){
    $('#true_province').val($( "#province_select option:selected" ).text());
    city_mun = Philippines.getCityMunByProvince($(this).val(), 'A');
    html = "<option value='' disabled selected>Select City / Municipality</option>";
    for(var key in city_mun) {
      // console.log(city_mun[key].name);
        html += "<option value=" + city_mun[key].mun_code  + ">" +city_mun[key].name + "</option>"
    }
    document.getElementById("city_mun_select").innerHTML = html;
});


$('#city_mun_select').change(function(){
    $('#true_city_mun').val($( "#city_mun_select option:selected" ).text());
    barangay = Philippines.getBarangayByMun($(this).val(), 'A');
    html = "<option value='' disabled selected>Select Barangay</option>";
    for(var key in barangay) {
      // console.log(city_mun[key].name);
        html += "<option value=" + barangay[key].mun_code  + ">" +barangay[key].name + "</option>"
    }
    document.getElementById("barangay_select").innerHTML = html;
});

$('#barangay_select').change(function(){
    $('#true_barangay').val($( "#barangay_select option:selected" ).text());

});

</script>
  <?php require("public/coffin_crypt/coffin_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable({
      "ordering": false,
    });
   
  })
</script>

