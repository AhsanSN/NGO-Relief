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
    if(($session_email=='admin@admin.admin')&&($session_password=='123')){
        $logged=1;
    }
    else{
        $logged=0;
    }
    
}
?>