<?php
session_start();

session_destroy();

header('Location: /COMP2245-Project2/Dolphin%20CRM/login.php');

