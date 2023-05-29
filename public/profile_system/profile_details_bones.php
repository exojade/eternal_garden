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
    display: block;
    margin-bottom: 10px;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile Details
        <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modal_add_profile">Add Profile</a>
      </h1>
    </section>
<?php 
$bone = query("select * from pricing where type='bone_crypt'");
// dump($bone);
// $requirements = query("select * from requirements where pricing_id = ?", $bone[0]["pricing_id"]);
$services = query("select * from services");
?>



    <div class="modal fade" id="modal_add_profile">
          <div class="modal-dialog modal-lg">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center">Add Profile</h3>
              </div>
              <div class="modal-body">
               
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
                  <?php
                  // dump($profile);
                  if(count($profiles) == 0): ?>
                  <option value="one_bone">One Bone</option>
                  <option value="two_bone">Two Bone</option>
                  <option value="three_bone">Three Bone</option>
                  <option value="four_bone">Four Bone</option>
                  <?php elseif(count($profiles) == 1): ?>
                    <option value="one_bone">One Bone</option>
                  <option value="two_bone">Two Bone</option>
                  <option value="three_bone">Three Bone</option>
                  <?php elseif(count($profiles) == 2): ?>
                    <option value="one_bone">One Bone</option>
                  <option value="two_bone">Two Bone</option>
                  <?php elseif(count($profiles) == 3): ?>
                    <option value="one_bone">One Bone</option>
                  <?php else:?>
                    <option value="no_bone">Cannot enter</option>
                  <?php endif; ?>
                  
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
            <div class="four_bone" style="display:none;">
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


            <span class="rheader bg-primary">FOURTH DECEASED INFORMATION</span>
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
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline">Save changes</button>
              </div>
            </div>
          </div>
      </div>
    <section class="content">





    <div class="row">
    <div class="col-md-3">

    <div class="box box-primary">
            <div class="box-body box-profile">
               
              <h3 class="profile-username text-center"><?php echo($crypt_name["crypt_name"]); ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Row</b> <a class="pull-right"><?php echo($crypt_name["row_number"]); ?></a>
                </li>
                <li class="list-group-item">
                <b>Column</b> <a class="pull-right"><?php echo($crypt_name["column_number"]); ?></a>
                </li>
                <li class="list-group-item">
                <b>Slot Number</b> <a class="pull-right"><?php echo($crypt_name["slot_number"]); ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>


		<div class="box">
			<div class="box-body">

      <ul class="nav nav-tabs tabs-left nav-pills ">
          <?php 

          for($i=0;$i<4;$i++){
            if(isset($profiles[$i]["deceased_name"])){
              if($i == 0){ ?>
               <li class="active"><a href="#<?php echo($profiles[$i]["profile_id"]); ?>" data-toggle="tab"><?php echo($profiles[$i]["deceased_name"]); ?></a></li>
               <?php
              }
              else{ ?>
                <li><a href="#<?php echo($profiles[$i]["profile_id"]); ?>" data-toggle="tab"><?php echo($profiles[$i]["deceased_name"]); ?></a></li>
                <?php
              }
            }
            else{
              if($i == 0){ ?>
              <li class="active"><a href="#slot<?php echo($i); ?>" data-toggle="tab"><?php echo("SLOT" . $i);?></a></li>
              <?php  }
              else{
              ?> <li><a href="#slot<?php echo($i); ?>" data-toggle="tab"><?php echo("SLOT" . $i);?></a></li> <?php
              }
            }
          }
        ?>
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
            <?php for($i=0;$i<4;$i++){
            if(isset($profiles[$i]["deceased_name"])){
              if($i == 0){ ?>
               <div class="active tab-pane" id="<?php echo($profiles[$i]["profile_id"]); ?>">
               <?php
              }
              else{ ?>
                <div class="tab-pane" id="<?php echo($profiles[$i]["profile_id"]); ?>">
                <?php
              }
            }
            else{
              if($i == 0){ ?>
              <div class="active tab-pane" id="slot<?php echo($i); ?>">
              <?php  }
              else{
              ?> <div class="tab-pane" id="slot<?php echo($i); ?>"> <?php
              }
            } ?>
      

        <?php if(isset($profiles[$i]["deceased_name"])):
          $p = $profiles[$i];
          ?>
          
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
          <?php $trans = query("select * from transaction where transaction_id = ?", $p["current_transaction_id"]);
                $trans = $trans[0];
          ?>

          <span class="rheader bg-primary">Payment Information</span>

          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
            <label>Date of Purchase</label>
            <input type="text" readonly class="form-control" value="<?php echo($trans["date"]); ?>">
          </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
            <label>Payment</label>
            <input type="text" readonly class="form-control" value="<?php echo($trans["total_fee"]); ?>">
          </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Date Transfer</label>
                <input type="text" readonly class="form-control" value="<?php echo($p["deceased_burial_date"]); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Contact</label>
                <input type="text" readonly class="form-control" value="<?php echo($p["deceased_burial_date"]); ?>">
              </div>
            </div>
          </div>
          </div>
          </div>

        <?php else:  ?>
          <p>No Details</p>
        <?php endif; ?>
				</div>
      <?php }?>
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


