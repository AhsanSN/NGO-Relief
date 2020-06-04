<?$filenameLink = basename($_SERVER['PHP_SELF']);
?>
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="./" class="simple-text logo-normal">
          Portal
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
          <li class="nav-item <?if($filenameLink=='data.php'){echo'active';}?>">
            <a class="nav-link" href="./campaigns.php">
              <i class="material-icons">list</i>
              <p>Campaigns</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='my_data.php'){echo'active';}?>">
            <a class="nav-link" href="./my_data.php">
              <i class="material-icons">list</i>
              <p>Data</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='map.php'){echo'active';}?>">
            <a class="nav-link" href="./map.php">
              <i class="material-icons">list</i>
              <p>Map</p>
            </a>
          </li>
          <!--
          <li class="nav-item <?if($filenameLink=='foodItems.php'){echo'active';}?>">
            <a class="nav-link" href="./foodItems.php">
              <i class="material-icons">fastfood</i>
              <p>Food Items</p>
            </a>
          </li>
          <li class="nav-item <?if($filenameLink=='settings.php'){echo'active';}?>">
            <a class="nav-link" href="./settings.php">
              <i class="material-icons">settings</i>
              <p>Settings</p>
            </a>
          </li>
          -->
        </ul>
      </div>
    </div>
