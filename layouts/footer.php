  <style>
.white-text{
  color: #fff;
}
  </style>
  


  <script src="AdminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <footer class="main-footer no-print">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="#">Cemetery Management and Tracking System</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ../wrapper -->

<!-- jQuery 3 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);


  $('.generic_form').submit(function(e) {
      e.preventDefault();
      swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
      var url = $(this).data('url');
      // alert(url);
      $.ajax({
        type: 'post',
        url: url,
        data: $(this).serialize(),
        success: function (results) {
            var o = jQuery.parseJSON(results);
            if(o.result == 'success'){
              window.location.replace(o.link);
            }
            else if(o.result == 'failed'){
                swal({
                    title: o.title,
                    text: o.message,
                    type: "error"
                }).then(function() {
                    swal.close();
                });
            }
        }
      });
    });




    $(document).on('submit', '.generic_form_trigger', function(e) {
    e.preventDefault(); // Prevent the default form submission

    var form = $(this)[0];
    var formData = new FormData(form);
    var promptmessage = "";
    var prompttitle = "";
    if(typeof($(this).data('title')) != "undefined" ) {
      promptmessage = $(this).data('message');
      prompttitle = $(this).data('title');
    }
    else{
      promptmessage = 'This form will be submitted. Are you sure you want to continue?';
      prompttitle = 'Data submission';
    }


    
    var url = $(this).data('url');

    swal({
        title: prompttitle,
        text: promptmessage,
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.value) {
            swal({ title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false });
            $.ajax({
                type: 'post',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                success: function(results) {
                    var o = jQuery.parseJSON(results);
                    console.log(o);
                    if (o.result === "success") {
                        swal.close();
                        swal({
                            title: "Submit success",
                            text: o.message,
                            type: "success"
                        }).then(function () {
                          if(typeof(o.newlink) != "undefined" && o.newlink !== null) {
                          if(o.newlink == "newlink"){
                            console.log(o);
                            if(o.link == "refresh")
                            window.location.reload();
                            else if(o.link == "not_refresh")
                              console.log("");
                            else
                              window.open(o.link, '_blank');
                              // window.location.replace(o.link, "_blank");
                          }
                      }
                      else{
                        if(o.link == "refresh")
                        window.location.reload();
                        else if(o.link == "not_refresh")
                          console.log("");
                        else
                          window.location.replace(o.link);

                      }
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: o.message,
                            type: "error"
                        });
                        console.log(results);
                    }
                },
                error: function(results) {
                    console.log(results);
                    swal("Error!", "Unexpected error occured!", "error");
                }
            });
        }
    });
});




$(document).on('submit', '#deleteFormTrigger', function(e) {
    e.preventDefault(); // Prevent the default form submission

    var form = $(this)[0];
    var formData = new FormData(form);
    var promptmessage = "";
    var prompttitle = "";
    if(typeof($(this).data('title')) != "undefined" ) {
      promptmessage = $(this).data('message');
      prompttitle = $(this).data('title');
    }
    else{
      promptmessage = 'This form will be submitted. Are you sure you want to continue?';
      prompttitle = 'Data submission';
    }


    
    var url = $(this).data('url');

    swal({
      //  customClass: { // Add custom class only for this SweetAlert dialog
      //       popup: 'delete-alert' // Custom class for the SweetAlert dialog triggered by the form with ID "deleteFormTrigger"
      //   },
        title: prompttitle,
        text: promptmessage,
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'Cancel',
        // footer: '<a href="#">Why do I have this issue?</a>',
        // customClass: { // Add custom class only for this SweetAlert dialog
        //     popup: 'delete-alert',
        //     backdrop: 'red-backdrop' // Custom class for the background of the specific SweetAlert dialog
        // }
        background: "#fff url(resources/red.jpg)",
  backdrop: `
    rgba(0,0,123,0.4)
    url("resources/red.jpg")
    left top
    no-repeat
  `,
  onOpen: function() {
        // Set the font color of text and title to white
        $(".swal2-title, .swal2-content").css("color", "white");
    }
       
    }).then((result) => {
      $('.swal-text').addClass('white-text');
    $('.swal-title').addClass('white-text');
        if (result.value) {
            swal({ title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false });
            $.ajax({
                type: 'post',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                success: function(results) {
                    var o = jQuery.parseJSON(results);
                    console.log(o);
                    if (o.result === "success") {
                        swal.close();
                        swal({
                            title: "Submit success",
                            text: o.message,
                            type: "success"
                        }).then(function () {
                          if(typeof(o.newlink) != "undefined" && o.newlink !== null) {
                          if(o.newlink == "newlink"){
                            console.log(o);
                            if(o.link == "refresh")
                            window.location.reload();
                            else if(o.link == "not_refresh")
                              console.log("");
                            else
                              window.open(o.link, '_blank');
                              // window.location.replace(o.link, "_blank");
                          }
                      }
                      else{
                        if(o.link == "refresh")
                        window.location.reload();
                        else if(o.link == "not_refresh")
                          console.log("");
                        else
                          window.location.replace(o.link);

                      }
                        });
                    } else {
                        swal({
                            title: "Error!",
                            text: o.message,
                            type: "error"
                        });
                        console.log(results);
                    }
                },
                error: function(results) {
                    console.log(results);
                    swal("Error!", "Unexpected error occured!", "error");
                }
            });
        }
    });
});
// $('.swal-overlay').css('background-color', 'rgba(255, 0, 0, 0.6)');

