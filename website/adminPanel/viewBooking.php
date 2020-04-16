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

if(isset($_GET['cartId'])){
    $cartId = $_GET['cartId'];
    
    $query = "select u.name, u.email, sum(b.quantity*m.price)as 'cost', b.timeAdded, b.timeDue from as_booking b INNER join as_menu m on b.itemId=m.id inner join as_users u on u.userIdTag=b.userIdTag where b.cartId='$cartId'";
    $result = $con->query($query); 
    if ($result->num_rows > 0)
    { 
        while($row = $result->fetch_assoc()) 
        { 
            $name = $row['name'];
            $email = $row['email'];
            $cost = $row['cost'];
            $timeAdded = $row['timeAdded'];
            $timeDue = $row['timeDue'];
        }
    }
    $query_bookedRoomsList = "select b.cartId, m.name, m.about, m.price, b.quantity, m.category, (b.quantity*m.price)as 'cost' from as_booking b INNER join as_menu m on b.itemId=m.id where b.cartId='$cartId'"; 
    
}
//booked rooms list


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

                  <h4 class="card-title ">Booking Details</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        
                        <tbody>
                          <tr>
                              <td>Name: </td>
                              <td><?echo $name?></td>
                          </tr>
                          <tr>
                              <td>Phone Number: </td>
                              <td><?echo $email?></td>
                          </tr>
                          <tr>
                              <td>Booking Time: </td>
                              <td><?echo substr(date('d/m/Y H:i:s', $timeAdded), 0, 10)?> <?echo $timeDue?></td>
                          </tr>
                          <tr>
                              <td>Cost</td>
                              <td>Rs. <?echo $cost?></td>
                          </tr>
                        </tbody>
                      </table>
                     
                  </div>
                </div>
            </div>
                <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                          Dish
                        </th>
                        <th>
                          Quantity
                        </th>
                        <th>
                          Cost
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
                                    echo "<td>".$row['quantity']."</td>";
                                    echo "<td>".$row['cost']."</td>";
                                    echo "</tr>";
                                }
                            }
                          ?>
                          
                        </tbody>
                      </table>
                     
                  </div>
                  <br>
                  <div class="card-header card-header-success">
                    
                  <h4 class="card-title ">TOTAL COST: <b>RS. <?echo $cost?></b></h4>
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
