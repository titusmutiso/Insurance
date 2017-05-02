<?php
//DECLARE id_nums bigint[];
//id_nums :=  ARRAY(select cust_id from Customers WHERE name = CName);
//DECLARE id_num bigint;

//FOR id_num in select cust_id from Customers WHERE name = CName LOOP
 // your code here
//END LOOP;
require 'includes/config.php';
require_once('AfricasTalkingGateway.php');

require 'includes/css.php';
require 'includes/js.php';

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
                        location = 'sms-report.php';  
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
                        location = 'sms-report.php';  
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