<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">

<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}
</style>




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        Settings
      </h1>
    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-7">
        <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">LAWN PRICES</h3>
          <span style="float:right;"><a class="btn btn-info btn">Add Lawn</a></span>
        </div>
        <div class="box-body">
          <?php $pricing_lawn = query("select * from pricing_lawn"); ?>
          <table class="table table-bordered">
            <thead>
              <th></th>
              <th>Type</th>
              <th class="text-right">Pre Need</th>
              <th class="text-right">At Need</th>
              <th>Status</th>
            </thead>
            <tbody>
              <?php foreach($pricing_lawn as $row): ?>
              <tr>
                <td><a href="#" data-toggle="modal" data-target="#updateModalLawn_<?php echo($row["tbl_id"]); ?>" class="btn btn-warning btn-xs btn-block"><i class="fa fa-pencil"></i></a></td>
                <td><?php echo($row["name"]); ?></td>
                <td class="text-right"><?php echo(to_peso($row["pre_need"])); ?></td>
                <td class="text-right"><?php echo(to_peso($row["at_need"])); ?></td>
                <td><?php echo($row["active_status"]); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>

      <?php foreach($pricing_lawn as $row): ?>
        <div class="modal fade" id="updateModalLawn_<?php echo($row["tbl_id"]); ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Price Lawn</h4>
              </div>
              <form class="generic_form_trigger" data-url="settings">
              <div class="modal-body">
              <input type="hidden" name="action" value="updateLawn">
              <input type="hidden" name="tbl_id" value="<?php echo($row["tbl_id"]); ?>">

              <div class="form-group">
                <label for="exampleInputEmail1">Lawn Type</label>
                <input type="text" name="name" value="<?php echo($row["name"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pre Need</label>
                    <input type="number" name="pre_need" value="<?php echo($row["pre_need"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">At Need</label>
                    <input type="number" name="at_need" value="<?php echo($row["at_need"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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


      <?php endforeach; ?>


      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">SERVICES PRICE</h3>
          <span style="float:right;"><a class="btn btn-info btn">Add Service</a></span>
        </div>
        <div class="box-body">
          <?php $services = query("select * from services"); ?>
          <table class="table table-bordered">
            <thead>
              <th></th>
              <th>Service</th>
              <th class="text-right">Cost</th>
            </thead>
            <tbody>
              <?php foreach($services as $row): ?>
              <tr>
                <td><a href="#" data-toggle="modal" data-target="#updateModalServices_<?php echo($row["service_id"]); ?>" class="btn btn-warning btn-xs btn-block"><i class="fa fa-pencil"></i></a></td>
                <td><?php echo($row["service_name"]); ?></td>
                <td class="text-right"><?php echo(to_peso($row["cost"])); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
        </div>


        <?php foreach($services as $row): ?>
        <div class="modal fade" id="updateModalServices_<?php echo($row["service_id"]); ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Services</h4>
              </div>
              <form class="generic_form_trigger" data-url="settings">
              <div class="modal-body">
              <input type="hidden" name="action" value="updateService">
              <input type="hidden" name="service_id" value="<?php echo($row["service_id"]); ?>">

              <div class="form-group">
                <label for="exampleInputEmail1">Service</label>
                <input type="text" name="service_name" value="<?php echo($row["service_name"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Cost</label>
                    <input type="number" name="cost" value="<?php echo($row["cost"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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


      <?php endforeach; ?>



        <div class="col-md-5">
        <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">BONE CRYPT SETTINGS</h3>
        </div>
        <div class="box-body">
          <?php $bone_crypt = query("select * from pricing_bonecrypt"); ?>
          <table class="table table-bordered">
            <thead>
              <th></th>
              <th>Type</th>
              <th class="text-right">Amount</th>
              <th class="text-right">Certification</th>
              <th class="text-right">Lapida</th>
            </thead>
            <tbody>
              <?php foreach($bone_crypt as $row): ?>
              <tr>
                <td><a href="#" data-toggle="modal" data-target="#updateModalBone_<?php echo($row["tbl_id"]); ?>" class="btn btn-warning btn-xs btn-block"><i class="fa fa-pencil"></i></a></td>
                <td><?php echo($row["type"]); ?></td>
                <td class="text-right"><?php echo(to_peso($row["amount"])); ?></td>
                <td class="text-right"><?php echo(to_peso($row["certification"])); ?></td>
                <td class="text-right"><?php echo(to_peso($row["lapida_amount"])); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>



      <?php foreach($bone_crypt as $row): ?>
        <div class="modal fade" id="updateModalBone_<?php echo($row["tbl_id"]); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Bone Crypt</h4>
              </div>
              <form class="generic_form_trigger" data-url="settings">
              <div class="modal-body">
              <input type="hidden" name="action" value="updateBoneSettings">
              <input type="hidden" name="tbl_id" value="<?php echo($row["tbl_id"]); ?>">


              <div class="form-group">
                <label for="exampleInputEmail1">Type</label>
                <input type="text" name="type" value="<?php echo($row["type"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>


              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" name="amount" value="<?php echo($row["amount"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Certification</label>
                    <input type="number" name="certification" value="<?php echo($row["certification"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Lapida Cost</label>
                    <input type="number" name="lapida_amount" value="<?php echo($row["lapida_amount"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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


      <?php endforeach; ?>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">COFFIN CRYPT SETTINGS</h3>
        </div>
        <div class="box-body">
          <?php $coffin_crypt = query("select * from pricing_coffincrypt"); ?>
          <table class="table table-bordered">
            <thead>
              <th></th>
              <th>Type</th>
              <th class="text-right">Amount</th>
              <th class="text-right">Certification</th>
              <th class="text-right">Lapida</th>
            </thead>
            <tbody>
              <?php foreach($coffin_crypt as $row): ?>
              <tr>
                <td><a href="#" data-toggle="modal" data-target="#updateModalCoffin_<?php echo($row["tbl_id"]); ?>" class="btn btn-warning btn-xs btn-block"><i class="fa fa-pencil"></i></a></td>
                <td><?php echo($row["type"]); ?></td>
                <td class="text-right"><?php echo(to_peso($row["amount"])); ?></td>
                <td class="text-right"><?php echo(to_peso($row["certification_amount"])); ?></td>
                <td class="text-right"><?php echo(to_peso($row["lapida_amount"])); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <?php foreach($coffin_crypt as $row): ?>
          <div class="modal fade" id="updateModalCoffin_<?php echo($row["tbl_id"]); ?>">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Coffin Crypt</h4>
              </div>
              <form class="generic_form_trigger" data-url="settings">
              <div class="modal-body">
              <input type="hidden" name="action" value="updateCoffinSettings">
              <input type="hidden" name="tbl_id" value="<?php echo($row["tbl_id"]); ?>">


              <div class="form-group">
                <label for="exampleInputEmail1">Type</label>
                <input type="text" name="type" value="<?php echo($row["type"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>


              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Amount</label>
                    <input type="number" name="amount" value="<?php echo($row["amount"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Certification</label>
                    <input type="number" name="certification_amount" value="<?php echo($row["certification_amount"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Lapida Cost</label>
                    <input type="number" name="lapida_amount" value="<?php echo($row["lapida_amount"]); ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
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
        <?php endforeach; ?>





      </div>
        </div>
      </div>
    </section>


    
  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>

<script src="AdminLTE/bower_components/moment/moment.js"></script>
<script src="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <?php
	require("layouts/footer_end.php");
  ?>
  <script>
    $('.select2').select2()
  </script>


