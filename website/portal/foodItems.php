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

if(isset($_GET["deleteItem"])){
    $id = $_GET["deleteItem"];
    
     $sql="delete from as_menu where id='$id'";
    
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
}

//booked rooms list
$query_bookedRoomsList = "select f.id, f.name, f.about, f.price, f.category, f.image, a.name as 'addonOf',  IF(f.childOf!=0, 'YES', 'NO') as 'addon' from (select m.id,  m.name, m.about, m.price, m.category,  m.image, m.childOf from as_menu m where m.resturantId='1') as f left outer join as_menu a on a.id= f.childOf"

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

                  <h4 class="card-title ">Menu
                  <a href="./addItem.php"><button class="btn btn-social" style="background-color:green;">Add New Item</button></a>
                  </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                            Image
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          About
                        </th>
                        <th>
                          Price
                        </th>
                         <th>
                         Category
                        </th>
                        <th>
                         Addon
                        </th>
                        <th>
                          Delete
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
                                    echo '<td><img  width="70" height="50"  src="'.$row['image'].'" alt="image"></td>';
                                    echo "<td>".$row['name']."</td>";
                                    echo "<td>".$row['about']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    echo "<td>".$row['category']."</td>";
                                    if($row['addon']=='YES'){
                                        echo '<td><button class="btn btn-social " style="background-color:#6454f9;">'.$row['addonOf'].'</button></td>';
                                    }
                                    if($row['addon']=='NO'){
                                       echo '<td><a href="addAddon.php?id='.$row['id'].'"><button class="btn btn-social " style="background-color:green;">Add Addon</button></a></td>';
                                    }
                                    echo '<td><a href="./foodItems.php?deleteItem='.$row['id'].'"><button class="btn btn-social btn-just-icon btn-google" style="background-color:red;"><i class="material-icons">cancel</i></button></a></td>';
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
