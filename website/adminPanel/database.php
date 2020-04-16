<?php

$host='localhost';
$username='anomozco_wp585';
$user_pass='d9oI0N=QgO#$';
$database_in_use='anomozco_wp585';

$con = mysqli_connect($host,$username,$user_pass,$database_in_use);
if (!$con)
{
    echo"not connected";
}
if (!mysqli_select_db($con,$database_in_use))
{
    echo"database not selected";
}
?>