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




if(isset($_POST['title'])&&isset($_POST['desc'])){
    
    $title = mb_htmlentities(($_POST['title']));
    $desc = mb_htmlentities(($_POST['desc']));
    $start = mb_htmlentities(($_POST['start']));
    $end = mb_htmlentities(($_POST['end']));
    $cost = mb_htmlentities(($_POST['cost']));

  
    $sql="INSERT INTO `Campaign` (`CampaignID`, `TriggerEvent_TriggerEventID`, `Org_OrgID`, `CampaignType_CampaignTypeID`, `Title`, `Description`, `StartDate`, `EndDate`, `CostPerUnit`) VALUES (NULL, '1', '$session_id', '1', '$title', '$desc', '$start', NULL, '$cost');";
    if(!mysqli_query($con,$sql))
    {
        echo "err$start";
    }
        
        
}
else{
    //do nothing
    1;
}




//booked rooms list
$query_list = "select * from Campaign where Org_OrgID = $session_id 
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
            <div class="alert alert-primary" role="alert" style="display:none;" id="pageReloadPop">
            Update detected. Page reloading...
        </div>
          
          <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Add Campaign</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form style="margin:12px;" method="POST" action="">
                     <div class="form-row">
                         <div class="form-group col-md-2">
                          <label for="inputEmail4">Title</label>
                          <input required name="title" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputEmail4">Description</label>
                          <input required name="desc" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                          <label for="inputEmail4">Start Date</label>
                          <input required name="start" type="date" class="form-control" placeholder="">
                        </div>
                        
                        <div class="form-group col-md-2">
                          <label for="inputEmail4">CostPerUnit</label>
                          <input required name="cost" type="number" class="form-control" placeholder="">
                        </div>
                        <!--
                        <div class="form-group col-md-2">
                          <label for="inputEmail4">Role</label>
                          <input required name="role" type="text" class="form-control" placeholder="">
                        </div>
                        -->
                        <div class="form-group col-md-2">
                          <button type="submit" class="btn btn-primary">Add Campaign</button>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>
              
              
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Campaigns</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                          Title
                        </th>
                        <th>
                          Description
                        </th>
                        <th>
                          Start Date
                        </th>
                        <th>
                          End Date
                        </th>
                        <th>
                          Cost Per Unit
                        </th>
                      </thead>
                        <tbody id="commentArea">
                          <?php
                          $result_list = $con->query($query_list); 
                            if ($result_list->num_rows > 0)
                            { 
                                while($row = $result_list->fetch_assoc()) 
                                { 
                                    echo "<tr>";
                                    echo "<td>".$row['Title']."</td>";
                                    echo "<td>".$row['Description']."</td>";
                                    echo "<td>".$row['StartDate']."</td>";
                                    echo "<td>".$row['EndDate']."</td>";
                                    echo "<td>Rs. ".$row['CostPerUnit']."</td>";
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
