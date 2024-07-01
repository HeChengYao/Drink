<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drink_shop";

// 創建連接
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連接
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$drink_id = $_POST['drink'];
$size = $_POST['size'];
$sugar = $_POST['sugar'];
$ice = $_POST['ice'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO orders (drink_id, size, sugar, ice, quantity) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssi", $drink_id, $size, $sugar, $ice, $quantity);

if ($stmt->execute()) {
    echo "訂單已成功提交！";
} else {
    echo "錯誤: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>