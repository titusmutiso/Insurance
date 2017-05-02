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

