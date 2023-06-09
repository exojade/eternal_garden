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
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
          <li><a href="index"><i class="fa fa-circle"></i> <span>Main</span></a></li>
          <li><a href="coffin_crypt?action=list"><i class="fa fa-building"></i> <span>Coffin Crypt</span></a></li>
          <li><a href="bone_crypt?action=list"><i class="fa fa-bone"></i> <span>Bone Crypt</span></a></li>
          <li><a href="lawn?action=list"><i class="fa fa-cross"></i> <span>Lawn</span></a></li>
          <li><a href="mausoleum?action=list"><i class="fa fa-home"></i> <span>Mausoleum</span></a></li>
          <li><a href="profile?action=list"><i class="fa fa-users"></i> <span>Profile</span></a></li>
          <?php
          $schedule = query("select COUNT(*) as count from burial_schedule where remarks = 'PENDING'");
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

          <li><a href="transfer?action=list"><i class="fa fa-bell"></i> <span>Notice to Transfer</span>
            <span class="pull-right-container">
              <span class="label label-danger pull-right">5</span>
            </span></a></li>
        <!-- <li class="header">SETTINGS</li>
          <li><a href="index"><i class="fa fa-database"></i> <span>Requirements</span></a></li>
          <li><a href="index"><i class="fa fa-bolt"></i> <span>Services</span></a></li>
          <li><a href="index"><i class="fa fa-dollar"></i> <span>Pricing</span></a></li> -->
      </ul>
    </section>
  </aside>