<div class="sidebar collapse">
    <div class="sidebar-content">
      <!-- User dropdown -->
      <div class="user-menu dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="uploads/users/avatar.png" alt="Userimage">
        <div class="user-info"><?php echo $profile_username ?> <span><?php echo $_SESSION['user'] ?></span></div>
        </a>
        
      </div>
      <!-- /user dropdown -->
      <!-- Main navigation -->
      <ul class="navigation">
        <li <?php if ($page=="dashboard"){ ?>class="active"<?php }?>><a href="dashboard"><span>Dashboard</span> <i class="icon-screen2"></i></a></li>

        <li <?php if ($mainpage=="customers"){ ?>class="active"<?php }?>><a href="#" class="expand" ><span>Customers</span> <i class="fa fa-address-book-o" aria-hidden="true"></i></a>
		<ul>
            <li <?php if ($page=="add-customer"){ ?>class="active"<?php }?>><a href="create-customer">Add Customer</a></li>
            <li <?php if ($page=="customers"){ ?>class="active"<?php }?>><a href="customers">View Customers</a></li>
          </ul>
		</li>
            <?php if($_SESSION['user']=="admin") { ?>

          <li <?php if ($mainpage == "reports"){ ?>class="active"<?php } ?>><a href="#"
                                                                               class="expand"><span>Reports</span> <i
                          class="fa fa-bar-chart" aria-hidden="true"></i></a>
              <ul>

                  <li <?php if ($page == "all-reports"){ ?>class="active"<?php } ?>><a href="all-reports">All Lists
                          Reports</a></li>
                  <li <?php if ($page == "paid-report"){ ?>class="active"<?php } ?>><a href="paid-report">Payments
                          Reports</a></li>

                  <li <?php if ($page == "sms-report"){ ?>class="active"<?php } ?>><a href="sms-report">SMS
                          Reports</a></li>

              </ul>
          </li>
      <?php
      }
          ?>
          <?php if($_SESSION['user']=="admin") { ?>
              <li <?php if ($mainpage == "users"){ ?>class="active"<?php } ?>><a href="#"
                                                                                 class="expand"><span>Users</span> <i
                              class="fa fa-users"></i></a>
                  <ul>

                      <li <?php if ($page == "add-user"){ ?>class="active"<?php } ?>><a href="create-user">Add User</a>
                      </li>
                      <li <?php if ($page == "users"){ ?>class="active"<?php } ?>><a href="users">View Users</a></li>
                  </ul>
              </li>
              <?php
          }
          ?>
          <?php if($_SESSION['user']=="admin") { ?>
              <li <?php if ($page == "settings"){ ?>class="active"<?php } ?>><a href="settings"><span>Settings</span> <i
                              class="fa fa-cogs" aria-hidden="true"></i></a></li>
              <?php
          }
          ?>
        
      </ul>
      <!-- /main navigation -->
    </div>
  </div>