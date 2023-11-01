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
        Persons need to be notified
      </h1>
    </section>
    <section class="content">
      <?php $notification = query("SELECT *
FROM (
    SELECT
        n.profile_id,
        SUM(CASE WHEN n.year_date <= CURDATE() AND (ns.year_notif_status = '' OR ns.year_notif_status IS NULL) THEN 1 ELSE 0 END) AS year_need_to_notify,
        SUM(CASE WHEN n.6months_date <= CURDATE() AND (ns.6months_notif_status = '' OR ns.6months_notif_status IS NULL) THEN 1 ELSE 0 END) AS six_months_need_to_notify,
        SUM(CASE WHEN n.3months_date <= CURDATE() AND (ns.3months_notif_status = '' OR ns.3months_notif_status IS NULL) THEN 1 ELSE 0 END) AS three_months_need_to_notify,
        SUM(CASE WHEN n.month_date <= CURDATE() AND (ns.month_notif_status = '' OR ns.month_notif_status IS NULL) THEN 1 ELSE 0 END) AS month_need_to_notify,
        SUM(CASE WHEN n.week_date <= CURDATE() AND (ns.week_notif_status = '' OR ns.week_notif_status IS NULL) THEN 1 ELSE 0 END) AS week_need_to_notify,
        SUM(CASE WHEN n.day_before_date <= CURDATE() AND (ns.day_before_notif_status = '' OR ns.day_before_notif_status IS NULL) THEN 1 ELSE 0 END) AS day_before_need_to_notify,
        SUM(CASE WHEN n.date_expired <= CURDATE() AND (ns.day_notif_status = '' OR ns.day_notif_status IS NULL) THEN 1 ELSE 0 END) AS date_expired_need_to_notify
    FROM notification n
    LEFT JOIN notification_status ns ON n.notification_id = ns.notification_id
    LEFT JOIN profile_list p ON p.profile_id = n.profile_id
    WHERE p.active_status IS NULL OR p.active_status != 'FORMER'
    GROUP BY n.profile_id
) AS subquery
ORDER BY
    year_need_to_notify + six_months_need_to_notify + three_months_need_to_notify + month_need_to_notify + week_need_to_notify + day_before_need_to_notify DESC
    "); 
    // dump($notification);

    $Profile = [];
    $profile = query("select * from profile_list");
    foreach($profile as $row):
      $Profile[$row["profile_id"]] = $row;
    endforeach;


    $notifications_final = [];

if (!empty($notification)) {
    // Loop through the results and add notifications to the array
    foreach ($notification as $row) {
        if ($row['year_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "year_notification"];
        }
        if ($row['six_months_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "6months_notification"];
        }
        if ($row['three_months_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "3months_notification"];
        }
        if ($row['month_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "month_notification"];
        }
        if ($row['week_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "week_notification"];
        }
        if ($row['day_before_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "day_before_notification"];
        }
        if ($row['date_expired_need_to_notify'] > 0) {
            $notifications_final[] = ["profile_id" => $row['profile_id'], "type_notification" => "date_expired"];
        }
    }
  }

  // dump($notifications_final);

  $groupedNotifications = [];

foreach ($notifications_final as $row) {
    $profileId = $row["profile_id"];
    $typeNotification = $row["type_notification"];

    // If the profile_id is not in the groupedNotifications array, create a new entry
    if (!isset($groupedNotifications[$profileId])) {
        $groupedNotifications[$profileId] = ["profile_id" => $profileId, "type_notifications" => []];
    }

    // Add the type_notification to the array for the specific profile_id
    $groupedNotifications[$profileId]["type_notifications"][] = $typeNotification;
}


  // dump($groupedNotifications);

    ?>

    <div class="box">
        <div class="box-body">
          <table class="table table-bordered sample_datatable">
            <thead>
              <th>Name</th>
              <th>Lease Date</th>
              <th>Expiry Date</th>
              <th>Type of Notification</th>
            </thead>
            <tbody>
              <?php foreach($groupedNotifications as $row): ?>
                <tr>
                  <td><a href="profile?action=client_details&slot=<?php echo($Profile[$row["profile_id"]]["slot_number"]); ?>"><?php echo($Profile[$row["profile_id"]]["client_firstname"] . " " . $Profile[$row["profile_id"]]["client_lastname"]); ?></a></td>
                  <td><?php echo($Profile[$row["profile_id"]]["lease_date"]); ?></td>
                  <td><?php echo($Profile[$row["profile_id"]]["date_expired"]); ?></td>
                  <td>
                  <?php foreach($row["type_notifications"] as $notif): ?>
                    <form class="generic_form_trigger" data-url="transfer" style="display:inline;">
                      <input type="hidden" name="action" value="notify_mail">
                      <input type="hidden" name="profile_id" value="<?php echo($row["profile_id"]); ?>">
                      <input type="hidden" name="notif_type" value="<?php echo($notif); ?>">
                      <button class="btn btn-danger btn-xs"><?php echo($notif); ?></button>
                    </form>
                  <?php endforeach; ?>
                  </td>
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

<script src="AdminLTE/bower_components/moment/moment.js"></script>
<script src="AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="AdminLTE/bower_components/sweetalert/sweetalert2.min.js"></script>
  
  <?php
	require("layouts/footer_end.php");
  ?>

<script>
  $(function () {
    $('.sample_datatable').DataTable()
   
  })
</script>


