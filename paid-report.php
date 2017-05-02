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
          


             
      </div>
      </div>
      <div class="panel-body">

          
          <br>
          <div class="clearfix"></div>
         
          <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h4>Ksh. </h4>
                        <h3>
                            <?php
          //premium/balnce Calculation

        $premiums_query  = "SELECT sum(total_premium) FROM `premiums`";
        $premiums_res    = mysqli_query($connection,$premiums_query);
        while($premiums_row = mysqli_fetch_array($premiums_res)){
         $total_pays = $premiums_row['sum(total_premium)'];

            echo number_format($total_pays) ;
        }
?>
       
       

                        </h3>
                        <p>
                            Premium Amounts
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                   
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                       <h4>Ksh. </h4>
                        <h3>
                            <?php
          //premium/balnce Calculation

        $paid_query  = "SELECT sum(paid_premium) FROM `premiums`";
        $paid_res    = mysqli_query($connection,$paid_query);
        while($paid_row = mysqli_fetch_array($paid_res)){
         $paid_pays = $paid_row['sum(paid_premium)'];

            echo number_format($paid_pays) ;
        }
?>
       
       

                        </h3>
                        <p>
                            Total Paid
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                   
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                       <h4>Ksh. </h4>
                        <h3>
                            <?php
          //premium/balnce Calculation

        $balance_query  = "SELECT sum(balance) FROM `premiums`";
        $balance_res    = mysqli_query($connection,$balance_query);
        while($balance_row = mysqli_fetch_array($balance_res)){
         $balance_pays = $balance_row['sum(balance)'];

            echo number_format($balance_pays) ;
        }
