<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<style>
.products-list {
	padding-right: 10px;
    height: 200px;
    overflow: auto;
}
</style>
<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>
  <div class="content-wrapper">

  <section class="content-header">
      <h1>
        Dashboard
        <small>System Monitoring</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> HOMES</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
      <?php 
      
      $bone = query("select count(*) as count from crypt_list where crypt_type = 'BONE'");
      $bone = $bone[0]["count"];

      $coffin = query("select count(*) as count from crypt_list where crypt_type = 'COFFIN'");
      $coffin = $coffin[0]["count"];

      $lawn = query("select count(*) as count from crypt_list where crypt_type = 'LAWN'");
      $lawn = $lawn[0]["count"];

      $mausoleum = query("select count(*) as count from crypt_list where crypt_type = 'MAUSOLEUM'");
      $mausoleum = $mausoleum[0]["count"];




      ?>

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bone Crypt</span>
              <span class="info-box-number"><?php echo($bone); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Coffin Crypt</span>
              <span class="info-box-number"><?php echo($coffin); ?></span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-cross"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Lawn</span>
              <span class="info-box-number"><?php echo($lawn); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mausoleum</span>
              <span class="info-box-number"><?php echo($mausoleum); ?></span>
            </div>
          </div>
        </div>
      </div>



      


      <!-- <div class="row">
        <div class="col-md-12">
          <a class="btn btn-flat btn-primary" data-target="#modal-add-bid" data-toggle="modal">Add Bid</a>
        </div>
      </div> -->

      <div class="row">
        <div class="col-md-12">
        <div class="row">
        <div class="col-md-9">
        <div class="form-group">
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-users"></i>
            </div>
            <input id="search_engine" autocomplete="off" type="text" class="form-control pull-right" placeholder="Search Deceased Name">
          </div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
          <button onclick="find_deceased();" class="btn btn-primary btn-flat btn-block">Search</button>
        </div>
        </div>
      </div>
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Results</h3>
                </div>
                <div class="box-body">
                  <table class="table table-bordered" id="results_table">
                    <tbody>
                    <tr class="results-data">
                      <th>Action</th>
                      <th>Deceased Name</th>
                      <th>Date of Death</th>
                      <th>Location</th>
                    </tr>
                  </tbody></table>
                </div>
              </div>
          </div>

          <!-- <div class="col-md-6">
          <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Burial Schedule</h3>
                </div>
                <div class="box-body">
                  <table class="table table-bordered" id="results_table">
                    <tbody>
                    <tr class="results-data">
                      <th>Action</th>
                      <th>Deceased Name</th>
                      <th>Date of Death</th>
                      <th>Location</th>
                    </tr>
                  </tbody></table>
                </div>
              </div>

          </div> -->
        </div>
	  
    </section>
  </div>
  
  
  <?php 
    require("layouts/footer.php");
  ?>

<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>

  <script>
function find_deceased() {
	swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
	var search_query = $('#search_engine').val();
	var amount = $('#search_engine_amount').val();
		$.ajax({
		  type : 'post',
		  url : 'index',
		  data: {
      action: "track_deceased",
			q: search_query
		  },
		//   data :  'q='+search_query,
		  success : function(data){
			$( "#results_table .rowings" ).remove();
			if(data == "not enough"){
			  swal({
				title: 'Information',
				text: 'Not Enough. Taasi gamay ang Search. < 2 characters.',
				type: "error"
			  }).then(function() {
				swal.close();
			  });
			}
			else{
			  data = JSON.parse(data);
			// console.log(data);
			$.each(data, function(i, item) {
			  console.log(data[i]);
			  $('.results-data').after('\
			  <tr class="rowings">\
			  <td><a target="_blank" href="profile?action=details&id='+data[i].slot_id+'" class="btn btn-primary btn-flat btn-block">Details</a></td>\
			  <td>'+data[i].deceased_name+'</td>\
			  <td>'+data[i].deceased_date_death+'</td>\
			  <td>'+data[i].location+'</td>\
			  <tr>');
			});
			swal.close();
		  }
		}
		});    
		  }
  </script>
  
  <?php
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('#example2').DataTable()
   
  })
</script>


