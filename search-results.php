<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session
session_start();
if(!isset($_SESSION['login_user']))
{
    header("Location: index");
}
$login_session=$_SESSION['login_user'];
$user_id = $_SESSION['id'];

//db config
require 'includes/config.php';
require 'user_profile.php';


//functions
require 'includes/functions.php';
//page name
$mainpage = 'customers';
$page = 'customers';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    //header
    require 'includes/header.php';
    //css
    require 'includes/css.php';

    ?>
</head>
<body class="sidebar-wide">
<!--navigation-->
<?php
//top navigation
require 'includes/top-menu.php';

?>
<!-- Page container -->
<div class="page-container">
    <!-- side bar-->
    <?php require 'includes/side-menu.php'; ?>
    <!--ennd of side bar-->
    <!-- Page content -->
    <div class="page-content">
        <!-- Page header -->
        <?php require 'includes/breadcrumb.php'; ?>
        <!-- end Page header-->
        <!-- Default panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="col-md-12">
                    <?php
                    if(isset($_POST['search'])) {
                    $date_from = $_POST['from'];
                    $date_to = $_POST['to'];
                    // $format = date_create_from_format('m/d/Y',$date_from);
                    $date_start = date_format($date_from,'d-m-Y');
                    $date_end = date_format($date_to,'d-m-Y');
                    //$application_type =$_POST['service'];
                    //$customer_status =$_POST['status'];
                    //SELECT * FROM `sp_customers` WHERE `commencement_date` >= '$date_from' AND commencement_date <= '$date_to'
                    $clients_query="SELECT * FROM `sp_customers` WHERE `commencement_date` BETWEEN '$date_start' AND '$date_end'";
                    //$sql="SELECT * FROM `sp_customers` WHERE DATE(`commencement_date`) >= '$date_from' AND DATE(`commencement_date`) <= '$date_to'";
                    //$clients_query  = mysqli_query($connection,$sql);
                    $clients_res    = mysqli_query($connection,$clients_query);
                    $clients_count  =   mysqli_num_rows($clients_res);

                    ?>
                <h6 class="panel-title">Default panel</h6>
                    <span class="pull-right">
              <div class="btn-group">
                <a href="export_excel?type=all&date-from=<?php echo $date_from ?>&date-to=<?php echo $date_to ?>" class="btn btn-primary"> Export All Policies </a>
                <a href="export_excel?type=active&date-from=<?php echo $date_from ?>&date-to=<?php echo $date_to ?>" class="btn btn-success"> Export Active Policies</a>
                <a href="export_excel?type=expired&date-from=<?php echo $date_from ?>&date-to=<?php echo $date_to ?>" class="btn btn-danger">Export Expired Policies</a>
                </div>
                    </span>
                </div>
            </div>
            <div class="panel-body">

                <p>
                    <h4><?php echo $clients_count ?> Results for Starting Dates<strong> <?php echo $date_from ?></strong> to <strong><?php echo  $date_to ?></strong></h4>
                </p>
                    <div class="table-responsive">
                        <table id="example-table" class="table table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox" > </th>

                                <th>Customer Name</th>
                                <th>Date of Registration</th>
                                <th>Date of Expiry</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Company</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>


                            <?php
                            if (mysqli_num_rows($clients_res) > 0) {

                                while($clients_row=mysqli_fetch_array($clients_res)) {

                                    $clients_names = $clients_row['full_names'];
                                    //$clients_mname = $clients_row['role'];
                                    $clients_company = $clients_row['company'];
                                    $commenced_date = $clients_row['commencement_date'];
                                    $expiry_date = $clients_row['renewal_date'];
                                    $clients_status = $clients_row['status'];
                                    $clients_phone= $clients_row['phone_no'];
                                    $clients_email= $clients_row['email_add'];

                                    $clients_id = $clients_row['id'];?>
                                    <tr>
                                        <td><input type="checkbox" > </td>
                                        <td><a href='view-customer?id=<?php echo $clients_id ?>'><?php echo $clients_names; ?></a></td>
                                        <td><?php echo $commenced_date; ?></td>
                                        <td><?php echo $expiry_date; ?></td>
                                        <td ><a href="mailto:<?php echo $clients_email; ?>"> <?php echo $clients_email; ?></a></td>
                                        <td ><a href="tel:<?php echo $clients_phone; ?>"> <?php echo $clients_phone; ?></a></td>
                                        <td><?php echo $clients_company; ?></td>
                                        <td ><?php if($clients_status==1){
                                                ?>
                                                <span class="label label-success"><a href="delete.php?id=<?php echo $clients_id ?>&type=deactivate" style="color: #fff; text-decoration: none">Active</a> </span></span>

                                            <?php }else{
                                                ?>
                                                <span class="label label-danger"><a href="delete.php?id=<?php echo $clients_id ?>&type=activate" style="color: #fff; text-decoration: none">suspended</a></span>
                                                <?php
                                            } ?></td>
                                        <td width="15%"><div class="btn-group"><a href='edit-customer?id=<?php echo $clients_id ?>' data-toggle="tooltip" title="Edit" data-placement="top" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> </a>
                                                &nbsp;<a href='delete?id=<?php echo $clients_id ?>&type=customers' data-toggle="tooltip" title="Delete" data-placement="top" onclick="return confirm('Are you sure you wish to move this record to trash?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> </a>
                                            </div>
                                        </td>
                                    </tr>


                                <?php }
                            }  else {
                                echo 'No Records';
                            }

                            ?>


                            </tbody>
                        </table>
                    </div>
                <?php

                }
                ?>
                



            </div>
        </div>
        <!-- /default panel -->

        <!--footer-->
        <?php require 'includes/footer.php'; ?>
    </div>
</div>

<!-- end Page container -->
<!--JS-->
<!-- end Page container -->
<!--JS-->
<?php require 'includes/js.php';?>
<script>
    //DataTables Initialization
    $(document).ready(function() {
        $('#example-table').dataTable();
    });
    $(document).ready(function() {
        $('#ongoing-table').dataTable();
    });
    $(document).ready(function() {
        $('#completed-table').dataTable();
    });

</script>
</body>
</html>

