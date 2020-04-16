<?$filenameLink = basename($_SERVER['PHP_SELF']);
?>
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="./" class="simple-text logo-normal">
          Admin Panel
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?if($filenameLink=='dashboard.php'){echo'active';}?>  ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='bookings.php'){echo'active';}?>">
            <a class="nav-link" href="./bookings.php">
              <i class="material-icons">fastfood</i>
              <p>Bookings</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='resturants.php'){echo'active';}?>">
            <a class="nav-link" href="./resturants.php">
              <i class="material-icons">store</i>
              <p>Resturants</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='users.php'){echo'active';}?>">
            <a class="nav-link" href="./users.php">
              <i class="material-icons">people</i>
              <p>Users</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
