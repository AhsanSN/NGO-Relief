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


if(isset($_POST["name"])&&isset($_POST["cost"])&&isset($_POST["description"])&&isset($_POST["category"])){
    $name = $_POST["name"];
    $cost = $_POST["cost"];
    $description = $_POST["description"];
    $category = $_POST["category"];


    //image handeling
    $filename = "none";
    $target_dir = "./itemImages/";
    $randomNo = md5(time().$session_id);
    $target_file = $target_dir ."A"."$randomNo". basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if($_FILES["fileToUpload"]["tmp_name"]!="") {
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    
    // Check if file already exists
    if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $filename=$target_file;
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "mp4" && $imageFileType != "avi") {
        echo "Sorry, only JPG, JPEG, PNG, MP4 & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            $filename=$target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    }
    
    if($filename!="none"){
            $sql="insert into as_menu (`resturantId`, `name`, `price`, `about`, `image`, `category`) values ('$session_id', '$name', '$cost', '$description', '$filename', '$category')";
            if(!mysqli_query($con,$sql))
            {
                echo "err";
            }
            
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

                  <h4 class="card-title ">Add Item to Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form style="margin:12px;" method="post" action="" autocomplete="off" enctype="multipart/form-data" >
                     <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Item Name</label>
                          <input id="studentIdBox"  name="name" type="text" class="form-control" placeholder="" required>
                        </div>
                       <div class="form-group col-md-6">
                          <label for="inputEmail4">Item Description</label>
                          <textarea id="studentIdBox"  name="description" type="text" class="form-control" placeholder="" required></textarea>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="inputEmail4">Item Cost (Rs. )</label>
                          <input id="studentIdBox"  name="cost" type="number" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Category</label>
                            <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1" name="category">
                              <option value="Meal">Meals</option>
                              <option value="Starter">Starters</option>
                              <option value="Beverages">Beverages</option>
                              <option value="Sweet Dishes">Sweet Dishes</option>
                            </select>
                          </div>
                      </div>
                      <div class="form-group col-md-6">
                          <label for="inputEmail4">Item Image</label>
                        </div>
                      <input class="btn btn-primary primary_btn rounded" style="background-color:#777;" type="file" name="fileToUpload" id="fileToUpload" required>
                      <button type="submit" class="btn btn-primary">Add Item</button>
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