?>
       
       

                        </h3>
                        <p>
                            Total Balances
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                    
                </div>
            </div><!-- ./col -->
             <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h4>Number</h4>
                        <h3>
                            <?php 
                            //select all with 0 or 1 status count
                            $pending_query = mysqli_query($connection,"SELECT * FROM premiums WHERE status = 0 OR status = 1");
                            $pending_count = mysqli_num_rows($pending_query);


                            echo $pending_count;
                            ?>
                        </h3>
                        <p>
                            Pending Payments
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                    
                </div>
            </div><!-- ./col -->
            </div>
          <div class="clearfix"></div>
          <ul id="userTab" class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab">All Payments</a>
              </li>
              <li><a href="#drafts" data-toggle="tab">Cleared Payments</a>
              </li>
              <li><a href="#month" data-toggle="tab">Balances</a>
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
                              <th>Premium</th>
                              <th>Paid Premium</th>
                              <th>Balance</th>
                              <th>Due Date</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          // select all from Payment table then foreign key to execute
                          $payment_query = mysqli_query($connection,"SELECT * FROM premiums ORDER BY id DESC");
                          //count if 0 no Records else Show Payments
                          $payment_count = mysqli_num_rows($payment_query);

                          if($payment_count ==0){
                            echo  'No Record found';
                          }else{
                            while($pay_row=mysqli_fetch_array($payment_query)){
                              $client_id = $pay_row['customer_id'];
                              $pay_id = $pay_row['id'];
                              $premium = $pay_row['total_premium'];
                              $paid_premium = $pay_row['paid_premium'];
                              $balance = $pay_row['balance'];
                              $date_paid = $pay_row['date_paid'];
                              $balance_date = $pay_row['balance_date'];
                              $pay_status = $pay_row['status'];
                              //dates
                              $paid_date = date("d/m/Y", strtotime($date_paid));
                              $due_date = date("d/m/Y", strtotime($balance_date));
                                //define status
                              if($pay_status ==0){
                                  $state = '<span class="label label-danger">Pay Overdue</span>';
                                 }else if($pay_status ==1){
                                  $state = '<span class="label label-warning">Pending Payment</span>';
                                 }else{
                                  $state = '<span class="label label-success">Cleared</span>';
                                 }
                                 //get customer names/ID & More
                                  $clients_query  = "SELECT * FROM sp_customers WHERE id = '$client_id'";
                                  $clients_res    = mysqli_query($connection,$clients_query);
                                  $clients_row=mysqli_fetch_array($clients_res);
                                   $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];

                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $client_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td>KSH. <?php echo number_format($premium) ?></td>
                                      <td>KSH. <?php echo number_format($paid_premium); ?></td>
                                      <td>KSH. <?php echo  number_format($balance) ?></td>
                                      <td><?php echo  $due_date ?></td>
                                      <td><?php echo  $state ?></td>
                                     
                                      
                                      
                                      
                                      <?php 
                                      if($pay_status ==2){
                                        ?>
                                        <td width="15%">
<div class="btn-group"><a href='view-customer?id=<?php echo $client_id ?>' data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> </a>
  </div>
                                      </td>
                                      <?php }else{
//update state
                                        ?>
                                         <td width="15%"><div class="btn-group"><a data-toggle="modal" data-target="#update_pay" data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-dollar"></i> </a>
                                             
                                          </div>
                                      </td>

                                        <?php

                                      }
                                      ?>
                                      
                                             
                                        
                                  </tr>


                                  <?php

                            }
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
                              <th>Premium</th>
                              <th>Paid Premium</th>
                              <th>Balance</th>
                              <th>Due Date</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          // select all from Payment table then foreign key to execute
                          $payment_query = mysqli_query($connection,"SELECT * FROM premiums WHERE status=2");
                          //count if 0 no Records else Show Payments
                          $payment_count = mysqli_num_rows($payment_query);

                          if($payment_count ==0){
                            echo  'No Record found';
                          }else{
                            while($pay_row=mysqli_fetch_array($payment_query)){
                              $client_id = $pay_row['customer_id'];
                              $pay_id = $pay_row['id'];
                              $premium = $pay_row['total_premium'];
                              $paid_premium = $pay_row['paid_premium'];
                              $balance = $pay_row['balance'];
                              $date_paid = $pay_row['date_paid'];
                              $balance_date = $pay_row['balance_date'];
                              $pay_status = $pay_row['status'];
                              //dates
                              $paid_date = date("d/m/Y", strtotime($date_paid));
                              $due_date = date("d/m/Y", strtotime($balance_date));
                                //define status
                              if($pay_status ==0){
                                  $state = '<span class="label label-danger">Pay Overdue</span>';
                                 }else if($pay_status ==1){
                                  $state = '<span class="label label-warning">Pending Payment</span>';
                                 }else{
                                  $state = '<span class="label label-success">Cleared</span>';
                                 }
                                 //get customer names/ID & More
                                  $clients_query  = "SELECT * FROM sp_customers WHERE id = '$client_id'";
                                  $clients_res    = mysqli_query($connection,$clients_query);
                                  $clients_row=mysqli_fetch_array($clients_res);
                                   $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];

                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $client_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td>KSH. <?php echo number_format($premium) ?></td>
                                      <td>KSH. <?php echo number_format($paid_premium); ?></td>
                                      <td>KSH. <?php echo  number_format($balance) ?></td>
                                      <td><?php echo  $due_date ?></td>
                                      <td><?php echo  $state ?></td>
                                     
                                      
                                      
                                  <?php 
                                      if($pay_status ==2){
                                        ?>
                                        <td width="15%">
<div class="btn-group"><a href='view-customer?id=<?php echo $client_id ?>' data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> </a>
  </div>
                                      </td>
                                      <?php }else{
//update state
                                        ?>
                                         <td width="15%"><div class="btn-group"><a data-toggle="modal" data-target="#update_pay" data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-dollar"></i> </a>
                                             
                                          </div>
                                      </td>

                                        <?php

                                      }
                                      ?>
                                      
                                  </tr>


                                  <?php

                            }
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
                              <th>Premium</th>
                              <th>Paid Premium</th>
                              <th>Balance</th>
                              <th>Due Date</th>
                              <th>Status</th>
                              <th>Actions</th>
                          </tr>
                          </thead>

                          <?php
                          // select all from Payment table then foreign key to execute
                          $payment_query = mysqli_query($connection,"SELECT * FROM premiums WHERE status=1");
                          //count if 0 no Records else Show Payments
                          $payment_count = mysqli_num_rows($payment_query);

                          if($payment_count ==0){
                            echo  'No Record found';
                          }else{
                            while($pay_row=mysqli_fetch_array($payment_query)){
                              $client_id = $pay_row['customer_id'];
                              $pay_id = $pay_row['id'];
                              $premium = $pay_row['total_premium'];
                              $paid_premium = $pay_row['paid_premium'];
                              $balance = $pay_row['balance'];
                              $date_paid = $pay_row['date_paid'];
                              $balance_date = $pay_row['balance_date'];
                              $pay_status = $pay_row['status'];
                              //dates
                              $paid_date = date("d/m/Y", strtotime($date_paid));
                              $due_date = date("d/m/Y", strtotime($balance_date));
                                //define status
                              if($pay_status ==0){
                                  $state = '<span class="label label-danger">Pay Overdue</span>';
                                 }else if($pay_status ==1){
                                  $state = '<span class="label label-warning">Pending Payment</span>';
                                 }else{
                                  $state = '<span class="label label-success">Cleared</span>';
                                 }
                                 //get customer names/ID & More
                                  $clients_query  = "SELECT * FROM sp_customers WHERE id = '$client_id'";
                                  $clients_res    = mysqli_query($connection,$clients_query);
                                  $clients_row=mysqli_fetch_array($clients_res);
                                   $clients_number = $clients_row['cust_number'];
                                  $clients_names = $clients_row['full_names'];

                                  ?>
                                  <tr>
                                      <td><?php echo  $clients_number ?> </td>
                                      <td><a href='view-customer?id=<?php echo $client_id ?>'><?php echo $clients_names; ?></a></td>
                                      <td>KSH. <?php echo number_format($premium) ?></td>
                                      <td>KSH. <?php echo number_format($paid_premium); ?></td>
                                      <td>KSH. <?php echo  number_format($balance) ?></td>
                                      <td><?php echo  $due_date ?></td>
                                      <td><?php echo  $state ?></td>
                                     
                                      
                                      
                                      <?php 
                                      if($pay_status==2){
                                        ?>
                                        <td width="15%">
<div class="btn-group"><a href='view-customer?id=<?php echo $client_id ?>' data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> </a>
  </div>
                                      </td>
                                      <?php }else{
//update state
                                        ?>
                                         <td width="15%"><div class="btn-group"><a data-toggle="modal" data-target="#update_pay" data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-dollar"></i> </a>
                                             
                                          </div>
                                      </td>

                                        <?php

                                      }
                                      ?>
                                      
                                  </tr>


                                  <?php

                            }
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

<!--Modal update Pay -->

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

