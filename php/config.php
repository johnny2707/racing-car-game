<?php
    if ($_SERVER['SERVER_NAME']=="localhost") {
        // Development/Local Server
        $bd_host="";
        $bd_user="";
        $bd_password="";
        $bd_database="";
    }
    else {
        // Production Server
        $bd_host="";
        $bd_user="";
        $bd_password="";
        $bd_database="";
    }
?>