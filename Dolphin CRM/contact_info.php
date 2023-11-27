<?php
include 'utils/function.php';
session_start();
$conn = getConn();

$contactId = filter_input(INPUT_GET, 'contactId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


$comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_SPECIAL_CHARS);
$updated_at = date("F j, Y");
$created_at = date("F j, Y") . " at " . date("h:i a");
$userId = $_SESSION['id'];

if ($comment) {
    $sql = $conn->exec("UPDATE Contacts SET updated_at = '$updated_at' WHERE id = '$contactId'");
    $sql = $conn->exec("INSERT INTO notes (contact_id, comment, created_by, created_at) VALUES ('$contactId', '$comment', '$userId', '$created_at')");
}


$sql = $conn->prepare("SELECT CONCAT(Contacts.title, ' ', Contacts.firstname, ' ', Contacts.lastname) AS fullName, Contacts.email, Contacts.company, Contacts.telephone, Contacts.created_at, Contacts.updated_at, CONCAT(user2.firstname, ' ', user2.lastname) AS assigned_to, CONCAT(user1.firstname, ' ', user1.lastname) AS created_by 
FROM Contacts JOIN users user1 ON Contacts.created_by = user1.id JOIN users user2 ON Contacts.assigned_to = user2.id WHERE Contacts.id = :contactId");
$sql->execute(['contactId' => $contactId]);
$contact = $sql->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS fullName, notes.comment, notes.created_at FROM notes JOIN users ON notes.created_by = users.id WHERE notes.contact_id = :contactId");
$stmt->execute(['contactId' => $contactId]);
$notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div>
        <div>
            <img src="#" alt="">
            <h1><?= $contact['fullName'] ?></h1>
            <p>Created on <?= $contact['created_at'] ?> by <?= $contact['created_by'] ?></p>
            <p>Updated on <?= $contact['updated_at'] ?></p>
        </div>
        <div>
            <button><img src="#" alt=""><span>Assign to me</span></button>
            <button><img src="#" alt=""><span>Switch to Sales Lead</span></button>
        </div>
    </div>

    <div>
        <div>
            <h4>Email</h4>
            <p><?= $contact['email'] ?></p>
        </div>
        <div>
            <h4>Company</h4>
            <p><?= $contact['company'] ?></p>
        </div>
        <div>
            <h4>Phone</h4>
            <p><?= $contact['telephone'] ?></p>
        </div>
        <div>
            <h4>Assigned To</h4>
            <p><?= $contact['assigned_to'] ?></p>
        </div>
    </div>

    <div>
        <div>
            <img src="#" alt="">
            <h4>Notes</h4>
        </div>
        <hr>
        <div id="notes">
            <?php foreach ($notes as $note): ?>
                <h3><?= $notes['fullName'] ?> ?></h3>
                <p><?= $note['comment'] ?></p>
                <p><?= $note['created_at'] ?></p>
            <?php endforeach; ?>
        </div>
        <div>
            <form action="contact_info.php" method="post">
                <label for="comment">Add a note about <?= explode(" ", $contact['fullName'])[1] ?></label>
                <br>
                <textarea name="comment" id="comment" cols="40" rows="10" placeholder="Enter details here"></textarea>
                <button id="addNote" type="submit">Add Note</button>
            </form>
        </div>
    </div>
</section>

