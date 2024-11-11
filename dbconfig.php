<?php
    $conn = new mysqli('localhost', 'root', '', 'attendance');
    if($conn -> error){
        echo 'Error: Connection was not successful';
    }
?>