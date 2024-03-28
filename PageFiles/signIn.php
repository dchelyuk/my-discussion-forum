<?php
//signs user in, verifies passwords, and creates cookie of username. more cookies mnay be needed later
session_start();
$host = 'localhost:3306';
$dbname = 'db_75934729';
$username = '75934729';
$password = '75934729';
//TODO: what cookies are needed? investigate with sql databases and funtionality requirements
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM Users WHERE username = :username");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username']; 
            header("Location: MainPage.html");
            echo json_encode(['success' => true]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect username or password.']);
            exit;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}