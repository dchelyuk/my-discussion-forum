<?php
global $host, $dbname, $username, $password;
include 'dbCredentials.php';
session_start();

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$userId = $_SESSION['userId'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['userImage'])) {
//    $username = trim($_POST['username']);
//    $pass = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $image = $_FILES['userImage'];

    $targetDirectory = "../uploads/";

    $targetFile = $targetDirectory . basename($image['name']);
    $imageFileType = $image['type'];

    if (!in_array($imageFileType, ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'])) {
        echo "Sorry, only JPG, PNG, & GIF files are allowed.";
    } elseif ($image['size'] > 10000000) {
        echo "Sorry, your file is too large.";
    } else {
        $imageFile = file_get_contents($image['name']);
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {

            $stmt = $conn->prepare("INSERT INTO userImages (userId, contentType, image) VALUES (:userId,
            :contentType, :imageData) ON DUPLICATE KEY UPDATE userId = VALUES(userId), contentType =
                VALUES(contentType), image = VALUES(image);");
            $stmt->bindParam(':userId', $userId);
            $stmt->bindParam(':contentType', $imageFileType);
            $stmt->bindParam(':imageData', $imageFile, PDO::PARAM_LOB);

            try {
                $stmt->execute();
                echo "Image inserted successfully.";
            } catch (PDOException $e) {
                echo "Error inserting image: " . $e->getMessage();
            }
        } else {
            echo "File upload failed";
        }
    }
} else {
    echo "Some error in file transfer";
}

if (file_exists($targetFile)) {
    if (unlink($targetFile)) {
        echo "File deleted successfully.";
    } else {
        echo "Error deleting file.";
    }
} else {
    echo "File does not exist.";
}

$conn = null;

header("Location: AccountPage.html");
exit;
