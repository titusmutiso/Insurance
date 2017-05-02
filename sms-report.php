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

                
                <br>
                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-lg-3 col-sm-12 col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h4>Messages Dispatched </h4>
                                <h3>
                                    <?php
                                    //premium/balnce Calculation

                                    $sms_query  = "SELECT * FROM `sp_message`";
                                    $sms_res    = mysqli_query($connection,$sms_query);
                                   
                                   $sms_count = mysqli_num_rows($sms_res);

                                   echo  $sms_count;
                                    ?>



                                </h3>
                                <p>
                                   
                                </p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-bag"></i>
                            </div>

                        </div>
                    </div><!-- ./col -->
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="btn-group pull-right">
                            <a data-toggle="modal" data-target="#sendSms" class="btn btn-primary">Single/Bulk Custom SMS</a>
                            <!--<a href="" class="btn btn-success">Custom Bulk SMS</a>-->
                        </div>



                </div>
                <div class="clearfix"></div>


                        <div class="datatable">
                            <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Customer Number </th>
                                    <th>Customer Name</th>
                                    <th>SMS body</th>
                                    <th>Date Dispatched</th>

                                </tr>
                                </thead>

                                <?php


                                if($sms_count ==0){
                                    echo  'No Record found';
                                }else{
                                    while($sms_row=mysqli_fetch_array($sms_res)){
                                        $client_id = $sms_row['customer_id'];
                                        $sms_id = $sms_row['id'];
                                        $sms_body= $sms_row['message_body'];
                                        $sms_date= $sms_row['date_send'];

                                        //dates
                                        $dispatch_date = date("d/m/Y", strtotime($sms_date));
                                        //define status

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
                                            <td><?php echo $sms_body ?></td>
                                            <td><?php echo $dispatch_date ?></td>




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
               if($_POST){
    //SMS Login
                    $username   = "Hannah.malla";
                    $apikey     = "0c310a24191c130cdd3436cd374acdf093fd87793111d36a96d728f7e187830e";

                            $id_num =implode(',',$_POST['numbers']);
                            $ids = $_POST['numbers'];
                            
                            //remove spaces
                            
                            
                        //select all
                          
                        $recipients_sql = mysqli_query($connection,"SELECT * FROM sp_customers WHERE id  IN('".implode("','", $ids)."')");
                        //$recipients = array();
                        while($recipients_row = mysqli_fetch_array($recipients_sql)){

                        $addresses[] = $recipients_row['phone_no'];

                       // $recipients = $dest[];
                        
                         $message = $_POST['message'];
              
                         }
                         $final_numbers= explode(",",str_replace(' ', '', $id_num));
                             for($i=0; $i< count($final_numbers); $i++){
                                 $final_numbers[$i];
                               
                              $sqli= mysqli_query($connection,"INSERT INTO `sp_message`(`id`, `customer_id`, `message_body`, `date_send`) VALUES (NULL,'$final_numbers[$i]','$message',NOW())");

                         }
                          $recipients =implode(",",$addresses);
                         //echo $rec_count = count($recipients);
                          $message ;
                          $from = "EXPATAGENCY";
                        //Initialize the gateway class depending on whether you are testing or using the live account
                        //Live
                        $gateway = new AfricasTalkingGateway($username, $apikey);
                        try {
                            // The send command.
                            $results = $gateway->sendMessage($recipients, $message, $from);
                            //Response from Africa's Talking

                            foreach ($results as $result) {

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
                        location = 'sms-report';  
                    });
                     });
            </script>";  
        }
                        } catch (AfricasTalkingGatewayException $e) {
                            //echo "Encountered an error while sending: ".$e->getMessage();

                            echo "<script language = javascript>
                swal({  title: 'Message Error ',
                 text: 'Encountered an error while sending" . $e->getMessage() . "',  
                type: 'error', 
                 
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'sms-report';  
                    });
                     });
            </script>";

                        }
                    }
           


                ?>
                <form role="form" method="post" action="" enctype="multipart/form-data">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="Slide-title">Full Names</label>
                            <select  class="form-control selectpicker" required multiple data-live-search="true" name="numbers[]" >
                                <option disabled>Select Numbers</option>
                                <?php
                                //select Users/customers
                                $clients_query  = "select * from sp_customers ORDER BY id DESC";
                                $clients_res    = mysqli_query($connection,$clients_query);
                                $clients_count  =   mysqli_num_rows($clients_res);
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

                                        <option value="<?php echo $clients_id ?>"><?php echo $clients_names ?></option>
                                    <?php }
                                }  else {
                                    ?>
                                    <option>No Records to Select</option>

                                <?php  }

                                ?>

                            </select>

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

                        <button type="submit" name="dispatch" class="btn btn-primary  btn-square">Submit</button>


                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!--End of SMS-->