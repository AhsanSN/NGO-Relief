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




if(isset($_POST['email'])&&isset($_POST['password'])){
    
    $name = mb_htmlentities(($_POST['name']));
    $email = mb_htmlentities(($_POST['email']));
    $password = mb_htmlentities( md5(md5(sha1( $_POST['password'])).'Anomoz'));
  
  
    $sql="INSERT INTO `Login`(`LoginRole_LoginRoleID`, `Org_OrgID`, `UserName`, `Email`, `Pwd`) values ('1','$session_id', '$name', '$email', '$password')";
    if(!mysqli_query($con,$sql))
    {
        echo "err$session_id";
    }
        
        
}
else{
    //do nothing
    1;
}




//booked rooms list
$query_list = "select * from Login where Org_OrgID = $session_id 
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

                  <h4 class="card-title ">Add Volunteer</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form style="margin:12px;" method="POST" action="">
                     <div class="form-row">
                         <div class="form-group col-md-3">
                          <label for="inputEmail4">Name</label>
                          <input required name="name" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Email</label>
                          <input required name="email" type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Password</label>
                          <input required name="password" type="password" class="form-control" placeholder="">
                        </div>
                        <!--
                        <div class="form-group col-md-2">
                          <label for="inputEmail4">Role</label>
                          <input required name="role" type="text" class="form-control" placeholder="">
                        </div>
                        -->
                        <div class="form-group col-md-3">
                          <button type="submit" class="btn btn-primary">Add Volunteer</button>
                        </div>
                      </div>
                      
                    </form>
                  </div>
                </div>
              </div>
              
              
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Volunteers</h4>
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
                          Role
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
                                    echo "<td>".$row['UserName']."</td>";
                                    echo "<td>".$row['Email']."</td>";
                                    echo "<td>Volunteer</td>";
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
