<?include_once("global.php");?>
<!DOCTYPE html>
<html lang="en">

<?include_once("./phpParts/head.php")?>

<?
if ($logged==0){ 
    ?>
    <script type="text/javascript">
            window.location = "./";
        </script>
    <?
}

//booked rooms list
$query_bookedRoomsList = "select f.id, f.name, f.email, count(f.cartId) as 'nOrders' from (select u.id, u.name, u.email, count( b.cartId) as 'cartId' from as_users u inner join as_booking b on u.userIdTag=b.userIdTag GROUP by b.cartId) as f GROUP by f.name"; 


?>
  <body class="">
      
  <div class="wrapper">
      <?include("./phpParts/sidebar.php")?>
    <div class="main-panel">
      <!-- Navbar -->
      <?include("./phpParts/navBar.php")?>
        
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
      

          <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Users</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Total Bookings
                        </th>
                         
                        
                      </thead>
                        <tbody>
                          <?php
                          date_default_timezone_set("Asia/Karachi");
                          $result_bookedRoomList = $con->query($query_bookedRoomsList); 
                            if ($result_bookedRoomList->num_rows > 0)
                            { 
                                while($row = $result_bookedRoomList->fetch_assoc()) 
                                { 
                                    echo "<tr>";
                                    echo "<td>".$row['name']."</td>";
                                    echo "<td>".$row['email']."</td>";
                                    echo "<td>".$row['nOrders']."</td>";
                                
                                }
                            }
                          ?>
                          
                          
                        </tbody>
                      </table>
                     
                  </div>
                </div>
            </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
  
  

  <!--   Core JS Files   -->
  <?include("./phpParts/footer.php")?>
</body>

</html>
