<?include_once("global.php");?>
<?
if(isset($_POST['email'])&&isset($_POST['password'])){
    
    $name = mb_htmlentities(($_POST['name']));
    $RegistrationNo = mb_htmlentities(($_POST['regNo']));
    $ContactPerson = mb_htmlentities(($_POST['contactPerson']));
    $ContactNumber = mb_htmlentities(($_POST['contact']));
    $Address = mb_htmlentities(($_POST['address']));
    $email = mb_htmlentities(($_POST['email']));
    $password = mb_htmlentities( md5(md5(sha1( $_POST['password'])).'Anomoz'));
  
  
    $sql="INSERT INTO `Org`(`Name`, `RegisteredOn`, `RegistrationNo`, `ContactPerson`, `ContactNumber`, `Address`, `email`, `password`) VALUES ('$name', NULL, '$RegistrationNo', '$ContactPerson', '$ContactNumber', '$Address', '$email', '$password')";
    if(!mysqli_query($con,$sql))
    {
        echo "err";
    }else{
         $_SESSION['email'] = $email;
         $_SESSION['password'] = $password;
        ?>
        <script type="text/javascript">
            window.location = "./";
        </script>
        <?
    }
        
        
}
else{
    //do nothing
    1;
}



?>
<!DOCTYPE html>
<html lang="en">
<?include("./phpParts/head.php")?>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
     
      
    </div>
    <div class="main-panel">
      <!-- Navbar -->
 
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              
              <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">NGO Signup</h4>
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
                          <label for="inputEmail4">Registeration No.</label>
                          <input required name="regNo" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Contact Person</label>
                          <input required name="contactPerson" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Phone</label>
                          <input required name="contact" type="text" class="form-control" placeholder="">
                        </div>
                      </div>
                     <div class="form-row">
                         <div class="form-group col-md-6">
                          <label for="inputEmail4">Address</label>
                          <input required name="address" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Email</label>
                          <input required name="email" type="email" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-3">
                          <label for="inputEmail4">Password</label>
                          <input required name="password" type="password" class="form-control" placeholder="">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  <?include("./phpParts/footer.php")?>

</body>

</html>
