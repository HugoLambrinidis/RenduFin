<?php
if(isset($_SESSION['flashBag'])){
    $type = $_SESSION['flashBag'][0]['type'];
    $message = $_SESSION['flashBag'][0]['message'];
    echo $type." - ".$message;
    unset($_SESSION['flashBag']);
}
