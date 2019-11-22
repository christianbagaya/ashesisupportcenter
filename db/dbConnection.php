<?php

//database connection variables
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $dbname = "dm2021";

        $servername = "cs.ashesi.edu.gh";
        $username = "esther_oduro";
        $password = "esther_oduro";
        $dbname = "webtech_fall2019_esther_oduro";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
?>
