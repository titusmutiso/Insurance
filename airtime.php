<?php
// Save this code in clientAirtime.php. Configure the callback URL for your phone number
// to point to the location of this script on the web
// e.g http://www.yoursite.com/clientAirtime.php
//ensure $table variable that holds our table if empty, for repeated use
$table = "";
//Check if the form has sent POST data
if(isset($_POST['number'])) {
//require DB and Gateway
require_once "AfricasTalkingGateway.php";
 require_once('DBConn.php');
// Specify your login credentials
 $user = "iamuser";
 $api = "680fdfa9eae83b8649c7d3884adkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk1dcb68";
//Try to send to the gateway over the internet
try{
 $gateway = new AfricasTalkingGateway($user, $api);
 $phone = $_POST['number'];
 $amount = $_POST['amount'];
 $phoneArr = explode(',', $phone);
 $recipients = array();
//store array array in object variable
foreach($phoneArr as $phone) {
 $recipients[] = array("phoneNumber"=>$phone, "amount"=>'KES ' . $amount);
 }
//JSON encode and hit the gateway
 $rec = json_encode($recipients);
 $results = $gateway->sendAirtime($rec);
 
 //Create insert values by looping the individual 
 //elements of the results array, allowing for persisting of many phone numbers
 $insert = "";
 foreach($results as $result) {
 $insert .= ",('".$result->status."','".$result->amount."','".$result->phoneNumber."','".$result->requestId."')";
 }
//eliminate the preceeding , and take the rest of the string
 $insertFinal = substr($insert, 1);
 //$insert should hold string like "('Success','KES XX', '+25477XXXYYY', '22222XX'),('Success','KES XX', '+25477ZZZYYY', '22222XX')"
//Persist $results =============
//Check if user posted a number to be topped up
 if($insert != '') {
 $subScriberSql = "INSERT INTO `".$sendTable."` (`status`,`amount`,`phoneNumber`,`requestId`)";
 $subScriberSql.= "VALUES " . $insertFinal;
//persist in db 
 if($dbConnection->query($subScriberSql))
 {
 error_log(print_r($POST,true));
 }
//===================
//Assemble the table and pass to variable; first the header, then assemble the data using a loop in the <td></td>
$table = "<table width='40%' border='1'><tr><th>Phone number</th><th>Amount</th><th>ErrorMessage</th></tr>";
foreach($results as $res) {
$table .= "<tr><td>" . $res->phoneNumber . "</td><td>" . $res->amount . "</td><td>" . $res->errorMessage . "</td></tr>";
 }
//end table with tag
 $table .= "</table>";
}
}
//complete with catch
 catch (AfricasTalkingGatewayException $e){
 echo $e->getMessage();
 }
}
?>
//Now we set up a simple form
<html>
<div>
 <form name="form" method="post" action="#">
 <table>
 <tr><td>Phone number:</td><td> <input type="text" name="number"/></td></tr>
 <tr><td>Amount:</td><td><input type="number" name="amount"/></td></tr>
 <tr><td/><td><input type="submit" value="submit"/></td></tr>
 </table>
 </form>
</div>
<div>
<?php echo $table;?>
</div>
</html>
And that's it. You should have a form that accepts numbers in the format +254722123456, +254733987654 and amount.