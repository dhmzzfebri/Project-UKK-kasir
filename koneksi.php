<?php
session_start();
$conn = new mysqli('localhost','root','','ukk');
if(!$conn){
    echo "database tidak terhubung";
}
?>