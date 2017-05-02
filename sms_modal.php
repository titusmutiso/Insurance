
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

