<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//database
require 'includes/config.php';
//login - sessions

//functions
require 'includes/functions.php';

$id=$_REQUEST['id'];
$type=$_REQUEST['type'];
switch($type)
{
	//delete sliders
case 'user':
mysqli_query($connection,"delete from  sp_users where id=$id");
header("location:users.php");
break;	
case 'customers':
//delete projects
mysqli_query($connection,"delete from  sp_customers where id=$id");
header("location:customers.php");
break;
case 'projects':
//delete images
mysqli_query($connection,"delete from  sp_projects where id=$id");
header("location:projects.php");
break;
    case 'deactivate':
//delete images
        mysqli_query($connection,"UPDATE sp_customers SET status='0' where id=$id");
        header("location:customers.php");
        break;
    case 'activate':
//delete images
        mysqli_query($connection,"UPDATE sp_customers SET status='1' where id=$id");
        header("location:customers.php");
        break;

}



?>
