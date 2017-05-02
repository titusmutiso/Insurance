<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'includes/config.php';


?>
<?php

$result2 = mysqli_query($connection,"SELECT * FROM sp_clients WHERE status= 1");
while($row = mysqli_fetch_array($result2))
{
$to = $row['clients_email'];
$subject = "New Bulk";
$emailBody="";
$emailBody .= "ID: ".$row['id']."; Names: ".$row['client_names']."; Dates:      ".$row['renewal_date']."; Email: ".$row['clients_email']." \n";

$headers = 'From: Work Pass Notification System <info@sparkkenya.com>' . "\r\n" .
    'Reply-To: Spark World Kenya' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

      if(mail($to, $subject, $emailBody, $headers)) {
          echo $emailBody;
          echo 'Email sent successfully!';
      } else {
          echo $emailBody;
          die('Failure: Email was not sent!');
      }

}

mysqli_close($connection);
?>
