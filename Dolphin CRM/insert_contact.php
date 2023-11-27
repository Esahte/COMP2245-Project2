<?php
include 'utils/function.php';
session_start();
$conn = getConn();

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
$telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_SPECIAL_CHARS);
$company = filter_input(INPUT_POST, 'company', FILTER_SANITIZE_SPECIAL_CHARS);
$type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
$assigned_to = filter_input(INPUT_POST, 'assigned_to', FILTER_SANITIZE_SPECIAL_CHARS);
$created_by = $_SESSION['id'];
$created_at = date("F j, Y");
$updated_at = date("F j, Y");

$sql = $conn->prepare("SELECT * FROM Contacts WHERE email = :email");
$sql->execute(['email' => $email]);
$result = $sql->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT id FROM users WHERE CONCAT(firstname, ' ', lastname) LIKE :assigned_to");
$stmt->execute(['assigned_to' => "%$assigned_to%"]);
$assignee = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $update = [
        'title' => $title,
        'firstname' => $firstname,
        'lastname' => $lastname,
        'telephone' => $telephone,
        'company' => $company,
        'type' => $type,
        'assigned_to' => $assignee['id'],
        'updated_at' => $updated_at];
    $setClauses = [];
    foreach ($update as $key => $value) {
        if ($value) {
            $setClauses[] = " $key = '$value'";
        }
    }
    $sql = "UPDATE Contacts SET" . implode(',', $setClauses) . " WHERE email = '$email'";
    $conn->exec($sql);
} else {
    $assigned_to = $assignee['id'];
    $sql = $conn->exec("INSERT INTO Contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('$title', '$firstname', '$lastname', '$email', '$telephone', '$company', '$type', '$assigned_to', '$created_by', '$created_at', '$updated_at')");
}

