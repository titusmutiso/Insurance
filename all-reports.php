<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session
session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location: index");
}
$login_session=$_SESSION['login_user'];
$user_id = $_SESSION['id'];

//db config
require 'includes/config.php';
require 'user_profile.php';

//functions
    require 'includes/functions.php';
//page name
$mainpage ='';
$page = 'dashboard';


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        //header
         require 'includes/header.php';
        //css
        require 'includes/css.php';
        
        ?>
    </head>
    <body class="sidebar-wide">
        <!--navigation-->
        <?php
        //top navigation
        require 'includes/top-menu.php';
        
        ?>
        <!-- Page container -->
        <div class="page-container">
            <!-- side bar-->
            <?php require 'includes/side-menu.php'; ?>
            <!--ennd of side bar-->
            <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <?php require 'includes/breadcrumb.php'; ?>
            <!-- end Page header-->
             <!-- Default panel -->
    <div class="panel panel-default">
      <div class="panel-heading">
          <div class="col-md-12">
        <h6 class="panel-title">All Reports</h6>
          <span class="pull-right">
              <div class="btn-group">

              <a href="export_excel?type=all" class="btn btn-primary"> Export All Policies </a>
                  <a href="export_excel?type=active" class="btn btn-success"> Export Active Policies</a>
                  <a href="export_excel?type=expired" class="btn btn-danger">Export Expired Policies</a>
                  <a href="sms-test" class="pull-right btn btn-default">SMS Expiring in a Month</a>

          </div>
          </span>


             
      </div>
      </div>
      <div class="panel-body">

          <form method="POST" class="" action="search-results.php">
              <!--<div class="col-md-3">
                  <div class="form-group">
                  <label>Application Type</label>
                  <select name="service" class="form-control">
                  <option value=""> Select Service</option>

                      <option value="1"> Mpesa Paybill</option>
                      <option value="2">Buy Goods & Services</option>
                  </select>
                  </div>


              </div>
              <div class="col-md-2">
                  <div class="form-group">
                     <label> Account Status</label>
                     <br>
                     <select name="status" class="form-control">
                     <option value=""> Select Account Status</option>
                      <option value="0"> Pending</option>
                      <option value="1">Activated</option>
                  </select>
              </div>
              </div>-->
              <div class="col-md-3">
                  <div class="form-group">

                      <label>Date From</label>
                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="from">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">

                      <label> To</label>
                      <br>

                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="to">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">

                      <label> Category</label>
                      <br>

                     <select name="type" class="form-control">
                         <option>All</option>
                         <option value="1">Active</option>
                         <option value="0">Expired</option>
                     </select>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="form-group">
                      <label></label>
                      <br>


                      <input type="submit" class="btn btn-md btn-success" value="search" name="search">
                  </div>
              </div>
          </form>
          <br>
          <div class="clearfix"></div>
          <ul id="userTab" class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab">All Policies</a>
              </li>
              <li><a href="#drafts" data-toggle="tab">Active</a>
              </li>
              <li><a href="#month" data-toggle="tab">A month/Less to Expiry</a>
              </li>

              <li><a href="#trash" data-toggle="tab">Inactive/Expired</a>
              </li>
          </ul>
          <div id="userTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="overview">
                  <div class="datatable">
                      <table class="table table-striped table-bordered">
                          <thead>
                          <tr>
                              <th>Customer Number </th>

                              <th>Customer Name</th>
                              <th>Date of Registration</th>
                              <th>Date of Expiry</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Company</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          $clients_query  = "select * from sp_customers ORDER BY id DESC";
                          $clients_res    = mysqli_query($connection,$clients_query);
                          $clients_count  =   mysqli_num_rows($clients_res);

                          ?>
                          <?php
                          if (mysqli_num_rows($clients_res) > 0) {

                              while($clients_row=mysqli_fetch_array($clients_res)) {
                                  $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];
                                  //$clients_mname = $clients_row['role'];
                                  $clients_company = $clients_row['company'];
                                  $commenced_date = $clients_row['commencement_date'];
                                  $expiry_date = $clients_row['renewal_date'];
                                  $clients_status = $clients_row['status'];
                                  $clients_phone= $clients_row['phone_no'];
                                  $clients_email= $clients_row['email_add'];

                                  $clients_id = $clients_row['id'];
                                  $expire_date = date("d/m/Y", strtotime($expiry_date));
                                  $start_date= date("d/m/Y", strtotime($commenced_date));
                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td><?php echo $start_date; ?></td>
                                      <td><?php echo $expire_date; ?></td>
                                      <td ><a href="mailto:<?php echo $clients_email; ?>"> <?php echo $clients_email; ?></a></td>
                                      <td ><a href="tel:<?php echo $clients_phone; ?>"> <?php echo $clients_phone; ?></a></td>
                                      <td><?php echo $clients_company; ?></td>
                                      <td ><?php if($clients_status==1){
                                              ?>
                                              <span class="label label-success"><a href="delete.php?id=<?php echo $clients_id ?>&type=deactivate" style="color: #fff; text-decoration: none">Active</a> </span></span>

                                          <?php }else{
                                              ?>
                                              <span class="label label-danger"><a href="delete.php?id=<?php echo $clients_id ?>&type=activate" style="color: #fff; text-decoration: none">suspended</a></span>
                                              <?php
                                          } ?></td>
                                      <td width="15%"><div class="btn-group"><a href='edit-customer?id=<?php echo $clients_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                              &nbsp;<a href='delete?id=<?php echo $clients_id ?>&type=customers' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                             
                                          </div>
                                      </td>
                                  </tr>


                              <?php }
                          }  else {
                              echo 'No Records';
                          }

                          ?>


                          </tbody>
                      </table>
                  </div>
                  <!-- /.table-responsive -->
              </div>
              <div class="tab-pane fade" id="drafts">
                  <div class="datatable">
                      <table class="table table-striped table-bordered">
                          <thead>
                          <tr>
                              <th>Customer Number </th>

                              <th>Customer Name</th>
                              <th>Date of Registration</th>
                              <th>Date of Expiry</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Company</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          $clients_query  = "select * from sp_customers WHERE status=1  ORDER BY id DESC";
                          $clients_res    = mysqli_query($connection,$clients_query);
                          $clients_count  =   mysqli_num_rows($clients_res);

                          ?>
                          <?php
                          if (mysqli_num_rows($clients_res) > 0) {

                              while($clients_row=mysqli_fetch_array($clients_res)) {
                                  $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];
                                  //$clients_mname = $clients_row['role'];
                                  $clients_company = $clients_row['company'];
                                  $commenced_date = $clients_row['commencement_date'];
                                  $expiry_date = $clients_row['renewal_date'];
                                  $clients_status = $clients_row['status'];
                                  $clients_phone= $clients_row['phone_no'];
                                  $clients_email= $clients_row['email_add'];
//
                                  $clients_id = $clients_row['id'];
                                  $expire_date = date("d/m/Y", strtotime($expiry_date));
                                  $start_date= date("d/m/Y", strtotime($commenced_date));
                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td><?php echo $start_date; ?></td>
                                      <td><?php echo $expire_date; ?></td>
                                      <td ><a href="mailto:<?php echo $clients_email; ?>"> <?php echo $clients_email; ?></a></td>
                                      <td ><a href="tel:<?php echo $clients_phone; ?>"> <?php echo $clients_phone; ?></a></td>
                                      <td><?php echo $clients_company; ?></td>
                                      <td ><?php if($clients_status==1){
                                              ?>
                                              <span class="label label-success"><a href="delete.php?id=<?php echo $clients_id ?>&type=deactivate" style="color: #fff; text-decoration: none">Active</a> </span></span>

                                          <?php }else{
                                              ?>
                                              <span class="label label-danger"><a href="delete.php?id=<?php echo $clients_id ?>&type=activate" style="color: #fff; text-decoration: none">suspended</a></span>
                                              <?php
                                          } ?></td>
                                      <td width="15%"><div class="btn-group"><a href='edit-customer?id=<?php echo $clients_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                              &nbsp;<a href='delete?id=<?php echo $clients_id ?>&type=customers' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                             
                                          </div>
                                      </td>
                                  </tr>


                              <?php }
                          }  else {
                              echo 'No Records';
                          }

                          ?>


                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="tab-pane fade" id="month">
                  <div class="datatable">
                      <table class="table table-striped table-bordered">
                          <thead>
                          <tr>
                              <th>Customer Number </th>

                              <th>Customer Name</th>
                              <th>Date of Registration</th>
                              <th>Date of Expiry</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Company</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php

                          $clients_query  = "SELECT * FROM sp_customers WHERE message = 0 AND renewal_date >= CURDATE() AND renewal_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY);";
                          $clients_res    = mysqli_query($connection,$clients_query);
                          $clients_count  =   mysqli_num_rows($clients_res);

                          ?>
                          <?php
                          if (mysqli_num_rows($clients_res) > 0) {

                              while($clients_row=mysqli_fetch_array($clients_res)) {
                                  $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];
                                  //$clients_mname = $clients_row['role'];
                                  $clients_company = $clients_row['company'];
                                  $commenced_date = $clients_row['commencement_date'];
                                  $expiry_date = $clients_row['renewal_date'];
                                  $clients_status = $clients_row['status'];
                                  $clients_phone= $clients_row['phone_no'];
                                  $clients_email= $clients_row['email_add'];

                                  $clients_id = $clients_row['id'];

                                  //
                                  $expire_date = date("d/m/Y", strtotime($expiry_date));
                                  $start_date= date("d/m/Y", strtotime($commenced_date));


                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td><?php echo $start_date; ?></td>
                                      <td><?php echo $expire_date; ?></td>
                                      <td ><a href="mailto:<?php echo $clients_email; ?>"> <?php echo $clients_email; ?></a></td>
                                      <td ><a href="tel:<?php echo $clients_phone; ?>"> <?php echo $clients_phone; ?></a></td>
                                      <td><?php echo $clients_company; ?></td>
                                      <td ><?php if($clients_status==1){
                                              ?>
                                              <span class="label label-success"><a href="delete.php?id=<?php echo $clients_id ?>&type=deactivate" style="color: #fff; text-decoration: none">Active</a> </span></span>

                                          <?php }else{
                                              ?>
                                              <span class="label label-danger"><a href="delete.php?id=<?php echo $clients_id ?>&type=activate" style="color: #fff; text-decoration: none">suspended</a></span>
                                              <?php
                                          } ?></td>
                                      <td width="15%"><div class="btn-group"><a href='edit-customer?id=<?php echo $clients_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                              &nbsp;<a href='delete?id=<?php echo $clients_id ?>&type=customers' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                             
                                          </div>
                                      </td>
                                  </tr>


                              <?php }
                          }  else {
                              echo 'No Records';
                          }

                          ?>


                          </tbody>
                      </table>
                  </div>
              </div>
              <div class="tab-pane fade" id="trash">
                  <div class="datatable">
                      <table class="table table-striped table-bordered">
                          <thead>
                          <tr>
                              <th>Customer Number </th>

                              <th>Customer Name</th>
                              <th>Date of Registration</th>
                              <th>Date of Expiry</th>
                              <th>Email</th>
                              <th>Phone Number</th>
                              <th>Company</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          $clients_query  = "select * from sp_customers WHERE status=0 ORDER BY id DESC";
                          $clients_res    = mysqli_query($connection,$clients_query);
                          $clients_count  =   mysqli_num_rows($clients_res);

                          ?>
                          <?php
                          if (mysqli_num_rows($clients_res) > 0) {

                              while($clients_row=mysqli_fetch_array($clients_res)) {

                                  $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];
                                  //$clients_mname = $clients_row['role'];
                                  $clients_company = $clients_row['company'];
                                  $commenced_date = $clients_row['commencement_date'];
                                  $expiry_date = $clients_row['renewal_date'];
                                  $clients_status = $clients_row['status'];
                                  $clients_phone= $clients_row['phone_no'];
                                  $clients_email= $clients_row['email_add'];

                                  $clients_id = $clients_row['id'];
                                  $expire_date = date("d/m/Y", strtotime($expiry_date));
                                  $start_date= date("d/m/Y", strtotime($commenced_date));
                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td><?php echo $start_date; ?></td>
                                      <td><?php echo $expire_date; ?></td>
                                      <td ><a href="mailto:<?php echo $clients_email; ?>"> <?php echo $clients_email; ?></a></td>
                                      <td ><a href="tel:<?php echo $clients_phone; ?>"> <?php echo $clients_phone; ?></a></td>
                                      <td><?php echo $clients_company; ?></td>
                                      <td ><?php if($clients_status==1){
                                              ?>
                                              <span class="label label-success"><a href="delete.php?id=<?php echo $clients_id ?>&type=deactivate" style="color: #fff; text-decoration: none">Active</a> </span></span>

                                          <?php }else{
                                              ?>
                                              <span class="label label-danger"><a href="delete.php?id=<?php echo $clients_id ?>&type=activate" style="color: #fff; text-decoration: none">suspended</a></span>
                                              <?php
                                          } ?></td>
                                      <td width="15%"><div class="btn-group"><a href='edit-customer?id=<?php echo $clients_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                              &nbsp;<a href='delete?id=<?php echo $clients_id ?>&type=customers' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                             
                                          </div>
                                      </td>
                                  </tr>


                              <?php }
                          }  else {
                              echo 'No Records';
                          }

                          ?>


                          </tbody>
                      </table>
                  </div>
              </div>
          </div>



      </div>
    </div>
    <!-- /default panel -->
            
      <!--footer-->
<?php require 'includes/footer.php'; ?>      
  </div>      
  </div>
        
        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>
        <script src="js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>

        <script>
            // Listen for click on toggle checkbox
            $('#select-all').click(function(event) {
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                }
            });
            $('.datepicker').datepicker();
        </script>
    </body>
</html>