<script>




$(document).ready(function() {
    var total = 0;
    var additional_cost = 0;
    $("#bone_options").change(function() {
        var val = $(this).val();
        console.log(val);
        if(val === "one_bone") {
            $(".one_bone").show();
            // $(".one_bone input").prop("disabled", false);
            $(".one_bone input").val("");
            $(".one_bone input").prop('required',true);
            $('.one_bone input').removeAttr('disabled')
            // $('.disabledCheckboxes').prop("disabled", true);
            // $('.disabledCheckboxes').removeAttr("disabled");
            $(".two_bone input").prop("disabled", true);
            $(".two_bone").hide();
            $(".two_bone input").val("");
            $('.two_bone input').removeAttr('required')

            $(".three_bone").hide();
            $(".three_bone input").prop("disabled", true);
            $(".three_bone input").val("");
            $('.three_bone input').removeAttr('required')

            $(".four_bone").hide();
            $(".four_bone input").prop("disabled", true);
            $(".four_bone input").val("");
            $('.four_bone input').removeAttr('required')

            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["one_bone"]); ?>;
            $('#total').val(total);  
        }

        else if(val === "two_bone"){
            $(".one_bone").hide();
            $(".one input").prop("disabled", true);
            $(".one_bone input").val("");
            $('.one_bone input').removeAttr('required')

            $(".two_bone").show();
            $('.two_bone input').removeAttr('disabled')
            $(".two_bone input").val("");
            $(".two_bone input").prop('required',true);

            $(".three_bone").hide();
            $(".three_bone input").prop("disabled", true);
            $(".three_bone input").val("");
            $('.three_bone input').removeAttr('required')

            $(".four_bone").hide();
            $(".four_bone input").prop("disabled", true);
            $(".four_bone input").val("");
            $('.four_bone input').removeAttr('required')
            // $(".three_bone input").prop('required',true);
            
            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["two_bone"]); ?>;
            $('#total').val(total);  
        }

        else if(val === "three_bone"){
            $(".one_bone").hide();
            $(".one input").prop("disabled", true);
            $(".one_bone input").val("");
            $('.one_bone input').removeAttr('required')
            

            $(".two_bone input").prop("disabled", true);
            $(".two_bone").hide();
            $(".two_bone input").val("");
            $('.two_bone input').removeAttr('required')

            $(".three_bone").show();
            $('.three_bone input').removeAttr('disabled')
            $(".three_bone input").val("");
            $(".three_bone input").prop('required',true);
          
            $(".four_bone").hide();
            $(".four_bone input").prop("disabled", true);
            $(".four_bone input").val("");
            $('.four_bone input').removeAttr('required')


            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["three_bone"]); ?>;
            $('#total').val(total);  
        }

        else if(val === "four_bone"){
            $(".one_bone").hide();
            $(".one input").prop("disabled", true);
            $(".one_bone input").val("");
            $('.one_bone input').removeAttr('required')
            

            $(".two_bone input").prop("disabled", true);
            $(".two_bone").hide();
            $(".two_bone input").val("");
            $('.two_bone input').removeAttr('required')

            $(".three_bone").hide();
            $(".three_bone input").prop("disabled", true);
            $(".three_bone input").val("");
            $('.three_bone input').removeAttr('required')


            $(".four_bone").show();
            $('.four_bone input').removeAttr('disabled')
            $(".four_bone input").val("");
            $(".four_bone input").prop('required',true);

            total = additional_cost + <?php echo($bone[0]["original_cost"]); ?> + <?php echo($bone[0]["four_bone"]); ?>;
            $('#total').val(total);  
        }
  
    });


    $('.amount_class').change(function() {
        if(this.checked) {
          var amount = $(this).data('amount');
          total = total + amount;
          console.log(total);
          //   var returnVal = confirm("Are you sure?");
          //   $(this).prop("checked", returnVal);
        }
        else{
          var amount = $(this).data('amount');
          total = total - amount;
          console.log(total);
        }
        $('#total').val(total);        
    });
});






