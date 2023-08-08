<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
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
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Details
      
      </h1>
    </section>


    <section class="content">


    <div class="modal fade" id="modal_add_client">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Client's Profile</h4>
              </div>
              <form class="generic_form_trigger" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="add_client">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Name</label>
                  <input required type="text" name="client_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Address</label>
                  <input required type="text" name="client_address" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Contact</label>
                  <input required type="text" name="client_contact" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select required class="form-control" name="gender">
                  <option value="" selected disabled>Please select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Presented</label>
                  <input required type="text" name="id_presented" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Number</label>
                  <input required type="text" name="id_number" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Place Issued</label>
                  <input required type="text" name="place_issued" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Lease Date</label>
                  <input required type="date" value="<?php echo(date("Y-m-d")); ?>" name="lease_date" class="form-control" id="exampleInputEmail1" placeholder="---">
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



       






    <?php if(empty($client)): ?>
              <div class="alert alert-warning alert-dismissible">
         
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                There's no lease information here! Click add Client to get started.
                <br>
                <br>
                <a href="#" data-toggle="modal" data-target="#modal_add_client" class="btn btn-primary">Add Profile</a>
              </div>

    <?php else: ?>
        <?php $client = $client[0]; ?>


        <div class="modal fade" id="modal_add_deceased">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deceased Profile</h4>
              </div>
              <form class="generic_form_trigger" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="add_deceased">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">
                <input type="hidden" name="client_id" value="<?php echo($client["profile_id"]) ?>">
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input required type="text" name="deceased_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input required type="date" name="birthdate" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input required type="date" name="date_of_death" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
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
                  <input required type="text" name="religion" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Interment Type</label>
                  <select required class="form-control" name="interment_type">
                  <option value="" selected disabled>Please select interment</option>
                    <option value="1st Interment">1st Interment</option>
                    <option value="2nd Interment">2nd Interment</option>
                  </select>
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
              <div class="form-group">
                <label>Interment Services to be availed</label>
                <select name="services[]" class="form-control select2" multiple data-placeholder="Select Interment Service"
                        style="width: 100%;">
                  <option value="Chapel Only">Chapel Only</option>
                  <option value="Chapel with Sound System">Chapel with Sound System</option>
                  <option value="Tents and Chairs Rental">Tents and Chairs Rental</option>
                </select>
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
        <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="AdminLTE/dist/img/user4-128x128.jpg" alt="User profile picture">
              <h3 class="profile-username text-center"><?php echo($client["client_name"]); ?></h3>
              <p class="text-muted text-center"><?php echo($client["client_address"]); ?></p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Crypt Type</b> <a class="pull-right"><?php echo($slot["crypt_slot_type"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Slot / Lawn #</b> <a class="pull-right"><?php echo($slot["slot_number"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Lease Status</b> <a class="pull-right"><?php echo($client["lease_status"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Lease Date</b> <a class="pull-right"><?php echo($client["lease_date"]); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Date Expired</b> <a class="pull-right"><?php echo($client["date_expired"]); ?></a>
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
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Deceased Information</a></li>
              <li><a href="#timeline" data-toggle="tab">Transaction Logs</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal_add_deceased">Add Deceased Profile</a>
                <br>
                <br>
               <table class="table table-borderd table-striped">
                <thead>
                    <th>Deceased Name</th>
                    <th>BirthDate</th>
                    <th>Date of Death</th>
                    <th>Burial Date</th>
                    <th>Burial Status</th>
                    <th>Type</th>
                </thead>
                <tbody>
                    <?php foreach($deceased as $d): ?>
                        <tr>
                            <td><?php echo($d["deceased_name"]); ?></td>
                            <td><?php echo($d["birthdate"]); ?></td>
                            <td><?php echo($d["date_of_death"]); ?></td>
                            <td><?php echo($d["burial_date"]); ?></td>
                            <td><?php echo($d["burial_status"]); ?></td>
                            <td><?php echo($d["interment_type"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
               </table>
                  <?php
                  $forward = query("select * from deceased_profile where slot_number = ? and burial_status = 'NO BURIAL DATE'", $_GET["slot"]);
                  if(!empty($forward)):
                  ?>
                  <a href="#" data-toggle="modal" data-target="#modal_forward" class="btn btn-primary btn-flat">Forward to Cemetery for Burial Scheduling</a>
                  <?php endif; ?>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
<script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<script src="AdminLTE/dist/js/adminlte.min.js"></script>
<script src="AdminLTE/dist/js/demo.js"></script>
<script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
<script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  <?php require("public/coffin_crypt/coffin_crypt_js.php"); ?>

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