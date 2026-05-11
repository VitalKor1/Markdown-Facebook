<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $text = $_POST["text"] ?? '';

    if ($text === '') {
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
    <link rel="shortcut icon" href="img/FascebookLogo.png" type="image/x-icon">
    <title>Facebook2</title>
    <link rel="stylesheet" href="CSS/addPost.css">

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
                    <a href="#">Profiles</a>
                </li>
                <li>
                    <a href="#">Posts</a>
                </li>
                <li>
                    <a href="#">Settings</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">###</a>
                </li>
            </ul>
            
            <div class="creatorslogotip">
              <img src="img/Creators_logo.png" alt="" class="creatorlogo">  
            </div>
            
            
        </nav>
      </header>

      <!-- main -->
       <main>

        <form action="addPost.php" method="POST" enctype="multipart/form-data">

    <div class="postCreator">

        <h2>Create Post</h2>

        <textarea name="text" placeholder="What's on your mind?" class="postText"></textarea>

        <div class="uploadSection">
            <label for="imageUpload" class="uploadBtn">Add Image</label>
            <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
        </div>

        <div class="previewContainer">
            <div class="imageWrapper">
                <img id="previewImage" src="" alt="">
                <span id="removeImage">✕</span>
            </div>
        </div>

        <div class="tagsSection">
            <select id="tagSelect">
                <option value="">Select tag...</option>
                <option value="Travel">Travel</option>
                <option value="Food">Food</option>
                <option value="Music">Music</option>
                <option value="Work">Work</option>
                <option value="Life">Life</option>
            </select>

            <div class="selectedTags"></div>
        </div>


        <button type="submit" class="postBtn">Post</button>

    </div>

</form>
           
       </main>

       <!-- footer -->
       
</body>
<script src="codeaddpost.js"></script>
</html>