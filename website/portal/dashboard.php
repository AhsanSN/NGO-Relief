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

//number of rooms booked uptil now
$query = "select count(distinct cartId) as 'nBookings'
from  as_booking where resId='$session_id'
"; 
$result = $con->query($query); 
if ($result->num_rows > 0)
{ 
    while($row = $result->fetch_assoc()) 
    { 
        $nRoomsBookedTillNow= $row['nBookings'];
    }
}



//cash earned
$query = "select u.name, u.email, sum(b.quantity*m.price)as 'cost', b.timeAdded, b.timeDue from as_booking b INNER join as_menu m on b.itemId=m.id inner join as_users u on u.userIdTag=b.userIdTag WHERE b.resId='$session_id'";
    $result = $con->query($query); 
    if ($result->num_rows > 0)
    { 
        while($row = $result->fetch_assoc()) 
        { 
            $cost = $row['cost'];
        }
    }

//total resturants
$query = "select count(id) as 'nRes'
from   as_resturants
"; 
$result = $con->query($query); 
if ($result->num_rows > 0)
{ 
    while($row = $result->fetch_assoc()) 
    { 
        $nBookedRooms= $row['nRes'];
    }
}

//pending bookings
$query = "select count(distinct cartId) as 'nBookings'
from   as_booking where status != 'done'
"; 
$result = $con->query($query); 
if ($result->num_rows > 0)
{ 
    while($row = $result->fetch_assoc()) 
    { 
        $nExpiredRooms= $row['nBookings'];
    }
}

//booked rooms list
$query_bookedRoomsList = "select b.cartId, r.id, b.timeDue, b.timeAdded, b.status, u.name  as 'userName', r.name as 'resName' from   
as_booking b  LEFT outer join as_users u on u.userIdTag=b.userIdTag inner join as_resturants r on b.resId=r.id where status != 'done' and r.id='$session_id' group by b.cartId order by b.id desc
"; 


?>
  <body class="" onload="getLiveUpdates()">
      
  <div class="wrapper">
      <?include("./phpParts/sidebar.php")?>
    <div class="main-panel">
      <!-- Navbar -->
      <?include("./phpParts/navBar.php")?>
        
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
            <div class="alert alert-primary" role="alert" style="display:none;" id="pageReloadPop">
            Update detected. Page reloading...
        </div>
          
          <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Live Bookings</h4>
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
                        <tbody id="commentArea">
                          <?php
                          $result_bookedRoomList = $con->query($query_bookedRoomsList); 
                            if ($result_bookedRoomList->num_rows > 0)
                            { 
                                while($row = $result_bookedRoomList->fetch_assoc()) 
                                { 
                                    echo "<tr>";
                                    echo "<td>".$row['userName']."</td>";
                                    echo "<td>".$row['resName']."</td>";
                                    echo "<td>".date('Y/m/d H:i:s', $row['timeAdded'])."</td>";
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
                    <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">library_books</i>
                  </div>
                  <p class="card-category">Total Bookings</p>
                  <h3 class="card-title"><?echo $nRoomsBookedTillNow?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     Number of total bookings
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                  <p class="card-category">Sales</p>
                  <h3 class="card-title" id="nBookedRooms"><?echo $cost?>                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     Total Sales uptil now (PKR)
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">stars</i>
                  </div>
                  <p class="card-category">Rating</p>
                  <h3 class="card-title" id="nExpiredRooms"><?echo $session_rating?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     Current Rating
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">fastfood</i>
                  </div>
                  <p class="card-category">Food Items</p>
                  <h3 class="card-title"><?echo $nExpiredRooms?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                     Number of food items in resturant
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
  <script>
  
    var pData;
    function getLiveUpdates() {
      setInterval(function(){ fetchFromDB(); }, 3000);
    }
    
    function fetchFromDB(){
        console.log("fetched")
        getResturantsFromServer();
        
    }
    
    function getResturantsFromServer(){
        var InitiateGetTransactions = function(textIdInp, callback) // How can I use this callback?
         {
             var request = new XMLHttpRequest();
             request.onreadystatechange = function()
             {
                 if (request.readyState == 4 && request.status == 200)
                 {
                     callback(request.responseText); // Another callback here
                 }
                 if (request.readyState == 4 && request.status == 0)
                 {
                     console.log("no response for resturants") // Another callback here
                 }
             }; 
             request.open("POST", "https://game.anomoz.com/api/allSet/post/read_live_resturant_bookings.php?resId=<?echo $session_id?>");
             request.send();
         }
         
         var _this = this;
         var frameTransactions = function mycallback(data) {
           var dataParsed
           dataParsed = JSON.parse(data);
           if(dataParsed.message=="none"){
             console.log("no transactions")
           }
           else{
             var sampleTrans = dataParsed
               console.log(sampleTrans)
              if(JSON.stringify(pData)!=JSON.stringify(sampleTrans)){
                  //add to local storage
                  pData = sampleTrans
                  setupTable(sampleTrans)
                console.log("resturants storage updated", sampleTrans)
              }
              
           }
         }
         InitiateGetTransactions(1, frameTransactions); //passing mycallback as a method 
      }
      
      function setupTable(pData){
          //var a=$("#new_comment").val();
          $("#commentArea").empty()
            if (true){
                for (var i=0; i<pData.length; i++){
                    var username = pData[i].username;
                    var resturantName = pData[i].resturantName;
                    var timeAdded = pData[i].timeAdded;
                    var timeDue = pData[i].timeDue;
                    var status = pData[i].status;
                    var id = pData[i].id;
                    var cartId = pData[i].cartId;
                    var txt1 = '<tr><td>'+username+'</td><td>'+resturantName+'</td><td>'+timeAdded+'</td><td>'+timeDue+'</td><td>'+status+'</td><td><a href="./viewBooking.php?cartId='+cartId+'"><button class="btn btn-social btn-just-icon btn-google" style="background-color:green;"><i class="material-icons">chevron_right</i></button></a></td></tr>';
                    $("#commentArea").append(txt1);     // Append new elements
                }
            }
      }

</script>
</body>

                                    

</html>
