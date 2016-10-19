<?php

$con = mysqli_connect("127.0.0.1", "root", "", "android");

if (mysqli_connect_errno($con)) {
    echo "0";
}
$username = $_POST['login'];
$password = $_POST['password'];
$result = mysqli_query($con, "SELECT count(*) as nbr FROM user where email='$username' and pwd='$password'");

$row = mysqli_fetch_array($result);
//echo "SELECT count(*) as nbr FROM admin where login='$username' and pwd='$password'"."<br>";

$data = $row[0];

if ($data) {
    echo $data;
} else {
    echo "0";
}
mysqli_close($con);
