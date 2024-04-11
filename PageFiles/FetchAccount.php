<?php
header('Content-Type: application/json');
global $host, $dbname, $username, $password;
include 'dbCredentials.php';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// TODO: Make userId get from mainpage when they click on the link to view Account
$userId = 2;

$user_id = $_GET['userId'] ?? null;

// Fetch post data
$stmt = $pdo->prepare("SELECT username, accountCreateDate, picture_url FROM Users WHERE userId = :userId;");
$stmt->execute(['userId' => $userId]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);

//echo $account;

$response = [
    'username' => $account['username'],
    'accountCreateDate' => $account['accountCreateDate'],
    'picture_url' => $account['picture_url']
];

echo json_encode($response);