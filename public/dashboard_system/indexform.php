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

      $lawn = query("select count(*) as count from crypt_slot where crypt_slot_type = 'LAWN'");
      $lawn = $lawn[0]["count"];

      $mausoleum = query("select count(*) as count from crypt_list where crypt_type = 'MAUSOLEUM'");
      $mausoleum = $mausoleum[0]["count"];

      $annex = query("select count(*) as count from crypt_list where crypt_type = 'ANNEX'");
      $annex = $annex[0]["count"];

      $common = query("select count(*) as count from crypt_list where crypt_type = 'COMMON'");
      $common = $common[0]["count"];



      ?>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-bone"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Bone Crypt</span>
              <span class="info-box-number"><?php echo($bone); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Coffin Crypt</span>
              <span class="info-box-number"><?php echo($coffin); ?></span>
            </div>
          </div>
        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-cross"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Lawn</span>
              <span class="info-box-number"><?php echo($lawn); ?></span>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Mausoleum</span>
              <span class="info-box-number"><?php echo($mausoleum); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-black"><i class="fa fa-cross"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Common</span>
              <span class="info-box-number"><?php echo($common); ?></span>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-cross"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Annex</span>
              <span class="info-box-number"><?php echo($annex); ?></span>
            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Burials 5 Year Span</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>

        <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistics: Male vs Female [5 Year Span]</h3>

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


        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Statistics: Age Bracket <?php echo(date("Y")); ?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="age_bar" style="height: 300px;"></div>
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
<script src="AdminLTE/bower_components/chart.js/Chart.js"></script>


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

      <?php
$data = query("
    SELECT
        all_years.year AS YEAR,
        COALESCE(SUM(CASE WHEN profile_data.gender = 'Male' THEN 1 ELSE 0 END), 0) AS male_count,
        COALESCE(SUM(CASE WHEN profile_data.gender = 'Female' THEN 1 ELSE 0 END), 0) AS female_count
    FROM
        (
            SELECT DISTINCT YEAR(CURDATE()) - n + 1 AS year
            FROM 
                (SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) AS numbers
        ) AS all_years
    LEFT JOIN
        (
            SELECT
                YEAR(deceased_profile.burial_date) AS year,
                gender
            FROM
                deceased_profile
            WHERE
                YEAR(deceased_profile.burial_date) BETWEEN YEAR(CURDATE()) - 5 AND YEAR(CURDATE())  -- Filter for the last 5 years
        ) AS profile_data
    ON
        all_years.year = profile_data.year
    GROUP BY
        all_years.year
    ORDER BY
        all_years.year;
");

?>

var bar = new Morris.Bar({
    element: 'bar-chart',
    resize: true,
    data: [
        <?php foreach($data as $row): ?>
            {y: '<?php echo $row["YEAR"]; ?>', a: <?php echo $row["male_count"]; ?>, b: <?php echo $row["female_count"]; ?>},
        <?php endforeach; ?>
    ],
    barColors: ['#00a65a', '#f56954'],
    xkey: 'y',
    ykeys: ['a', 'b'],
    labels: ['Male', 'Female'],
    hideHover: 'auto'
});


 <?php 
   $bracket = [];
   $bracket[0] = "0 - 10";
   $bracket[1] = "11 - 25";
   $bracket[2] = "26 - 35";
   $bracket[3] = "36 - 45";
   $bracket[4] = "46 - 60";
   $bracket[5] = "61 - 75";
   $bracket[6] = "76 - 85";
   $bracket[7] = "86 and above";

   $bracks = query("SELECT
   CASE
       WHEN age_died BETWEEN 0 AND 10 THEN '0 - 10'
       WHEN age_died BETWEEN 11 AND 25 THEN '11 - 25'
       WHEN age_died BETWEEN 26 AND 35 THEN '26 - 35'
       WHEN age_died BETWEEN 36 AND 45 THEN '36 - 45'
       WHEN age_died BETWEEN 46 AND 60 THEN '46 - 60'
       WHEN age_died BETWEEN 61 AND 75 THEN '61 - 75'
       WHEN age_died BETWEEN 76 AND 85 THEN '76 - 85'
       WHEN age_died >= 86 THEN '86 and above'
   END AS age_bracket,
   COUNT(*) AS count
FROM
   deceased_profile
GROUP BY
   age_bracket
ORDER BY
   MIN(age_died);");

$Bracket = [];

   foreach($bracks as $row):
    $Bracket[$row["age_bracket"]] = $row;
   endforeach;
  //  dump($Bracket);

?>
    var age_bar = new Morris.Bar({
      element: 'age_bar',
      resize: true,
      data: [
        <?php foreach($bracket as $row): ?>
          {y: '<?php echo($row); ?>', a: <?php if(isset($Bracket[$row])): echo($Bracket[$row]["count"]); else: echo("0"); endif; ?>},
        <?php endforeach; ?>

      ],
      barColors: ['#33658A'],
      xkey: 'y',
      ykeys: ['a'],
      labels: ['Count'],
      hideHover: 'auto'
    });



    <?php
$data = query("
    SELECT
        all_years.year AS YEAR,
        COALESCE(SUM(IF(deceased_profile.burial_date IS NOT NULL, 1, 0)), 0) AS count_per_year
    FROM
        (
            SELECT DISTINCT YEAR(CURDATE()) - n + 1 AS year
            FROM 
                (SELECT 1 AS n UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION SELECT 5) AS numbers
        ) AS all_years
    LEFT JOIN
        deceased_profile ON all_years.year = YEAR(deceased_profile.burial_date)
        AND YEAR(deceased_profile.burial_date) BETWEEN YEAR(CURDATE()) - 5 AND YEAR(CURDATE())  -- Filter for the last 5 years
    GROUP BY
        all_years.year
    ORDER BY
        all_years.year;
");

$labels = array();
$dataPoints = array();

foreach ($data as $row) {
    $labels[] = $row["YEAR"];
    $dataPoints[] = $row["count_per_year"];
}
?>


    var areaChartData = {
      labels  : <?php echo json_encode($labels); ?>,
      datasets: [
        
        {
          label               : 'Digital Goods',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : <?php echo json_encode($dataPoints); ?>
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : false,
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


