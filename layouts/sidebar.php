<?php 
$role = $_SESSION["eternal_garden"]["role"];

$pending = query("select COUNT(*) as count from burial_schedule where remarks = 'FOR SCHEDULING'");
$pend = $pending[0]["count"];
?>

<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
			<img src="AdminLTE/dist/img/user-avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
			<p>Hello</p>
			<a href="#"><i class="fa fa-circle text-success"></i> <?php echo($user["fullname"]); ?></a>
        </div>
      </div>

      <?php if($role == "ADMINISTRATOR"): ?>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li><a href="index"><i class="fa fa-home"></i> <span>Main</span></a></li>
          <li><a href="settings"><i class="fa fa-cogs"></i> <span>Settings</span></a></li>
          <!-- <li><a href="maps?filter=ALL"><i class="fa fa-map"></i> <span>Map</span></a></li> -->
          <li><a href="maps?action=map_editor"><i class="fa fa-map"></i> <span>Map Editor</span></a></li>
          <li><a href="transaction?action=list"><i class="fa fa-file"></i> <span>Transaction</a></li>
          <li><a href="sales?action=list"><i class="fa fa-dollar"></i> <span>Sales</a></li>
          <li><a href="reports?action=list"><i class="fa fa-table"></i> <span>Reports</a></li>
          <li><a href="burial_space?action=list"><i class="fa fa-cross"></i> <span>Burial Space</span></a></li>
          <!-- <li><a href="coffin_crypt?action=list"><i class="fa fa-building"></i> <span>Coffin Crypt</span></a></li> -->
          <!-- <li><a href="bone_crypt?action=list"><i class="fa fa-bone"></i> <span>Bone Crypt</span></a></li> -->
          
          <!-- <li><a href="lawn?action=list"><i class="fa fa-cross"></i> <span>Lawn</span></a></li> -->
          <!-- <li><a href="mausoleum?action=list"><i class="fa fa-home"></i> <span>Mausoleum</span></a></li> -->
          <li><a href="profile?action=client_list"><i class="fa fa-users"></i> <span>Client Profile</span></a></li>
          <li><a href="profile?action=deceased_list"><i class="fa fa-users"></i> <span>Deceased Profile</span></a></li>
          <li><a href="users?action=list"><i class="fa fa-users"></i> <span>Users</span></a></li>
          <?php if($pend != 0): ?>
            <li><a href="pending_burial?action=list"><i class="fa fa-calendar"></i> <span>Pending for Burial</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo($pend); ?></span>
            </span></a></li>
          <?php else: ?>
            <li><a href="pending_burial?action=list"><i class="fa fa-calendar"></i> <span>Pending for Burial</span></a></li>
            <?php endif; ?>
          <?php
          $schedule = query("select COUNT(*) as count from burial_schedule where remarks in ('POSTPONED','PENDING')");
          $sched = $schedule[0]["count"];
          ?>
          <?php if($sched != 0): ?>
            <li><a href="schedule"><i class="fa fa-calendar"></i> <span>Schedule</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo($sched); ?></span>
            </span></a></li>
          <?php else: ?>
            <li><a href="schedule"><i class="fa fa-calendar"></i> <span>Schedule</span></a></li>
          <?php endif; ?>


          <?php
          
      //     $count = query("SELECT
      //     (SUM(year_need_to_notify) +
      //     SUM(six_months_need_to_notify) +
      //     -- SUM(three_months_need_to_notify) + SUM(month_need_to_notify) +
      //     SUM(week_need_to_notify) +
      //     SUM(day_before_need_to_notify) +
      //     SUM(date_expired_need_to_notify)) count
      // FROM (
      //     SELECT
      //         n.profile_id,
      //         MAX(CASE WHEN n.year_date <= CURDATE() AND (ns.year_notif_status = '' OR ns.year_notif_status IS NULL) THEN 1 ELSE 0 END) AS year_need_to_notify,
      //         MAX(CASE WHEN n.6months_date <= CURDATE() AND (ns.6months_notif_status = '' OR ns.6months_notif_status IS NULL) THEN 1 ELSE 0 END) AS six_months_need_to_notify,
      //         MAX(CASE WHEN n.3months_date <= CURDATE() AND (ns.3months_notif_status = '' OR ns.3months_notif_status IS NULL) THEN 1 ELSE 0 END) AS three_months_need_to_notify,
      //         MAX(CASE WHEN n.month_date <= CURDATE() AND (ns.month_notif_status = '' OR ns.month_notif_status IS NULL) THEN 1 ELSE 0 END) AS month_need_to_notify,
      //         MAX(CASE WHEN n.week_date <= CURDATE() AND (ns.week_notif_status = '' OR ns.week_notif_status IS NULL) THEN 1 ELSE 0 END) AS week_need_to_notify,
      //         MAX(CASE WHEN n.day_before_date <= CURDATE() AND (ns.day_before_notif_status = '' OR ns.day_before_notif_status IS NULL) THEN 1 ELSE 0 END) AS day_before_need_to_notify,
      //         MAX(CASE WHEN n.date_expired <= CURDATE() AND (ns.day_notif_status = '' OR ns.day_notif_status IS NULL) THEN 1 ELSE 0 END) AS date_expired_need_to_notify
      //     FROM notification n
      //     LEFT JOIN notification_status ns ON n.notification_id = ns.notification_id
      //     LEFT JOIN profile_list p ON p.profile_id = n.profile_id
      //     WHERE p.active_status IS NULL OR p.active_status != 'FORMER'
      //     GROUP BY n.profile_id
      // ) AS subquery
      // GROUP BY profile_id
      // HAVING
      //     count > 0;
      
      // ");
      // dump($count);
          
          ?>

          <li><a href="notification"><i class="fa fa-bell"></i> <span>Notification Logs</span>
          <?php 
          // if(isset($count[0])): 
          ?>
          <?php 
          // if($count[0]["count"] != 0): 
          ?>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php
              //  echo($count[0]["count"]); 
               ?></span>
            </span>
          <?php 
        // endif; 
        ?>
          <?php 
        // endif; 
        ?>
          </a></li>
            
            <!-- <li><a href="resources/pdf_installer.exe"><i class="fa fa-download"></i> <span>PDF Installer</span> -->
           </a></li>

      </ul>

      <?php elseif($role=="CEMETERY"): ?>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li><a href="index"><i class="fa fa-home"></i> <span>Main</span></a></li>
          <!-- <li><a href="maps?filter=ALL"><i class="fa fa-map"></i> <span>Map</span></a></li> -->
          <!-- <li><a href="maps?action=map_editor"><i class="fa fa-map"></i> <span>Map Editor</span></a></li> -->
          <!-- <li><a href="transaction?action=list"><i class="fa fa-file"></i> <span>Transaction</a></li> -->
          <!-- <li><a href="sales?action=list"><i class="fa fa-dollar"></i> <span>Sales</a></li> -->
          <li><a href="reports?action=list"><i class="fa fa-table"></i> <span>Reports</a></li>
          <!-- <li><a href="burial_space?action=list"><i class="fa fa-cross"></i> <span>Burial Space</span></a></li> -->
          <!-- <li><a href="coffin_crypt?action=list"><i class="fa fa-building"></i> <span>Coffin Crypt</span></a></li> -->
          <!-- <li><a href="bone_crypt?action=list"><i class="fa fa-bone"></i> <span>Bone Crypt</span></a></li> -->
          
          <!-- <li><a href="lawn?action=list"><i class="fa fa-cross"></i> <span>Lawn</span></a></li> -->
          <!-- <li><a href="mausoleum?action=list"><i class="fa fa-home"></i> <span>Mausoleum</span></a></li> -->
          <li><a href="profile?action=client_list"><i class="fa fa-users"></i> <span>Client Profile</span></a></li>
          <li><a href="profile?action=deceased_list"><i class="fa fa-users"></i> <span>Deceased Profile</span></a></li>
          <!-- <li><a href="users?action=list"><i class="fa fa-users"></i> <span>Users</span></a></li> -->
          <?php if($pend != 0): ?>
            <li><a href="pending_burial?action=list"><i class="fa fa-calendar"></i> <span>Pending for Burial</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo($pend); ?></span>
            </span></a></li>
          <?php else: ?>
            <li><a href="pending_burial?action=list"><i class="fa fa-calendar"></i> <span>Pending for Burial</span></a></li>
            <?php endif; ?>
          <?php
          $schedule = query("select COUNT(*) as count from burial_schedule where remarks in ('POSTPONED','PENDING')");
          $sched = $schedule[0]["count"];
          ?>
          <?php if($sched != 0): ?>
            <li><a href="schedule"><i class="fa fa-calendar"></i> <span>Schedule</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo($sched); ?></span>
            </span></a></li>
          <?php else: ?>
            <li><a href="schedule"><i class="fa fa-calendar"></i> <span>Schedule</span></a></li>
          <?php endif; ?>


          <?php
          
          $count = query("SELECT
          (SUM(year_need_to_notify) +
          SUM(six_months_need_to_notify) +
          SUM(three_months_need_to_notify) +
          SUM(month_need_to_notify) +
          SUM(week_need_to_notify) +
          SUM(day_before_need_to_notify) +
          SUM(date_expired_need_to_notify)) count
      FROM (
          SELECT
              n.profile_id,
              MAX(CASE WHEN n.year_date <= CURDATE() AND (ns.year_notif_status = '' OR ns.year_notif_status IS NULL) THEN 1 ELSE 0 END) AS year_need_to_notify,
              MAX(CASE WHEN n.6months_date <= CURDATE() AND (ns.6months_notif_status = '' OR ns.6months_notif_status IS NULL) THEN 1 ELSE 0 END) AS six_months_need_to_notify,
              MAX(CASE WHEN n.3months_date <= CURDATE() AND (ns.3months_notif_status = '' OR ns.3months_notif_status IS NULL) THEN 1 ELSE 0 END) AS three_months_need_to_notify,
              MAX(CASE WHEN n.month_date <= CURDATE() AND (ns.month_notif_status = '' OR ns.month_notif_status IS NULL) THEN 1 ELSE 0 END) AS month_need_to_notify,
              MAX(CASE WHEN n.week_date <= CURDATE() AND (ns.week_notif_status = '' OR ns.week_notif_status IS NULL) THEN 1 ELSE 0 END) AS week_need_to_notify,
              MAX(CASE WHEN n.day_before_date <= CURDATE() AND (ns.day_before_notif_status = '' OR ns.day_before_notif_status IS NULL) THEN 1 ELSE 0 END) AS day_before_need_to_notify,
              MAX(CASE WHEN n.date_expired <= CURDATE() AND (ns.day_notif_status = '' OR ns.day_notif_status IS NULL) THEN 1 ELSE 0 END) AS date_expired_need_to_notify
          FROM notification n
          LEFT JOIN notification_status ns ON n.notification_id = ns.notification_id
          LEFT JOIN profile_list p ON p.profile_id = n.profile_id
          WHERE p.active_status IS NULL OR p.active_status != 'FORMER'
          GROUP BY n.profile_id
      ) AS subquery
      GROUP BY profile_id
      HAVING
          count > 0;
      
      ");
      // dump($count);
          
          ?>

          <li><a href="transfer?action=list"><i class="fa fa-bell"></i> <span>Notice to Transfer</span>
          <?php if(isset($count[0])): ?>
          <?php if($count[0]["count"] != 0): ?>
            <span class="pull-right-container">
              <span class="label label-danger pull-right"><?php echo($count[0]["count"]); ?></span>
            </span>
          <?php endif; ?>
          <?php endif; ?>
          </a></li>
            
            <!-- <li><a href="resources/pdf_installer.exe"><i class="fa fa-download"></i> <span>PDF Installer</span> -->
           </a></li>

      </ul>
      <?php elseif($role=="CEEMDO"): ?>
        <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li><a href="index"><i class="fa fa-home"></i> <span>Main</span></a></li>
          <!-- <li><a href="maps?filter=ALL"><i class="fa fa-map"></i> <span>Map</span></a></li> -->
          <li><a href="maps?action=map_editor"><i class="fa fa-map"></i> <span>Map Editor</span></a></li>
          <li><a href="transaction?action=list"><i class="fa fa-file"></i> <span>Transaction</a></li>
          <li><a href="sales?action=list"><i class="fa fa-dollar"></i> <span>Sales</a></li>
          <li><a href="reports?action=list"><i class="fa fa-table"></i> <span>Reports</a></li>
          <li><a href="burial_space?action=list"><i class="fa fa-cross"></i> <span>Burial Space</span></a></li>
          <!-- <li><a href="coffin_crypt?action=list"><i class="fa fa-building"></i> <span>Coffin Crypt</span></a></li> -->
          <!-- <li><a href="bone_crypt?action=list"><i class="fa fa-bone"></i> <span>Bone Crypt</span></a></li> -->
          
          <!-- <li><a href="lawn?action=list"><i class="fa fa-cross"></i> <span>Lawn</span></a></li> -->
          <!-- <li><a href="mausoleum?action=list"><i class="fa fa-home"></i> <span>Mausoleum</span></a></li> -->
          <li><a href="profile?action=client_list"><i class="fa fa-users"></i> <span>Client Profile</span></a></li>
          <li><a href="profile?action=deceased_list"><i class="fa fa-users"></i> <span>Deceased Profile</span></a></li>
          <!-- <li><a href="users?action=list"><i class="fa fa-users"></i> <span>Users</span></a></li> -->
      
            
            <!-- <li><a href="resources/pdf_installer.exe"><i class="fa fa-download"></i> <span>PDF Installer</span> -->
           </a></li>

      </ul>
      <?php endif; ?>
    </section>
  </aside>