function createButton(text, cb) {
  return $('<button class="btn btn-primary btn-flat" style="margin: 0px 10px 0px 10px;">' + text + '</button>').on('click', cb);
}

$(document).on('click', '.SwalBtn1', function() {
        //Some code 1
     //    console.log('Button 1');
        var id = $(this).data('id');
        window.open("coffin_crypt?action=new&slot_id="+id+"&option=indigent", "_blank");
        swal.close();
    });
    $(document).on('click', '.SwalBtn2', function() {
        //Some code 2 
     //    console.log('Button 2');
        var id = $(this).data('id');
        window.open("coffin_crypt?action=new&slot_id="+id+"&option=ordinary", "_blank");
        swal.close();
    });


$('.coffin_crypt_form').submit(function(e) {
      e.preventDefault();
      var url = $(this).data('url');
      var my_id = $(this).data('my_id');
      console.log(my_id);

        var promptmessage = 'Occupy Bone Crpyt';
        var prompttitle = 'COFFIN CRYPT';
    
        swal({
            title: prompttitle,
            text: promptmessage,
            // html: "Some Text" +
            // "<br>" +
            // '<a href="#" data-id="'+my_id+'" class="SwalBtn1 btn-flat btn btn-primary">' + 'INDIGENT' + '</a>' +
            // '<a href="#" data-id="'+my_id+'" class="SwalBtn2 btn-flat btn btn-primary">' + 'ORDINARY' + '</a>',
            type: 'info',
            showConfirmButton: true,
      showCancelButton: true
          //   confirmButtonText: 'Ordinary',
          //   cancelButtonText: 'Indigent'
        }).then((result) => {
            if (result.value) {
                window.open("profile?action=details&id="+my_id+"", "_blank");
                swal.close();
            // --- end of ajax
            }
            else{

              // console.log($(this).serialize());
          //     swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
          //   $.ajax({
          //       type: 'post',
          //       url: url,
          //       data: $(this).serialize() + '&quincena=2',
          //       success: function (results) {
          //       var o = jQuery.parseJSON(results);
          //       console.log(o);
          //       if(o.result === "success") {
          //           swal.close();
                 
          //           swal({title: "Submit success",
          //           text: o.message,
          //           type:"success"})
          //           .then(function () {
          //           //window.location.replace('./applicant.php?page=list');
          //           window.location.replace(o.link);
          //           });
          //       }
          //       else {
          //           swal({
          //           title: "Error!",
          //           text: o.message,
          //           type:"error"
          //           });
          //           console.log(results);
          //       }
          //       },
          //       error: function(results) {
          //       console.log(results);
          //       swal("Error!", "Unexpected error occur!", "error");
          //       }
          //   });

            }
        });
    });


</script>

