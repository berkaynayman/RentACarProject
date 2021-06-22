<?php
session_start();
session_destroy();

Header("Location:http://localhost/RentACarProject/login.php");


?>