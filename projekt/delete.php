<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = isset($_POST["id"]) ? (int)$_POST["id"] : 0;

    if ($id <= 0) {
        die("Invalid ID");
    }


    $stmt = $conn->prepare("SELECT image FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && $row["image"]) {
        $path = "uploads/" . $row["image"];
        if (file_exists($path)) {
            unlink($path);
        }
    }

    
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "OK";
}
?>