<?php
function connection(){
    $conn = mysqli_connect('localhost', 'root', '', 'customer_info', '3307');
    if(!$conn){
        die("Failed to Connect Database!");
    }
    return $conn;
}
