<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dolphin CRM</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&family=Roboto:wght@300;400;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="styles.css" media="screen"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="utils/functions.js" charset="utf-8"></script>
    <script src="index.js" charset="utf-8"></script>
    <script src="home.js" charset="utf-8"></script>
    <script src="contact_info.js" charset="utf-8"></script>
</head>
<body>
<header id="head">
    <img src="img/dolphin.png" alt="">
    <p>Dolphin CRM</p>
</header>
<main class="main">
    <section id="nav">
        <nav>
            <ul>
                <li><img src="img/home.svg" alt=""><a class="no_refresh" id="home" href="home.php">Home</a></li>
                <li><img src="img/user.svg" alt=""><a class="no_refresh" id="newContact" href="new_contact.php">New
                        Contact</a></li>
                <li><img src="img/users.svg" alt=""><a class="no_refresh" id="users" href="users.php">Users</a></li>
                <hr style="border-color: #ebedef">
                <li><img src="img/trace.svg" alt=""><a id="logout" href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </section>
    <section id="results">
        <?= include 'home.php'; ?>
    </section>
</main>
</body>
</html>