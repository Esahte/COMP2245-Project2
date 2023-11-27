<?php
include 'utils/function.php';
$conn = getConn();

$stmt = $conn->prepare("SELECT id, CONCAT(title, ' ', firstname, ' ', lastname) AS fullName, email, company, type, assigned_to FROM Contacts");
$stmt->execute();
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="info">
    <div class="viewHead">
        <h1>Dashboard</h1>
        <button><img src="img/plus.svg" alt=""><a class="no_refresh" href="new_contact.php">Add Contact</a></button>
    </div>
    <div class="table">
        <div>
            <div id="filter">
                <img src="img/filter.svg" alt="">
                <h4>Filter By:</h4>
                <ul>
                    <li><a class="cont_types active" id="all" href="home.php">All</a></li>
                    <li><a class="cont_types" id="sales" href="contacts.php">Sales Leads</a></li>
                    <li><a class="cont_types" id="support" href="contacts.php">Support</a></li>
                    <li><a class="cont_types" id="assigned" href="contacts.php">Assigned To Me</a></li>
                </ul>
            </div>

            <div id="homeResult">
                <table>
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Company</th>
                        <th scope="col">Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <th scope="row"><?= $contact['fullName'] ?></th>
                            <td><?= $contact['email'] ?></td>
                            <td><?= $contact['company'] ?></td>
                            <td><span class="<?= str_replace(' ', '_', $contact['type']) ?>"><?= $contact['type'] ?></span><a id="<?= $contact['id'] ?>"
                                                                       class="contactInfo"
                                                                       href="contact_info.php">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>