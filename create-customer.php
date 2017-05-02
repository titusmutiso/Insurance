<?php

/* 
 * To change this license header, choose License Headers in customerect Properties.
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
   $page = 'add-customer';


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
        <h6 class="panel-title">Add Customer</h6>
      </div>
      <div class="panel-body">
          <!--content here -->
          <?php
          //script to save
          if (isset($_POST['save'])) {
              // get the form data

              $customer_title = htmlentities($_POST['customer_name'], ENT_QUOTES);
              $middle_name = htmlentities($_POST['middle_name'], ENT_QUOTES);
              $last_name = htmlentities($_POST['last_name'], ENT_QUOTES);
              $full_names = htmlentities($customer_title." ".$middle_name." ".$last_name, ENT_QUOTES);
              $customer_number = htmlentities($_POST['phone_number'], ENT_QUOTES);
              $customer_email = htmlentities($_POST['email_add'], ENT_QUOTES);
              $customer_commence = htmlentities(date("Y-m-d",strtotime($_POST['start_date'])), ENT_QUOTES);
              $customer_expiry = htmlentities(date("Y-m-d",strtotime($_POST['expiry'])), ENT_QUOTES);
              $customer_status = htmlentities($_POST['status'], ENT_QUOTES);
              
              $cover = $_POST['cover'];
              //premium calculations & Details
              $customer_premium = $_POST['premium'];
              $paid_premium = $_POST['paid_amount'];
              $balance = $customer_premium - $paid_premium;
              $due_date = $_POST['due_date'];
              $date_paid = $_POST['paid_date'];

              //
              //$customer_policy = htmlentities($_POST['policy'], ENT_QUOTES);
              //$customer_policy2 = htmlentities($_POST['policy2'], ENT_QUOTES);
              //$customer_policy3 = htmlentities($_POST['policy3'], ENT_QUOTES);
              $customer_company = htmlentities($_POST['company'], ENT_QUOTES);

              $expire_date = date("d/m/Y", strtotime($expiry_date));

              //customer Number
              $cus_query = "SELECT MAX(cast(id as decimal)) id FROM sp_customers ";
              if($cus_result = mysqli_query($connection,$cus_query))
              {
                  $cus_row = mysqli_fetch_assoc($cus_result);

                  $cus_count = $cus_row['id'];
                  $cus_count = $cus_count+1;

                  $code_no = str_pad($cus_count, 4, "0", STR_PAD_LEFT);

                  $customer_code = "CUS-".$code_no;
              }


              //posting to DB
              $sql ="INSERT INTO `sp_customers`(`id`, `cust_number`,`first_name`,`middle_name`, `last_name`, `commencement_date`, `renewal_date`, `phone_no`, `email_add`,`company`,`cover`,`premium`, `status`, `date_created`, `full_names`,`message`) VALUES (NULL,'$customer_code','$customer_title','$middle_name','$last_name','$customer_commence','$customer_expiry','$customer_number','$customer_email','$customer_company','$cover','$customer_premium','$customer_status',NOW(),'$full_names',0)";




              if(mysqli_query($connection, $sql) === TRUE) {

                  foreach ($_POST['policy'] as $customer_policy)
                  {

                      $doquery = mysqli_query($connection,"INSERT INTO `sp_policies`(`id`,`policy`,`customer_id`,`date_created`)VALUES (NULL,'$customer_policy','$cus_count',NOW())");

                  }
                    if(empty($paid_premium)){
                    $pay_status = 0;
                  }else if($paid_premium == $customer_premium){
                    $pay_status = 2;
                  }else{
                    $pay_status = 1;
                  }

                  mysqli_query($connection,"INSERT INTO `premiums`(`id`, `customer_id`, `total_premium`, `paid_premium`, `balance`, `date_paid`, `balance_date`,`status`)VALUES(NULL,'$cus_count','$customer_premium','$paid_premium','$balance','$date_paid','$due_date','$pay_status')");

                  
                                         echo "<script language = javascript>
                swal({  title: 'Message Sent ',
                 text: 'Customer Created Successfully',  
                type: 'success', 
                timer :4000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true, }, 
                function(){   
                    setTimeout(function(){     
                        location = 'create-customer.php';  
                    });
                     });
            </script>";  


              } else {
                  echo "<script language = javascript>
                swal({  title: 'Creating Error ',
                 text: 'Error While Creating',  
                type: 'error', 
                timer :4000,   
                showCancelButton: false,   
                closeOnConfirm: false,   
                confirmButtonText: 'Accept', 
                showLoaderOnConfirm: true };
            </script>";  
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">First Name</label>
                      <input type="text" name="customer_name" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Middle Name (optional)</label>
                      <input type="text" name="middle_name" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="form-group">
                      <label for="Slide-title">Phone Number</label>
                      <input type="text" name="phone_number" class="form-control" id="exampleInputEmail1" placeholder="+254700000000">
                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Email Address</label>

                          <input class="form-control" type="email" name="email_add" placeholder="email@domain.com"/>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Commencement Date</label>

                      <!-- <input class="form-control" type="text" name="start_date" placeholder="date"/>-->
                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="start_date">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Expiry Date</label>

                      <!--<input class="form-control" type="text" name="expiry" placeholder="date"/>-->
                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="expiry">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>
                  </div>

              </div>
               <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Insurance Cover</label>

                     <select name="cover" class="form-control">
                       <option>Select Cover Here</option>
                       <option value="1">Car</option>
                       <option value="2">Medical Cover</option>
                       <option value="3">House </option>
                     </select>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Type of Policy</label>

                      <input class="form-control" type="text" name="policy[]" placeholder="KCB 200E "/>
                      <input class="form-control" type="text" name="policy[]" placeholder="KCB 200E "/>
                      <input class="form-control" type="text" name="policy[]" placeholder="KCH 800D"/>

                  </div>
              </div>
               <div class="col-lg-3">

                  <div class="form-group">
                      <label for="Slide-title">Premium (KSh.) </label>

                      <input class="form-control" type="text" name="premium" placeholder="10000"/>

                  </div>
              </div>
              <div class="col-lg-3">

                  <div class="form-group">
                      <label for="Slide-title">Premium Paid (KSh.) </label>

                      <input class="form-control" type="text" name="paid_amount" placeholder="10000"/>

                  </div>
              </div>
              <div class="col-lg-3">

                  <div class="form-group">
                      <label for="Slide-title">Date Paid </label>
                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="paid_date">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>

                  </div>
              </div>
              <div class="col-lg-3">

                  <div class="form-group">
                      <label for="Slide-title">Due Date (Balance Date) </label>
                      <div class="input-group date" data-provide="datepicker">
                          <input type="text" class="form-control" name="due_date">
                          <div class="input-group-addon">
                              <span class="fa fa-calendar"></span>
                          </div>
                      </div>

                  </div>
              </div>
              <div class="col-lg-4">

                  <div class="form-group">
                      <label for="Slide-title">Company</label>

                      <input class="form-control" type="text" name="company" placeholder="CIC"/>

                  </div>
              </div>
                 <div class="col-lg-4 col-md-4">
                  <div class="form-group">
                      <label for="Slide-desc">Status</label>
                      <select name="status" class="form-control">

                          <option value="1">Active</option>
                          <option value="0">Inactive</option>

                      </select>
                  </div>
              </div>




              <div class="col-lg-12">
              <button type="submit" name="save" class="btn btn-primary  btn-square pull-right">Submit</button>
              </div>
          </form>




      </div>
    </div>
    <!-- /default panel -->
            
      <!--footer-->
<?php require 'includes/footer.php'; ?>      
  </div>      
  </div>
        
        <!-- end Page container -->
        <!--JS-->
        <?php require 'includes/js.php';?>

        <script src="js/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script>
        $('.datepicker').datepicker();
    </script>

    </body>
</html>

