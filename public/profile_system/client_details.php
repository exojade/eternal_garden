<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/select2/dist/css/select2.min.css">
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
                  <label for="exampleInputEmail1">First Name *</label>
                  <input required type="text" name="first_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name</label>
                  <input type="text" name="middle_name" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name *</label>
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
                  <label for="exampleInputEmail1">Province *</label>
                  <select required class="form-control" id="province_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">City | Municipality *</label>
                  <select required class="form-control" id="city_mun_select"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Barangay *</label>
                  <select required class="form-control" id="barangay_select"></select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Address Home *</label>
                  <input required type="text" name="client_address" class="form-control" id="exampleInputEmail1" placeholder="Subdivision / Village / Purok (Complete Address)">
                </div>
              </div>
</div>
<hr>
<div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Client Contact</label>
                  <input required type="text" name="client_contact" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Email</label>
                    <input required type="email" name="email_address" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>


              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
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
                      <input name="certificate_indigency" type="file" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">Valid ID *</label>
                      <input name="valid_id" required type="file" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="exampleInputFile">2 x 2 ID *</label>
                      <input name="picture" required type="file" id="exampleInputFile">
                      <p class="help-block">Upload document here!</p>
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
                There's no lease information here! Click add Client to get started.
                <br>
                <br>
                <a href="#" data-toggle="modal" data-target="#modal_add_client" class="btn btn-primary">Add Profile</a>
              </div>

    <?php else: ?>
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
<script src="AdminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="node_modules/philippine-location-json-for-geer/build/phil.min.js"></script>
<script type="text/javascript">
     console.log(Philippines.sort(Philippines.provinces,"A"));
     
     console.log(Philippines.getBarangayByMun("112315"));
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



    $('.select2').select2()
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

<scropt






