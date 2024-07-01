<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drink_shop";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

$sql = "SELECT id, name, price, image_url FROM menu_items";
$result = $conn->query($sql);

$menu_items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['image_url'] = htmlspecialchars($row['image_url']);
        $menu_items[] = $row;
    }
}
error_log("Menu items: " . print_r($menu_items, true));
echo json_encode($menu_items);
?>