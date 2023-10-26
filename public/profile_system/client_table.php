<style>
.service_list{
  margin-bottom: 0px;
}

.disable-click {
    pointer-events: none;
  }
  </style>
<div class="modal fade" id="modal_add_deceased">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deceased Profile</h4>
              </div>
              <form class="generic_form_trigger" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="add_deceased">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">
                <input type="hidden" name="client_id" value="<?php echo($client["profile_id"]) ?>">
              <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">First Name*</label>
                  <input required type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Middle Name</label>
                  <input  type="text" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name*</label>
                  <input required type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label for="exampleInputEmail1">Suffix</label>
                  <input  type="text" name="suffix" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input required type="date" name="birthdate" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Death</label>
                  <input required type="date" name="date_of_death" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender</label>
                  <select required class="form-control" name="gender">
                  <option value="" selected disabled>Please select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Religion</label>
                  <input required type="text" name="religion" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              
              <?php if($slot["crypt_slot_type"] == "LAWN"): ?>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Interment Type</label>
                  <select required class="form-control" name="interment_type">
                  <option value="" selected disabled>Please select interment</option>
                    <option value="1st Interment">1st Interment</option>
                    <option value="2nd Interment">2nd Interment</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Deceased Type</label>
                  <select required class="form-control" name="deceased_type">
                  <option value="" selected disabled>Please select type of deceased</option>
                    <option value="REMAINS">REMAINS</option>
                    <option value="BONES">BONES</option>
                  </select>
                </div>
              </div>



              
              <?php endif; ?>

              <div class="col-md-12">
                  <div class="form-group">
                      <label for="exampleInputFile">Death Certificate</label>
                      <input name="death_certificate" required type="file" id="exampleInputFile">
                      <p class="help-block">Upload death certificate here!</p>
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






        <div class="modal fade" id="modal_forward">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Forward for Burial Scheduling</h4>
              </div>
              <form class="generic_form_trigger" data-url="profile">
              <div class="modal-body">
                <input type="hidden" name="action" value="forward_cemetery">
                <input type="hidden" name="slot_number" value="<?php echo($_GET["slot"]) ?>">


                <?php if($slot["crypt_type"] == "COFFIN"): 
                  $price = query("select * from pricing_coffincrypt where type = ?", $client["occupant_type"]);
                  $price = $price[0];
                  ?>
                  <input type="hidden" name="price_id" value="<?php echo($price["tbl_id"]); ?>">
                  <div class="form-group service_list">
                    <label>
                      <input disabled checked class="coffin_price disable-click" type="checkbox" name="coffin_amount" value="<?php echo($price["amount"]); ?>" data-cost="<?php echo($price["amount"]); ?>" >
                      <span style="margin-left: 15px;">Coffin Amount  (<?php echo(to_peso($price["amount"])); ?>)</span>
                    </label>
                  </div>

                  <div class="form-group service_list">
                    <label>
                      <input disabled checked class="coffin_price disable-click" type="checkbox" name="certification_amount" value="<?php echo($price["certification_amount"]); ?>" data-cost="<?php echo($price["certification_amount"]); ?>" >
                      <span style="margin-left: 15px;">Certification Fee  (<?php echo(to_peso($price["certification_amount"])); ?>)</span>
                    </label>
                  </div>

                  <div class="form-group service_list">
                    <label>
                      <input checked class="coffin_price" type="checkbox" name="lapida_amount" value="<?php echo($price["lapida_amount"]); ?>" data-cost="<?php echo($price["lapida_amount"]); ?>" >
                      <span style="margin-left: 15px;">Lapida Cost  (<?php echo(to_peso($price["lapida_amount"])); ?>)</span>
                    </label>
                  </div>
                  <hr>
                <?php endif; ?>


                <?php if($slot["crypt_type"] == "BONE"):  
                  $price = query("select * from pricing_bonecrypt");
                  ?>

                  <div class="form-group">
                    <label>BONE PRICE OPTION</label>
                    <select required name="bone_option" class="form-control" id="pricingOption">
                      <option disabled value="" selected>Please select bone options</option>
                      <?php foreach($price as $row): ?>
                        <option data-amount="<?php echo($row["amount"]); ?>" data-certification="<?php echo($row["certification"]); ?>" 
                        data-lapida_amount="<?php echo($row["lapida_amount"]); ?>" 
                        value="<?php echo($row["type"]); ?>"><?php echo($row["type"]); ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div id="pricingOptions" style="display:none;">

               
                    
                  </div>

                  <hr>
                <?php endif; ?>

                <?php if($slot["crypt_type"] == "BONE"): ?>
                <div class="form-group service_list">
                    <label>
                      <input id="lapida" type="checkbox" name="lapida_amount" value="" data-cost="" >
                      <span style="margin-left: 15px;">Lapida</span>
                    </label>
                  </div>
                <?php endif; ?>

                <?php $services = query("select * from services"); ?>
                <?php foreach($services as $row): ?>
                  <div class="form-group service_list">
                    <label>
                      <input type="checkbox" name="service[]" value="<?php echo($row["service_name"]); ?>" data-cost="<?php echo($row["cost"]); ?>" >
                      <span style="margin-left: 15px;"><?php echo($row["service_name"]); ?>  (<?php echo(to_peso($row["cost"])); ?>)</span>
                    </label>
                  </div>
                <?php endforeach; ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Total Cost</label>
                  <input type="text" disabled class="form-control" id="total_cost" placeholder="0">
                </div>
              
              <!-- <div class="form-group">
                <label>Interment Services to be availed (optional)</label>
                <select name="services[]" class="form-control select2" multiple data-placeholder="Select Interment Service"
                        style="width: 100%;">
                  <option value="Chapel Only">Chapel Only</option>
                  <option value="Chapel with Sound System">Chapel with Sound System</option>
                  <option value="Tents and Chairs Rental">Tents and Chairs Rental</option>
                </select>
              </div> -->
              <div class="row">
                  <div class="col-md-6">

                  <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Burial Schedule Date (optional)</label>
                        <div class="input-group">
                          <input name="deceased_burial_date" type="date" class="form-control">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  
                  </div>
                  <div class="col-md-6">
                    <div class="bootstrap-timepicker">
                      <div class="form-group">
                        <label>Burial Time (optional)</label>
                        <div class="input-group">
                          <input name="deceased_burial_time" value="" type="text" class="form-control timepicker">
                          <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
          </div>
        </div>





