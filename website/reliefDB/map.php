<?include_once("global.php");?>
<!DOCTYPE html>
<html lang="en">

<?include_once("./phpParts/head.php")?>
 <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
   integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
   crossorigin=""/>
   
    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
   integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
   crossorigin=""></script>
   
   
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
<script>
    var pointers_lat_lst = [];
    var pointers_lng_lst = [];
</script>
<?
$i = 0;


$query_pointers = "select * from CampaignBeneficiary_t cb inner join Beneficiary b on cb.BeneficiaryID=b.BeneficiaryID"; 
if(isset($_GET['filter-campaign'])){
    $_srch = $_GET['filter-campaign'];
    $query_pointers = "select * from CampaignBeneficiary_t cb inner join Beneficiary b on cb.BeneficiaryID=b.BeneficiaryID where CampaignID='$_srch'"; 
}
if(isset($_GET['filter-organization'])){
    $_srch = $_GET['filter-organization'];
    $query_pointers = "select * from CampaignBeneficiary_t cb inner join Beneficiary b on cb.BeneficiaryID=b.BeneficiaryID where cb.VolunteerID in (select v.VolunteerID from Volunteer v where v.Org_OrgID='$_srch')"; 
}





$result_pointers = $con->query($query_pointers); 
if ($result_pointers->num_rows > 0)
{ 
    while($row = $result_pointers->fetch_assoc()) 
    { 
        ?>
        <script>
            pointers_lat_lst[<?echo $i?>] = "<?echo $row['latitude']?>"
            pointers_lng_lst[<?echo $i?>] = "<?echo $row['longitude']?>"
        </script>
        <?
        $i +=1;
    }
}


$query_campaigns = "select * from Campaign
"; 
$result_campaigns = $con->query($query_campaigns); 

$query_organizations = "select * from Org
"; 
$result_organizations = $con->query($query_organizations); 


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

                  <h4 class="card-title ">Search by</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                             <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Campaigns
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                  <?
                                  if ($result_campaigns->num_rows > 0)
                                    { 
                                        while($row = $result_campaigns->fetch_assoc()) 
                                        { 
                                            ?>
                                            <li><a href="?filter-campaign=<?echo $row['CampaignID']?>"><?echo $row['Title']?></a></li>
                                            <?
                                        }
                                    }
                                    
                                    ?>
                                
                              </ul>
                            </div> 
                        </div>
                        
                        
                        <div class="col-md-4">
                             <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Organizations
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu">
                                  <?
                                  if ($result_organizations->num_rows > 0)
                                    { 
                                        while($row = $result_organizations->fetch_assoc()) 
                                        { 
                                            ?>
                                            <li><a href="?filter-organization=<?echo $row['OrgID']?>"><?echo $row['Name']?></a></li>
                                            <?
                                        }
                                    }
                                    
                                    ?>
                                
                              </ul>
                            </div> 
                        </div>
                        
                  </div>
                </div>
              </div>
                
                <hr>
                
                <div class="card">
                <div class="card-header card-header-primary">

                  <h4 class="card-title ">Maps</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                   
                   <style>
                       #mapid { height: 1000px; }
                   </style>
                   
                    <div id="mapid"></div>
                   
                  </div>
                </div>
              </div>
              
           
            </div>
          </div>
        </div>
      </div>
    </div>

    </div>
    <script>
       
       
       var mymap = L.map('mapid').setView([24.940787221611,67.094784148586], 11);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    //accessToken: 'your.mapbox.access.token'
		accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw' // non usare questo perchè è di LeafletJS http://leafletjs.com/examples/quick-start/example.html
}).addTo(mymap);

for (var i=0; i<=pointers_lat_lst.length; i++){
    temp = [pointers_lat_lst[i],pointers_lng_lst[i]];
    L.marker(temp).addTo(mymap);
}






    </script>
  
  

  <!--   Core JS Files   -->
  <?include("./phpParts/footer.php")?>
</body>

                                    

</html>
