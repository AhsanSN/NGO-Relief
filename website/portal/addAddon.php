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

if(isset($_GET["id"])){
    $childOf = $_GET["id"];
    $query = "select * from as_menu where id='$childOf'
    "; 
    $result = $con->query($query); 
    if ($result->num_rows > 0)
    { 
        while($row = $result->fetch_assoc()) 
        { 
            $childOfName= $row['name'];
            $childOfCategory= $row['category'];
        }
    }
}

if(isset($_POST["name"])&&isset($_POST["cost"])){
    $name = $_POST["name"];
    $cost = $_POST["cost"];
    $sql="insert into as_menu (`resturantId`, `name`, `price`, `about`, `image`, `category`, `childOf`) values ('$session_id', '$name', '$cost', 'addon', 'ignore', '$childOfCategory', '$childOf')";
            if(!mysqli_query($con,$sql))
            {
                echo "err";
            }
            else{
                ?>
                <script type="text/javascript">
                        window.location = "./foodItems.php";
                    </script>
                <?
            }
    
}

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

                  <h4 class="card-title ">Adding Addon to <b><?echo $childOfName?></b></h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form style="margin:12px;" method="post" action="" autocomplete="off" >
                     <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Addon Name</label>
                          <input id="studentIdBox"  name="name" type="text" class="form-control" placeholder="" required>
                        </div>
                       <div class="form-group col-md-6">
                          <label for="inputEmail4">Cost</label>
                          <input id="studentIdBox"  name="cost" type="number" class="form-control" placeholder="" required>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Add addon</button>
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
