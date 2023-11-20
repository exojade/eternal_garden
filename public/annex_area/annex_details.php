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
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
      <?php echo($annex["crypt_name"]); ?>
      <a class="btn btn-primary pull-right btn-flat" data-toggle="modal" data-target="#modalAddClient">Register Client</a>
      </h1>
    </section>
    <section class="content">
    <div class="modal fade" id="modalAddClient">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Client's Profile</h4>
              </div>
              <form class="generic_form_trigger" autocomplete="off" data-url="annex">
              <div class="modal-body">
                <input type="hidden" name="action" value="addClient">
                <input type="hidden" name="crypt_id" value="<?php echo($_GET["id"]) ?>">
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
                  <input  type="text" name="client_contact" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Email</label>
                    <input  type="email" name="email_address" class="form-control" id="exampleInputEmail1" placeholder="---">
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
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Presented</label>
                  <input type="text" name="id_presented" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">ID Number</label>
                  <input type="text" name="id_number" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Place Issued</label>
                  <input type="text" name="place_issued" class="form-control" id="exampleInputEmail1" placeholder="---">
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




















    <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                  <th>Action</th>
                  <th>Deceased</th>
                  <th>BirthDate</th>
                  <th>Date Died</th>
                  <th>Age Died</th>
                  <th>Death Certificate</th>
                  <th>Client</th>
                </thead>
                <tbody>
                  <?php foreach($deceased_profile as $row): ?>
                    <tr>
                      <td><a href="annex?action=client_details&slot=<?php echo($row["slot_number"]); ?>" class="btn btn-primary btn-xs btn-block">Details</a></td>
                      <td><?php echo($row["deceased_firstname"] . " " . $row["deceased_lastname"]); ?></td>
                      <td><?php echo($row["birthdate"]); ?></td>
                      <td><?php echo($row["date_of_death"]); ?></td>
                      <td><?php echo($row["age_died"]); ?></td>
                      <td><a href="<?php echo($row["death_certificate"]); ?>" class="btn btn-primary btn-xs">View Certificate</a></td>
                      <td><?php echo($row["client_firstname"] . " " . $row["client_lastname"]); ?></td>
                    </tr>
                  <?php endforeach; ?>
         
                </tbody>
              </table>
            </div>
          </div>
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
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
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
    });
   
  })
</script>

