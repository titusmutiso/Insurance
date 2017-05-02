<?php
    require_once('AfricasTalkingGateway.php');
    //Your user credentials
     $username   = "Hannah.malla";
    $apikey     = "0c310a24191c130cdd3436cd374acdf093fd87793111d36a96d728f7e187830e";
    //The recipients for your message (Starting with country code e.g +254...)
	$recipients = array();
	
	//sql query
	
$sql = '';
$sms_query ="";
	
	foreach($phoneArr as $phone) {
 $recipients[] = array("phoneNumber"=>$phone, "amount"=>'KES ' . $amount);
 }
	
    $recipients = "+254-XXXXXXXXX,+254-XXXXXXXXXX";
    //The really good bit
    $message = "Trial Message";
    //Initialize the gateway class depending on whether you are testing or using the live account
    //Live
    $gateway = new AfricasTalkingGateway($username, $apikey);
    //Sandbox
    //$gateway = new AfricasTalkingGateway($username, $apikey, "sandbox");

    try { 
    // The send command. 
    $results = $gateway->sendMessage($recipients, $message);
    //Response from Africa's Talking        
        foreach($results as $result) {
        // status is either "Success" or "error message"
        echo " Number: " .$result->number;
        echo " Status: " .$result->status;
        echo " MessageId: " .$result->messageId;
        echo " Cost: "   .$result->cost."\n";
      }
    } catch ( AfricasTalkingGatewayException $e ) {
      echo "Encountered an error while sending: ".$e->getMessage();
    }

?>

<?php
<?php 
$con = mysql_connect("localhost","dbuser","dbpass"); // replace dbuser, dbpass with your db user and password
mysql_select_db("dbname", $con); // replace dbname with your database name
/*
To use this script database table must have three fields named sno, email and sub_status
*/
$query = "select sno, email from dbtable where sub_status = 'SUBSCRIBED'";
$result = mysql_query($query, $con);
$emails = array();
$sno = array();
while($row=mysql_fetch_assoc($result))
{
    $sno[] = $row['sno']; // this will be used to unsubscribe the user
    $emails[]=$row['email']; // email id of user
}
/* you can also get email id data from CSV using below code */
//$file =  file_get_contents("travel_database.csv"); 
//$emails = explode(",",$file);
/* count.txt is used to store current email sent number/count */
$count =  file_get_contents("count.txt");
for($i=$count;$i<count($emails);$i++)
{
    $to  = $emails[$i];
    // subject
    $subject = 'Set Your Title Here';
    // message
    $message = file_get_contents("sample.html"); // this will get the HTML sample template sample.html
    $message .= '<p><a href="http://yourdomain.com/path-to-folder/unsubscribe.php?id='.$sno[$i].'&username='.$emails[$i].'">Please click here to unsubscribe.</a></p>
    </body>
    </html>';
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Additional headers
    //$headers .= "To: $to" . "\r\n";
    $headers .= 'From: Name <info@yourdomain.com>' . "\r\n";
    //$headers .= 'Cc: sendcc@yourdomain.com' . "\r\n";
    //$headers .= 'Bcc: sendbcc@yourdomain.com' . "\r\n";
    // Mail it
    if(mail($to, $subject, $message, $headers)) {
        $file = fopen("mailsentlist.txt","a+"); // add email id to mailsentlist.txt to track the email sent
        fwrite($file, $to.",\r\n");
        fclose($file);
    }
    else
    {
        $file = fopen("notmailsentlist.txt","a+"); // add email to notmailsentlist.txt here which have sending email error
        fwrite($file, $to.",\r\n");
        fclose($file);
    }
    if(($i-$count)>=200) // this will send 200 mails from database per execution
    {   
        $filec = fopen("count.txt",'w'); // store current count to count.txt
        fwrite($filec, $i);
        fclose($filec);
        break;
    }
}//for end
$filec = fopen("count.txt",'w'); // store fine count to count.txt this will be used as a start point of next execution
fwrite($filec, $i);
fclose($filec);
?>