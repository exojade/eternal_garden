<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/slickgrid/slickgrid.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Ayos</li>
      </ol>
    </section>
    <section class="content">
	
	
	<div class="row">
		<div class="col-xs-8">
		<div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
              <table id="simple-datatable" class="table table-hover table-bordered table-striped table-responsive">
                <thead>
				<tr>
                  <th>Action</th>
                  <th>Username</th>
                  <th>Fullname</th>
                  <th>Role</th>
				</tr>
              </thead>

			  <tbody>
				  <?php foreach($users as $u): ?>
				<tr>
                  <td><?php echo($u["username"]); ?></td>
                  <td><?php echo($u["username"]); ?></td>
                  <td><?php echo($u["role"]); ?></td>
                  <td><?php echo($u["fullname"]); ?></td>
				</tr>
				<?php endforeach; ?>
              </tbody>
			
			
			
			</table>
			  <br>
			 
            </div>
            <!-- /.box-body -->
          </div>
		</div>


		<div class="col-xs-4">
		<div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">


			<form method="post" id="users_form">
				
				<input type="hidden" name="action" value="add_user">

				<div id="lgrp" class="form-group">
					<label for="lastname">Full Name</label>
					<input type="text" class="form-control" name="fullname"  placeholder="Enter full name..." required>
				</div>

				<div id="lgrp" class="form-group">
					<label for="lastname">Username</label>
					<input type="text" class="form-control" name="username"  placeholder="Enter user name..." required>
				</div>

				<div class="form-group">
					<label for="brgy">Role</label>
					<select name="role" class="form-control select2" id="roles" class="form-control" required="">
						<option value="" disabled="" selected="">Select role...</option>
					</select>
					<div class="help-block with-errors"></div>
				</div>


				<div class="form-group">
					<label for="brgy">Default password: <i>secret</i></label>
				
				</div>
    

				
			 
            </div>


			<div class="box-footer">
              <button type="submit" class="btn btn-primary btn-flat">Submit</button>
          </div>
			</form>
            <!-- /.box-body -->
          </div>
		</div>
	  </div>
	  
    </section>
    <!-- /.content -->
  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>
	<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
	<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
	<script src="AdminLTE/bower_components/slickgrid/slickgrid.js"></script>
	<script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="public/users_system/users.js"></script>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

