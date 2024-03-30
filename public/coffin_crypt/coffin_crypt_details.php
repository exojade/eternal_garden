<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}

.table .btn{
  font-size:12px !important;
}
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
  <h1>
        Coffin Crypt Details
        <button class="pull-right btn btn-flat btn-primary">VACANT</button>
        <button class="pull-right btn btn-flat btn-danger">OCCUPIED</button>
        <span class="pull-right" style="margin-right: 20px;">Legends:</span>
      </h1>
    </section>
    <section class="content">

    <?php foreach($crypt_slots as $slots): 
      if($slots["occupied_by"] != ""):
      $profile = query("select * from profile_list where profile_id = ?", $slots["occupied_by"]);
      $profile = $profile[0];
      ?>
      <div class="modal fade" id="modal_view_slot_<?php echo($slots["slot_id"]); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Client Information</h3>
              </div>
              <div class="modal-body">

              <dl>
                <dt>Deceased</dt>
                <dd><?php echo($profile["deceased_name"]); ?></dd>
                <div class="row">
                  <div class="col-md-3">
                    <dt>Date of Birth</dt>
                    <dd><?php echo($profile["deceased_dob"]); ?></dd>
                  </div>
                  <div class="col-md-6">
                    <dt>Date of Death</dt>
                    <dd><?php echo($profile["deceased_date_death"]); ?></dd>
                  </div>
                  <div class="col-md-3">
                    <dt>Burial Date</dt>
                    <dd><?php echo($profile["deceased_burial_date"]); ?></dd>
                  </div>
                </div>

                <br>
                <dt>Client</dt>
                <dd><?php echo($profile["client_name"]); ?></dd>
                <div class="row">
                  <div class="col-md-3">
                    <dt>Contact</dt>
                    <dd><?php echo($profile["client_contact"]); ?></dd>
                  </div>
                  <div class="col-md-9">
                    <dt>Address</dt>
                    <dd><?php echo($profile["client_address"]); ?></dd>
                  </div>
                </div>
              </dl>

              <div class="row">
                <div class="col-md-3">
                <dt>Availed</dt>
                  <?php $pricing_availed = unserialize($profile["pricing_availed"]); ?>
                  <?php foreach($pricing_availed as $price): ?>
                    <dd><b><?php echo($price["cost_name"]); ?></b> : <?php echo($price["cost"]); ?></dd>
                  <?php endforeach; ?>
                </div>
                  <div class="col-md-6">
                <dt>Services Availed</dt>
                  <?php $services = unserialize($profile["services_availed"]); ?>
                  <?php foreach($services as $service): ?>
                    <dd><b><?php echo($service["service"]); ?></b> : <?php echo($service["cost"]); ?></dd>
                  <?php endforeach; ?>
                </div>

                <div class="col-md-3">
                <dt>Requirements</dt>
                  <?php $requirements = unserialize($profile["requirements"]); ?>
                  <?php foreach($requirements as $r): ?>
                    <dd><?php echo($r["requirement"]); ?></dd>
                  <?php endforeach; ?>
                </div>
              </div>
			        
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
          </div>
      </div>
    <?php else: ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo($coffin_crypt["crypt_name"]); ?> - Front</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <tbody>
                <?php 
                $x = 0;
                for($i=1;$i<=$coffin_crypt["crypt_rows"];$i++): ?>
                <tr>
                  <?php for($j=1;$j<=$coffin_crypt["crypt_columns"];$j++): ?>
                    <?php if($crypt_slots[$x]["active_status"] == "VACANT"): 
                      // dump($crypt_slots[$x]);
                      ?>

                      <td>
                      <a href="profile?action=client_details&slot=<?php echo($crypt_slots[$x]["slot_id"]); ?>" href="#" class="btn btn-primary btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></a>
                        <!-- <form class="coffin_crypt_form" data-my_id="<?php echo($crypt_slots[$x]["slot_id"]); ?>">
                          <button type="submit" class="btn btn-primary btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></button>
                        </form> -->
                      </td>


                      <!-- <td><a data-id="<?php echo($crypt_slots[$x]["slot_id"]); ?>" data-toggle="modal" data-target="#modal_add_client" href="#" class="btn btn-primary btn-block btn-flat open_modal"><?php echo($crypt_slots[$x]["slot_number"]); ?></a></td> -->
                    <?php elseif($crypt_slots[$x]["active_status"] == "OCCUPIED"): ?>
                      <td><a href="profile?action=client_details&slot=<?php echo($crypt_slots[$x]["slot_id"]); ?>" href="#" class="btn btn-danger btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></a></td>
                    <?php endif; ?>
                    <?php $x++; ?>
                  <?php endfor; ?>
                </tr>
                <?php endfor; ?>
                </tbody>
                </tfoot>
              </table>
              </table>
            </div>
            <!-- /.box-body -->
          </div>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><?php echo($coffin_crypt["crypt_name"]); ?> - Back</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <tbody>
                <?php 
                for($i=1;$i<=$coffin_crypt["crypt_rows"];$i++): ?>
                <tr>
                  <?php for($j=1;$j<=$coffin_crypt["crypt_columns"];$j++): ?>
                    <?php if($crypt_slots[$x]["active_status"] == "VACANT"): ?>

<td>
<a href="profile?action=client_details&slot=<?php echo($crypt_slots[$x]["slot_id"]); ?>" href="#" class="btn btn-primary btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></a>
  <!-- <form class="coffin_crypt_form" data-my_id="<?php echo($crypt_slots[$x]["slot_id"]); ?>">
    <button type="submit" class="btn btn-primary btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></button>
  </form> -->
</td>


<!-- <td><a data-id="<?php echo($crypt_slots[$x]["slot_id"]); ?>" data-toggle="modal" data-target="#modal_add_client" href="#" class="btn btn-primary btn-block btn-flat open_modal"><?php echo($crypt_slots[$x]["slot_number"]); ?></a></td> -->
<?php elseif($crypt_slots[$x]["active_status"] == "OCCUPIED"): ?>
<td><a href="profile?action=client_details&slot=<?php echo($crypt_slots[$x]["slot_id"]); ?>" href="#" class="btn btn-danger btn-block btn-flat "><?php echo($crypt_slots[$x]["slot_number"]); ?></a></td>
                    <?php endif; ?>
                    <?php $x++; ?>
                  <?php endfor; ?>
                </tr>
                <?php endfor; ?>
                </tbody>
                </tfoot>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
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
  <?php require("public/coffin_crypt/coffin_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
   
  })
</script>

