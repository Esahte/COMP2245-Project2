<?php
include 'utils/function.php';
session_start();
$conn = getConn();

$filter = filter_input(INPUT_GET, 'filter', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'all';

if ($filter === 'all') {
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts");
    $stmt->execute();
} else if ($filter === 'assigned'){
    $user_id = $_SESSION['id'];
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts WHERE assigned_to = $user_id");
} else {
    $stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts WHERE type LIKE :filter");
    $stmt->execute(['filter' => "%$filter%"]);
}
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Company</th>
        <th>Type</th>
    </tr>
    </thead>
    <tbody id="result">
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= $contact['fullName'] ?></td>
            <td><?= $contact['email'] ?></td>
            <td><?= $contact['company'] ?></td>
            <td><?= $contact['type'] ?><a id="<?= $contact['id'] ?>" class="no_refresh"
                                          href="contact_info.php">View</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

