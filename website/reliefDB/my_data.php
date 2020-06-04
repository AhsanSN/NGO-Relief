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



//booked rooms list
$query_list = "select  b.cnicImage, b.Name, b.Address, b.Phone, b.NIC, b.MonthlyIncome from CampaignBeneficiary_t cb inner join Beneficiary b on cb.BeneficiaryID=b.BeneficiaryID inner join Login l on l.LoginID=cb.VolunteerID where l.Org_OrgID= $session_id 
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

                  <h4 class="card-title ">My Collected Data</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    
                    
                    <table class="table">
                        <thead class=" text-primary">
                        <th>
                          Beneficiary Name
                        </th>
                        <th>
                          CNIC
                        </th>
                        <th>
                          Address
                        </th>
                        <th>
                          Phone
                        </th>
                        <th>
                          Income
                        </th>
                        <th>
                          CnicIMG
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
                                    echo "<td>".$row['Name']."</td>";
                                    echo "<td>".$row['NIC']."</td>";
                                    echo "<td>".$row['Address']."</td>";
                                    echo "<td>".$row['Phone']."</td>";
                                    echo "<td>Rs. ".$row['MonthlyIncome']."</td>";
                                    if($row['cnicImage']!='' && file_exists("./uploads/".$row['cnicImage'].".jpg")){
                                    ?>
                                    <td><a href="./uploads/<?echo $row['cnicImage']?>.jpg" target="_blank">View</a></td>
                                    <?
                                    }
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
