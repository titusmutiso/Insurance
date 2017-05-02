<?php
/**
 * Created by PhpStorm.
 * User: SparkWorld
 * Date: 3/27/2017
 * Time: 10:19 AM
 */
require 'includes/config.php';
//session



$type=$_REQUEST['type'];

$output = '';
switch($type)
{
    case 'all':
        //select all from customers
        $customer_query  = "SELECT * FROM sp_customers ORDER BY id DESC";
        $customer_res    = mysqli_query($connection,$customer_query);

        //file naming as per date exported
        $date_name = date("d-m-Y");
        $file_name  = fopen("$date_name - All_Users.csv", "w");
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=$date_name - All_Users.csv");


        if(mysqli_num_rows($customer_res)> 0)
        {
            fwrite($file_name,"\"Customer ID\",\"Client Names\",\"Date Started\",\"Renewal Date\",\"Phone Number\",\"Email Address\",\"Policy Type\",\"Company\",\"Status\",\"Date Created\"".PHP_EOL);
            while($customer_row = mysqli_fetch_array($customer_res))
            {
                $customer_id = $customer_row['id'];
                $customer_names = $customer_row['full_names'];
                $customer_start =  $customer_row['commencement_date'];
                $customer_renewal =  $customer_row['renewal_date'];
                //unused variables
                $customer_email = $customer_row['email_add'];
                $customer_phone = $customer_row['phone_no'];
                $customer_status= $customer_row['customer_status'];
                $customer_policy = $customer_row['type_of_policy'];
                $customer_company = $customer_row['company'];
                $date_created = $customer_row['date_created'];

                if($customer_status ==1){
                    echo'Active';
                }else{
                    echo'Suspended/Expired';
                }
                //$customer_application = $customer_row['app_type'];
//SELECT `id`, `first_name`, `middle_name`, `last_name`, `commencement_date`, `renewal_date`, `phone_no`, `email_add`, `type_of_policy`, `company`, `status`, `date_created`, `full_names` FROM `sp_customers` WHERE 1



                //write csv details for each single customer
                fwrite($file_name,"\"".$customer_id."\", \"".$customer_names."\",\"".$customer_start."\",\"".$customer_renewal."\",\"".$customer_phone."\",\"".$customer_email."\",\"".$customer_policy."\",\"".$customer_company."\",\"".$customer_status."\",\"".$date_created."\"".PHP_EOL);

            }
            //$output .= '</table>';

            //echo $output;
            fclose($file_name);
            readfile("$date_name - All_Users.csv");

        }

        break;
    case 'active':
        //select all with customer status 1
        //select all from customers
        $customer_query  = "SELECT * FROM sp_customers WHERE status=1 ORDER BY id DESC";
        $customer_res    = mysqli_query($connection,$customer_query);

        //file naming as per date exported
        $date_name = date("d-m-Y");
        $file_name  = fopen("$date_name - All_Active_Users.csv", "w");
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=$date_name - All_Active_Users.csv");


        if(mysqli_num_rows($customer_res)> 0)
        {
            fwrite($file_name,"\"Customer ID\",\"Client Names\",\"Date Started\",\"Renewal Date\",\"Phone Number\",\"Email Address\",\"Policy Type\",\"Company\",\"Status\",\"Date Created\"".PHP_EOL);
            while($customer_row = mysqli_fetch_array($customer_res))
            {
                $customer_id = $customer_row['id'];
                $customer_names = $customer_row['full_names'];
                $customer_start =  $customer_row['commencement_date'];
                $customer_renewal =  $customer_row['renewal_date'];
                //unused variables
                $customer_email = $customer_row['email_add'];
                $customer_phone = $customer_row['phone_no'];
                $customer_status= $customer_row['customer_status'];
                $customer_policy = $customer_row['type_of_policy'];
                $customer_company = $customer_row['company'];
                $date_created = $customer_row['date_created'];


                //$customer_application = $customer_row['app_type'];
//SELECT `id`, `first_name`, `middle_name`, `last_name`, `commencement_date`, `renewal_date`, `phone_no`, `email_add`, `type_of_policy`, `company`, `status`, `date_created`, `full_names` FROM `sp_customers` WHERE 1



                //write csv details for each single customer
                fwrite($file_name,"\"".$customer_id."\", \"".$customer_names."\",\"".$customer_start."\",\"".$customer_renewal."\",\"".$customer_phone."\",\"".$customer_email."\",\"".$customer_policy."\",\"".$customer_company."\",\"".$customer_status."\",\"".$date_created."\"".PHP_EOL);

            }
            //$output .= '</table>';

            //echo $output;
            fclose($file_name);
            readfile("$date_name - All_Active_Users.csv");

        }

        break;
    case 'expired':
        //select with customers status 0
        $customer_query  = "SELECT * FROM sp_customers WHERE status=0 ORDER BY id DESC";
        $customer_res    = mysqli_query($connection,$customer_query);

        //file naming as per date exported
        $date_name = date("d-m-Y");
        $file_name  = fopen("$date_name - All_Expired_Users.csv", "w");
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment; filename=$date_name - All_Expired_Users.csv");


        if(mysqli_num_rows($customer_res)> 0)
        {
            fwrite($file_name,"\"Customer ID\",\"Client Names\",\"Date Started\",\"Renewal Date\",\"Phone Number\",\"Email Address\",\"Policy Type\",\"Company\",\"Status\",\"Date Created\"".PHP_EOL);
            while($customer_row = mysqli_fetch_array($customer_res))
            {
                $customer_id = $customer_row['id'];
                $customer_names = $customer_row['full_names'];
                $customer_start =  $customer_row['commencement_date'];
                $customer_renewal =  $customer_row['renewal_date'];
                //unused variables
                $customer_email = $customer_row['email_add'];
                $customer_phone = $customer_row['phone_no'];
                $customer_status= $customer_row['customer_status'];
                $customer_policy = $customer_row['type_of_policy'];
                $customer_company = $customer_row['company'];
                $date_created = $customer_row['date_created'];


                //$customer_application = $customer_row['app_type'];
//SELECT `id`, `first_name`, `middle_name`, `last_name`, `commencement_date`, `renewal_date`, `phone_no`, `email_add`, `type_of_policy`, `company`, `status`, `date_created`, `full_names` FROM `sp_customers` WHERE 1



                //write csv details for each single customer
                fwrite($file_name,"\"".$customer_id."\", \"".$customer_names."\",\"".$customer_start."\",\"".$customer_renewal."\",\"".$customer_phone."\",\"".$customer_email."\",\"".$customer_policy."\",\"".$customer_company."\",\"".$customer_status."\",\"".$date_created."\"".PHP_EOL);

            }
            //$output .= '</table>';

            //echo $output;
            fclose($file_name);
            readfile("$date_name - All_Expired_Users.csv");

        }

        break;
}