<?php
require'includes/config.php';
$get_id = $_GET['id'];

// select all from Payment table then foreign key to execute
                          $payment_query = mysqli_query($connection,"SELECT * FROM premiums WHERE customer_id ='$get_id'");
                          $pay_row=mysqli_fetch_array($payment_query);
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

              $sql ="UPDATE `premiums` SET `paid_premium`='$payed_premium',`balance`='$balance_now',`balance_date`=NOW(),`status`='$pay_state' WHERE `customer_id` = '$get_id'";

              if(mysqli_query($connection,$sql)===TRUE){
                echo  'Success';
                echo $balance_amount;echo'alredy pre<br>';
                echo $paid_amount;echo 'entered <br>';
                echo $payed_premium; echo 'paid prem<br>';
                echo $premium_p; echo 'premium <br>';
                echo $balance_now; echo 'balance <br>';
                echo $pay_state;
              }else{
                echo 'Error';
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