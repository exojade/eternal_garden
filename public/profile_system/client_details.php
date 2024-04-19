<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<!-- <link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css"> -->
<link rel="stylesheet" href="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

<link rel="stylesheet" href="AdminLTE/plugins/iCheck/all.css">
<link rel="stylesheet" href="AdminLTE/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}

.tabs-left.nav-tabs>li>a {
    display: block;
    margin-right: -1px;
}
.tabs-right.nav-tabs>li, .tabs-left.nav-tabs>li {
    float: none;
}
.rheader {
    padding: 10px 10px 10px 10px !important;
    display: block;
    margin-bottom: 10px;
}

.color-red{
  color: red;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Details
        <form class="generic_form_trigger" data-url="profile" style="display:inline;float: right;">
          <input type="hidden" name="action" value="vacate">
          <input type="hidden" name="slot_id" value="<?php echo($_GET["slot"]) ?>">
          <button class="btn btn-danger btn-flat">Vacate</button>
        </form>


        <?php if($slot["active_status"] != "OCCUPIED"): ?>
          <a href="#" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalTemp" style="display:inline;float: right; margin-right: 10px;">Capture</a>
        <?php endif; ?>

        

        <!-- <form class="generic_form_trigger" data-url="profile" style="display:inline;float: right; margin-right: 10px;">
          <input type="hidden" name="action" value="vacate">
          <input type="hidden" name="slot_id" value="<?php echo($_GET["slot"]) ?>">
          <button class="btn btn-info btn-flat">Capture</button>
        </form> -->
      
      </h1>
    </section>


    <section class="content">


    <?php if($slot["active_status"] != "OCCUPIED"): ?>
    <div class="modal fade" id="modalTemp">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Capture TEMP</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="uploadCapture">
              <input type="hidden" name="action" value="uploadCaptureTempProfile">
              <input type="hidden" name="crypt_slot" value="<?php echo($_GET["slot"]) ?>">
              <div class="modal-body">

              <?php $tempProfile = query("select * from profile_list where tempStatus = 'TEMP'"); ?>


              <div class="form-group">
                <label>Temp Profile</label>
                <select style="width: 100%;" class="form-control" id="tempProfile" name="tempProfile">
                  <option value=""></option>
                  <?php foreach($tempProfile as $row): ?>
                    <option value="<?php echo($row["profile_id"]); ?>"><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <button type="submit" class="btn btn-info">Submit</button>

            

          

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
              </div>
            </form>
            </div>
          </div>
        </div>
        <?php endif; ?>




    <div class="modal fade" id="modal_add_client">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Client's Profile</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="add_client">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">
                <input type="hidden" name="crypt_slot_type" value="<?php echo($slot["crypt_type"]) ?>">
                <input type="hidden" name="province" id="true_province" value="">
                <input type="hidden" name="city_mun" id="true_city_mun" value="">
                <input type="hidden" name="barangay" id="true_barangay" value="">

              
              
                <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="color-red"><b>*</b></span></label>
                  <input required type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name (optional)</label>
                  <input type="text" name="middle_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="color-red"><b>*</b></span></label>
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
                  <label for="exampleInputEmail1">Province <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="province_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">City | Municipality <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="city_mun_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Barangay <span class="color-red"><b>*</b></span></label>
                  <select required class="form-control" id="barangay_select"></select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Home Address <span class="color-red"><b>*</b></span></label>
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
                    <label for="exampleInputEmail1">Client Email (optional)</label>
                    <input type="email" name="email_address" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red"><b>*</b></span></label>
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
                      <p class="help-block">Upload softcopy</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Valid ID (optional)</label>
                      <input name="valid_id"  type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Take a photo of the valid ID and upload it here. </p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">2 x 2 ID (optional)</label>
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
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">ID Presented </label>
                  <input required type="text" name="id_presented" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div> -->
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
          
              <?php if($slot["crypt_type"] == "BONE"): ?>


              <?php elseif($slot["crypt_type"] == "COFFIN"): ?>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Lease Date</label>
                  <input required type="date" value="<?php echo(date("Y-m-d")); ?>" name="lease_date" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Occupant Type</label>
                  <select required class="form-control" name="occupant_type">
                    <option value="" selected disabled>Please select occupant type</option>
                    <option value="NON INDIGENT">NON INDIGENT</option>
                    <option value="INDIGENT">INDIGENT</option>
                  </select>
                </div>
              </div>
                
              <?php elseif($slot["crypt_type"] == "MAUSOLEUM"): ?>

              <?php elseif($slot["crypt_type"] == "LAWN"): ?>
              
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



       






    <?php if($slot["active_status"] == "VACANT"): ?>
              <div class="alert alert-warning alert-dismissible">
         
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                There's no lease information here! Click add Profile to get started.
                <br>
                <br>
                <a href="#" data-toggle="modal" data-target="#modal_add_client" class="btn btn-primary">Add Profile</a>
              </div>

    <?php else: ?>
        <?php $client = $client[0]; ?>


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


      






       
        <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="AdminLTE/dist/img/user4-128x128.jpg" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo($client["client_firstname"] . " " . $client["client_lastname"]); ?></h3>
              <div class="text-center">
                <a href="#" data-toggle="modal" data-target="#updateClientModal" class="btn btn-warning btn-sm">Update</a>
                <?php $transaction = query("select * from transaction where profile_id = ?", $client["profile_id"]); ?>
              </div>
              <br>
              
              <p class="text-muted text-center"><?php echo($client["client_address"] . ", " . $client["barangay"] . ", " . $client["city_municipality"]. ", " . $client["province"]); ?></p>
              <p class="text-muted text-center"><?php echo($client["email_address"]); ?></p> 
              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                  <b>Name</b> <a class="pull-right"><?php
                  // dump($slot);
                  echo($slot["crypt_name"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Crypt Type</b> <a class="pull-right"><?php echo($slot["crypt_type"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Slot / Lawn #</b> <a class="pull-right"><?php echo($slot["slot_number"]); ?></a>
                </li>
                <?php if($slot["crypt_slot_type"] == "LAWN"): ?>
                  <li class="list-group-item">
                    <b>Purchase Status</b> <a class="pull-right"><?php echo($client["lease_status"]); ?></a>
                  </li>
                <?php endif; ?>

                <?php if($slot["crypt_slot_type"] == "COFFIN"): ?>
                  <li class="list-group-item">
                  <b>Lease Date</b> <a class="pull-right"><?php echo($client["lease_date"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Date Expired</b> <a class="pull-right"><?php echo($client["date_expired"]); ?></a>
                </li>
                <?php endif; ?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About the Client</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Gender</b> <a class="pull-right"><?php echo($client["gender"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact Number</b> <a class="pull-right"><?php echo($client["client_contact"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>ID Presented</b> <a class="pull-right"><?php echo($client["id_presented"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>ID Number</b> <a class="pull-right"><?php echo($client["id_number"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Place Issued</b> <a class="pull-right"><?php echo($client["place_issued"]); ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">

        <?php if($slot["crypt_type"] == "LAWN"): ?>
          <?php if($client["transaction_id"] == ""): ?>
            <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                As per the specified requirement, prior to adding a deceased individual to a lawn lot, 
                the client is obligated to make the necessary payment for the lot. This prerequisite is in place to ensure that 
                all financial obligations associated with the acquisition of the lawn lot have been duly fulfilled before any further actions are taken.
            </div>

            <?php $price_lawn = query("select * from pricing_lawn where name = ?", $slot["lawn_type"]); ?>
            <?php $price = ($client["lease_status"] == "PRE NEED") ? $price_lawn[0]["pre_need"] : $price_lawn[0]["at_need"]; 
                  $price = ($client["residency"] == "PANABO") ? $price : $price * 2; 
            ?>

            <div class="row">
              <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border ">
                  <h3 class="box-title">Pay Lawn Bills</h3>
                </div>
                <div class="box-body">
                <table class="table table-striped">
            <thead>
            <tr>
              <th>Product</th>
              <th>Lawn Type</th>
              <th>Residency</th>
              <th>Lease Type</th>
              <th>Price</th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo($price_lawn[0]["type"]); ?></td>
                <td><?php echo($price_lawn[0]["name"]); ?></td>
                <td><?php echo($client["residency"]); ?></td>
                <td><?php echo($client["lease_status"]); ?></td>
                <td><?php echo(to_peso($price)); ?></td>
              </tr>
           
            </tbody>
          </table>
          <tfoot>
            <br>
            <form class="generic_form_trigger" data-url="profile">
              <input type="hidden" name="action" value="lawn_bill">
              <input type="hidden" name="client" value="<?php echo($client["profile_id"]); ?>">
              <button class="btn btn-primary">Pay Bill</button>
            </form>
            

          </tfoot>
                </div>
              </div>
              </div>
            </div>




          <?php else: ?>
            <?php require("client_table.php"); ?>
          <?php endif; ?>
        <?php else: ?>
          <?php require("client_table.php"); ?>
        <?php endif; ?>









          
        </div>
      </div>











    <?php endif; ?>
    </section>
  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>
  
  <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.bundle.min.js'></script> -->
<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="AdminLTE/dist/js/adminlte.min.js"></script>
<script src="AdminLTE/dist/js/demo.js"></script>
<script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
<!-- <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script> -->
<script src="AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>
<script type="text/javascript">


$('[data-mask]').inputmask()

     
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
















var all_province = Philippines.sort(Philippines.provinces,"A");
    html = "<option value='' disabled selected>Select Province</option>";

    <?php if(isset($client["province"])): ?>
      html = "<option value='<?php echo($client["province"]); ?>' selected><?php echo($client["province"]); ?></option>";
    <?php else: ?>
      html = "<option value='' disabled selected></option>";
    <?php endif; ?>
    
    for(var key in all_province) {
      // console.log(all_province[key].name);
        html += "<option value=" + all_province[key].prov_code  + ">" +all_province[key].name + "</option>"
    }
    document.getElementById("update_province_select").innerHTML = html;


  $('#update_province_select').change(function(){
    $('#update_true_province').val($( "#update_province_select option:selected" ).text());
    city_mun = Philippines.getCityMunByProvince($(this).val(), 'A');
    html = "<option value='' disabled selected>Select City / Municipality</option>";
 
    
    for(var key in city_mun) {
      // console.log(city_mun[key].name);
        html += "<option value=" + city_mun[key].mun_code  + ">" +city_mun[key].name + "</option>"
    }
    document.getElementById("update_city_mun_select").innerHTML = html;
});


$('#update_city_mun_select').change(function(){
    $('#update_true_city_mun').val($( "#update_city_mun_select option:selected" ).text());
    barangay = Philippines.getBarangayByMun($(this).val(), 'A');
    html = "<option value='' disabled selected>Select Barangay</option>";
 
    for(var key in barangay) {
      // console.log(city_mun[key].name);
        html += "<option value=" + barangay[key].mun_code  + ">" +barangay[key].name + "</option>"
    }
    document.getElementById("update_barangay_select").innerHTML = html;
});

$('#update_barangay_select').change(function(){
    $('#update_true_barangay').val($( "#update_barangay_select option:selected" ).text());

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
  autoWidth: false,
});

$('#courseInput').select2({
        tags: true,
        placeholder: "Select ID or enter a new one",
        allowClear: true
    });

    $('#tempProfile').select2({
        // tags: true,
        placeholder: "Select temp Profile",
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

    // $('.select2').select2()
  })
</script>

<script>
$('.timepicker').timepicker({
      showInputs: false,
      autoUpdateInput: false,   
    })
    $('.timepicker').val("");
  

    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  </script>




<script>

// $(document).ready(function() {
//     // Initialize autoNumeric for each input field with the class allowanceInput
//     new AutoNumeric('#total_cost', {
//         currencySymbol: '₱',
//         digitGroupSeparator: ',', // optional thousand separator
//         decimalCharacter: '.', // decimal separator
//         decimalPlaces: 2, // number of decimal places
//         minimumValue: '0' // optional minimum value
//     });
// });

$(document).ready(function() {

  var totalCostInput = new AutoNumeric('#total_cost', {
        currencySymbol: '₱',              // Set currency symbol to '₱'
        digitGroupSeparator: ',',         // Use comma as the thousand separator
        decimalCharacter: '.',            // Use dot as the decimal separator
        decimalPlaces: 2,                 // Set number of decimal places to 2
        minimumValue: '0'                 // Set minimum value to '0'
    });


   new AutoNumeric('#discount', {
        currencySymbol: '₱',              // Set currency symbol to '₱'
        digitGroupSeparator: ',',         // Use comma as the thousand separator
        decimalCharacter: '.',            // Use dot as the decimal separator
        decimalPlaces: 2,                 // Set number of decimal places to 2
        minimumValue: '0'                 // Set minimum value to '0'
    });


    $('input.coffin_price,input#lapida,input#discount ,input[type="checkbox"][name="service[]"]').on('change', function() {
        updateTotalCost();
    });


    $('input#discount').on('input', function() {
        updateTotalCost();
    });



    $('input.coffin_price:checked,input#lapida,input#discount input[type="checkbox"][name="service[]"]:checked').trigger('change');


    function convertCurrencyToDouble(currencyString) {
        // Remove currency symbol and commas
        var cleanedString = currencyString.replace('₱', '').replace(',', '');
        // Parse as a floating-point number
        var result = parseFloat(cleanedString);
        return result;
    }

    function updateTotalCost() {
     
      var totalCost = 0;

      var discount = convertCurrencyToDouble($('#discount').val());
      console.log(discount);

      <?php if($slot["crypt_type"] == "BONE"): ?>
        var selectedOption = $('#pricingOption option:selected');
        $('#lapida').data('cost', selectedOption.data('lapida_amount'));
        totalCost += parseInt(selectedOption.data('amount')) + parseInt(selectedOption.data('certification'));
      <?php endif; ?>

        var selectedServices = $('input.coffin_price:checked,input#lapida:checked, input[type="checkbox"][name="service[]"]:checked');
        selectedServices.each(function() {
            totalCost += parseInt($(this).data('cost'));
        });
        totalCost = totalCost - discount;
        $('#total_cost').val(totalCost);
        totalCostInput.set(totalCost);
        // $('#total_cost').autoNumeric('set', totalCost);
    }
    $('#pricingOption').on('change', updateTotalCost);
});


$(document).on("click", ".open_transfer_modal", function () {
     var myBookId = $(this).data('id');
     $("#modal_transfer .modal-body #deceased_id").val( myBookId );
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});


$(document).on("click", ".open_transaction_modal", function () {
     var transaction_id = $(this).data('id');
     $.ajax({
        type : 'post',
        url : 'profile',
        data: {
            transaction_id: transaction_id, action: "modal_details"
        },
        success : function(data){
            $('#modal_details .fetched_data').html(data);
            // swal.close();
            $('#modal_details').modal('show');
            // $(".select2").select2();//Show fetched data from database
        }
      });
     
     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});







</script>

<scropt






