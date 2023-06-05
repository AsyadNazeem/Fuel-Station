
<nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
          <a class="sidebar-brand" href="#">
            <span class="align-middle"> Admin Dashbord</span>
          </a>

          <ul class="sidebar-nav">
            <li class="sidebar-header">Pages</li>

            <li class="sidebar-item active">
              <?php $content= $_SESSION['content']='content';
            
            ?>

              <a class="sidebar-link" href="../admin/admin_dashboard.php">
                <i class="align-middle" data-feather="sliders"></i>
                <span class="align-middle">Dashboard</span>
              </a>
              
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../admin/users.php">
                <i class="align-middle" data-feather="user"></i>
                <span class="align-middle">Users</span>
              </a>
            </li>
              <li class="sidebar-item">
                  <a class="sidebar-link" href="../admin/filling_stations.php">
                      <i class="align-middle" data-feather="zap"></i>
                      <span class="align-middle">Filling station</span>
                  </a>
              </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../admin/fuel.php">
                <i class="align-middle" data-feather="droplet"></i>
                <span class="align-middle">Fuel price </span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../admin/Orders.php">
                <i class="align-middle" data-feather="message-square"></i>
                <span class="align-middle">Fuel Orders</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../../login.php">
                <i class="align-middle" data-feather="log-in"></i>
                <span class="align-middle">Sign In</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link" href="../../logout.php">
                <i class="align-middle" data-feather="user-plus"></i>
                <span class="align-middle">Logout</span>
              </a>
            </li>


          </ul>

          <div class="sidebar-cta">

          </div>
        </div>
        </nav>
