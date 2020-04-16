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
$query_bookedRoomsList = "select b.timeDue, b.timeAdded, b.status, u.name  as 'userName', r.name as 'resName' , b.cartId from   
as_booking b  LEFT outer join as_users u on u.userIdTag=b.userIdTag inner join as_resturants r on b.resId=r.id  group by b.cartId order by b.id desc
"; 


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

                  <h4 class="card-title ">Bookings</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                          Username
                        </th>
                        <th>
                          Resturant Name
                        </th>
                        <th>
                          Date Added
                        </th>
                        <th>
                          Time Added
                        </th>
                        <th>
                          Time Due
                        </th>
                        <th>
                          Status
                        </th>
                        <th>
                          View
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
                                    echo "<td>".$row['userName']."</td>";
                                    echo "<td>".$row['resName']."</td>";
                                    echo "<td>".substr(date('d/m/Y H:i:s', $row['timeAdded']), 0, 10)."</td>";
                                    echo "<td>".substr(date('Y/m/d H:i:s', $row['timeAdded']), -9)."</td>";
                                    echo "<td>".$row['timeDue']."</td>";
                                    echo "<td>".$row['status']."</td>";
                                    echo '<td><a href="./viewBooking.php?cartId='.$row['cartId'].'"><button class="btn btn-social btn-just-icon btn-google" style="background-color:green;"><i class="material-icons">chevron_right</i></button></a></td>';
                                    echo "</tr>";
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
