<?
ini_set('session.cookie_lifetime', 60 * 60 * 24 * 100);
ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 100);
ini_set('session.save_path', '/tmp');

session_start();

//maybe you want to precise the save path as well
include_once("database.php");

//maybe you want to precise the save path as well
//cheaking
if (isset($_SESSION['email'])&&isset($_SESSION['password']))
{
    $session_password = $_SESSION['password'];
    $session_email =  $_SESSION['email'];
    $session_role =  $_SESSION['role'];
    $session_name =  $_SESSION['name'];
    
    $query = "select * from as_resturants where email='$session_email' and password='$session_password'
    "; 
    $result = $con->query($query); 
    if ($result->num_rows > 0)
    { 
        while($row = $result->fetch_assoc()) 
        { 
            $session_name= $row['name'];
            $session_id= $row['id'];
            $session_rating= $row['rating'];
            $logged=1;
        }
    }
    else{
        $logged=0;
    }

    
}
?>