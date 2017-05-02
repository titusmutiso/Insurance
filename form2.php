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



          <div class="container">
              <div class="row">
              <div class="col-md-12">
                  <section>
                      <div class="wizard">
                          <div class="wizard-inner">
                              <div class="connecting-line"></div>
                              <ul class="nav nav-tabs" role="tablist">

                                  <li role="presentation" class="active">
                                      <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                                      </a>
                                  </li>

                                  <li role="presentation" class="disabled">
                                      <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                                      </a>
                                  </li>
                                  <li role="presentation" class="disabled">
                                      <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                                      </a>
                                  </li>

                                  <li role="presentation" class="disabled">
                                      <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                                      </a>
                                  </li>
                              </ul>
                          </div>

                          <form role="form">
                              <div class="tab-content">
                                  <div class="tab-pane active" role="tabpanel" id="step1">
                                      <h3>Step 1</h3>
                                      <p>This is step 1</p>
                                      <ul class="list-inline pull-right">
                                          <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                      </ul>
                                  </div>
                                  <div class="tab-pane" role="tabpanel" id="step2">
                                      <h3>Step 2</h3>
                                      <p>This is step 2</p>
                                      <ul class="list-inline pull-right">
                                          <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                          <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                      </ul>
                                  </div>
                                  <div class="tab-pane" role="tabpanel" id="step3">
                                      <h3>Step 3</h3>
                                      <p>This is step 3</p>
                                      <ul class="list-inline pull-right">
                                          <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                          <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                          <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                                      </ul>
                                  </div>
                                  <div class="tab-pane" role="tabpanel" id="complete">
                                      <h3>Complete</h3>
                                      <p>You have successfully completed all steps.</p>
                                  </div>
                                  <div class="clearfix"></div>
                              </div>
                          </form>
                      </div>
                  </section>
              </div>
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
    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();

            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }
    </script>
    </body>
</html>

