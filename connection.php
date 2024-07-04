<?php 
    $db = new PDO('mysql:host=localhost;dbname=dietbuddy','root','');
    if($db)
    {
        // echo "Connected";
    }
    else
    {
        echo "Not Connected";
    }
?>