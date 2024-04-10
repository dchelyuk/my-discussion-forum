<?php
header('Content-Type: application/json');

$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// TODO: Make userId get from mainpage when they click on the link to view Account
$userId = 2;

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