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
$mainpage = 'customers';
$page = 'customers';


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
        <h6 class="panel-title">Customers</h6>
          <span class="pull-right">
        <span class="pull-right">
              <div class="btn-group">

              <a href="export_excel?type=all" class="btn btn-primary"> Export All Policies </a>
                  <a href="export_excel?type=active" class="btn btn-success"> Export Active Policies</a>
                  <a href="export_excel?type=expired" class="btn btn-danger">Export Expired Policies</a>
                  <a href="sms-test" class="pull-right btn btn-default">SMS Expiring in a Month</a>

          </div>

              <?php echo date('l') .' '.date('d').', '.date('Y'); ?>
          </span>
      </div>

      </div>
      <div class="panel-body">
          <div class="datatable">
              <table class="table table-striped table-bordered">
                  <thead>
                  <tr>


                      <th>Customer #</th>
                      <th>Customer Name</th>
                      <th>Date of Registration</th>
                      <th>Date of Expiry</th>
                      <th>Cover</th>
                     
                      <th>Phone Number</th>
                      <th>Company</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                  </thead>

                  <?php
                 $clients_query  = "select * from sp_customers ORDER BY id DESC";
                // $clients_query  = "SELECT * FROM sp_customers WHERE renewal_date >= CURDATE() - INTERVAL 30 DAY";
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
                          $cover= $clients_row['cover'];

                          $clients_id = $clients_row['id'];

                          ?>
                          <tr>
                              <td><?php echo  $clients_number ?> </td>
                              <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                              <td><?php echo $commenced_date; ?></td>
                              <td><?php echo $expiry_date; ?></td>
                              <td><?php 
                                  if($cover ==1){

                                    echo"CAR";

                                  }else if($cover ==2){
                                    echo"Medical";

                                  }else{
                                    echo"House";

                                  }

                              ?></td>
                              
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
    <!-- /default panel -->
            
      <!--footer-->
<?php require 'includes/footer.php'; ?>      
  </div>      
  </div>
        
        <!-- end Page container -->
        <!--JS-->
        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>
        <script>
            //DataTables Initialization
            $(document).ready(function() {
                $('#example-table').dataTable();
            });
            $(document).ready(function() {
                $('#ongoing-table').dataTable();
            });
            $(document).ready(function() {
                $('#completed-table').dataTable();
            });

        </script>
    </body>
</html>

<div class="modal fade" id="update_pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Payments</h4>
            </div>
            <div class="modal-body">
            <?php
            //update payment, status, date paid
            if(isset($_POST['save'])){

              //variables
              $balance_amount = $_POST['paid-premiums'];
              $paid_amount = $_POST['paid'];
              //$customer_id = $_POST['customer_id'];
              //balance after pay
              $payed_premium= $balance_amount + $paid_amount;
              $premium_p = $_POST['premium'];
              $balance_now = $_POST['premium'] - $payed_premium;


             // $calcualte_balance = $paid_amount - $balance_amount;
              //if amount paid minus former balance =0 or greater update status to 2 - cleared, if not 1 pending
              if($payed_premium == $premium_p){
                $pay_state = 2;
              }else{
                $pay_state = 1;
              }

              $sql ="UPDATE `premiums` SET `paid_premium`='$payed_premium',`balance`='$balance_now',`balance_date`=NOW(),`status`='$pay_state' WHERE `customer_id` = '$client_id'";

              if(mysqli_query($connection,$sql)===TRUE){
               echo "<script language = javascript>
                swal({  title: 'Payment ',
                 text: 'Payment Updated Successfully',  
                type: 'success', 
                timer :3000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'paid-report.php';  
                    });
                     });
            </script>";
              }else{
                 echo "<script language = javascript>
                swal({  title: 'Payment ',
                 text: 'Error While Updating',  
                type: 'error', 
                timer :3000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'paid-report.php';  
                    });
                     });
            </script>";
              }


            }

            ?>
            
                <form role="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="customer_id" value="<?php echo $client_id ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Slide-title">Full Names</label>
                            <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" value="<?php echo $clients_names ?>">
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Slide-title">Premium</label>
                            <input type="text" name="premium" class="form-control" id="exampleInputEmail1" value="<?php echo $premium ?>">
                        </div>
                    </div>
                    <div class="col-lg-4">

                        <div class="form-group">
                            <label for="Slide-title">Total Paid</label>

                            <input class="form-control" type="text" name="paid-premiums" value="<?php echo  $paid_premium?>" />

                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Slide-title">Balance</label>
                            <input type="text" name="balance" class="form-control" id="exampleInputEmail1" value="<?php echo  $balance?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Slide-title">Enter Payment here</label>
                            <input type="text" name="paid" class="form-control" id="exampleInputEmail1" placeholder="Enter Payment Amount">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    
                    


                   

            <div class="modal-footer">

                        <button type="submit" name="save" class="btn btn-primary  btn-square">Submit</button>
                  
             
                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                   </form>
                
            </div>
        </div>
    </div>
</div>