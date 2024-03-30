<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">

<style>


input[type=text] {
    text-transform: uppercase;
}

.rheader {
    padding: 10px 10px 10px 10px !important;
    display: inline-block;
    margin-bottom: 10px;
}

.checkbox{

                      /* If you want to implement it in very old browser-versions */
                      -webkit-user-select: none; /* Chrome/Safari */ 
                      -moz-user-select: none; /* Firefox */
                      -ms-user-select: none; /* IE10+ */
                      /* The rule below is not implemented in browsers yet */
                      -o-user-select: none;
                      /* The rule below is implemented in most browsers by now */
                      user-select: none;
            
}

</style>




<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <section class="content-header">
      <h1>

      </h1>
    </section>
    <section class="content">
    <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <form class="generic_form_trigger" data-url="coffin_crypt">
              <input type="hidden" name="action" value="new_coffin_crypt">
              <input type="hidden" name="profile_type" value="<?php echo($_GET["option"]); ?>">
              <input type="hidden" name="pricing" value="<?php echo($coffin[0]["pricing_id"]); ?>">
              <input type="hidden" name="slot_id" value="<?php echo($_GET["slot_id"]); ?>">
              
            <span class="rheader bg-primary">CLIENT'S INFORMATION (PROCESSOR)</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Name</label>
                  <input required type="text" name="client_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-6">
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
            </div>

            <span class="rheader bg-primary">DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input required type="text" name="deceased_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input required type="date" name="deceased_dob" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input required type="date" name="deceased_date_death" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">BURIAL SCHEDULE</span>
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input required type="date" name="deceased_burial_date" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Burial Time:</label>
                  <div class="input-group">
                    <input name="deceased_burial_time" type="text" class="form-control timepicker">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              </div>

              <div class="col-md-4">
              <div class="form-group">
                <label>Remarks</label>
                <select name="remarks" class="form-control select2" style="width: 100%;">
                  <option selected="selected">PENDING</option>
                  <option>DONE</option>
                </select>
              </div>

              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">
              <span class="rheader bg-primary">CRYPT AVAILED</span>

              <?php
              $_GET["option"] = "ordinary";
              if($_GET["option"] == "ordinary"): ?>
              <div class="form-group" unselectable="on">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["original_cost"]); ?>" class="amount_class" name="crypt_cost" >
                      Crypt Cost (<?php echo(to_peso($coffin[0]["original_cost"])); ?>)
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["lapida_cost"]); ?>" class="amount_class" name="lapida_cost">
                      Lapida (<?php echo(to_peso($coffin[0]["lapida_cost"])); ?>)
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["certification_cost"]); ?>" class="amount_class" name="certification_cost">
                      Certification (<?php echo(to_peso($coffin[0]["certification_cost"])); ?>)
                    </label>
                  </div>
                </div>
              <?php endif; ?>


              <?php if($_GET["option"] == "indigent"): ?>
              <div class="form-group" unselectable="on">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["indigent_cost"]); ?>" class="amount_class" name="crypt_cost" >
                      Crypt Cost (<?php echo(to_peso($coffin[0]["indigent_cost"])); ?>)
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["lapida_cost"]); ?>" class="amount_class" name="lapida_cost">
                      Lapida (<?php echo(to_peso($coffin[0]["lapida_cost"])); ?>)
                    </label>
                  </div>

                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($coffin[0]["certification_cost"]); ?>" class="amount_class" name="certification_cost">
                      Certification (<?php echo(to_peso($coffin[0]["certification_cost"])); ?>)
                    </label>
                  </div>
                </div>
              <?php endif; ?>

              </div>

              <div class="col-md-4">
              <span class="rheader bg-primary">SERVICES AVAILED</span>
              <?php foreach($services as $s): ?>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($s["cost"]); ?>" class="amount_class" name="<?php echo($s["service_id"]) ?>">
                      <?php echo($s["service_name"]) ?> (<?php echo(to_peso($s["cost"])); ?>)
                    </label>
                  </div>
              <?php endforeach; ?>

              </div>

              <div class="col-md-4">
              <span class="rheader bg-primary">REQUIREMENTS</span>
              <?php foreach($requirements as $r): ?>
                <div class="checkbox">
                    <label>
                      <input type="checkbox" name="<?php echo($r["requirements_id"]) ?>">
                      <?php echo($r["requirement"]) ?>
                    </label>
                  </div>
              <?php endforeach; ?>
              </div>
            </div>
            <div class="form-group">
              <label>Total</label>
              <input value="0" name="total_fee" class="form-control" type="text" readonly id="total">
            </div>
              <br>
              <br>
              <br>
            <button disabled class="btn btn-primary btn-flat" type="submit">Submit</button>
            </form>
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
  <script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script>
$('.timepicker').timepicker({
      showInputs: false
    })
  </script>
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

