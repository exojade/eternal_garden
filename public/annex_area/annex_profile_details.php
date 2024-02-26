<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/iCheck/all.css">
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
      
      </h1>
    </section>
    <section class="content">
        <?php $client = $client[0]; ?>
        <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="AdminLTE/dist/img/user4-128x128.jpg" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo($client["client_firstname"] . " " . $client["client_lastname"]); ?></h3>
              <p class="text-muted text-center"><?php echo($client["client_address"] . ", " . $client["barangay"] . ", " . $client["city_municipality"]. ", " . $client["province"]); ?></p>
              <p class="text-muted text-center"><?php echo($client["email_address"]); ?></p> 
              <div class="text-center">
                <a href="#" data-toggle="modal" data-target="#updateClientModal" class="btn btn-warning btn-sm">Update</a>
              </div>
              <Br>
              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                  <b>Name</b> <a class="pull-right"><?php
                  // dump($slot);
                  echo($slot["crypt_name"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Crypt Type</b> <a class="pull-right"><?php echo($slot["crypt_type"]); ?></a>
                </li>
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

        <style>
.service_list{
  margin-bottom: 0px;
}

.disable-click {
    pointer-events: none;
  }


  
  </style>


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


<div class="modal fade" id="modal_add_deceased">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deceased Profile</h4>
              </div>
              <form class="generic_form_trigger" data-url="annex">
              <div class="modal-body">
                <input type="hidden" name="action" value="addDeceased">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">
                <input type="hidden" name="client_id" value="<?php echo($client["profile_id"]) ?>">
              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="color-red">*</span></label>
                  <input required type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name </label>
                  <input  type="text" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="color-red">*</span></label>
                  <input required type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Suffix</label>
                  <input  type="text" name="suffix" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth <span class="color-red">*</span></label>
                  <input max="<?php echo(date("Y-m-d")); ?>" required type="date" name="birthdate" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death <span class="color-red">*</span></label>
                  <input max="<?php echo(date("Y-m-d")); ?>" required type="date" name="date_of_death" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red">*</span></label>
                  <select required class="form-control" name="gender">
                  <option value="" selected disabled>Please select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Religion</label>
                  <input  type="text" name="religion" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              
              <?php if($slot["crypt_slot_type"] == "LAWN"): ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Interment Type</label>
                  <select required class="form-control" name="interment_type">
                  <option value="" selected disabled>Please select interment</option>
                    <option value="1st Interment">1st Interment</option>
                    <option value="2nd Interment">2nd Interment</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Type</label>
                  <select required class="form-control" name="deceased_type">
                  <option value="" selected disabled>Please select type of deceased</option>
                    <option value="REMAINS">REMAINS</option>
                    <option value="BONES">BONES</option>
                  </select>
                </div>
              </div>



              
              <?php endif; ?>

              <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputFile">Death Certificate</label>
                      <input name="death_certificate" required type="file" id="exampleInputFile">
                      <p class="help-block">Upload death certificate here!</p>
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









        <div class="modal fade" id="modal_details">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deceased Profile</h4>
              </div>
              <div class="modal-body">
                  <div class="fetched_data"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="modal_transfer">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">List of For Transfer Profiles</h4>
              </div>
              <div class="modal-body">
                <?php 
                
                $transfer = query("
                select *, s.slot_number as slot_number from crypt_slot s left join crypt_list c
                on c.crypt_id = s.crypt_id
                left join profile_list p
                on s.occupied_by = p.profile_id
                where s.active_status = 'OCCUPIED'
                and s.slot_id != ?", $slot["slot_id"]); 
                
                $common = query("select * from crypt_list where crypt_type = 'COMMON'");
                
                ?>
                <table class="table table-bordered sample_datatable">
                  <thead>
                    <th></th>
                    <th>Client</th>
                    <th>Crypt Type</th>
                    
                  </thead>

                <?php foreach($common as $row): ?>
                  <tr>
                  <td>
                      <form class="generic_form_trigger" data-url="profile">
                        <input type="hidden" name="action" value="transfer">
                        <input type="hidden" name="deceased_id" id="deceased_id">
                        <input type="hidden" name="crypt_type" value="<?php echo($row["crypt_type"]); ?>">
                        <input type="hidden" name="crypt_id" value="<?php echo($row["crypt_id"]); ?>">
                        <button class="btn btn-danger btn-xs btn-block" type="submit"><i class="fa fa-fw fa-exchange"></i></button>
                      </form>
                    </td>
                    <td><?php echo($row["crypt_type"]); ?></td>
                    <td><?php echo("COMMON AREA"); ?></td>

                  </tr>

                <?php endforeach; ?>


                <?php foreach($transfer as $row): ?>
                  <tr>
          <?php
          $remarks = "";
          if($row["crypt_type"] == "BONE"):
            $remarks = $row["crypt_type"] . " | " . $row["crypt_name"] . " | Row: " . $row["row_number"] . " | Column: " . $row["column_number"] . " | Slot: " . $row["slot_number"];
          elseif($row["crypt_type"] == "COFFIN"):
            $remarks = $row["crypt_type"] . " | " . $row["crypt_name"] . " | Row: " . $row["row_number"] . " | Column: " . $row["column_number"] . " | Slot: " . $row["slot_number"];
          elseif($row["crypt_type"] == "LAWN"):
            $remarks = $row["crypt_type"] . " | " . $row["lawn_type"];
          endif;
          ?>
                    <td>
                      <form class="generic_form_trigger" data-url="profile">
                        <input type="hidden" name="action" value="transfer">
                        <input type="hidden" name="deceased_id" id="deceased_id">
                        <input type="hidden" name="slot_id" value="<?php echo($row["slot_id"]); ?>">
                        <input type="hidden" name="crypt_type" value="<?php echo($row["crypt_type"]); ?>">
                        <button class="btn btn-danger btn-xs btn-block" type="submit"><i class="fa fa-fw fa-exchange"></i></button>
                      </form>
                    </td>
                    <td><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></td>
                    <td><?php echo($remarks); ?></td>
               
                  </tr>

                <?php endforeach; ?>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>






        <div class="modal fade" id="modal_forward">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Forward for Burial Scheduling</h4>
              </div>
              <form class="generic_form_trigger" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="forward_cemetery">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">


                <?php if($slot["crypt_type"] == "COFFIN"): 
                  $price = query("select * from pricing_coffincrypt where type = ?", $client["occupant_type"]);
                  $price = $price[0];
                  ?>
                  <input type="hidden" name="price_id" value="<?php echo($price["tbl_id"]); ?>">
                  <div class="form-group service_list">
                    <label>
                      <input disabled checked class="coffin_price disable-click" type="checkbox" name="coffin_amount" value="<?php echo($price["amount"]); ?>" data-cost="<?php echo($price["amount"]); ?>" >
                      <span style="margin-left: 15px;">Coffin Amount  (<?php echo(to_peso($price["amount"])); ?>)</span>
                    </label>
                  </div>

                  <div class="form-group service_list">
                    <label>
                      <input disabled checked class="coffin_price disable-click" type="checkbox" name="certification_amount" value="<?php echo($price["certification_amount"]); ?>" data-cost="<?php echo($price["certification_amount"]); ?>" >
                      <span style="margin-left: 15px;">Certification Fee  (<?php echo(to_peso($price["certification_amount"])); ?>)</span>
                    </label>
                  </div>

                  <div class="form-group service_list">
                    <label>
                      <input checked class="coffin_price" type="checkbox" name="lapida_amount" value="<?php echo($price["lapida_amount"]); ?>" data-cost="<?php echo($price["lapida_amount"]); ?>" >
                      <span style="margin-left: 15px;">Lapida Cost  (<?php echo(to_peso($price["lapida_amount"])); ?>)</span>
                    </label>
                  </div>
                  <hr>
                <?php endif; ?>


                <?php if($slot["crypt_type"] == "BONE"):  
                  $price = query("select * from pricing_bonecrypt");
                  ?>

                  <div class="form-group">
                    <label>BONE PRICE OPTION</label>
                    <select required name="bone_option" class="form-control" id="pricingOption">
                      <option disabled value="" selected>Please select bone options</option>
                      <?php foreach($price as $row): ?>
                        <option data-amount="<?php echo($row["amount"]); ?>" data-certification="<?php echo($row["certification"]); ?>" 
                        data-lapida_amount="<?php echo($row["lapida_amount"]); ?>" 
                        value="<?php echo($row["type"]); ?>"><?php echo($row["type"]); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div id="pricingOptions" style="display:none;">

               
                    
                  </div>

                  <hr>
                <?php endif; ?>

                <?php if($slot["crypt_type"] == "BONE"): ?>
                <div class="form-group service_list">
                    <label>
                      <input id="lapida" type="checkbox" name="lapida_amount" value="" data-cost="" >
                      <span style="margin-left: 15px;">Lapida</span>
                    </label>
                  </div>
                <?php endif; ?>

                <?php $services = query("select * from services"); ?>
                <?php foreach($services as $row): ?>
                  <div class="form-group service_list">
                    <label>
                      <input type="checkbox" name="service[]" value="<?php echo($row["service_name"]); ?>" data-cost="<?php echo($row["cost"]); ?>" >
                      <span style="margin-left: 15px;"><?php echo($row["service_name"]); ?>  (<?php echo(to_peso($row["cost"])); ?>)</span>
                    </label>
                  </div>
                <?php endforeach; ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Total Cost</label>
                  <input type="text" disabled class="form-control" id="total_cost" placeholder="0">
                </div>
              
              <!-- <div class="form-group">
                <label>Interment Services to be availed (optional)</label>
                <select name="services[]" class="form-control select2" multiple data-placeholder="Select Interment Service"
                        style="width: 100%;">
                  <option value="Chapel Only">Chapel Only</option>
                  <option value="Chapel with Sound System">Chapel with Sound System</option>
                  <option value="Tents and Chairs Rental">Tents and Chairs Rental</option>
                </select>
              </div> -->
              <div class="row">
                  <div class="col-md-6">

                  <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Burial Schedule Date (optional)</label>
                        <div class="input-group">
                          <input name="deceased_burial_date" type="date" class="form-control">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                  <div class="col-md-6">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Burial Time (optional)</label>
                        <div class="input-group">
                          <input name="deceased_burial_time" value="" type="text" class="form-control timepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
          </div>
        </div>




     


<?php 
if($slot["crypt_type"] == "COFFIN"):
$lease_date = $client["lease_date"];
$date_expired = $client["date_expired"];
$current_date = date("Y-m-d");

$lease_start = new DateTime($lease_date);
$lease_end = new DateTime($date_expired);
$duration = $lease_start->diff($lease_end)->days;
$days_passed = $lease_start->diff(new DateTime($current_date))->days;
$progress_percentage = ($days_passed / $duration) * 100;
$days_left = $duration - $days_passed;
// dump($progress_percentage);

$progress_percentage = 100 - $progress_percentage;
if($progress_percentage <= 0)
$progress_percentage = 0;


?>
<div class="box">
<div class="box-header with-border bg-primary" style="color:#fff;">
              <h3 class="box-title">Lease Status</h3>
            </div>
  <div class="box-body">

  
    <?php if($progress_percentage == 0): ?>
      <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                This Coffin Crypt is already expired.
              </div>
    <?php endif; ?>
    <p><b>Days left</b>: <?php echo(to_amount($days_left)); ?> days</p>
 <div class="progress progress-sm active">
                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo($progress_percentage); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo($progress_percentage); ?>%">
                  <span class="sr-only">20% Complete</span>
                </div>
              </div>
              </div>
              </div>
<?php endif; ?>

<?php $burial_schedule = query("select * from burial_schedule where profile_id = ? and remarks = 'POSTPONED'", $client["profile_id"]); ?>
  <?php if(!empty($burial_schedule)): ?>
      <div class="alert alert-warning alert-dismissible">
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                Burial Schedule is postponed
                <form class="generic_form_trigger" data-url="profile" 
                  data-message="Lifting postponement will notify the cemetery scheduler. Do you want to continue?" 
                  data-title="Lift Postponement" style="display:inline;">
                  <input type="hidden" name="action" value="continue">
                  <input type="hidden" name="profile_id" value="<?php echo($client["profile_id"]); ?>">
                  <input type="hidden" name="slot_id" value="<?php echo($slot["slot_id"]); ?>">
                  <br>
                  <br>
                  <button type="submit" class="btn btn-primary btn-flat">Lift Postponement</button>
                  </form>
              </div>
    <?php endif; ?>


<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Deceased Information</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal_add_deceased">Add New Deceased Profile</a>
                <br>
                <br>
               <table class="table table-bordered sample_datatable">
                <thead>
                    <th>Delete</th>
                    <th>Update</th>
                    <th>Deceased Name</th>
                    <th>Birth</th>
                    <th>Death</th>
                    <th>Age Died</th>
                    <th>Burial Date</th>
                    <th>Burial Status</th>
                </thead>
                <tbody>
                    <?php foreach($deceased as $d): ?>


                      <div class="modal fade" id="modalDeceased_<?php echo($d["deceased_id"]); ?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header bg-primary">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Update Deceased</h4>
                            </div>
                            <form class="generic_form_trigger" data-url="profile">
                            <div class="modal-body">
                <input type="hidden" name="action" value="updateDeceased">
                <input type="hidden" name="deceased_id" value="<?php echo($d["deceased_id"]); ?>">
              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name <span class="color-red">*</span></label>
                  <input value="<?php echo($d["deceased_firstname"]); ?>" required type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name </label>
                  <input value="<?php echo($d["deceased_middlename"]); ?>" type="text" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name <span class="color-red">*</span></label>
                  <input value="<?php echo($d["deceased_lastname"]); ?>" required type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Suffix</label>
                  <input value="<?php echo($d["deceased_suffix"]); ?>" type="text" name="suffix" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth <span class="color-red">*</span></label>
                  <input value="<?php echo($d["birthdate"]); ?>" max="<?php echo date('Y-m-d'); ?>" required type="date" name="birthdate" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death <span class="color-red">*</span></label>
                  <input value="<?php echo($d["date_of_death"]); ?>" max="<?php echo date('Y-m-d'); ?>" required type="date" name="date_of_death" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red">*</span></label>
                  <select required class="form-control" name="gender">
                    <option value="" disabled>Please select gender</option>
                    <option value="Male" <?php echo ($d["gender"] == "Male") ? "selected" : ""; ?>>Male</option>
                    <option value="Female" <?php echo ($d["gender"] == "Female") ? "selected" : ""; ?>>Female</option>
                </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Religion</label>
                  <input value="<?php echo($d["religion"]); ?>" type="text" name="religion" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              

              <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputFile">Death Certificate </label>
                      <?php if($d["death_certificate"] != ""): ?>
                        <a target="_blank" href="<?php echo($d["death_certificate"]); ?>">View Existing File</a>
                      <?php endif; ?>
                      <input name="death_certificate" type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload death certificate here!</p>
                  </div>
              </div>
            </div>
              </div>
                            <div class="modal-footer">
                              <button class="btn btn-primary" type="submit">Save</button>
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                        <tr>

                        
                        <td>
                      


                                <form class="generic_form_trigger" data-url="profile">
                                  <input type="hidden" name="action" value="deleteDeceased">
                                  <input type="hidden" name="deceased_id" value="<?php echo($d["deceased_id"]); ?>">
                                  <button class="btn btn-danger btn-xs btn-block"><i class="fa fa-fw fa-trash"></i></button>
                                </form>
                            </td>
                            <td>
                            <!-- <div class="btn-group btn-group-justified"> -->
                                <a href="#" data-toggle="modal" data-target="#modalDeceased_<?php echo($d["deceased_id"]); ?>" class="btn btn-xs btn-block btn-warning"><i class="fa fa-fw fa-pencil"></i></a>
                                <!-- <a href="#" data-id="<?php echo($d["deceased_id"]); ?>" data-toggle="modal" data-target="#modal_transfer" class="btn btn-primary btn-xs btn-block open_transfer_modal"><i class="fa fa-fw fa-exchange"></i></a> -->
                            <!-- </div> -->
                            <!-- <a href="#" data-id="<?php echo($d["deceased_id"]); ?>" data-toggle="modal" data-target="#modal_transfer" class="btn btn-danger btn-xs btn-block open_transfer_modal"><i class="fa fa-fw fa-exchange"></i></a> -->
                            </td>
                            <td><?php echo($d["deceased_name"]); ?></td>
                            <td><?php echo($d["birthdate"]); ?></td>
                            <td><?php echo($d["date_of_death"]); ?></td>
                            <td><?php echo($d["age_died"]); ?></td>
                            <td><?php echo($d["burial_date"]); ?></td>
                            <td><?php echo($d["burial_status"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
               </table>
                  <?php
                  $forward = query("select * from deceased_profile where slot_number = ? and burial_status = 'NO BURIAL DATE'", $_GET["slot"]);
                  if(!empty($forward)):
                  ?>
                  <a href="#" data-toggle="modal" data-target="#modal_forward" class="btn btn-primary btn-flat">Pay Bill and Forward to Burial Scheduler</a>
                  <?php endif; ?>

                  <?php 
                  $burial_schedule = query("select * from burial_schedule where profile_id = ? and remarks not in ('DONE', 'POSTPONED')", $client["profile_id"]); 
                  if(!empty($burial_schedule)):
                  ?>
                  <form class="generic_form_trigger" data-url="profile" 
                  data-message="Cancellation of Burial will cost: 500.00 and this slot will be vacant after submission. Do you want to continue?" 
                  data-title="Cancellation of Burial" style="display:inline;">
                  <input type="hidden" name="action" value="cancellation">
                  <input type="hidden" name="profile_id" value="<?php echo($client["profile_id"]); ?>">
                  <input type="hidden" name="slot_id" value="<?php echo($slot["slot_id"]); ?>">
                  <button type="submit" class="btn btn-danger btn-flat">Cancel Burial</button>
                  </form>
                  <form class="generic_form_trigger" data-url="profile" 
                  data-message="Postponement of Burial will cost: 500.00 and will be subject to rescheduling of burial. Do you want to continue?" 
                  data-title="Postponement of Burial" style="display:inline;">
                  <input type="hidden" name="action" value="postponement">
                  <input type="hidden" name="profile_id" value="<?php echo($client["profile_id"]); ?>">
                  <input type="hidden" name="slot_id" value="<?php echo($slot["slot_id"]); ?>">
                  <button type="submit" class="btn btn-warning btn-flat">Postpone Burial</button>
                  </form>
                  <?php endif; ?>

              </div>
              <div class="tab-pane" id="timeline">
                <?php 
                $transaction = query("select *,t.transaction_id as transaction_id from transaction t
                left join profile_list p
                on t.profile_id = p.profile_id where slot_id = ?
                order by timestamp desc
                ", $slot["slot_id"]);
                
                $Deceased_transaction = [];
                $deceased_transaction = query("select * from deceased_transaction");
                foreach($deceased_transaction as $row):
                  $Deceased_transaction[$row["transaction_id"]] = $row;
                endforeach;
                // dump($Deceased_transaction);
                ?>
                <div class="table-responsive">
                <table class="table table-bordered table-striped sample_datatable">
                  <thead>
                    <th width="10%">Details</th>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Fee</th>
                    <th width="30%">Remarks</th>
                  </thead>
                  <tbody>
                    <?php foreach($transaction as $row): ?>
                      <tr>
                        <td><a href="#" data-toggle="modal" data-target="#modal_details" data-id="<?php echo($row["transaction_id"]); ?>" class="open_transaction_modal btn btn-xs btn-primary btn-block">SEE DETAILS</a></td>
                        <td><?php echo($row["date"]); ?></td>
                        <td><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?><br>
                            <?php if(isset($Deceased_transaction[$row["transaction_id"]])): ?>
                              
                            <?php endif; ?>
                      </td>
                        <td><?php echo(to_peso($row["total_fee"])); ?></td>
                        <td><?php echo($row["logs"]); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
               </div>
              </div>
            </div>
          </div>
                          
                              <div class="box">
                                <div class="box-body">
                                  <table class="table table-bordered">
                                      <thead>
                                        <th>Attachment</th>
                                        <th>Link</th>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th>Certificate of Indigency</th>
                                          <th><?php if($client["certificate_indigency"] != ""): ?> <a target="_blank" href="<?php echo($client["certificate_indigency"]); ?>" class="btn  btn-sm btn-primary">Certificate of Indigency</a> <?php endif; ?></th>
                                        </tr>
                                        <tr>
                                          <th>Valid ID</th>
                                          <th><?php if($client["valid_id"] != ""): ?> <a target="_blank" href="<?php echo($client["valid_id"]); ?>" class="btn  btn-sm btn-primary">Valid ID</a> <?php endif; ?></th>
                                        </tr>
                                        <tr>
                                          <th>Picture Image</th>
                                          <th><?php if($client["picture"] != ""): ?> <a target="_blank" href="<?php echo($client["picture"]); ?>" class="btn  btn-sm btn-primary">Picture Image</a> <?php endif; ?></th>
                                        </tr>
                                      </tbody>
                                  </table>
                                </div>
                            </div>


          
        </div>
      </div>
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
<script src="AdminLTE/plugins/select2/js/select2.full.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script type="text/javascript">
  


    $('#courseInput2').select2({
        tags: true,
        placeholder: "Select ID or enter a new one",
        allowClear: true
    });

    $('#courseInput2').on('select2:open', function() {
        $('.select2-search__field').attr('placeholder', 'Search here. If not found, type the ID presented.');
    });


  $('[data-mask]').inputmask()


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
    console.log(html);
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
$(document).ready(function() {
    $('input.coffin_price,input#lapida ,input[type="checkbox"][name="service[]"]').on('change', function() {
        updateTotalCost();
    });

    $('input.coffin_price:checked,input#lapida input[type="checkbox"][name="service[]"]:checked').trigger('change');

    function updateTotalCost() {
     
      var totalCost = 0;


      <?php if($slot["crypt_type"] == "BONE"): ?>
        var selectedOption = $('#pricingOption option:selected');
        $('#lapida').data('cost', selectedOption.data('lapida_amount'));
        totalCost += parseInt(selectedOption.data('amount')) + parseInt(selectedOption.data('certification'));
      <?php endif; ?>

        var selectedServices = $('input.coffin_price:checked,input#lapida:checked, input[type="checkbox"][name="service[]"]:checked');
        selectedServices.each(function() {
            totalCost += parseInt($(this).data('cost'));
        });
        $('#total_cost').val(totalCost);
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
