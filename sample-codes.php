<?php
/**
 * Created by PhpStorm.
 * User: SparkWorld
 * Date: 3/27/2017
 * Time: 4:21 PM
 */

//date intervals
require 'includes/config.php';

$query = "SELECT MAX(cast(id as decimal)) id FROM sp_customers ";
if($result = mysqli_query($connection,$query))
{
    $row = mysqli_fetch_assoc($result);

    $count = $row['id'];
    $count = $count+1;

     $code_no = str_pad($count, 4, "0", STR_PAD_LEFT);

     echo "CUS-".$code_no;
}