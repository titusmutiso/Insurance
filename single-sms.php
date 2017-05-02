<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location: index");
}
$login_session=$_SESSION['login_user'];
$user_id = $_SESSION['id'];

$get_id = $_GET['id'];

require 'includes/config.php';
require_once('AfricasTalkingGateway.php');
//Your user credentials
$username   = "Hannah.malla";
$apikey     = "0c310a24191c130cdd3436cd374acdf093fd87793111d36a96d728f7e187830e";

?>

<?php

$result2 = mysqli_query($connection,"SELECT * FROM sp_customers WHERE id = '$get_id'");
//$recipients = array();

$row = mysqli_fetch_array($result2);

$recipients = $row['phone_no'];
$customer_id =$row['id'];
$dates =$row['renewal_date'];

    //message date
    $message = "Dear Client, Kindly note your insurance cover is expiring on ".$dates.".Please make arrangements to renew early in advance. Asante for your support. Expat Insurance Agencies Nairobi";

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
            echo " Status: " .$result->status;

            //if success update message to 1
            mysqli_query($connection,"UPDATE sp_customers SET message = 0 WHERE id='$customer_id'; ");

            // echo " MessageId: " .$result->messageId;
            // echo " Cost: "   .$result->cost."\n";
            header("Location:view-customer?id=".$get_id);
        }
    } catch ( AfricasTalkingGatewayException $e ) {
        echo "Encountered an error while sending: ".$e->getMessage();

}
mysqli_close($connection);
?>

