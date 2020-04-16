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


if(isset($_POST["oldPassword"])){
    $newPassword = $_POST["newPassword"];
    $oldPassword = $_POST["oldPassword"];

if((!$newPassword)||(!$oldPassword)){
    $message = "Please insert both fields.";
    } 
else{ 

        //update room status
        $sql="update as_resturants set password='$newPassword' where password='$oldPassword' and email='$session_email '";
    
        if(!mysqli_query($con,$sql))
        {
        echo"can not";
        }
       
        ?>
    <script type="text/javascript">
            window.location = "./dashboard.php";
        </script>
    <?
        
}}

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
                <div class="card" style="margin-top: 40px;">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Change Password</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form style="margin:12px;" method="post" action="" autocomplete="off" >
                     <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Old Password</label>
                          <input id="studentIdBox"  name="oldPassword" type="password" class="form-control" placeholder="" required>
                        </div>
                       <div class="form-group col-md-6">
                          <label for="inputEmail4">New Password</label>
                          <input id="studentIdBox"  name="newPassword" type="password" class="form-control" placeholder="" required>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
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
