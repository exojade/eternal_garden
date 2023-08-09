<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/morris.js/morris.css">
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
        Reports
        <small>System</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="./"><i class="fa fa-dashboard"></i> HOMES</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <section class="content">
    <div class="box box-info">
    <div class="box-header with-border">
              <h3 class="box-title">Filter Here</h3>
              <div class="box-tools pull-right">
                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              
                </div>

                <div class="box-body">
                <div class="row">
              <div class="col-md-3">
              <div class="form-group">
                <label>From Date:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>To Date:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control">
                </div>
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Filter:</label>
                <button class="btn btn-primary btn-block">Filter</button>
              </div>
              </div>
              <div class="col-md-3">
              <div class="form-group">
                <label>Print:</label>
                <a href="resources/sales_revenue.pdf" target="_blank" class="btn btn-success btn-block"><i class="fa fa-print"></i> Print</a>
              </div>
              </div>
            </div>

                </div>
            </div>
            </div>




      <div class="row">
        <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Burials Statistics</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:300px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-4">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistics: Age Bracket | Male vs Female</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>



    </section>
  </div>
  <?php 
    require("layouts/footer.php");
  ?>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
<script src="AdminLTE/bower_components/morris.js/morris.min.js"></script>
<script src="AdminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>


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
			  <td><a href="profile?action=details&id='+data[i].slot_id+'" class="btn btn-primary btn-flat btn-block">Details</a></td>\
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

      

    var bar = new Morris.Bar({
      element: 'bar-chart',
      resize: true,
      data: [
        {y: '0-15', a: 100, b: 90},
        {y: '16-30', a: 75, b: 65},
        {y: '31-40', a: 50, b: 40},
        {y: '41-50', a: 75, b: 65},
        {y: '51-60', a: 50, b: 40},
        {y: '61-80', a: 75, b: 65},
        {y: '80+', a: 100, b: 90}
      ],
      barColors: ['#00a65a', '#f56954'],
      xkey: 'y',
      ykeys: ['a', 'b'],
      labels: ['Male', 'Female'],
      hideHover: 'auto'
    });


    var areaChartData = {
      labels  : [
        <?php for($i=1;$i<32;$i++):
          echo("'".$i."',");
        endfor;
          ?>
      ],
      datasets: [
        
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [
            <?php for($i=1;$i<32;$i++):
          echo(rand(100,1000) .",");
        endfor;
          ?>
            // 28, 48, 40, 19, 86, 27, 90, 70, 35, 80, 90, 100

          ]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)


  </script>
  
  <?php
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('#example2').DataTable()
   
  })
</script>


