<?php
 session_start();
include "db.php";

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $text = $_POST["text"] ?? '';

    if ($text == '') {
        die("text is empty");
    }

    $imageName = null;

    if (!empty($_FILES["image"]["name"])) {
        $imageName = time() . "_" . $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageName);
    }

    $stmt = $conn->prepare("INSERT INTO posts (text, image) VALUES (?, ?)");
    $stmt->bind_param("ss", $text, $imageName);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="shortcut icon" href="img/FascebookLogo.png" type="image/x-icon">
</head>
<body>
    <!-- header -->
    <header>
        <nav>
            <div class="LogoName" style="cursor: pointer;">
                <img src="img/FascebookLogo.png" alt="">
                <h1>acebook</h1>
            </div>
            <ul class="ulnav">
                <li>
                    <a href="">Profiles</a>
                </li>
                <li>
                    <a href="#cardpsot">Posts</a>
                </li>
                <li>
                    <a href="#">Settings</a>
                </li>
                <li>
                    <a href="#About">About</a>
                </li>
                <li>
                    <a href="#">###</a>
                </li>
            </ul>
            
            <div class="creatorslogotip">
                <span class="username">
        <?php if (isset($_SESSION['username'])): ?>
            <?= htmlspecialchars($_SESSION['username']) ?>
        <?php endif; ?>
    </span>
              <img src="img/Creators_logo.png" alt="" class="creatorlogo">  
            </div>
            
            
        </nav>
    </header>

    <!-- main -->
     <main>
        <div class="settingswindow ">
        <div class="btnregist btnsettings">Registrate</div>
        <form method="POST" style="margin:0;">
    <button type="submit" name="logout" class="btnregist btnsettings">
        Log Out
    </button>
</form>
            <button type="submit" class="btnlogin btnsettings">Login</button>
        </div>
        <form action="index.php" method="POST" class="navigatepannelmain" enctype="multipart/form-data">
            <ul>
                <li><a href="#">Posts</a></li>
                <li><a href="#">Group</a></li>
                <li><a href="#">Friends</a></li>
                <li>
                    <input type="text" name="search" id="search" placeholder="Search in Facebook">
                </li>
            </ul>
        </form>
            <button class="crtpst">Create Post +</button>
        <form action="index.php" method="GET" class="cardpsot" id="cardpsot">
            
            <?php
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");

while ($row = $result->fetch_assoc()):
?>

    <div class="card" data-id="<?= $row['id'] ?>">

        <div class="card-text">
            <img src="img/face.jpg" class="logoface" alt="">
            <p>News Production</p>
        </div>

        <div class="card-info">
            <p><?= htmlspecialchars($row["text"]) ?></p>
        </div>

        <?php if ($row["image"]): ?>
            <img src="uploads/<?= $row["image"] ?>" alt="">
        <?php endif; ?>

        <button type="button" class="morinfo">More Information</button>
        <button  class="deletebutton" type="button">X</button>
    </div>

<?php endwhile; ?>

        </form>
     </main>

     <!-- footer -->
      <footer>
        <form action="index.php" method="GET" class="footerform">
            <div class="first-column">
                <h2 id="About">About</h2>
                <p>Number: +48(58)-712-45-90</p>
                <p>Creator's Mail: creators@gmail.com</p>
                <p>Feedback and suggestions Mail: creators.feedback@gmail.com</p>
                <p>Collaboration & Advertising's Mail: creators.collab@gmail.com</p>
                <p>Info</p>
            </div>

            <img src="img/FAcebookimg.jpg" alt="">
        </form>
        <button onclick="logAction('CLICK_MORE_INFO')">More Information</button>
      </footer>
</body>
    <script src="maincode.js"></script>
</html>