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
$mainpage ='';
$page = 'dashboard';


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
        <!--get counts-->
        <?php
        //get number of contacts
        $contacts_query  = "SELECT * FROM `sp_customers`";
        $contacts_res    = mysqli_query($connection,$contacts_query);
        $contacts_count  =   mysqli_num_rows($contacts_res);

        //number registers today
        $day_sql="SELECT * FROM `sp_customers` WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 DAY)";
        $day_results = mysqli_query($connection, $day_sql);
        $day_count = mysqli_num_rows($day_results);

        //this week
        $week_sql="SELECT * FROM `sp_customers` WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $week_results = mysqli_query($connection, $week_sql);
        $week_count = mysqli_num_rows($week_results);

        //this Month
        $month_sql="SELECT * FROM `sp_customers` WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
        $month_results = mysqli_query($connection, $month_sql);
        $month_count = mysqli_num_rows($month_results);

        //get number of contacts per designation
        //cio Expiring this Month

        $month_expiry= mysqli_query($connection,"SELECT * FROM sp_customers WHERE message = 0 AND renewal_date >= CURDATE() AND renewal_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY)");
        //$recipients = array();

        $expiry_count = mysqli_num_rows($month_expiry);


        //Weekly Contacts
        $active_query  = "SELECT * FROM `sp_customers` WHERE status=1";
        $active_res    = mysqli_query($connection,$active_query);
        $active_count  =   mysqli_num_rows($active_res);
        //suspended
        $suspended_query  = "SELECT * FROM `sp_customers` WHERE status=0";
        $suspended_res    = mysqli_query($connection,$suspended_query);
        $suspended_count  =   mysqli_num_rows($suspended_res);

        //count messages
        $message_query= mysqli_query($connection,"SELECT * FROM sp_message");
        $message_count = mysqli_num_rows($message_query);


        ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo $contacts_count ?>
                        </h3>
                        <p>
                            Contacts
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bag"></i>
                    </div>
                    <a href="customers" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo  $day_count ?>
                            <!--53<sup style="font-size: 20px">%</sup>-->
                        </h3>
                        <p>
                            Registered Today
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="customers" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>

                            <?php echo $week_count ?>
                        </h3>
                        <p>
                            Registered This Week
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="customers" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $month_count ?>
                        </h3>
                        <p>
                            <?php //echo date('Y-m-d',strtotime("-30 days")); ?>
                            Registered this Month
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="customers" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="clearfix"></div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                            <?php echo $expiry_count ?>
                        </h3>
                        <p>

                            Expiring this Month
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="all-reports.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>

                        <?php echo $active_count ?>
                    </h3>
                    <p>
                        Active Customers
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="all-reports.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            <?php echo  $suspended_count ?>
                            <!--53<sup style="font-size: 20px">%</sup>-->
                        </h3>
                        <p>
                           Inactive Customers
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="all-reports.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                            <?php echo  $message_count ?>
                            <!--53<sup style="font-size: 20px">%</sup>-->
                        </h3>
                        <p>
                            Messages
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="sms-report.php" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div><!-- ./col -->
        </div><!-- /.row -->





        <!-- /default panel -->

        <!--footer-->
        <?php require 'includes/footer.php'; ?>
    </div>
</div>

<!-- end Page container -->
<!--JS-->
<?php require 'includes/js.php';?>

</body>
</html>

