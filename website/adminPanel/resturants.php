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

if(isset($_GET["freezeAccount"])){
    $email = $_GET["freezeAccount"];
    
     $sql="update as_resturants  set isActive='0' where id='$email'";
    
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
}

if(isset($_GET["openAccount"])){
    $email = $_GET["openAccount"];
    
     $sql="update as_resturants  set isActive='1' where id='$email'";
    
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
}

//booked rooms list
$query_bookedRoomsList = "select f.resId as id, f.resId, f.name, f.rating, f.lng, f.lat, f.isActive, f.timeAccountCreated, count(f.nCount) as 'nOrders'  from (
select r.id as resId, r.name, r.rating, r.lng, r.lat, r.isActive, r.timeAccountCreated, count(b.cartId) as nCount from as_resturants r left outer join as_booking b on r.id=b.resId group by b.cartId) as f group by f.name"; 


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

                  <h4 class="card-title ">Resturants</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        
                        <th>
                          Resturant Name
                        </th>
                        <th>
                          Rating
                        </th>
                        <th>
                          Account Created
                        </th>
                         <th>
                         People Served
                        </th>
                        <th>
                          Account Status
                        </th>
                        <th>
                         Freeze Account
                        </th>
                        <th>
                          Open Account
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
                                    echo "<td>".$row['rating']."</td>";
                                    echo "<td>".(date('d/m/Y H:i:s', $row['timeAccountCreated']))."</td>";
                                    echo "<td>".$row['nOrders']."</td>";
                                    if($row['isActive']=='1'){
                                        echo "<td>LIVE</td>";
                                    }
                                    if($row['isActive']=='0'){
                                        echo "<td>BLOCKED</td>";
                                    }
                                    echo '<td><a href="./resturants.php?freezeAccount='.$row['id'].'"><button class="btn btn-social btn-just-icon btn-google" style="background-color:orange;"><i class="material-icons">arrow_downward</i></button></a></td>';
                                    echo '<td><a href="./resturants.php?openAccount='.$row['id'].'"><button class="btn btn-social btn-just-icon btn-google" style="background-color:green;"><i class="material-icons">arrow_upward</i></button></a></td>';
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
