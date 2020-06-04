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
    $session_role =  'admin';
    $session_name =  $_SESSION['Name'];
    
    $query = "select * from Org where email='$session_email' and password='$session_password'
    "; 
    $result = $con->query($query); 
    if ($result->num_rows > 0)
    { 
        while($row = $result->fetch_assoc()) 
        { 
            $session_name= $row['Name'];
            $session_id= $row['OrgID'];
            $logged=1;
        }
    }
    else{
        $logged=0;
    }

    
}


if (!function_exists('mb_htmlentities')) {
    function mb_htmlentities($string, $hex = true, $encoding = 'UTF-8') {
        return htmlspecialchars($string);
        /**
        return preg_replace_callback('/[\x{80}-\x{10FFFF}]/u', function ($match) use ($hex) {
            return (sprintf($hex ? '&#x%X;' : '&#%d;', mb_ord($match[0])));
        }, $string);
        **/
    
    }
}
?>