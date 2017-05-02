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

//contact id
$get_id = $_GET['id'];
//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
require 'includes/functions.php';
//page name
$mainpage ='customers';
$page = 'customers';


require_once('AfricasTalkingGateway.php');


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
        <?php
        //brand
        $view_result = mysqli_query($connection,"SELECT * FROM sp_customers WHERE id ='$get_id'");

        // display records if there are records to display

        $view_row=mysqli_fetch_array($view_result);

        $customer_number = $view_row['cust_number'];
        $client_fname = $view_row['first_name'];
        $client_mname = $view_row['middle_name'];
        $client_lname = $view_row['last_name'];
        $client_fullname = $view_row['full_names'];
        $client_commence = $view_row['commencement_date'];
        $client_expiry = $view_row['renewal_date'];
        //$client_policy = $view_row['type_of_policy'];
        $client_company = $view_row['company'];
        $client_email = $view_row['email_add'];
        $client_phone = $view_row['phone_no'];
        $client_status = $view_row['status'];
        $date_created= $view_row['date_created'];
         $cover= $view_row['cover'];
         $premium= $view_row['premium'];
        $names = $view_row['first_name']." ".$view_row['last_name'];

        ?>
        <!-- Default panel -->
        <div class="panel panel-default">
      <div class="panel-heading">
          <div class="col-md-12">
        <h6 class="panel-title">Customer Information</h6>
          


             
      </div>
      </div>
      <div class="panel-body">
      <!--Tabs Here-->
      <div class="row">
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h5>Messages </h5>
                        <h4>
                            <?php
          //premium/balnce Calculation

        $messages_query  = "SELECT *FROM `sp_message` WHERE customer_id='$get_id'";
        $message_res    = mysqli_query($connection,$messages_query);
        $message_count = mysqli_num_rows($message_res);

        echo $message_count;
        
?>
       
       

                        </h4>
                        <p>
                          
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                   
                </div>
            </div><!-- ./col -->
             <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h5>Policies </h5>
                        <h4>
                            <?php
          //premium/balnce Calculation

        $policy_query  = "SELECT * FROM `sp_policies` WHERE customer_id='$get_id'";
        $policy_res    = mysqli_query($connection,$policy_query);
        $policy_count = mysqli_num_rows($policy_res);
        

       


        echo number_format($policy_count);
        
?>
       
       

                        </h4>
                        <p>
                          
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
                    <h5>Total Premiums </h5>
                        <h4>KSH.
                            <?php
          //premium/balnce Calculation

        $total_query  = "SELECT sum(total_premium) FROM `premiums` WHERE customer_id='$get_id'";
        $total_res    = mysqli_query($connection,$total_query);
        //$message_count = mysqli_num_rows($message_res);
        $total_row = mysqli_fetch_array($total_res);

        $premium_total = $total_row['sum(total_premium)'];


        echo number_format($premium_total);
        
?>
       
       

                        </h4>
                        <p>
                          
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                   
                </div>
            </div><!-- ./col -->
            <div class="col-lg-2 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h5>Paid Premiums </h5>
                        <h4>KSH.
                            <?php
          //premium/balnce Calculation

        $paid_query  = "SELECT sum(paid_premium) FROM `premiums` WHERE customer_id='$get_id'";
        $paid_res    = mysqli_query($connection,$paid_query);
        //$message_count = mysqli_num_rows($message_res);
        $paid_row = mysqli_fetch_array($paid_res);

        $paid_total = $paid_row['sum(paid_premium)'];


        echo number_format($paid_total);
        
?>
       
       

                        </h4>
                        <p>
                          
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
                    <h5>Balance Premiums </h5>
                        <h4>KSH.
                            <?php
          //premium/balnce Calculation

        $balance_query  = "SELECT sum(balance) FROM `premiums` WHERE customer_id='$get_id'";
        $balance_res    = mysqli_query($connection,$balance_query);
        //$message_count = mysqli_num_rows($message_res);
        $balance_row = mysqli_fetch_array($balance_res);

        $balance_total = $balance_row['sum(balance)'];


        echo number_format($balance_total);
        
