<?php
include 'utils/function.php';
$conn = getConn();

$stmt = $conn->prepare("SELECT CONCAT(users.firstname, ' ', users.lastname) AS fullName, users.email, users.role, users.created_at FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="info">
    <div class="viewHead">
        <h2>Users</h2>
        <button><img src="img/plus.svg" alt=""><a class="no_refresh" href="new_user.php">Add User</a></button>
    </div>
    <div class="table">
        <table id="user_table">
            <thead>
            <tr>
                <th scope="col" >Name</th>
                <th scope="col" >Email</th>
                <th scope="col" >Role</th>
                <th scope="col" >Created</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <th scope="row"><?= $user['fullName'] ?></th>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

