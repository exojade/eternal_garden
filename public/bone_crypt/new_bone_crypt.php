<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

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
        New Coffin Crypt
      </h1>
    </section>
    <section class="content">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <form class="generic_form_trigger" data-url="bone_crypt">
              <input type="hidden" name="action" value="new_bone_crypt">
             
              <input type="hidden" name="slot_id" value="<?php echo($_GET["id"]); ?>">
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

            <div class="form-group">
              <label for="exampleInputEmail1">Bone Options</label>
                <select required class="form-control" name="bone_options" id="bone_options">
                  <option value="">Please select bone options</option>
                  <option value="one_bone">One Bone</option>
                  <option value="two_bone">Two Bone</option>
                  <option value="three_bone">Three Bone</option>
                  
                </select>
              <!-- <input required type="text" name="client_contact" class="form-control" id="exampleInputEmail1" placeholder="---"> -->
            </div>
            

            <div class="one_bone" style="display:none;">
            <span class="rheader bg-primary">DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            </div>

            <div class="two_bone" style="display:none;">
            <span class="rheader bg-primary">FIRST DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">SECOND DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled  type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            </div>


            <div class="three_bone" style="display:none;">
            <span class="rheader bg-primary">FIRST DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">SECOND DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            <span class="rheader bg-primary">THIRD DECEASED INFORMATION</span>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Name</label>
                  <input disabled type="text" name="deceased_name[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input disabled type="date" name="deceased_dob[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input disabled type="date" name="deceased_date_death[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Burial Date</label>
                  <input disabled type="date" name="deceased_burial_date[]" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
            </div>
            </div>


            <div class="row">
            


              <div class="col-md-8">
              <span class="rheader bg-primary">ADDITIONAL PAYMENTS</span>
              <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($bone[0]["certification_cost"]); ?>" class="amount_class" name="certficiation_cost" >
                      Certification Cost (<?php echo(to_peso($bone[0]["certification_cost"])); ?>)
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" data-amount="<?php echo($bone[0]["lapida_cost"]); ?>" class="amount_class" name="lapida_cost" >
                      Lapida Cost (<?php echo(to_peso($bone[0]["lapida_cost"])); ?>)
                    </label>
                  </div>

              </div>

            </div>

    
 
              
        




            <br>
           
            <div class="form-group">
              <label>Total</label>
              <input value="0" class="form-control" type="text" readonly name="total" id="total">
            </div>
              <br>
              <br>
              <br>
            <button class="btn btn-primary btn-flat" type="submit">Submit</button>
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

