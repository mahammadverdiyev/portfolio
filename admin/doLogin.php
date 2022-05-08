<?php

    include "../admin/loginUtil.php";

if(isset($_POST['username']) && isset($_POST['password']))
{
    include("../database.php");

    $username = trim(mysqli_real_escape_string($con,$_POST['username']));
    $password =  mysqli_real_escape_string($con,$_POST['password']);

    // check whether username exists in db or not
    $sql = "select * from admin where username = '{$username}'";
    runLogin($con, $sql, $password, $username,'dashboard.php','admin');

}
else{
    header("Location: login.php?username={$username}&code=1");
}
?>

