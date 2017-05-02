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
$mainpage = 'catalog';
$page = 'add-product';
//product ID
$product_id = $_GET['id'];

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
        <h6 class="panel-title">Default panel</h6>
      </div>
      <div class="panel-body">

          <?php
          //picck Script
          $view_result = mysqli_query($connection,"SELECT * FROM sp_products WHERE id ='$product_id'");

          // display records if there are records to display

          $view_row=mysqli_fetch_array($view_result);

          $product_name = $view_row['product_name'];
          $prod_desc= $view_row['product_desc'];
          $prod_brand= $view_row['brand'];
          $prod_status= $view_row['status'];
          $prod_price= $view_row['price'];
          $prod_img= $view_row['product_image'];
          $prod_serial= $view_row['serial_number'];
//SELECT `id`, `product_name`, `brand`, `serial_number`, `price`, `product_desc`, `product_image`, `status`, `date_created` FROM `sp_products` WHERE 1
          //script to update
          if (isset($_POST['update'])) {
              // get the form data

              $product_title = htmlentities($_POST['product_name'], ENT_QUOTES);
              $product_price = htmlentities($_POST['price'], ENT_QUOTES);
              $product_desc = htmlentities($_POST['product_desc'], ENT_QUOTES);
              $product_status = htmlentities($_POST['status'], ENT_QUOTES);
              $product_brand = htmlentities($_POST['brand'], ENT_QUOTES);
              $serial =1;
              //$product_logo = $_POST['product_image'];
              //Images
              //new code to upload image 1
              if($_FILES["product_image"]["name"]!=''){
                  //image extensions
                  $allowed_extension = array("jpg","png");
                  $ext =end(explode('.',$_FILES["product_image"]["name"]));
                  if(in_array($ext,$allowed_extension)){

                      //check image size 10mb
                      if($_FILES["product_image"]["size"]<10000000){
                          $name = substr($product_title, 0, 5).'-1'.'.'.$ext; //rename image
                          $product_logo= "uploads/products/".$name; //image path
                          move_uploaded_file($_FILES["product_image"]["tmp_name"],$product_logo);
                          //after upload
                          // header("Location:index.php?file-name=".$name."");





                      }else{
                          echo '<script>alert("Image Too Large")</script>';
                      }

                  }else{
                      echo '<script>alert("Invalid Image Extension")</script>';

                  }



              }else{
                  echo '<script>alert("Please Select Image 1")</script>';
              }


              $sql= "UPDATE `sp_products` SET `product_name`='$product_title',`brand`='$product_brand',`serial_number`='$serial',`price`='$product_price',`product_desc`='$product_desc',`product_image`='$product_logo',`status`='$product_status',`date_created`=NOW() WHERE id='$product_id'";

              if(mysqli_query($connection, $sql) === TRUE) {
                  echo '<div class="alert alert-success alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                           Product Updated successfully
                                        </div>';


              } else {
                  echo '<div class="alert alert-danger alert-dismissable">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                            Error while Updating Product
                                        </div>';
              }
          }

          ?>


          <form role="form" method="post" action="" enctype="multipart/form-data">

              <div class="col-lg-12">
                  <div class="form-group">
                      <label for="Slide-title">Product Name</label>
                      <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="<?php echo $product_name ?>">
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Price</label>
                      <input type="text" name="price" class="form-control" id="exampleInputEmail1" value="<?php echo $prod_price ?>">
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="Slide-title">Brand</label>
                      <select class="form-control" name="brand">

                          <option value="<?php echo $prod_brand ?>" SELECTED><?php echo $prod_brand ?></option>
                          <option value="Brand1">Brand 1</option>
                          <option value="Brand2">Brand 2</option>
                      </select>
                  </div>
              </div>




              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label>product Description</label>
                      <textarea rows="5" cols="5" class="form-control" name="product_desc" ><?php echo $prod_desc ?></textarea>
                  </div>
              </div>

              <div class="col-lg-6 col-md-6">
                  <div class="form-group">
                      <label for="Slide-desc">Status</label>
                      <select name="status" class="form-control">

                          <option value="<?php echo $prod_status ?>" selected><?php
                              if($prod_status==1){
                                  echo'Active';
                              }else{
                                  echo'InActive';
                              }

                              ?></option>
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>

                      </select>
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="exampleInputFile">Product Logo</label>
                      <input type="file" id="exampleInputFile" name="product_image" class="form-control" value="<?php echo $prod_img ?>">
                      <p class="help-block">Image Size Here (0 x 0)</p>
                  </div>
              </div>
              <div class="col-lg-6">
                  <div class="form-group">
                      <label for="exampleInputFile">Product Logo</label>
                      <img src="<?php echo $prod_img ?>" class="img-responsive"/>
                      <p class="help-block">Image Size Here (0 x 0)</p>
                  </div>
              </div>



              <div class="col-lg-12">
                  <button type="submit" name="update" class="btn btn-primary  btn-square pull-right">Update </button>
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
    </body>
</html>

