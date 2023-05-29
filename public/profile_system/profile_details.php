<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

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
    display: inline-block;
    margin-bottom: 10px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="row">
    <div class="col-md-3">

    <div class="box box-primary">
            <div class="box-body box-profile">

              <h3 class="profile-username text-center"><?php echo($profiles[0]["crypt_name"]); ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Row</b> <a class="pull-right"><?php echo($profiles[0]["row_number"]); ?></a>
                </li>
                <li class="list-group-item">
                <b>Column</b> <a class="pull-right"><?php echo($profiles[0]["column_number"]); ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>


		<div class="box">
			<div class="box-body">
				<ul class="nav nav-tabs tabs-left nav-pills ">
          <?php 
          $i = 0;
          foreach($profiles as $p): ?>
            <?php if($i == 0): ?>
            <li class="active"><a href="#<?php echo($p["profile_id"]); ?>" data-toggle="tab"><?php echo($p["deceased_name"]); ?></a></li>
            <?php else: ?>
              <li><a href="#<?php echo($p["profile_id"]); ?>" data-toggle="tab"><?php echo($p["deceased_name"]); ?></a></li>
            <?php endif; ?>
            <?php $i++; endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <div class="box-header bg-primary text-center" style="color:#fff;">
          <h3 class="box-title">Full Information</h3>
      </div>
      <div class="tab-content">
          <?php $i=0; foreach($profiles as $p): ?>
            <?php if($i == 0): ?>
              <div class="active tab-pane" id="<?php echo($p["profile_id"]); ?>">
            <?php else: ?>
              <div class="tab-pane" id="<?php echo($p["profile_id"]); ?>">
            <?php endif; ?>
              
              
				<div class="row">
			

				<div class="col-md-12">
					<br>
          <span class="rheader bg-primary">DECEASED INFORMATION</span>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
              <label>Deceased Name</label>
							<input type="text" readonly class="form-control" value="<?php echo($p["deceased_name"]); ?>">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="text" readonly class="form-control" value="<?php  echo(date('F d, Y', strtotime($p["deceased_dob"]))); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Death</label>
                  <input type="text" readonly class="form-control" value="<?php echo(date('F d, Y', strtotime($p["deceased_date_death"]))); ?>">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">CLIENT INFORMATION</span>

            <div class="form-group">
              <label>Client</label>
							<input type="text" readonly class="form-control" value="<?php echo($p["client_name"]); ?>">
						</div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["client_address"]); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Contact</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["client_contact"]); ?>">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">LEASE INFORMATION</span>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Transacation Date</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["date"]); ?>">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Total Fees</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["total_fee"]); ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Burial Date</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["deceased_burial_date"] . " | " . $p["deceased_burial_time"]); ?>">
                </div>
              </div>
              <?php if($p["date_expired"] != ""): ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label>Date Expired</label>
                  <input type="text" readonly class="form-control" value="<?php echo($p["date_expired"]); ?>">
                </div>
              </div>
              <?php
              $sdate = $p["deceased_burial_date"];
              $edate = $p["date_expired"];
              $date_diff = abs(strtotime($edate) - strtotime($sdate));
              $years = floor($date_diff / (365*60*60*24));
              $months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));
              $days = floor(($date_diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
              ?>
              <div class="col-md-12">
                <div class="form-group">
                  <label>REMAINING PERIOD</label>
                  <input type="text" readonly class="form-control" value="<?php echo($years . " years , " . $months . " months and " . $days); ?> days remaining">
                </div>
              </div>
              <?php endif; ?>
            </div>
            <div class="row">
            <?php $transaction = query("select * from transaction where transaction_id = ?", $p["current_transaction_id"]);
                  $transaction = $transaction[0];
            ?>

            <?php
            $requirements = unserialize($transaction["requirements"]);
            // dump($requirements);
            if($requirements != "" ): ?>
            
            <div class="col-md-6">
            <span class="rheader bg-primary">REQUIREMENTS</span>
              <?php foreach($requirements as $r): ?>
                <div class="form-group">
                  
                    <span class="font-blue-madison bold ">
                      <span id="ContentPlaceHolder1_label_pbiometricid" style="font-weight:bold;"><?php echo($r["requirement"]); ?></span></span>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>


            <?php
            $pricing_availed = unserialize($transaction["pricing_availed"]);
            // dump($pricing_availed);
            if($pricing_availed != "" ): ?>
            
            <div class="col-md-6">
            <span class="rheader bg-primary">PRICING AVAILED</span>
              <?php foreach($pricing_availed as $r): ?>
                <div class="form-group">
                     <?php echo($r["cost_name"]); ?>: <span class="font-blue-madison bold ">
                      <span id="ContentPlaceHolder1_label_pbiometricid" style="font-weight:bold;"><?php echo($r["cost"]); ?></span></span>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>


            <?php
            $services = unserialize($transaction["services"]);
            // dump($services);
            if($services != "" ): ?>
            <div class="col-md-12">
            <span class="rheader bg-primary">SERVICES AVAILED</span>
              <?php foreach($services as $r): ?>
                <div class="form-group">
                  
                     <?php echo($r["service"]); ?>:<span class="font-blue-madison bold ">
                      <span id="ContentPlaceHolder1_label_pbiometricid" style="font-weight:bold;"><?php echo($r["cost"]); ?></span></span>
                </div>
            <?php endforeach; ?>
            </div>
            <?php endif; ?>
            
            </div>

					</div>
				</div>

				</div>
			</div>
				</div>
          <?php $i++; endforeach; ?>
      </div>
    </div>
  </div>

      
          
		  
            
	

    
      <!-- /.row -->

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

