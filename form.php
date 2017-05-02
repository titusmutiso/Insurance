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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">Default panel</h6>
      </div>
      <div class="panel-body">
          <div class="stepwizard">
              <div class="stepwizard-row setup-panel">
                  <div class="stepwizard-step">
                      <a href="#step-1" type="button" class="btn btn-primary btn-circle btn-lg">1</a>
                      <p>Business Information</p>
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                      <p>Account Manager</p>
                  </div>
                  <div class="stepwizard-step">
                      <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                      <p>Transfer Information</p>
                  </div>
              </div>
          </div>
          <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
              <div class="row setup-content" id="step-1">
                  <div class="col-xs-12">

                      <h3> Business Information</h3>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Business Name <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text"  class="form-control" name="biz-name" placeholder="Enter Registered Business Name"  required/>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Business Type <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <select class="form-control" name="biz-type">
                                  <option>Select Business Type</option>
                                  <option> Sole-Proprietorship</option>
                                  <option>Partnership</option>
                                  <option>Limited Company</option>
                                  <option>Others</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Business Pin <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text" name="biz-pin"class="form-control" placeholder="Business PIN"  />

                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Business Operations / Services / Industry</label>
                              <input  maxlength="100" type="text"  name="biz-operation" class="form-control" placeholder="Eg. Salon, Hardware, Cafe"  />

                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Postal Address </label>
                              <input  maxlength="100" type="text"  name="biz-address" class="form-control" placeholder="Postal Address"  />

                          </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <div class="form-group">
                              <label class="control-label">Postal Code</label>
                              <input  maxlength="100" type="text"  name="biz-postal" class="form-control" placeholder="Postal Code"  />

                          </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <div class="form-group">
                              <label class="control-label">Town</label>
                              <input  maxlength="100" type="text"  name="biz-town" class="form-control" placeholder="Town"  />

                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">County</label>


                              <select name="county" class="form-control">
                                  <option>
                                      Select County
                                  </option>

                              </select>

                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Physical Location</label>
                              <input  maxlength="100" type="text"  name="biz-location" class="form-control" placeholder="Where your business is Located"  />

                          </div>
                      </div>


                      <div class="clearfix"></div>

                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                  </div>
              </div>

              <div class="row setup-content" id="step-2">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                          <h3> Account Manager</h3>
                      </div>


                      <div class="col-lg-2">
                          <div class="form-group">
                              <label class="control-label">First Name <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text"  name="fname"  class="form-control" placeholder="First Name " required />

                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label class="control-label">Middle Name </label>
                              <input  maxlength="100" type="text"  name="mname"  class="form-control" placeholder="Middle Name "  />

                          </div>
                      </div>
                      <div class="col-lg-2">
                          <div class="form-group">
                              <label class="control-label">Surname <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text"  name="lname"  class="form-control" placeholder="Surname "  required/>

                          </div>
                      </div>



                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Designation <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text"  name="designation" class="form-control" placeholder="Eg. Owner, MD, CFO etc"  />

                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-6 col-lg-3">
                          <div class="form-group">
                              <label class="control-label">National ID Number <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text" name="user-id-no" class="form-control" placeholder="National ID Number"  required/>

                          </div>
                      </div>
                      <div class="col-md-6 col-lg-3">
                          <div class="form-group">
                              <label class="control-label">Owner Mobile Number <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="text" name="mobile_no" class="form-control" value="<?php echo  $_SESSION['mobile_no']; ?>" onKeyPress="return numbersonly(this, event)" placeholder="Your Mobile Number"  required/>

                          </div>
                      </div>

                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">D.O.B <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <div class="clearfix"></div>
                              <div class="col-lg-4">
                                  <select name="dob-day" class="form-control">
                                      <option>Day</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                  </select>
                              </div>
                              <div class="col-lg-4">
                                  <select name="dob-month" class="form-control">
                                      <option value="00">Month</option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                  </select>
                              </div>
                              <div class="col-lg-4">
                                  <input type="text" class="form-control" name="dob-year" placeholder="eg. 1934" onKeyPress="return numbersonly(this, event)">

                              </div>
                          </div>
                      </div>
                      <div class="clearfix"></div>
                      <div class="col-md-12 col-lg-6 ">
                          <div class="form-group">
                              <label class="control-label">Official Email Address <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                              <input  maxlength="100" type="email" name="email" id="email" class="form-control" placeholder="Eg. info@simpay.co.ke" value="<?php echo $_SESSION['email'] ?>" required/>
                              <span id="result"></span>

                              <span class="text-danger"><strong>NB</strong> used to send or access  information on the online portal</span>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Application For : Choose ONE </label>
                              <div id="myRadioGroup">
                                  <div class="col-md-6 col-lg-6">
                                      <label >
                                          <input type="radio" name="biz-application" value="1" checked="true"/>Paybill Number
                                      </label>
                                  </div>
                                  <div class="col-md-6 col-lg-6">
                                      <label >
                                          <input type="radio" name="biz-application"  value="2"  />Buy Goods & Services

                                      </label>
                                  </div>
                                  <div class="clearfix"></div>
                                  <br>
                                  <div id="biz-application1" class="desc">
                                      <div class="form-group">
                                          <label class="control-label">Paybill Number Tariff : Choose One </label>
                                          <div class="">

                                              <div class="btn-group" data-toggle="buttons">

                                                  <label class="btn btn-success">
                                                      <input type="radio" name="biz-tariff" id="option2" autocomplete="off" value="Mgao">
                                                      Mgao
                                                  </label>

                                                  <label class="btn btn-success">
                                                      <input type="radio" name="biz-tariff" id="option1" autocomplete="off" value="BusinessBouquet">
                                                      Business Bouquet
                                                  </label>
                                                  <label class="btn btn-success">
                                                      <input type="radio" name="biz-tariff" id="option3" autocomplete="off" value="CustomerBouquet">
                                                      Customer Bouquet:
                                                  </label>
                                              </div>
                                              <p><strong>Pay bill Business Payments</strong> <br>
                                              <ul>
                                                  <li>
                                                      <span class="text-danger">Mgao Tariff </span> – split charges between customer and business
                                                  </li>
                                                  <li>
                                                      <span class="text-danger">Business Bouquet Tariff </span>- No charges to the business; customer bears all charges
                                                  </li>
                                                  <li>
                                                      <span class="text-danger">Customer Bouquet Tariff </span> - No charges to the customers; business bears all charges
                                                  </li>
                                              </ul>
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>

                      </div>



                      <div class="clearfix"></div>
                      <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
                  </div>
              </div>

              <div class="row setup-content" id="step-3">
                  <div class="col-xs-12">
                      <div class="col-md-12">
                          <h3>Transfer Information</h3>
                      </div>

                      <div class="col-md-4 col-lg-4">
                          <div class="form-group">
                              <div class="col-md-12 col-lg-12"> <label class="control-label">Select Payment Option(s) Here <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>

                              </div>
                              <div class="col-md-6 col-lg-6"><label >
                                      <input type="checkbox" name="mpesa-payment"   value="mpesa-payment" autocomplete="off">
                                      Mpesa
                                  </label></div>
                              <div class="col-md-6 col-lg-6">
                                  <label>
                                      <input type="checkbox" name="payment-option" value="bank-payment" autocomplete="off">
                                      Bank
                                  </label>
                              </div>


                          </div>
                      </div>


                      <div  >

                          <div class="col-md-4 col-lg-4">
                              <div class="form-group">
                                  <label class="control-label">Mobile Number </label>
                                  <input  maxlength="100" type="text"  name="biz-number" onKeyPress="return numbersonly(this, event)"  class="form-control" placeholder="Mobile Number" />

                              </div>
                          </div>
                          <div class="col-md-4 col-lg-4">
                              <div class="form-group">
                                  <label class="control-label">Mpesa Registered Name </label>
                                  <input  maxlength="100" type="text"  name="mpesa-name"   class="form-control" placeholder="Registered MPESA Name" />

                              </div>
                          </div>
                      </div>
                      <div >

                          <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                                  <label class="control-label">Bank Name </label>


                                  <select name="biz-bank" class="form-control" id="bank">
                                      <option>
                                          Select Bank
                                      </option>

                                  </select>

                              </div>
                          </div>

                          <div class="col-md-6 col-lg-6">
                              <div class="form-group">
                                  <label class="control-label">Bank Account Branch </label>

                                  <?php
                                  //$branch_query  = "select * from sp_banks_branches";
                                  //$branch_res    = mysqli_query($connection,$branch_query);

                                  ?>

                                  <select name="bank-branch" class="form-control" id="branches">
                                      <option>
                                          Select Bank Name First
                                      </option>

                                  </select>

                              </div>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Bank Account Name</label>
                              <input  maxlength="100" type="text"  name="biz-acc-name" class="form-control" placeholder="Bank Account Names" />

                          </div>
                      </div>

                      <div class="col-md-6 col-lg-6">
                          <div class="form-group">
                              <label class="control-label">Bank Account Number</label>
                              <input  maxlength="100" type="text"  name="biz-account" class="form-control" placeholder="Account Number"  />

                          </div>
                      </div>
                  </div>
                  <div class="clearfix"></div>

                  <h2>Next Of Kin</h2>
                  <div class="col-md-12 col-lg-4">
                      <div class="form-group">
                          <label class="control-label">Full Names</label>
                          <input  maxlength="100" type="text"  name="kin-name" class="form-control" placeholder="Full Names" />

                      </div>
                  </div>
                  <div class="col-md-12 col-lg-4">
                      <div class="form-group">
                          <label class="control-label">National ID</label>
                          <input  maxlength="100" type="text"  name="kin-id-no" class="form-control" placeholder="National ID Number" />

                      </div>
                  </div>
                  <div class="col-md-12 col-lg-4">
                      <div class="form-group">
                          <label class="control-label">Mobile Number</label>
                          <input  maxlength="100" type="text"  onKeyPress="return numbersonly(this, event)" name="kin-mobile" class="form-control" placeholder="Mobile Number"/>

                      </div>
                  </div>
                  <div class="clearfix"></div>
                  <h2>Proof Of Business Registration</h2>
                  <div class="col-md-12 col-lg-6 ">
                      <div class="form-group">
                          <label class="control-label">Attach A Copy Of National ID Front<span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                          <input  maxlength="100" type="file"  name="idno-front" class="form-control"   />


                      </div>
                  </div>
                  <div class="col-md-12 col-lg-6 ">
                      <div class="form-group">
                          <label class="control-label">Attach A Copy Of National ID Back<span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                          <input  maxlength="100" type="file"  name="idno-back"class="form-control"    />


                      </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                      <div class="form-group">
                          <label class="control-label">Attach A Copy Of Business PIN </label>
                          <input  maxlength="100" type="file" name="biz-pin-attach" class="form-control"  />

                      </div>
                  </div>

                  <div class="col-md-12 col-lg-6">
                      <div class="form-group">
                          <label class="control-label">Certificate Of Registration / BS Permit <span class="text-danger pull-right"><i class="fa fa-asterisk"></i></span></label>
                          <input  maxlength="100" type="file"  name="biz-reg-cert" class="form-control"  />

                      </div>
                  </div>
                  <div class="clearfix"></div>



                  <button class="btn btn-success btn-lg pull-right" type="submit" name="signup">Finish!</button>
              </div>
      </div>

        </form>
      </div>
    </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h6 class="panel-title">Default panel</h6>
            </div>
            <div class="panel-body">
          <div class="container">
              <div class="row">
                  <div class="col-lg-12">
                      <div id="rootwizard">
                          <div class="navbar">
                              <div class="navbar-inner">
                                  <div class="container">
                                      <ul>
                                          <li><a href="#tab1" data-toggle="tab">First</a></li>
                                          <li><a href="#tab2" data-toggle="tab">Second</a></li>
                                          <li><a href="#tab3" data-toggle="tab">Third</a></li>
                                          <li><a href="#tab4" data-toggle="tab">Forth</a></li>
                                          <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
                                          <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
                                          <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div id="bar" class="progress">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                              </div>
                          </div>

                          <div class="tab-content">
                              <div class="tab-pane" id="tab1">
                                  1
                              </div>
                              <div class="tab-pane" id="tab2">
                                  <p>
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
                                                  <label for="Slide-title">Postal Code</label>

                                                  <input class="form-control" type="text" name="postal_code" placeholder="00100"/>

                                              </div>
                                          </div>

                                          <div class="col-lg-6">


                                              <div class="form-group">
                                                  <label for="Slide-desc">Company Address</label>
                                                  <textarea name="address" class="form-control" ></textarea>
                                              </div>
                                          </div>
                                          <div class="col-lg-6 col-md-6">
                                              <div class="form-group">
                                                  <label>Company Description</label>
                                                  <textarea rows="5" cols="5" class="form-control" name="comp_desc"></textarea>
                                              </div>
                                          </div>

                                          <div class="col-lg-6 col-md-6">
                                              <div class="form-group">
                                                  <label for="Slide-desc">Status</label>
                                                  <select name="status" class="form-control">

                                                      <option value="1">Active</option>
                                                      <option value="0">Inactive</option>

                                                  </select>
                                              </div>
                                          </div>

                                          <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label for="exampleInputFile">Company Logo</label>
                                                  <input type="file" id="exampleInputFile" name="company_logo" class="form-control">
                                  <p class="help-block">Image Size Here (0 x 0)</p>
                              </div>
                          </div>



                          <div class="col-lg-12">
                              <button type="submit" name="save" class="btn btn-primary  btn-square pull-right">Submit</button>
                          </div>
                          </form>

                                  </p>
                              </div>
                              <div class="tab-pane" id="tab3">
                                  3
                              </div>
                              <div class="tab-pane" id="tab4">
                                  4
                              </div>
                              <div class="tab-pane" id="tab5">
                                  5
                              </div>
                              <div class="tab-pane" id="tab6">
                                  6
                              </div>
                              <div class="tab-pane" id="tab7">
                                  7
                              </div>
                              <ul class="pager wizard">
                                  <li class="previous first" style="display:none;"><a href="#">First</a></li>
                                  <li class="previous"><a href="#">Previous</a></li>
                                  <li class="next last" style="display:none;"><a href="#">Last</a></li>
                                  <li class="next"><a href="#">Next</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>


              </div>
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
        $(document).ready(function() {
            $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
                if(index==2) {
                    // Make sure we entered the name
                    if(!$('#name').val()) {
                        alert('You must enter your name');
                        $('#name').focus();
                        return false;
                    }
                }

                // Set the name for the next tab
                $('#tab3').html('Hello, ' + $('#name').val());

            }, onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard .progress-bar').css({width:$percent+'%'});
            }});
        });
    </script>
        <script>
            $(document).ready(function () {

                var navListItems = $('div.setup-panel div a'),
                    allWells = $('.setup-content'),
                    allNextBtn = $('.nextBtn');

                allWells.hide();

                navListItems.click(function (e) {
                    e.preventDefault();
                    var $target = $($(this).attr('href')),
                        $item = $(this);

                    if (!$item.hasClass('disabled')) {
                        navListItems.removeClass('btn-primary').addClass('btn-default');
                        $item.addClass('btn-primary');
                        allWells.hide();
                        $target.show();
                        $target.find('input:eq(0)').focus();
                    }
                });

                allNextBtn.click(function(){
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='url']"),
                        isValid = true;

                    $(".form-group").removeClass("has-error");
                    for(var i=0; i<curInputs.length; i++){
                        if (!curInputs[i].validity.valid){
                            isValid = false;
                            $(curInputs[i]).closest(".form-group").addClass("has-error");
                        }
                    }

                    if (isValid)
                        nextStepWizard.removeAttr('disabled').trigger('click');
                });

                $('div.setup-panel div a.btn-primary').trigger('click');
            });
            //check availabilty
            $(document).ready(function()
            {
                $("#email").keyup(function()
                {
                    var email = $(this).val();

                    if(email.length > 3)
                    {
                        $("#result").html('checking...');

                        /*$.post("username-check.php", $("#reg-form").serialize())
                         .done(function(data){
                         $("#result").html(data);
                         });*/

                        $.ajax({

                            type : 'POST',
                            url  : 'username-check.php',
                            data : $(this).serialize(),
                            success : function(data)
                            {
                                $("#result").html(data);
                            }
                        });
                        return false;

                    }
                    else
                    {
                        $("#result").html('');
                    }
                });

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                        $('#natid').attr('src', e.target.result);
                        $('#reg').attr('src', e.target.result);
                        $('#biz').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
            //display bank + mpesa
            $(document).ready(function() {
                $("input[name$='payment-option']").click(function() {
                    var test = $(this).val();

                    $("div.pay-option").hide();
                    $("#Pay" + test).show();
                });
            });


        </script>
    </body>
</html>

