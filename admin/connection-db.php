<?php

$myHost = "34.101.114.64";
$myUser = "koala";
$myPass = "Koala@123";
$myDbs = "lolodoks";


$koneksiDB = mysqli_connect($myHost, $myUser, $myPass, $myDbs);

if (! $koneksiDB){
    echo "Connection Failed!";
} else {
    echo "Connection Successfully!";
}
?>
