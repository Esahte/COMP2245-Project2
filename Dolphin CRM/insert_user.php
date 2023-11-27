<?php
include 'utils/function.php';
$conn = getConn();

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
$password = password_hash(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS), PASSWORD_DEFAULT);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_SPECIAL_CHARS);
$created_at = date('Y-m-d h:i');

$sql = $conn->exec("INSERT INTO users (firstname, lastname, password, email, role, created_at) VALUES('$firstname', '$lastname', '$password', '$email', '$role', '$created_at')");

header('Location: users.php');