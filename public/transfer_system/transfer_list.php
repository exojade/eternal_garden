<link rel="stylesheet" href="AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
<link rel="stylesheet" href="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
<link rel="stylesheet" href="AdminLTE/bower_components/sweetalert/sweetalert2.min.css">

<style>
.products-list {
    padding-right: 10px;
    height: 100%;
    overflow: auto;
}
.products-list .product-info {
    margin-left: 2px !important;
    font-size:180% !important;
}

.product-list-in-box>.item {

    border-bottom: 3px solid #000 !important;
}
</style>

<script src="AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
	<script src="AdminLTE/dist/js/adminlte.min.js"></script>
	<script src="AdminLTE/dist/js/demo.js"></script>
  <script src="AdminLTE/bower_components/Chart.js/Chart.js"></script>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <section class="content-header">
      <h1>
        For Transfer
      </h1>
    </section>
    <section class="content">

    <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                <li class="item">
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">MACARIO SAKAY</a>
                    <span class="pull-right">0 day left<br>
                    </span><br>
                    <a href="transfer?action=details" class="pull-right btn btn-success btn-flat">VIEW</a>
                    <span class="product-description">
                          MT. GILIAD<br>#22
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">BERNARDO CARPIO</a>
                    <span class="pull-right">2 day left<br>
                    </span><br>
                    <a href="transfer?action=details" class="pull-right btn btn-success btn-flat">VIEW</a>
                    <span class="product-description">
                          MT. GILIAD<br>#89
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">GREGORIO DEL PILAR</a>
                    <span class="pull-right">15 day left<br>
                    </span><br>
                    <a href="transfer?action=details" class="pull-right btn btn-success btn-flat">VIEW</a>
                    <span class="product-description">
                          MT. MAYON<br>#12
                        </span>
                  </div>
                </li>
                <!-- /.item -->
                <li class="item">
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title">HENERAL LUNA</a>
                    <span class="pull-right">30 day left<br>
                    </span><br>
                    <a href="transfer?action=details" class="pull-right btn btn-success btn-flat">VIEW</a>
                    <span class="product-description">
                          MT. APO<br>#45
                        </span>
                  </div>
                </li>
                <!-- /.item -->
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
    
      
    </section>

  </div>
  
  <?php 
    require("layouts/footer.php");
  ?>

<script src="AdminLTE/bower_components/moment/moment.js"></script>
<script src="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  
  <?php
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('#example2').DataTable()
   
  })
</script>


