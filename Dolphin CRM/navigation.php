<?php
session_start();
?>

<nav>
    <ul>
        <li><img src="img/home_black_24dp.svg" alt=""><a class="no_refresh" id="home" href="home.php">Home</a></li>
        <li><img src="img/account_circle_black_24dp.svg" alt=""><a class="no_refresh" id="newContact"
                                                                   href="new_contact.php">New
                Contact</a></li>
        <li><?php if ($_SESSION['role'] === 'Admin'): ?><img src="img/supervisor_account_black_24dp.svg"
                                                             alt=""><?php else: ?>
                <img src="img/people_black_24dp.svg" alt=""><?php endif; ?><a class="no_refresh" id="users"
                                                                              href="users.php">Users</a></li>
        <hr style="border-color: #ebedef">
        <li><img src="img/logout_black_24dp.svg" alt=""><a id="logout" href="logout.php">Logout</a></li>
    </ul>
</nav>