$(document).on('submit', '.generic_form_no_trigger', function(e) {
    e.preventDefault(); // Prevent the default form submission

    var form = $(this)[0];
    var formData = new FormData(form);
    var promptmessage = "";
    var prompttitle = "";
    if(typeof($(this).data('title')) != "undefined" ) {
      promptmessage = $(this).data('message');
      prompttitle = $(this).data('title');
    }
    else{
      promptmessage = 'This form will be submitted. Are you sure you want to continue?';
      prompttitle = 'Data submission';
    }


    
    var url = $(this).data('url');

    // swal({
    //     title: prompttitle,
    //     text: promptmessage,
    //     type: 'info',
    //     showCancelButton: true,
    //     confirmButtonText: 'Yes',
    //     cancelButtonText: 'Cancel'
    // }).then((result) => {
    //     if (result.value) {
            swal({ title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false });
            $.ajax({
                type: 'post',
                url: url,
                processData: false,
                contentType: false,
                data: formData,
                success: function(results) {
                    var o = jQuery.parseJSON(results);
                    console.log(o);
                    if (o.result === "success") {
                        swal.close();
                        if(typeof(o.newlink) != "undefined" && o.newlink !== null) {
                          if(o.newlink == "newlink"){
                            console.log(o);
                            if(o.link == "refresh")
                            window.location.reload();
                            else if(o.link == "not_refresh")
                              console.log("");
                            else
                              window.open(o.link, '_blank');
                              // window.location.replace(o.link, "_blank");
                          }
                      }
                      else{
                        if(o.link == "refresh")
                        window.location.reload();
                        else if(o.link == "not_refresh")
                          console.log("");
                        else
                          window.location.replace(o.link);

                      }
                    } else {
                        swal({
                            title: "Error!",
                            text: o.message,
                            type: "error"
                        });
                        console.log(results);
                    }
                },
                error: function(results) {
                    console.log(results);
                    swal("Error!", "Unexpected error occured!", "error");
                }
            });
        // }
    });
// });


  // $('.generic_form_trigger').submit(function(e) {


  //   var form = $(this)[0];
  //   var formData = new FormData(form);
  //     var promptmessage = 'This form will be submitted. Are you sure you want to continue?';
  //     var prompttitle = 'Data submission';
  //     e.preventDefault();
  //     var url = $(this).data('url');
      
  //       swal({
  //           title: prompttitle,
  //           text: promptmessage,
  //           type: 'info',
  //           showCancelButton: true,
  //           confirmButtonText: 'Yes',
  //           cancelButtonText: 'Cancel'
  //       }).then((result) => {
  //           if (result.value) {
  //               swal({title: 'Please wait...', imageUrl: 'AdminLTE/dist/img/loader.gif', showConfirmButton: false});
  //           $.ajax({
  //               type: 'post',
  //               url: url,
  //               processData: false,
  //               contentType: false,
  //               data: formData,
  //               success: function (results) {
  //               var o = jQuery.parseJSON(results);
  //               console.log(o);
  //               if(o.result === "success") {
  //                   swal.close();
  //                   swal({title: "Submit success",
  //                   text: o.message,
  //                   type:"success"})
  //                   .then(function () {
  //                     if(o.link == "refresh")
  //                       window.location.reload();
  //                     else
  //                       window.location.replace(o.link);
  //                   });
  //               }
  //               else {
  //                   swal({
  //                   title: "Error!",
  //                   text: o.message,
  //                   type:"error"
  //                   });
  //                   console.log(results);
  //               }
  //               },
  //               error: function(results) {
  //               console.log(results);
  //               swal("Error!", "Unexpected error occur!", "error");
  //               }
  //           });
  //           }
  //       });
  //   });
</script>
<!-- Bootstrap 3.3.7 -->

