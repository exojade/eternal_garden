<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

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
        Deceased Profile
      </h1>
    </section>
    <section class="content">
    <div class="box">
            <div class="box-header with-border">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <!-- <label>Select</label> -->
                    <select id="burialType" class="form-control">
                      <option value="" selected disabled>Burial Type</option>
                      <option value="COFFIN">COFFIN</option>
                      <option value="BONE">BONE</option>
                      <option value="LAWN">LAWN</option>
                      <option value="MAUSOLEUM">MAUSOLEUM</option>
                      <option value="COMMON">COMMON</option>
                      <option value="ANNEX">ANNEX</option>
                     
                    </select>
                  </div>
                </div>

                <div class="col-md-2">
                  <button onclick="filter();" class="btn btn-success btn-block">Filter</button>
                </div>


              </div>
            
            </div>
            <div class="box-body">
              <table class="table table-bordered table-striped sample_datatable">
                <thead>
                <tr>
                  <th>Deceased</th>
                  <th>BirthDate</th>
                  <th>Gender</th>
                  <th>Date of Death</th>
                  <th>Age Died</th>
                  <th>Location</th>
                  <th>Client</th>
                  <th>Death Certificate</th>
                </tr>
                </thead>
              
           
              </table>





              







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
  <script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  <?php require("public/coffin_crypt/coffin_crypt_js.php"); ?>

  <?php
	// render footer 2
	require("layouts/footer_end.php");
  ?>

<script>
 var datatable = 
            $('.sample_datatable').DataTable({
                // "searching": false,
                "pageLength": 10,
                language: {
                    searchPlaceholder: "Enter Filter"
                },
                // "bLengthChange": false,
                "ordering": false,
                // "info":     false,
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                
                'ajax': {
                    'url':'profile',
                     'type': "POST",
                     "data": function (data){
                        data.action = "deceased_datatable";
                     }
                },
                'columns': [
                    // { data: 'Employeeid', "visible": false, "searchable": false },
                    // { data: 'action', "orderable": false },
                    { data: 'deceased_name', "orderable": false },
                    { data: 'birthdate', "orderable": false  },
                    { data: 'gender', "orderable": false  },
                    { data: 'date_of_death', "orderable": false  },
                    { data: 'age_died', "orderable": false  },
                    { data: 'location', "orderable": false  },
                    { data: 'client', "orderable": false  },
                    { data: 'death_certificate', "orderable": false  },
                ],
            });

            function filter() {
           
              var burialType = $("#burialType").val();
            
        
            // else{
            datatable.ajax.url('profile?action=deceased_datatable&burial_space=' + burialType).load();
            // }
        }



</script>