<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Deceased Information</a></li>
              <li><a href="#timeline" data-toggle="tab">Transaction Logs</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <a href="#" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal_add_deceased">Add Deceased Profile</a>
                <br>
                <br>
               <table class="table table-borderd table-striped sample_datatable">
                <thead>
                    <th>Deceased Name</th>
                    <th>BirthDate</th>
                    <th>Date of Death</th>
                    <th>Age Died</th>
                    <th>Burial Date</th>
                    <th>Burial Status</th>
                    <th>Remarks</th>
                </thead>
                <tbody>
                    <?php foreach($deceased as $d): ?>
                        <tr>
                            <td><?php echo($d["deceased_name"]); ?></td>
                            <td><?php echo($d["birthdate"]); ?></td>
                            <td><?php echo($d["date_of_death"]); ?></td>
                            <td><?php echo($d["age_died"]); ?></td>
                            <td><?php echo($d["burial_date"]); ?></td>
                            <td><?php echo($d["burial_status"]); ?></td>
                            <td><?php echo($d["interment_type"]); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
               </table>
                  <?php
                  $forward = query("select * from deceased_profile where slot_number = ? and burial_status = 'NO BURIAL DATE'", $_GET["slot"]);
                  if(!empty($forward)):
                  ?>
                  <a href="#" data-toggle="modal" data-target="#modal_forward" class="btn btn-primary btn-flat">Forward to Cemetery for Burial Scheduling</a>
                  <?php endif; ?>
              </div>
              <div class="tab-pane" id="timeline">
                <ul class="timeline timeline-inverse">
                  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-user bg-aqua"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                      <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
                      </h3>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          3 Jan. 2014
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-camera bg-purple"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>