?>
       
       

                        </h4>
                        <p>
                          
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                   
                </div>
            </div><!-- ./col -->
            </div>
            <div class="clearfix"></div>

            <br>
            <hr>
            <!--Tabs Account Information-->
            <ul id="userTab" class="nav nav-tabs">
              <li class="active"><a href="#account" data-toggle="tab">Account Information</a>
              </li>
              <li><a href="#messages" data-toggle="tab">Messages</a>
              </li>
                <li><a href="#premiums" data-toggle="tab">Premiums</a>
                </li>
          </ul>

          <div id="userTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="account">
            <div class="row">

            <div class="col-lg-2">
                <!-- Profile links -->
                <div class="block">
                    <div class="block">
                        <br>
                        <br>
                        <div class="thumbnail">
                            <div class="thumb">
                                <?php
                                if(empty($users_image)){
                                    ?>

                                    <img alt="" src="http://static.bleacherreport.net/images/redesign/avatars/default-user-icon-profile.png">
                                    <?php

                                }else {
                                    ?>
                                    <img alt="" src="<?php echo $users_image ?>">
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="caption text-center">
                                <h6><?php echo $names ?> <small>

                                    </small></h6>
                                    <!--modal for SMS -->
                            <a data-toggle="modal" data-target="#sendSms" class="btn btn-danger btn-xs">Send SMS</a>
                                    <!--Modal SMS -->

                                  <a href='edit-customer?id=<?php echo $get_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"> Edit </a>
                            </div>
                        </div>
                    </div>



                </div>
                <?php

                ?>
                <!-- /profile links -->
            </div>
            <div class="col-lg-10">
                  <!-- Statistics -->
                            <div class="block">

                                <br>
                                <br>

                                <h6 class="heading-hr"><i class="icon-settings"></i> Customer Details</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6">
                                        <h4>Contact Details</h4>
                                        <table class="table table-responsive table-condensed table-stripped table-bordered">
                                            <tr>
                                                <td>Customer Number</td><td><strong><?php echo  $customer_number  ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Full Names</td><td><strong><?php echo  $client_fullname ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Phone Number</td><td><a href="tel:<?php echo  $client_phone?>"><?php echo  $client_phone?></a></td>
                                            </tr>
                                            <tr>
                                                <td>Email </td><td><a href="mailto:<?php echo $client_email ?>"><?php echo  $client_email ?></a></td>
                                            </tr>
                                            <tr>
                                                <td>Date Registered </td><td><?php echo  $date_created ?></td>
                                            </tr>
                                            
                                        </table>



                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <h4>Policy Status</h4>
                                        <table class="table table-responsive table-condensed table-stripped table-bordered">
                                            <?php
                                            //Select From premiums
                                            ?>

                                            <tr>
                                                <td>Commenced On</td><td><strong><?php echo  $client_commence?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Expiry Date</td><td><?php echo  $client_expiry?></td>
                                            </tr>
                                            <tr>
                                                <td>Company</td><td><?php echo  $client_company ?></td>
                                            </tr>
                                            <tr>
                                                <td>Insurance Cover</td><td><?php 
                                  if($cover ==1){

                                    echo"CAR";

                                  }else if($cover ==2){
                                    echo"Medical";

                                  }else{
                                    echo"House";

                                  }

                              ?></td>
                                            </tr>

                                        </table>
                                        <?php
                                        //policies Table
                                        $policy_result = mysqli_query($connection,"SELECT * FROM sp_policies WHERE customer_id ='$get_id'");

                                        // display records if there are records to display
                                        ?>
                                        <table  class="table table-responsive table-bordered">
                                            <?php
                                            while($policy_row=mysqli_fetch_array($policy_result)){
                                            //list all policies
                                            $policy_name = $policy_row['policy'];
                                            ?>
                                            <tr>
                                                <td><?php echo  $policy_name ?></td>
                                            </tr>
                                                <?php
                                            }

                                            ?>
                                        </table>



                                    </div>
                                </div>
                            </div>
            </div>
            </div>
             </div>

             
              
              <div class="tab-pane fade in" id="messages">
                  <br>
                  <br>
              <?php //messages table


              ?>
                  <div class="block">
                  <div class="row">
                      <div class="col-md-2">
                          <!--links here -->
                          <a data-toggle="modal" data-target="#sendSms" class="btn btn-danger btn-xs">Send SMS</a>
                          <!--Modal SMS -->

                          <a href='edit-customer?id=<?php echo $get_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"> Edit </a>

                      </div>
                      <div class="col-md-10">
                          <div class="datatable">
                              <table class="table table-stripped table-responsive table-bordered">
                                  <thead>
                                  <tr>
                                      <th>Message</th>
                                      <th>Date Dispatched</th>
                                  </tr>
                                  </thead>
                                  <?php
                                  if($message_count ==0){
                                      echo 'No records found';
                                  }else{
//variables
                                      while ($message_row = mysqli_fetch_array($message_res)){
                                          $message_body = $message_row['message_body'];
                                          $date_dispatched = $message_row['date_send'];
                                          ?>
                                          <tr>
                                              <td><?php echo $message_body ?></td>
                                              <td><?php echo  $date_dispatched?></td>

                                          </tr>

                                          <?php
                                      }
                                  }

                                  ?>

                              </table>
                          </div>
                      </div>
                  </div>
              </div>

              </div>
              <div class="tab-pane fade in" id="premiums">
                  <br>
                  <br>
                  <?php //messages table


                  ?>
                  <div class="block">
                      <div class="row">
                          <div class="col-md-2">
                              <!--Modal Links Here-->

                              <!--links here -->
                              <div class="btn-group">
                                  <a data-toggle="modal" data-target="#sendSms" class="btn btn-danger btn-xs">Send SMS</a>
                              </div>

                              <!--Modal SMS -->

                              <a href='edit-customer?id=<?php echo $get_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"> Edit </a>

                          </div>
                          <div class="col-md-10">
                              <div class="datatable">
                                  <table class="table table-stripped table-responsive table-bordered">
                                      <thead>
                                      <tr>
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
                          $payment_query = mysqli_query($connection,"SELECT * FROM premiums WHERE customer_id='$get_id'");
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
                                              ?>
                                              <tr>
                                                  <td>KSH. <?php echo number_format($premium) ?></td>
                                                  <td>KSH. <?php echo number_format($paid_premium); ?></td>
                                                  <td>KSH. <?php echo  number_format($balance) ?></td>
                                                  <td><?php echo  $due_date ?></td>
                                                  <td><?php echo  $state ?></td>

                                                  <?php
                                                  if($pay_status ==2){
                                                      ?>
                                                      <td width="15%">
                                                          <div class="btn-group"><a href='customers' data-toggle="tooltip" title="Update Pay" data-placement="top" class="btn btn-success btn-xs">Back to Customers </a>
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

                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
              </div>



      </div>
      </div>
        <!-- Profile grid -->
        

            <!-- /profile grid -->

            <!--footer-->
            <?php require 'includes/footer.php'; ?>
        </div>
    </div>

    <!-- end Page container -->
    <!--JS-->
    <?php require 'includes/js.php';?>
</body>
</html>


<!--SMS-->

<!--Send SMS-->
<div class="modal fade" id="sendSms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Custom SMS</h4>
            </div>
            <div class="modal-body">
                <?php
                //update payment, status, date paid
                if(isset($_POST['send'])){
                    //Your user credentials
                    $username   = "Hannah.malla";
                    $apikey     = "0c310a24191c130cdd3436cd374acdf093fd87793111d36a96d728f7e187830e";

                    $recipients = $client_phone;
                    $customer_id =$get_id;
                    //message date
                    $message = $_POST['message'];

                    // Specify your AfricasTalking shortCode or sender id
                    $from = "EXPATAGENCY";
                    //Initialize the gateway class depending on whether you are testing or using the live account
                    //Live
                    $gateway = new AfricasTalkingGateway($username, $apikey);
                    try {
                        // The send command.
                        $results = $gateway->sendMessage($recipients, $message, $from);
                        //Response from Africa's Talking
                        //
                        //echo $count;
                        //echo " Status: " .$results->status;
                        foreach($results as $result) {
                            // status is either "Success" or "error message"

                            //echo " Number: " .$result->number;
                            // echo " Status: " .$result->status;
                            echo "<script language = javascript>
                swal({  title: 'Message Sent ',
                 text: 'Message Was Send Successfully',  
                type: 'success', 
                timer :4000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'view-customer.php?id=".$get_id."';  
                    });
                     });
            </script>";
                            //custom Messages Here table
                            mysqli_query($connection,"INSERT INTO `sp_message`(`id`, `customer_id`, `message_body`, `date_send`) VALUES (NULL,'$get_id','$message',NOW())");

                            //if success update message to 1
                            //mysqli_query($connection,"UPDATE sp_customers SET message = 0 WHERE id='$customer_id'; ");

                            // echo " MessageId: " .$result->messageId;
                            // echo " Cost: "   .$result->cost."\n";
                            //header("Location:view-customer?id=".$get_id);
                        }
                    } catch ( AfricasTalkingGatewayException $e ) {
                        //echo "Encountered an error while sending: ".$e->getMessage();

                        echo "<script language = javascript>
                swal({  title: 'Message Error ',
                 text: 'Encountered an error while sending".$e->getMessage()."',  
                type: 'error', 
                timer :4000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'view-customer.php?id=".$get_id."';  
                    });
                     });
            </script>";

                    }
                    mysqli_close($connection);

                }


                ?>


                <form role="form" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="customer_id" value="<?php echo $get_id ?>">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Slide-title">Full Names</label>
                            <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" value="<?php echo $client_fullname ?>">
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Slide-title">Message</label>
                            <textarea name="message" class="form-control"></textarea>

                        </div>
                    </div>




                    <div class="clearfix"></div>






                    <div class="modal-footer">

                        <button type="submit" name="send" class="btn btn-primary  btn-square">Submit</button>


                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>



<!--End of SMS-->

<!--Payment-->
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
                    <input type="hidden" name="customer_id" value="<?php echo $get_id ?>">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="Slide-title">Full Names</label>
                            <input type="text" name="f_name" class="form-control" id="exampleInputEmail1" value="<?php echo $client_fullname ?>">
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



<!--Ene of Payment -->